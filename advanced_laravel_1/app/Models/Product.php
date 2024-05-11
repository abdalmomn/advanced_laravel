<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['title' , 'description' , 'user_id'];

    public function details()
    {
        return $this->hasOne(ProductDetail::class,'product_id' , 'id');//done
    }

    public function image(){
        return $this->morphOne('App\Models\Image' , 'imagable');//done
    }

    public function reviews()
    {
        return $this->hasMany(Review::class,'id' , 'product_id');//done
    }
}
