<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;

class Slider extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'url',
        'image'
    ];

    public static function saveImage($file){
        if($file){
            $name = time().'.'.$file->extension();
            $smallImage = Image::read($file->getRealPath());
            $bigImage = Image::read($file->getRealPath());
            $smallImage->resize(256,256,function ($constraint){
                $constraint->aspectRatio();
            });
            Storage::disk('local')->put('admin/sliders/small/'.$name,(string) $smallImage->encode());
            Storage::disk('local')->put('admin/sliders/big/'.$name,(string) $bigImage->encode());
            return $name;
        }else{
            return '';
        }
    }
}
