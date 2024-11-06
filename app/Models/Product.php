<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'title_en',
        'slug',
        'price',
        'review',
        'count',
        'image',
        'guarantee',
        'discount',
        'description',
        'is_special',
        'special_expiration',
        'status',
        'category_id',
        'brand_id'
    ];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function brand(){
        return $this->belongsTo(Brand::class);
    }

    public static function saveImage($file){
        if($file){
            $name = time().'.'.$file->extension();
            $smallImage = Image::read($file->getRealPath());
            $bigImage = Image::read($file->getRealPath());
            $smallImage->resize(256,256,function ($constraint){
                $constraint->aspectRatio();
            });
            Storage::disk('local')->put('admin/products/small/'.$name,(string) $smallImage->encode());
            Storage::disk('local')->put('admin/products/big/'.$name,(string) $bigImage->encode());
            return $name;
        }else{
            return '';
        }
    }

}
