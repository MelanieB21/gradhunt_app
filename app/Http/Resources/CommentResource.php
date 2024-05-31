<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'type' => 'comment',
            'id' => (string)$this->id,
            'attributes' => [
                'body'  => $this->body,
                'created_at' => $this->created_at->format('d-m-y H:i:s'),
                'updated_at' => $this->updated_at->format('d-m-y H:i:s'),
            ],
            'relationships' => [
                'user' => new UserResource($this->whenLoaded('user')),
            ],
        ];
    }
}
