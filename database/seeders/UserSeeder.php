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

        $third = new User;
        $third->username = 'Student 2';
        $third->email = 'w@w';
        $third->password = Hash::make('1');
        $third->user_type = 0;
        $third->save();

        $mentor = new User;
        $mentor->username = 'Mentor 1';
        $mentor->email = 'm@m';
        $mentor->password = Hash::make('1');
        $mentor->user_type = 3;
        $mentor->save();

        //
    }
}
