<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseController as BaseController;
use App\Models\Product;
use App\Models\Category;
use App\Models\Price;
use Validator;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\ProductResource;

class ProductController extends BaseController
{
    public function index(): JsonResponse
    {
        $products = Product::with(['categories', 'prices'])
            ->orderBy('id', 'DESC')
            ->get();
        // $products = Product::all();

        return $this->sendResponse(ProductResource::collection($products), 'Products retrieved successfully.');
    }

    public function show($id): JsonResponse
    {
        $product = Product::with(['categories', 'prices'])
            ->find($id);
        if (is_null($product)) {
            return $this->sendError('Product not found.');
        }

        return $this->sendResponse(new ProductResource($product), 'Product retrieved successfully.');
    }

    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'category_id' => 'required',
            'stock' => 'required',
            'price' => 'required'
        ]);

        if($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $input = $request->all();
        $input['created_by'] = $request->user()->id;

        $product = Product::create($input);

        return $this->sendResponse(new ProductResource($product), 'Product created successfully.');
    }

    public function update(Request $request, Product $product): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'category_id' => 'required',
            'stock' => 'required',
            'price' => 'required'
        ]);

        if($validator->fails()) {
            return $this->sendError('Validator Error.', $validator->errors());
        }

        $input = $request->all();
        $input['updated_by'] = $request->user()->id;

        $product->update($input);

        return $this->sendResponse(new ProductResource($product), 'Product updated successfully.');
    
    }

    public function destroy(Product $product): JsonResponse
    {
        $product->delete();
        return $this->sendResponse([], 'Product deleted successfully.');
    }
}
