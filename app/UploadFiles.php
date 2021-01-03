<?php

namespace App;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;

class UploadFiles 
{

    public static function uploadFile($uploadedFile, $folder = null, $filename = null, $resize, $thumbnail, $optimized) {
        
        $name = !is_null($filename) ? $filename : Str::random(25);
        
        $filePath = array();
        array_push($filePath, $folder . '\\' . $name . '.' . $uploadedFile->getClientOriginalExtension());
        
        if (!(Storage::exists($folder))){
            Storage::makeDirectory($folder);
        }

        if ($optimized)
        { // QUALITY = 60
            
            if (is_null($resize))
                Image::make($uploadedFile)->save(storage_path('app\\') . $filePath[0], 60);
            else
                Image::make($uploadedFile)->resize($resize, null, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save(storage_path('app\\') . $filePath[0], 60);

        } else {
            
            if (is_null($resize))
                Image::make($uploadedFile)->save(storage_path('app\\') . $filePath[0]);
            else
                Image::make($uploadedFile)->resize($resize, null, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save(storage_path('app\\') . $filePath[0]);    
            
        }
        
        if ($thumbnail){
            Image::make($uploadedFile)->resize(200, null, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save(storage_path('app\\') . $folder . '\\' . $name . '_thumb.' . $uploadedFile->getClientOriginalExtension());
            
            array_push($filePath, $folder . '\\' . $name . '_thumb.' . $uploadedFile->getClientOriginalExtension());
        }
        
        return $filePath;
    }
    
    
    public static function deleteFile($path){
        if (Storage::exists($path)){
            Storage::delete($path);
        }
    }
}