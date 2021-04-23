<?php
/**
 * Created by   :  Muhammad Yasir
 * Project Name : demedat
 * Product Name : PhpStorm
 * Date         : 27-Jun-16 12:08 PM
 * File Name    : GenerateThumb.php
 */

namespace App\Traits;

use App\Attachment;
use App\Services\StorageManager;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

trait GenerateThumb
{
    protected $disk;

    public function getDisks() {
        return Storage::disk('local');
    }

    public function generate_thumb($file, $file_id, $user_id, $type, $width, $height = NULL, $aspectRatio = FALSE) {

        $sm   = new StorageManager();
        $path = $sm->getPath($user_id, $type);
        // $name = $this->getFilenames($this->getFileExtensions($file));
        $name      = $this->getFilenames($file[ 'extension' ]);
        $file_path = \Config::get('constant_settings.ATTACHMENT_PATH') . '/app/' . $file[ 'storage_path' ];

        $image = Image::make($file_path)->encode('jpg');
        if($aspectRatio) {
            $image->resize($width, NULL, function ($constraint) {
                $constraint->aspectRatio();
            });
        } else {
            $image->resize($width, $height);
        }

        /*if(!$this->folderExist($path)) {
            $this->createFolder($path);
        }*/
        $path = storage_path('app' . DIRECTORY_SEPARATOR . $path);
        if(!file_exists($path)) {
            if(!mkdir($path, 0777, TRUE)) {
                $path = '';
            }
        }
        $storage_path = $type . '/' . $name;
        $path         = $path . $name;
        //$path         = $this->cleanFolders($path);

        $image->save($path);

        $values = ['parent_file_id' => $file_id, 'type' => $type, 'user_id' => $user_id, 'storage_path' => $storage_path];

        if(isset($image->basename)) {
            $data[ 'name' ]      = $image->basename;
            $data[ 'extension' ] = $image->extension;
            $data[ 'size' ]      = rand(123, 999);
            $data[ 'mime_type' ] = $image->mime;
            $data[ 'hash' ]      = '';//$image->encoded;
        } else {
            $data[ 'name' ]      = $image->getClientOriginalName();
            $data[ 'extension' ] = $this->getFileExtensions($image);
            $data[ 'size' ]      = $image->getClientSize();
            $data[ 'mime_type' ] = $image->getMimeType();
            $data[ 'hash' ]      = '';//hash('sha256',$image);
        }
        $this->save_file($values, $data);
    }

    private function getFilenames($extension) {
        return str_replace('.', '_', time() . uniqid(30, TRUE)) . '.' . $extension;
    }

    public function getFileExtensions($file) {
        $extension = $file->getClientOriginalExtension();
        if(!$extension) {
            $extension = $file->guessClientExtension();
        }
        if(!$extension) {
            $extension = $file->getExtension();
        }
        return $extension;
    }

    protected function cleanFolders($folder) {
        return trim(str_replace('..', '', $folder), '/');
    }

    protected function folderExist($path) {
        return $this->getDisks()->exists($path);
    }

    public function createFolder($folder, $mode = 0777, $recursive = TRUE) {
        return $this->getDisks()->makeDirectory($folder, $mode, $recursive);
    }

    public function save_file($data, $image) {
        $sfObj = new Attachment();

        $sfObj->parent_file_id = isset($data[ 'parent_file_id' ]) ? $data[ 'parent_file_id' ] : NULL;
        $sfObj->type           = isset($data[ 'type' ]) ? $data[ 'type' ] : NULL;
        $sfObj->parent_id      = isset($data[ 'parent_id' ]) ? $data[ 'parent_id' ] : NULL;
        $sfObj->parent_type    = isset($data[ 'parent_type' ]) ? $data[ 'parent_type' ] : NULL;
        $sfObj->user_id        = $data[ 'user_id' ];
        $sfObj->storage_path   = $data[ 'storage_path' ];
        $sfObj->extension      = $image[ 'extension' ];
        $sfObj->name           = $image[ 'name' ];
        $sfObj->mime_type      = $image[ 'mime_type' ];
        $sfObj->size           = $image[ 'size' ];
        $sfObj->hash           = $image[ 'hash' ];
        $sfObj->save();
    }

    public function profileThumbs($data, $height, $width, $directory,$type) {
        $file_path = \Config::get('constant_settings.ATTACHMENT_PATH') . '/app/' . $data[ 'result' ];

        $image = Image::make($file_path)->encode('jpg');
        $image->resize($width, $height);

        $path = storage_path('app' . DIRECTORY_SEPARATOR . $directory . DIRECTORY_SEPARATOR . $type. DIRECTORY_SEPARATOR);

        if(!file_exists($path)) {
            if(!mkdir($path, 0777, TRUE)) {
                $path = '';
            }
        }
        $path         = $path . $data['file_name'];
        //$path         = $this->cleanFolders($path);

        $image->save($path);

    }
}
