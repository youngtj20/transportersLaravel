<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MovementMemberResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'phone_number' => $this->phone_number,
            'email' => $this->email,
            'state' => $this->state,
            'lga' => $this->lga,
            'ward' => $this->ward,
            'unit' => $this->unit,
            'modes_of_transport' => $this->modes_of_transport ?: [],
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
