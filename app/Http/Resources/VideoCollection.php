<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class VideoCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */

    public function toArray($request): array
    {
        return[
            'data' => $this->collection,
            'links' =>[
                'self' => route('api.videos.index'),
            ]
                
        ];
    }
}
