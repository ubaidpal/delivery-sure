<?php
/**
 * Created by   :  Muhammad Yasir
 * Project Name : demedat
 * Product Name : PhpStorm
 * Date         : 27-Jun-16 12:04 PM
 * File Name    : UploadAttachment.php
 */

namespace App\Traits;

trait UploadAttachment
{
    use Uploader;
    use GenerateThumb;
    protected $allowedPhotoFiles = ['png', 'jpeg', 'jpg', 'bmp', 'gif'];
    protected $allowedVideoFiles = ['wmv', 'mp4', 'mkv', 'flv', 'qt', 'mov'];
    protected $allowedAudioFiles = ["mp3"];
    protected $notAllowedFiles   = ["exe"];

    /**
     * @return mixed
     */
    public function is_api() {
        return \URLFilter::filter();
    }

    public function upload_attachment($value, $user_id) {
        $token     = [];
        $extension = $value->getClientOriginalExtension();

        if(in_array(strtolower($extension), $this->getNotAllowedFiles())) {

            return 'invalid_file';

        } else {
            $data = $this->upload($user_id, $value, 'attachment');
        }

        return $data;
    }

    public function upload($user_id, $file, $type) {

        $data = $this->storeFile($file, $type, TRUE);

        if($type == 'album_photo') {
            $data[ 'is_temp' ] = 1;
        }
        if(!is_array($data)) {
            return FALSE;
        }
        $data[ 'type' ]        = $type;
        $data[ 'parent_type' ] = NULL;
        $data[ 'user_id' ]     = $user_id;
        $file_id               = $this->saveFileData($data);
        $extension             = strtolower($data[ 'extension' ]);

        if(in_array($extension, $this->getAllowedVideoFiles())) {

            $thumb = $this->get_thumb($data, $user_id);

            $values = ['parent_file_id' => $file_id, 'type' => 'attachment_thumb', 'user_id' => $user_id, 'storage_path' => $thumb[ 'storage_path' ]];

            $this->save_file($values, $thumb);

        } elseif(in_array($extension, $this->getAllowedPhotoFiles())) {

            $this->generate_thumb($data, $file_id, $user_id, 'attachment_thumb', \Config::get('constant_settings.MESSAGES_ATTACHMENT_WIDTH'), NULL, TRUE);
        }

        return array('data' => $data, 'file_id' => $file_id,);
    }

    public function getNotAllowedFiles() {
        return $this->notAllowedFiles;
    }

    public function getAllowedPhotoFiles() {
        return $this->allowedPhotoFiles;
    }

    public function getAllowedVideoFiles() {
        return $this->allowedVideoFiles;
    }

    public function getAllowedAudioFiles() {
        return $this->allowedAudioFiles;
    }

    public function get_thumb($file, $user_id) {
        $ffmpeg = \FFMpeg\FFMpeg::create(['ffmpeg.binaries' => env('FFMPEG_PATH', 'C:/FFMPEG/bin/ffmpeg.exe'), 'ffprobe.binaries' => env('FFPROBE_PATH', 'C:/FFMPEG/bin/ffprobe.exe'), 'timeout' => 3600, 'ffmpeg.threads' => 12,]);
        //$ffmpeg    = \FFMpeg\FFMpeg::create(['ffmpeg.binaries' => env('FFMPEG_PATH', '/usr/bin/ffmpeg'), 'ffprobe.binaries' => env('FFPROBE_PATH', '/usr/bin/ffprobe'), 'timeout' => 3600, 'ffmpeg.threads' => 12,]);
        $file_path = \Config::get('constant_settings.ATTACHMENT_PATH') . '/app/' . $file[ 'storage_path' ];
        $video     = $ffmpeg->open($file_path);
        $name      = str_replace('.', '_', time() . uniqid(30, TRUE));
        $img       = $name . '.jpg';

        $dir = storage_path('app' . DIRECTORY_SEPARATOR . 'attachment_thumb/'); //public_path('storage/attachments/thumbs/'.$user_id);
        if(!file_exists($dir)) {
            mkdir($dir, 0777, TRUE);
            ///die("dsfdsfdasfdas");
        }

        $video->frame(\FFMpeg\Coordinate\TimeCode::fromSeconds(2))->save($dir . "/" . $img);

        $data[ "storage_path" ] = "attachment_thumb/" . $img;
        $data[ "name" ]         = $img;
        $data[ 'extension' ]    = "jpg";
        $data[ 'mime_type' ]    = "image/jpeg";
        $data[ 'size' ]         = "1111111111";
        $data[ 'hash' ]         = "";

        return $data;
    }
}
