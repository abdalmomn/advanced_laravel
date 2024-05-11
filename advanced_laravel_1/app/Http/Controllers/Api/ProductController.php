<?php
namespace App\Http\Controllers\Api;

use App\Models\Product;
use App\Requests\Product\CreateProductValidator;
use App\Requests\Product\UpdateProductValidator;
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
        if(!empty($createProductValidator->getErrors())){
            return response()->json($createProductValidator->getErrors() , 406);
        }
        $data = $createProductValidator->request()->all();
        $data['user_id'] = Auth::user()->id;
        $response = $this->productsService->createProduct($data);
        return $this->sendResponse($response);
    }


    public function update($id , UpdateProductValidator $updateProductValidator)
    {
        if(!empty($updateProductValidator->getErrors())){
            return response()->json($updateProductValidator->getErrors() , 406);
        }

        $data = $updateProductValidator->request()->all();
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
