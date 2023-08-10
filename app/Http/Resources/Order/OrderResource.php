<?php

namespace App\Http\Resources\Order;

use App\Http\Resources\CartItem\CartItemResource;
use App\Http\Resources\Product\ProductResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
            'name' => $this->name,
            'surname' => $this->surname,
            'phone' => $this->phone,
            'email' => $this->email,
            'notes' => $this->notes,
            'status' => $this->status,
            'total_price' => $this->total_price,
            'products' => CartItemResource::collection($this->with_product),
            'created_at' => $this->created_at
        ];
    }
}
