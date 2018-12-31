<?php

use Illuminate\Database\Seeder;
use App\Models\User;
class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->name = 'Ahmad Bustomi';
        $user->email = 'test@email.com';
        $user->password = bcrypt('secret');
        $user->save();

        $user2 = new User();
        $user2->name = 'Bambang';
        $user2->email = 'test2@email.com';
        $user2->password = bcrypt('secret');
        $user2->save();

    }
}
