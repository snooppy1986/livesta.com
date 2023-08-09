<?php

namespace App\Http\Resources\Category;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
           'id' => $this->id,
           'slug' => $this->slug,
           'title' => $this->title,
           'thumbnail' => $this->thumbnail,
           'parent_id' => $this->parent_id,
           'children' => $this->children
        ];
    }
}
