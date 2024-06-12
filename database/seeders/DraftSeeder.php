<?php

namespace Database\Seeders;

use App\Models\Draft;
use App\Models\Platinum;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DraftSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Platinum::whereHas('user', function ($query) {
            $query->where('email' , 'like', 'a');
        })->get()->first()->drafts()->saveMany([
            new Draft(
                [
                    'draft_title' => 'Project Bangunan Tinggi',
                    'draft_number' => 1,
                    'draft_completion_date' => '2021-01-01',
                    'draft_days_taken' => 10,
                    'draft_ddc' => 5,
                    'draft_filename' => 'draft1.pdf',
                    'draft_filepath' => 'drafts/1',
                    'draft_page_count' => 10
                ]
            ),
            new Draft(
                [
                    'draft_title' => 'Project Bangunan Tinggi',
                    'draft_number' => 1,
                    'draft_completion_date' => '2021-01-01',
                    'draft_days_taken' => 10,
                    'draft_ddc' => 5,
                    'draft_filename' => 'draft1.pdf',
                    'draft_filepath' => 'drafts/1',
                    'draft_page_count' => 10
                ]
            ),
            new Draft(
                [
                    'draft_title' => 'Project Bangunan Tinggi',
                    'draft_number' => 1,
                    'draft_completion_date' => '2021-01-01',
                    'draft_days_taken' => 10,
                    'draft_ddc' => 5,
                    'draft_filename' => 'draft1.pdf',
                    'draft_filepath' => 'drafts/1',
                    'draft_page_count' => 10
                ]
            ),
            new Draft(
                [
                    'draft_title' => 'Project Bangunan Tinggi',
                    'draft_number' => 1,
                    'draft_completion_date' => '2021-01-01',
                    'draft_days_taken' => 10,
                    'draft_ddc' => 5,
                    'draft_filename' => 'draft1.pdf',
                    'draft_filepath' => 'drafts/1',
                    'draft_page_count' => 10
                ]
            )

        ]);
    }
}
