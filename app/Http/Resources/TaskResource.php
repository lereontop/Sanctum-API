<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => (string)$this->id,
            'attribute' => [
                'name' => $this->name,
                'descriptin' => $this->descriptin,
                'priority' => $this->priority,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at
            ],

            'relationship'=> [
                'id' => (string)$this->id,
                'user name' => $this->user->name,
                'user email' => $this->user->email,


            ]
        ];
    }
}
