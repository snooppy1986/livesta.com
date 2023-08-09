<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AttributeResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'area' => $this->area,
            'city' => $this->city,
            'street' => $this->street,
            'house_number' => $this->house_number,
            'postcode' => $this->postcode,
        ];
    }
}
