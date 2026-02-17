<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MenuItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'url' => $this->url,
            'parent_id' => $this->parent_id,
            'order' => $this->order,
            'type' => $this->type,
            'icon' => $this->icon,
            'target' => $this->target,
            'children' => MenuItemResource::collection($this->whenLoaded('children')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
