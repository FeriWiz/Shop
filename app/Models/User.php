<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use http\Env\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasApiTokens;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'mobile',
        'photo',
        'phone',
        'status',
        'is_amin',
        'user_name'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function addresses()
    {
        return $this->hasMany(Address::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public static function updateUserInfo($user, $request)
    {
        $image = self::saveImage($request->file);
        $user->update([
            'name' => $request->input('name'),
            'phone' => $request->input('phone'),
            'photo' => '$image'
        ]);
        $user->addresses()->create([
            'address' => $request->input('address'),
            'postal_code' => $request->input('postal_code'),
            'lat' => $request->input('lat'),
            'lng' => $request->input('lng'),
        ]);
    }

    public static function saveImage($file){
        if($file){
            $name = time().'.'.$file->extension();
            $smallImage = Image::read($file->getRealPath());
            $bigImage = Image::read($file->getRealPath());
            $smallImage->resize(256,256,function ($constraint){
                $constraint->aspectRatio();
            });
            Storage::disk('local')->put('admin/users/small/'.$name,(string) $smallImage->encode());
            Storage::disk('local')->put('admin/users/big/'.$name,(string) $bigImage->encode());
            return $name;
        }else{
            return '';
        }
    }
}
