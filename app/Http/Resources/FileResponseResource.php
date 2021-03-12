<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FileResponseResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            "success" => $this->success,
            "message" => $this->message
        ];
    }
}
