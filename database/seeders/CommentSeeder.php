<?php

namespace Database\Seeders;

use App\Models\Comment;
use Illuminate\Database\Seeder;


class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $comment = new Comment();
        $comment->body = 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua.';
        $comment->post_id = 1;
        $comment->user_id = 3;
        $comment->save();


        $comment = new Comment();
        $comment->body = 'Consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua.';
        $comment->post_id = 1;
        $comment->user_id = 3;
        $comment->save();
    }
}
