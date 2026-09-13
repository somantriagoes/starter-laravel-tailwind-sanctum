<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseController as BaseController;
use App\Models\Blog;
use Validator;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\BlogResource;

class BlogController extends BaseController
{
    public function index(): JsonResponse
    {
        $blogs = Blog::all();
        return $this->sendResponse(BlogResource::collection($blogs), 'Blogs retrieved successfully.');
    }

    public function show($id): JsonResponse
    {
        $blog = Blog::find($id);
        if (is_null($blog)) {
            return $this->sendError('Blog not found.');
        }
        return $this->sendResponse(new BlogResource($blog), 'Blog retrieved successfully.');
    }

    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'content' => 'required',
            // 'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image' => 'nullable|string'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $input = $request->all();
        // if ($request->hasFile('image')) {
        //     $imageName = time() . '.' . $request->image->extension();
        //     $request->image->move(public_path('images'), $imageName);
        //     $input['image'] = $imageName;
        // }
        $input['created_by'] = $request->user()->id;

        $blog = Blog::create($input);
        return $this->sendResponse(new BlogResource($blog), 'Blog created successfully.');
    }

    public function update(Request $request, Blog $blog): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'content' => 'required',
            // 'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image' => 'nullable|string'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $input = $request->all();
        // if ($request->hasFile('image')) {
        //     $imageName = time() . '.' . $request->image->extension();
        //     $request->image->move(public_path('images'), $imageName);
        //     $input['image'] = $imageName;
        // }
        $input['updated_by'] = $request->user()->id;

        $blog->update($input);
        return $this->sendResponse(new BlogResource($blog), 'Blog updated successfully.');
    }

    public function destroy(Blog $blog): JsonResponse
    {
        $blog->delete();
        return $this->sendResponse([], 'Blog deleted successfully.');
    }
}
