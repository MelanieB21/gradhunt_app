<?php

namespace App\Http\Resources;

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
            'type' => 'users',
            'id'=> (string)$this->resource->getRouteKey(),
            'attributes' => [
            'name'=> $this->resource->name,
            'email'=> $this->resource->email,
            ],
            'links' => [
                'self' => route('api.users.show', $this->resource)
            ]
        ]; 
    }

   
}
