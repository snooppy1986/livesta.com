<?php

namespace App\Http\Resources\User;


use App\Http\Resources\Order\OrderResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'email' => $this->email,
            'phone' => $this->phone,
            'password' => $this->password,
            'role' => $this->role,
            'avatar' => $this->avatar,
            'avatar_url' => $this->avatar_url,
            'orders' => OrderResource::collection($this->orders),
            'address' => new AttributeResource($this->userAttributes)
        ];
    }
}
