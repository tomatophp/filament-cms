<?php

namespace TomatoPHP\FilamentCms\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class PagesResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'short_description' => $this->short_description,
            'body' => $this->body,
            'cover_image' => $this->getMedia('cover')->first()?->getUrl(),
            'galary' =>  $this->getMedia('gallery')->map(function ($item) {
                return $item->getUrl();
            }),
            'html_url' => url('/pages/' . $this->slug)
        ];
    }
}
