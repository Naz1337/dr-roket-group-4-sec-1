<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $firstUser = new User;
        $firstUser->username = 'admin';
        $firstUser->email = 'admin';
        $firstUser->password = Hash::make('admin');
        $firstUser->user_type = 2;
        $firstUser->save();

        $secondUser = new User;
        $secondUser->username ='A student';
        $secondUser->email = 'k@k';
        $secondUser->password = Hash::make('1');
        $secondUser->user_type = 0;
        $secondUser->save();
    }
}
