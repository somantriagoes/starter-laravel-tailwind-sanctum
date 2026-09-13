<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseController as BaseController;
use App\Models\Category;
use Validator;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\CategoryResource;

class CategoryController extends BaseController
{
    public function index(): JsonResponse
    {
        $categories = Category::all();
        return $this->sendResponse(CategoryResource::collection($categories), 'Categories retrieved successfully.');
    }

    public function show($id): JsonResponse
    {
        $category = Category::find($id);
        if (is_null($category)) {
            return $this->sendError('Category not found.');
        }
        return $this->sendResponse(new CategoryResource($category), 'Category retrieved successfully.');
    }

    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $input = $request->all();
        $input['created_by'] = $request->user()->id;

        $category = Category::create($input);
    
        return $this->sendResponse(new CategoryResource($category), 'Category created successfully.');
    }

    public function update(Request $request, Category $category): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $input = $request->all();

        $input['updated_by'] = $request->user()->id;

        $category->update($input);
        return $this->sendResponse(new CategoryResource($category), 'Category updated successfully.');
    }

    public function destroy(Category $category): JsonResponse
    {
        $category->delete();
        return $this->sendResponse([], 'Category deleted successfully.');
    }
}
