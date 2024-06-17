<?php

namespace Database\Seeders;

use App\Enums\BlockType;
use App\Models\FocusItem;
use App\Models\WeeklyFocus;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WeeklyFocusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::where('email', 'like', 'a')->first()->weeklyFocuses()->saveMany([
            new WeeklyFocus(['start_date' => '2021-01-01', 'end_date' => '2021-01-07']),
            new WeeklyFocus(['start_date' => '2021-01-08', 'end_date' => '2021-01-14']),
            new WeeklyFocus(['start_date' => '2021-01-15', 'end_date' => '2021-01-21']),
            new WeeklyFocus(['start_date' => '2021-01-22', 'end_date' => '2021-01-28']),
            new WeeklyFocus(['start_date' => '2021-01-29', 'end_date' => '2021-02-04']),
        ]);

        WeeklyFocus::find(1)->focus_items()->createMany([
            [
                'block_type' => BlockType::FOCUS,
                'task' => 'Task 1',
            ]
        ]);
    }
}
