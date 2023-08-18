<?php

namespace App\Models\Traits;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

trait UploadFile
{
    public function UploadFile($file, $width, $height, $folder = null, $disk = 'storage', $filename = null)
    {
        $file_ext = $file->getClientOriginalExtension();

        if(!$filename)
            $filename= md5(now().$file->getClientOriginalName()).'-'.$width.'x'.$height.'.'.$file_ext;

        Image::make($file)
            ->fit($width, $height)
            ->save(Storage::path($folder).$filename);

        return $filename;
    }
}
