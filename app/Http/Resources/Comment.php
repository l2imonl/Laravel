<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use PhpParser\Node\Stmt\If_;

class Comment extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        if ($request->replies){
            return [
                'name' => $this->user->name,
                'id' => $this->id,
                'user_profile_pic' => $this->user->profile_photo_url,
                'body' => $this->body,
                'replies' => new CommentCollection($this->replies),
                'created_at' => $this->created_at,
            ];
        }else{
            return [
                'name' => $this->user->name,
                'body' => $this->body,
                'created_at' => $this->created_at,
            ];
        }

    }
}
