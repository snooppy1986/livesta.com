<?php

namespace App\Http\Resources\Product;

use App\Http\Resources\Attribute\AttributeResource;
use App\Http\Resources\Brand\BrandResource;
use App\Http\Resources\Category\CategoryResource;
use App\Http\Resources\Review\ReviewResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'slug' => $this->slug,
            'title' => $this->title,
            'image' => $this->image,
            'content' => $this->content,
            'code' => $this->code,
            'price_balls' => $this->price_balls,
            'price_discount' => $this->price_discount,
            'price_special' => $this->price_special,
            'price_through' => $this->price_through,
            'rating' => round($this->reviews->avg('rating'), 1),
            'new' => $this->new,
            'related_products' => $this->related,
            'brand' => new BrandResource($this->brand),
            'reviews' => ReviewResource::collection($this->reviews),
            'attributes' => new AttributeResource($this->attributes),
            'category' => CategoryResource::collection($this->category)->first(),
        ];
    }
}