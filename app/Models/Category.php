<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;

class Category extends Model
{
    use HasFactory;

    protected $fillable =  [
        'title',
        'image',
        'parent_id'
    ];

    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id', 'id')
            ->withDefault(['title' => '______']);
    }

    public function child()
    {
        return $this->hasMany(self::class, 'parent_id', 'id');
    }

    public static function saveImage($file){
        if($file){
            $name = time().'.'.$file->extension();
            $smallImage = Image::read($file->getRealPath());
            $bigImage = Image::read($file->getRealPath());
            $smallImage->resize(256,256,function ($constraint){
                $constraint->aspectRatio();
            });
            Storage::disk('local')->put('admin/categories/small/'.$name,(string) $smallImage->encode());
            Storage::disk('local')->put('admin/categories/big/'.$name,(string) $bigImage->encode());
            return $name;
        }else{
            return '';
        }
    }
}
