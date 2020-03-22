<?php

namespace App\Traits;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

trait UploadTrait
{
    public function uploadImage(UploadedFile $file, string $path, array $dimensoes, string $noExtensionName = '')
    {
        try{
            Storage::makeDirectory($path);

            $extension = strtolower($file->getClientOriginalExtension());

            if($noExtensionName != '')
                $fileName = $noExtensionName.'.'.$extension;
            else
                $fileName = Str::random().'.'.$extension;

            $img = Image::make($file);
            if(isset($dimensoes['width']) && isset($dimensoes['height'])) {
                $img->interlace()->resize($dimensoes['width'], $dimensoes['height']);
            } else {
                $img->interlace()->resize($dimensoes['width'], $dimensoes['height'] ?? null, function ($constraint){
                    $constraint->aspectRatio();
                });
            }

            Storage::put($path.$fileName, $img->stream($extension, 60));

            return [
                'success' => true,
                'arquivo' => $fileName
            ];

        }catch(\Exception $e) {
            return [
                'success' => false,
                'erro' => $e->getMessage()
            ];
        }
    }
}
