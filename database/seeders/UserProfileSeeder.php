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

        $mentor = User::firstWhere('email', 'm@m');

        assert($mentor instanceof User, "\$mentor should not be anything else other than User");

        $userProfile = new UserProfile;
        $userProfile->user_id = $mentor->id;
        $userProfile->profile_name = 'Mentor 1';
        $userProfile->profile_email = $mentor->email;
        $userProfile->birth_date = '2024-06-02'; // Replace with actual birth date
        $userProfile->phone_no = '123'; // Replace with actual phone number
        $userProfile->address = 'Jalan 1'; // Replace with actual address
        $userProfile->address2 = 'Taman Main2'; // Replace with actual address2
        $userProfile->save();

    }
}
