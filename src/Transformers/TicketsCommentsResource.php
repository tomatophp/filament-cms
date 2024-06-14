<?php

namespace TomatoPHP\TomatoSupport\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class TicketsCommentsResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'account' => $this->accountable_type::find($this->accountable_id)?->name,
            'response' => $this->response,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
