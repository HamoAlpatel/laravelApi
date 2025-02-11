<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReviewRsource extends JsonResource
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
            'product_id' => $this->product_id,
            'name' => $this->customer,
            'rev' => $this->review,
            'star' => $this->star,
            'date' => [
                'created_at'=>$this->created_at,
                'updated_at'=>$this->updated_at,
            ]

        ];
    }
}
