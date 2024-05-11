<?php
namespace App\Requests\Product;

use App\Requests\BaseRequestFormApi;

class CreateProductValidator extends BaseRequestFormApi
{
    public function rules(): array
    {
        return [
            'title' => 'required|min:3|max:50',
            'description' => 'required|min:5|max:1000',
            'size' => 'required|numeric|min:30|max:100',
            'color' => 'required|in:red,green',
            'price' => 'required|numeric|min:1|max:10000000',
        ];
    }

    public function authorized(): bool
    {
        return true;
    }
}
