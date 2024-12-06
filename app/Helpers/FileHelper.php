<?php

use Illuminate\Support\Str;
use App\Constants\MediaCollection;

if (!function_exists('uploadFile')) {
    function uploadFile($file, $model, $collectionName)
    {
        $fileName = generateFileName($file);
        $model->addMedia($file)
            ->usingFileName($fileName)
            ->toMediaCollection($collectionName);
    }
}

if (!function_exists('uploadFiles')) {
    function uploadFiles($files, $model, $collectionName)
    {
        foreach ($files as $file) {
            uploadFile($file, $model, $collectionName);
        }
    }
}

if (!function_exists('updateFile')) {
    function updateFile($files, $model, $collectionName)
    {
        $model->clearMediaCollection($collectionName);
        uploadFile($files, $model, $collectionName);
    }
}
if (!function_exists('updateFiles')) {
    function updateFiles($files, $model, $collectionName)
    {
        $model->clearMediaCollection($collectionName);
        uploadFiles($files, $model, $collectionName);
    }
}

if (!function_exists('generateFileName')) {
    function generateFileName($file)
    {
        $originalFilename = $file->getClientOriginalName();
        $pathInfo = pathinfo($originalFilename);
        $originalFilename = $pathInfo['filename'];


        $fileName = $originalFilename . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

        return $fileName;
    }
}
