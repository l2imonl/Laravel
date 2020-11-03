<?php

namespace App\Http\Resources;

use App\Http\Resources\User as UserResource;
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
        $return = ['id' => $this->id,
            'title' => $this->title,];

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
        if($request->user){
            $return += [
              'user' => new UserResource($this->user),
            ];
        }
        $return += ['created_at' => date('d.m.Y', strtotime($this->created_at)),];
        if($this->heading_image_path){
            $return += ['heading_image_url' => 'http://jettest.test/storage/'.$this->heading_image_path];
        }else{
            $return += ['heading_image_url' => 'http://jettest.test/storage/0'.rand(1,5).'.jpg'];
        }
        return $return;
    }
}
