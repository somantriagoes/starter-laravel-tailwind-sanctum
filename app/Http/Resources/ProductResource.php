<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);

        return [
            'id' => $this->id,
            'name' => $this->name,
            'category_id' => $this->category_id,
            'image' => $this->image,
            'stock' => $this->stock,
            'price' => $this->price,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at->format('Y-m-d H:i:s'),
            'categories' => $this->categories->toArray($request),
            // 'categories' => $this->categories->map(function ($category) {
            //     return [
            //         'id' => $category->id,
            //         'name' => $category->name,
            //     ];
            // })->toArray($request),
            'prices' => $this->prices->toArray($request),
        ];
    }
}
