<?php

namespace App\Http\Resources;

use App\Models\Comment;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Ramsey\Collection\Collection as CollectionCollection;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'type' => 'posts',
            'id' => (string)$this->resource->getRouteKey(),
            'attributes' => [
                'title' => $this->title,
                'message' => $this->message,
                'slug' => $this->slug,
                'created_at' => (new Carbon($this->created_at))->format('d-m-y H:i:s'),
                'updated_at' => $this->updated_at,
            ],
            'links' => [
                'self' => route('api.posts.show', $this->resource)
            ],
            'relationships' => [
                'user' => new UserResource($this->whenLoaded('user')),
               
            ],
        ];
    }
}
