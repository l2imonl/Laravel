<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //roles
        $admin_role = new Role();
        $admin_role->slug = 'admin';
        $admin_role->name = 'Admin';
        $admin_role->save();

        $mod_role = new Role();
        $mod_role->slug = 'moderator';
        $mod_role->name = 'Moderator';
        $mod_role->save();

        $user_role = new Role();
        $user_role->slug = 'user';
        $user_role->name = 'User';
        $user_role->save();

        $creator_role = new Role();
        $creator_role->slug = 'creator';
        $creator_role->name = 'Creator';
        $creator_role->save();

        //users

        $developer = new User();
        $developer->name = 'Admin';
        $developer->email = 'admin@gmail.com';
        $developer->email_verified_at = now();
        $developer->password = bcrypt('password');
        $developer->save();
        $developer->roles()->attach($admin_role);

        $admin = new User();
        $admin->name = 'Moderator';
        $admin->email = 'mod@gmail.com';
        $admin->email_verified_at = now();
        $admin->password = bcrypt('1234');
        $admin->save();
        $admin->roles()->attach($mod_role);

        $admin = new User();
        $admin->name = 'User';
        $admin->email = 'user@gmail.com';
        $admin->password = bcrypt('1234');
        $admin->save();
        $admin->roles()->attach($user_role);

        $admin = new User();
        $admin->name = 'Creator';
        $admin->email = 'creator@gmail.com';
        $admin->email_verified_at = now();
        $admin->password = bcrypt('1234');
        $admin->save();
        $admin->roles()->attach($creator_role);
    }
}
