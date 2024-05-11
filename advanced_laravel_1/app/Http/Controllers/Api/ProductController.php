<?php
namespace App\Http\Controllers\Api;

use App\Models\Product;
use App\Http\Requests\Product\CreateProductValidator;
use App\Http\Requests\Product\UpdateProductValidator;
use App\Services\ProductsService;
use Illuminate\Support\Facades\Auth;

class ProductController extends BaseController{
    public ProductsService $productsService;

    public function __construct(ProductsService $productsService)
    {
        $this->productsService = $productsService;
    }

    public function index()
    {
        return $this->productsService->getProducts();
    }


    public function store(CreateProductValidator $createProductValidator)
    {
        $data = $createProductValidator->validated();
        $data['user_id'] = Auth::user()->id;
        $response = $this->productsService->createProduct($data);
        return $this->sendResponse($response);
    }


    public function update($id , UpdateProductValidator $updateProductValidator)
    {
        $data = $updateProductValidator->validated();
        $data['user_id'] = Auth::id();
        $response = $this->productsService->updateProduct($id,$data);
        return $this->sendResponse($response);
    }

    public function destroy($id)
    {
        $this->productsService->deleteProduct($id);
        return $this->sendResponse('deleted successfully');
    }

    public function show($id)
    {
        return $this->productsService->getProduct($id);
    }
}
