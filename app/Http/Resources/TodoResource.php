<?php

namespace App\Http\Resources;

use App\Category;
use Illuminate\Http\Resources\Json\JsonResource;

class TodoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'priority' => $this->whenLoaded('priority'),
            'category' => $this->whenLoaded('category', new CategoryResource($this->category)),
            'isComplete' => $this->is_complete,
            'dueAt' => $this->due_at->toDateTimeString(),
            'completedAt' => $this->completed_at
                ? $this->completed_at->timestamp
                : null,
            'createdAt' => $this->created_at->toIso8601String(),
            'updatedAt' => $this->updated_at->toDateTimeString(),
        ];
    }
}
