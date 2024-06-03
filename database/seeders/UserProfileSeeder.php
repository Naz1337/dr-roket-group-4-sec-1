<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\models\UserProfile;

class UserProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userProfile = new UserProfile;

        $admin = User::firstWhere('email', 'admin');

        assert($admin instanceof User, "\$admin should not be anything else other than User");

        $userProfile->user_id = $admin->id;
        $userProfile->profile_name = 'Admin';
        $userProfile->profile_email = $admin->email;
        $userProfile->birth_date = '2024-06-02';
        $userProfile->phone_no = '123';
        $userProfile->address = 'Jalan 1';
        $userProfile->address2 = 'Taman Main2';
        $userProfile->save();



    }
}
