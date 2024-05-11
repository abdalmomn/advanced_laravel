<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    protected $fillable = ['comment' , 'user_id' , 'product_id'];

    public function product()
    {
        return $this->belongsTo(Product::class,'product_id' , 'id');//done
    }
    public function user()
    {
        return $this->belongsTo(User::class , 'user_id' , 'id');//done
    }

    public function image(){
        return $this->morphOne('App\Models\Image' , 'imagable');//done
    }

}
