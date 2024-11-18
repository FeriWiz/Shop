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
        return [
            'id' => $this['id'],
            'title' => $this['title'],
            'price' => $this['price'],
            'review' => $this['review'],
            'count' => $this['count'],
            'image' => url('admin/products/big/'.$this['image']),
            'guarantee' => $this['guarantee'],
            'slug' => $this['slug'],
            'description' => $this['description'],
            'is_special' => $this['is_special'],
            'special_expiration' => $this['special_expiration'],
            'status' => $this['status'],
            'category_id' => $this['category_id'],
            'category' => $this->category->title,
            'brand_id' => $this['brand_id'],
            'brand' => $this->brand->title,
            'sold' => $this['sold'],
        ];
    }
}
