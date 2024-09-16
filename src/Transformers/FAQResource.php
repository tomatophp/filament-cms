<?php

namespace TomatoPHP\FilamentCms\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class FAQResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'qa' => $this->qa,
            'answer' => $this->answer,
            'type' => $this->type?->name,
        ];
    }
}
