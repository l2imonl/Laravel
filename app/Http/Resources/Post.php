<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Traits\HtmlTrim;

class Post extends JsonResource
{
    use HtmlTrim;

    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        $return = ['title' => $this->title,];

        if ($request->trim) {
            $return += [
                'body' => $this->HtmlTrim($this->body, 500),
            ];
        } else {
            $return += [
                'body' => $this->body,
            ];
        }
        if ($this->heading_image_path) {
            if ($request->base64) {
                $return += [
                    'header_image' => base64_encode(file_get_contents($this->getHeaderImageUrlAttribute())),
                ];
            } else {
                $return += [
                    'header_image' => $this->getHeaderImageUrlAttribute(),
                ];
            }

        }
        $return += ['created_at' => $this->created_at,];
        return $return;
    }
}
