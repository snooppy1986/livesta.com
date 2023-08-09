<?php

namespace App\Http\Resources\Attribute;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AttributeResource extends JsonResource
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
            'application' => $this->application,
            'brand' => $this->brand,
            'country' => $this->country,
            'composition' => $this->composition,
            'gender' => $this->gender,
            'catalog_id' => $this->catalog_id,
            'warning' => $this->warning,
            'weight' => $this->weight
        ];
    }
}
