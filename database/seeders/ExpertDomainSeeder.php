<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ExpertDomain;
use App\Models\Platinum;

class ExpertDomainSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Expert Domain profile add
        ExpertDomain::create([
            'platinum_id' => Platinum::where('plat_name', 'John Smith')->first()->id,
            'expert_domain_names' => 'Zuriani Binti Mustaffa',
            'expert_domain_emails' => 'zuriani@umpsa.edu.my',
            'expert_domain_phonenumbers' => '094315562',
            'expert_domain_affiliation' => 'Universiti Malaysia Pahang As-Sultan Abdullah',
            'expert_domain_designation' => 'Ts.,Dr.',
            'expert_domain_research_title' => 'Machine Learning',
            'expert_domain_image' => 'null'
        ]);

        ExpertDomain::create([
            'platinum_id' => Platinum::where('plat_name', 'John Smith')->first()->id,
            'expert_domain_names' => 'Abdul Sahli Bin Fakharudin',
            'expert_domain_emails' => 'sahli@umpsa.edu.my',
            'expert_domain_phonenumbers' => '094315539',
            'expert_domain_affiliation' => 'Universiti Malaysia Pahang As-Sultan Abdullah',
            'expert_domain_designation' => 'Ts.,Dr.',
            'expert_domain_research_title' => 'Artificial Neural Network',
            'expert_domain_image' => 'null'
        ]);

        ExpertDomain::create([
            'platinum_id' => Platinum::where('plat_name', 'John Doe')->first()->id,
            'expert_domain_names' => 'Azlee Bin Zabidi',
            'expert_domain_emails' => 'azlee@umpsa.edu.my',
            'expert_domain_phonenumbers' => '094315574',
            'expert_domain_affiliation' => 'Universiti Malaysia Pahang As-Sultan Abdullah',
            'expert_domain_designation' => 'Ts.,Dr.',
            'expert_domain_research_title' => 'Computer-Based Teaching and Learning',
            'expert_domain_image' => 'null'
        ]);

        ExpertDomain::create([
            'platinum_id' => Platinum::where('plat_name', 'John Doe')->first()->id,
            'expert_domain_names' => 'Junaida Binti Sulaiman',
            'expert_domain_emails' => 'junaida@umpsa.edu.my',
            'expert_domain_phonenumbers' => '094315537',
            'expert_domain_affiliation' => 'Universiti Malaysia Pahang As-Sultan Abdullah',
            'expert_domain_designation' => 'Ts.,Dr.',
            'expert_domain_research_title' => 'Data Mining',
            'expert_domain_image' => 'null'
        ]);

        ExpertDomain::create([
            'platinum_id' => Platinum::where('plat_name', 'Alice Johnson')->first()->id,
            'expert_domain_names' => 'Mohd Arfian Bin Ismail',
            'expert_domain_emails' => 'arfian@umpsa.edu.my',
            'expert_domain_phonenumbers' => '094315599',
            'expert_domain_affiliation' => 'Universiti Malaysia Pahang As-Sultan Abdullah',
            'expert_domain_designation' => 'Ts.,Dr.',
            'expert_domain_research_title' => 'Soft Computing',
            'expert_domain_image' => 'null'
        ]);
    }
}
