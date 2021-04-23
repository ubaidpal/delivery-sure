<?php
/**
 *
 */
namespace App\Services;

use Carbon\Carbon;
use Dflydev\ApacheMimeTypes\PhpRepository;
use Illuminate\Support\Facades\Storage;
use App\StorageFile;

class StorageManager
{
    protected $disk;
    protected $File;

    function __construct() {
        $this->disk = Storage::disk('local');
    }

    public function storeFile($user_id, $file, $type, $parent_file_id = NULL, $child_type = NULL) {
        if(empty($user_id) || empty($type) || empty($file)) {
            return FALSE;
        }

        $path = $this->getPath($user_id, $type);

        if(isset($file->basename)) {
            $data[ 'name' ]      = $file->basename;
            $data[ 'extension' ] = $file->extension;
            $data[ 'size' ]      = rand(123, 999);
            $data[ 'mime_type' ] = $file->mime;
            $data[ 'hash' ]      = $file->encoded;
        } else {
            $data[ 'name' ]      = $file->getClientOriginalName();
            $data[ 'extension' ] = $this->getFileExtension($file);
            $data[ 'size' ]      = $file->getClientSize();
            $data[ 'mime_type' ] = $file->getMimeType();
            $data[ 'hash' ]      = sha1(file_get_contents($file));
        }

        $name = $this->getFilename($data[ 'extension' ]);

        $data[ 'storage_path' ] = $user_id . '/' . $name;

        $data[ 'user_id' ]     = $user_id;
        $data[ 'parent_type' ] = $type;

        $data[ 'parent_file_id' ] = $parent_file_id;
        $data[ 'type' ]           = $child_type;

        if(!$this->folderExists($path)) {
            $this->createDirectory($path);
        }

        $this->saveFile($path . $name, $file, $parent_file_id);

        return $data;
    }

    public function saveVideoThumbnail($user_id, &$image, $video_id) {
        $path = $this->getPath($user_id, 'video');
        $path = $path . 'thumbs' . DIRECTORY_SEPARATOR;
        if(!$this->folderExists($path)) {
            $this->createDirectory($path);
        }
        $info                   = pathinfo($image);
        $file_name              = $this->getFilename('jpg');
        $path                   = $path . $file_name;
        $data[ 'parent_type' ]  = 'video';
        $data[ 'parent_id' ]    = $video_id;
        $data[ 'storage_path' ] = $path;
        $data[ 'extension' ]    = $info[ 'extension' ];
        $data[ 'name' ]         = 'video thumb';
        $data[ 'mime_type' ]    = 'image/jpeg';
        $data[ 'user_id' ]      = $user_id;
        $data[ 'size' ]         = filesize($image);
        $data[ 'hash' ]         = hash('sha256', $image);
        $data[ 'type' ]         = 'video_thumb';

        $this->saveFile($path, $image);

        return $data;
    }

    public function getFileExtension($file) {
        $extension = $file->getClientOriginalExtension();
        if(!$extension) {
            $extension = $file->guessClientExtension();
        }
        if(!$extension) {
            $extension = $file->getExtension();
        }
        return $extension;
    }

    public function copyFromURL($user_id, $link, $type) {
        if(empty($user_id) || empty($type) || empty($link)) {
            return FALSE;
        }

        $path_info = pathinfo($link);
        $path      = $this->getPath($user_id, $type);

        $data[ 'name' ]      = $path_info[ 'basename' ];
        $data[ 'extension' ] = $path_info[ 'extension' ];

        $name                   = $this->getFilename($data[ 'extension' ]);
        $data[ 'storage_path' ] = $user_id . '/' . $name;

        $this->saveFile($path . $name, $link);

        $data[ 'size' ] = $this->getFileSize($path . $name);

        $data[ 'mime_type' ] = $this->getMimeType($path . $name);

        $data[ 'user_id' ] = $user_id;

        $data[ 'parent_type' ] = 'link';

        $data[ 'hash' ] = sha1(file_get_contents($link));

        return $data;
    }

    public function getPath($user_id, $type) {
        if($type == 'audio') {
            $path = 'audios';
        } elseif($type == 'video') {
            $path = 'videos';
        } elseif($type == 'album_photo' || $type == 'link') {
            $path = 'photos';
        } elseif($type == 'attachment') {
            $path = 'attachments';
        } elseif($type == 'deposit_slip') {
            $path = 'deposit_slips';
        } elseif('attachment_thumb') {
           return $path = 'attachment_thumb'.DIRECTORY_SEPARATOR;
        }

        return $path . DIRECTORY_SEPARATOR . $user_id . DIRECTORY_SEPARATOR;
    }

    public function getFile($type, $name,$imageType = null) {

        if(empty($name) || empty($type)) {
            return FALSE;
        }
        if($type == 'banners') {
            $path = 'banners';
        } elseif($type == 'admin_main_categories') {
            $path = 'admin_main_categories';
        } elseif($type == \Config::get('constants.IMAGE_TYPES.PRODUCT_IMAGES')) {
            $path = \Config::get('constants.IMAGE_TYPES.PRODUCT_IMAGES');
        } elseif($type == 'attachment') {
            $path = 'attachment';
        } elseif($type == 'video_thumb') {
            $path = '';
        } elseif($type == 'deposit_slip') {
            $path = 'deposit_slips';
        } else{
            $path = $type;
        }
        if(!is_null($imageType)){
            $path = $path . DIRECTORY_SEPARATOR .$imageType. DIRECTORY_SEPARATOR . $name;
        }else{
            $path = $path . DIRECTORY_SEPARATOR . $name;
        }

        if($this->disk->has($path)){
            return $this->disk->get($path);
        }

        return $this->disk->get($path . DIRECTORY_SEPARATOR . $name);
    }

    public function getFileByPath($path) {
        return $this->disk->get($path);
    }

    public function getFilename($extension) {
        return str_replace('.', '_', time() . uniqid(30, TRUE)) . '.' . $extension;
    }

    protected function folderExists($path) {
        return $this->disk->exists($path);
    }

    public function pathExists($path) {
        return $this->disk->exists($path);
    }

    protected function cleanFolder($folder) {
        return '/' . trim(str_replace('..', '', $folder), '/');
    }

    public function createDirectory($folder, $mode = 0777, $recursive = TRUE) {
        return $this->disk->makeDirectory($folder, $mode, $recursive);
    }

    public function getMimeType($path) {
        return $this->disk->mimeType($path);
    }

    public function getFileSize($path) {
        return $this->disk->size($path);
    }

    public function saveFile($path, $content, $parent_file_id = 0) {
        $path = $this->cleanFolder($path);

        if($this->disk->exists($path)) {
            return "File already exists.";
        }

        if($parent_file_id > 0) {
            return $this->disk->put($path, $content);
        } else {
            return $this->disk->put($path, file_get_contents($content));
        }

    }

    public function deletFile($path) {
        return $this->disk->delete($path);
    }
}
