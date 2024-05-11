<?php

namespace App\Services;

use App\Models\Product;
use App\Models\ProductDetail;
use App\Models\Review;

class ProductsService
{
    public function getProducts()
    {
        return Product::all();
    }

    public function getProduct($id)
    {
        return Product::where('id' , $id)->first();
    }

    public function createProduct($data)
    {
        $product = Product::create($data);
        $product->details()->create($data);
        return $product;
    }

    public function updateProduct($id,$data)
    {
        $product = $this->getProduct($id);
        $product->title = $data['title'];
        $product->description = $data['description'];
        $product->user_id = $data['user_id'];
        $product->details->size = $data['size'];
        $product->details->color = $data['color'];
        $product->details->price = $data['price'];
        $product->save();
        $product->details->save();
        return $product;
    }

    public function deleteProduct($id)
    {
        $product = $this->getProduct($id);
        if($product->details){
            $product->details()->delete();
        }
        if($product->reviews){
            $product->reviews()->delete();
        }
        if($product->imagable){
            $product->imagable()->delete();
        }
        $product->delete();
    }
}
