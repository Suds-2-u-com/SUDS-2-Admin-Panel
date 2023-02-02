<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\User;

class UsersTablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'    => 'admin',
            'email'    => 'admin@gmail.com',
            'password'   =>  Hash::make('123'),
            'remember_token' =>  time().Str::random(5),
        ]);
    }
}
?>