<?php

use App\Cuidador;
use App\Nino;
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
        $user->password = bcrypt('westrada04');
        $user->save();

        $cuidador = new Cuidador;
        $user->cuidador()->save($cuidador);

        $user = new User;
        $user->name = 'julian perez';
        $user->email = 'julian@niño.com';
        $user->password = bcrypt('123456789');
        $user->save();

        $nino = new Nino;
        $user->nino()->save($nino);

        $user = new User;
        $user->name = 'pedro lopez';
        $user->email = 'pedro@niño.com';
        $user->password = bcrypt('123456789');
        $user->save();

        $nino = new Nino;
        $user->nino()->save($nino);

        $cuidador = Cuidador::find(1);
        $cuidador->ninos()->attach(1);
        $cuidador->ninos()->attach(2);

    }
}
