<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User;
        $user->name = 'wilmer estrada';
        $user->email = 'westrada04@gmail.com';
        $user->rol = 'Tutor';
        $user->password = bcrypt('westrada04');
        $user->save();
    }
}
