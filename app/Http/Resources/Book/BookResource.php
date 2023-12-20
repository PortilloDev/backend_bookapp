<?php

namespace App\Http\Resources\Book;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
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
            'type' => 'book',
            'attributes' => [
                'title' => $this->title,
                'category' => $this->category->name,
                'author' => $this->author,
                'description' => $this->description,
                'read' => $this->read ? true : false,
                'summary' => $this->summary,
                'isbn' => $this->isbn,
                'slug' => $this->slug,
                'image' => $this->image,
                'tags' => $this->tags->pluck('name')->implode(', '),

            ]
        ];
    }
}
