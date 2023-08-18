<?php

namespace App\Http\Resources\MainSlider;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MainSliderResource extends JsonResource
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
            'image_link' => $this->image_link,
            'product_id' => $this->product_id,
            'title' => $this->title,
            'content' => $this->content,
            'status' => $this->status
        ];
    }
}
