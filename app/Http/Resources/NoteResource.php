<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

class NoteResource extends JsonResource
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
            'content' => $this->content,
            'created_at' => Carbon::parse($this->created_at)->format('d M Y, h:i:s'),
            'updated_at' => Carbon::parse($this->updated_at)->format('d M Y, h:i:s'),
        ];
    }
}
