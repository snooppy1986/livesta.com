<?php

namespace App\Http\Resources\Review;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReviewResource extends JsonResource
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
            'name_surname' => $this->name_surname,
            'advantage' => $this->advantage,
            'flaws' => $this->flaws,
            'message' => $this->message,
            'email' => $this->email,
            'rating' => $this->rating
        ];
    }
}
