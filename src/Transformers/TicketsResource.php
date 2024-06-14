<?php

namespace TomatoPHP\TomatoSupport\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class TicketsResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'account' => $this->accountable?->name,
            'name' => $this->name,
            'phone' => $this->phone,
            'subject' => $this->subject,
            'message' => $this->message,
            'code' => $this->code,
            'last_update' => $this->last_update,
            'is_closed' => $this->is_closed,
            'status' => $this->type?->name
        ];
    }
}
