<?php

use App\Models\Department;
use App\Models\Position;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DataTablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Department::create([
            'id' => 1,
            'name' => 'user'
        ]);

        Position::create([
            'id' => 1,
            'name' => 'user',
            'department_id' => '1'
        ]);

        User::create([
            'id' => 1,
            'name' => 'user',
            'email' => 'user@mail.ru',
            'post_id' => 1,
            'password' => Hash::make('user'),
        ]);

        User::create([
            'id' => 2,
            'name' => 'admin',
            'email' => 'admin@mail.ru',
            'post_id' => 1,
            'password' => Hash::make('admin'),
        ]);
    }
}
