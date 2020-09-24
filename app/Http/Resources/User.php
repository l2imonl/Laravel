<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class User extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        $return = [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
//            'posts' => new PostCollection($this->whenLoaded('posts')),
//            'comments' => new CommentCollection($this->whenLoaded('comments')),
            'roles' => new RoleCollection($this->roles),
//            'created_at' => $this->created_at,
//            'updated_at' => $this->updated_at,
        ];
        if ($this->profile_photo_path) {
            if ($request->base64) {
                $return += [
                    'profile_photo' => base64_encode(file_get_contents($this->profile_photo_url)),
                ];
            } else {
                $return += [
                    'profile_photo' => $this->profile_photo_url,
                ];
            }
        }
        return $return;
    }
}
