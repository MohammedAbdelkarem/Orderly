<?php

namespace App\Http\Traits;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

trait FileHelper
{

    public function uploadOne(UploadedFile $uploadedFile, $folder = null, $disk = 'public', $filename)
    {
        
        $name = !is_null($filename) ? $filename : Str::random(25);

        $file = $uploadedFile->storeAs($folder, $name . '.' . $uploadedFile->getClientOriginalExtension(), $disk);

        return $file;
    }


}
