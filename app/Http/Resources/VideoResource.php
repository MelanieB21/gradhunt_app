<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class VideoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'type' => 'video',
            'id' => (string)$this->resource->getRouteKey(),
            'attributes' => [
                'title' => $this ->resource-> title,
                'description' => $this ->resource->description,
                'slug' => $this ->resource->slug,
               // 'created_at' =>$this->resource->created_at,
               // 'updated_at' =>$this->resource->updated_at,
            ],
            
            'links' => [
                'self' => route('api.videos.show',$this->resource)
            ]
        ];
    }
}
