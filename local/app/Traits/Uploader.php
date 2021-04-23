<?php
/**
 * Created by   :  Muhammad Yasir
 * Project Name : shalmi
 * Product Name : PhpStorm
 * Date         : 02-May-16 2:32 PM
 * File Name    : Uploader.php
 */

namespace App\Traits;

use App\Attachment;
use Storage;

trait Uploader
{
    protected function storeFile($file, $type, $detail = FALSE) {
        $path = $type;

        $name = $this->getFilename($file);
        if(!$this->folderExists($path)) {
            $this->createDirectory($path);
        }
        $path = $path . '/' . $name;
        $data = [];
        if($detail) {
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
            $data[ 'storage_path' ] = $path;
        }

        $this->saveFile($path, $file);

        if($detail) {
            return $data;
        }
        return $path;
    }

    protected function getFileName($file) {
        if(isset($file->basename)) {
            $data[ 'name' ]      = $file->basename;
            $data[ 'extension' ] = $file->extension;

        } else {
            $data[ 'name' ]      = $file->getClientOriginalName();
            $data[ 'extension' ] = $this->getFileExtension($file);

        }

        return str_replace('.', '_', time() . uniqid(30, TRUE)) . '.' . $data[ 'extension' ];
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

    protected function folderExists($path) {
        return $this->getDisk()->exists($path);
    }

    public function getDisk() {
        return Storage::disk('local');
    }

    public function createDirectory($folder, $mode = 0777, $recursive = TRUE) {
        return $this->getDisk()->makeDirectory($folder, $mode, $recursive);
    }

    public function saveFile($path, $content, $parent_file_id = 0) {
        $path = $this->cleanFolder($path);

        if($this->getDisk()->exists($path)) {
            return "File already exists.";
        }

        if($parent_file_id > 0) {
            return $this->getDisk()->put($path, $content);
        } else {
            return $this->getDisk()->put($path, file_get_contents($content));
        }

    }

    protected function cleanFolder($folder) {
        return '/' . trim(str_replace('..', '', $folder), '/');
    }
    public function saveFileData($data, $return_object = FALSE) {
        $file = new Attachment();

        $file->parent_file_id = !empty($data[ 'parent_file_id' ]) ? $data[ 'parent_file_id' ] : NULL;
        $file->type           = !empty($data[ 'type' ]) ? $data[ 'type' ] : NULL;
        $file->parent_id      = isset($data[ 'parent_id' ]) ? $data[ 'parent_id' ] : NULL;
        $file->parent_type    = $data[ 'parent_type' ];
        $file->user_id        = $data[ 'user_id' ];
        $file->storage_path   = $data[ 'storage_path' ];
        $file->extension      = $data[ 'extension' ];
        $file->name           = $data[ 'name' ];
        $file->mime_type      = $data[ 'mime_type' ];
        $file->size           = $data[ 'size' ];
        $file->hash           = $data[ 'hash' ];
        // $file->width          = isset($data[ 'width' ]) ? $data[ 'width' ] : NULL;
        //$file->height         = isset($data[ 'height' ]) ? $data[ 'height' ] : NULL;
        $file->is_temp        = isset($data[ 'is_temp' ]) ? $data[ 'is_temp' ] : 0;


        $file->save();

        if($return_object) {
            return $file;
        }
        return $file->file_id;

        return FALSE;

    }
}
