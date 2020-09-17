<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         User::factory(10)->create();
        $this->call([UserSeeder::class]);
        $this->call([PostSeeder::class]);
        $this->call([CommentSeeder::class]);
    }
}
