<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Platinum;
use App\Models\User;
use App\Models\Publication;

    class PublicationDum extends Seeder
    {
        /**
         * Run the database seeds.
         */
        public function run(): void
        {
             // Specified Platinum names with example publications
             Publication::create([
                'platinum_id' => Platinum::where('plat_name', 'John Smith')->first()->id,
                'P_title' => 'A Study on Quantum Computing',
                'P_authors' => 'John Smith, Jane Doe',
                'P_published_date' => '2023-10-15',
                'P_type' => 'Journal',
                'P_volume' => '35',
                'P_issues' => '2',
                'P_pages' => '125',
                'P_publisher' => 'IEEE',
                'P_description' => 'This journal article discusses the recent advancements in quantum computing and its applications.',
                'P_path' => 'https://ieeexplore.ieee.org/document/9506212',
            ]);

            Publication::create([
            'platinum_id' => Platinum::where('plat_name', 'John Smith')->first()->id,
            'P_title' => 'Machine Learning Algorithms for Predictive Analytics',
            'P_authors' => 'John Smith, Alice Johnson',
            'P_published_date' => '2022-05-20',
            'P_type' => 'Conference',
            'P_volume' => '78',
            'P_issues' => '0',
            'P_pages' => '257',
            'P_publisher' => 'ICML',
            'P_description' => 'This conference paper presents various machine learning algorithms and their applications in predictive analytics.',
            'P_path' => 'https://icml.cc/Conferences/2022/Schedule?showEvent=17306',
        ]);
             Publication::create([
            'platinum_id' => Platinum::where('plat_name', 'John Doe')->first()->id,
            'P_title' => 'Advances in Artificial Intelligence',
            'P_authors' => 'John Doe, Bob Smith',
            'P_published_date' => '2023-08-10',
            'P_type' => 'Journal',
            'P_volume' => '50',
            'P_issues' => '3',
            'P_pages' => '225',
            'P_publisher' => 'Springer',
            'P_description' => 'This journal article discusses recent advances in artificial intelligence research and its applications.',
            'P_path' => 'https://link.springer.com/article/10.1007/s10462-023-09873-w',
        ]);
            Publication::create([
            'platinum_id' => Platinum::where('plat_name', 'John Doe')->first()->id,
            'P_title' => 'Deep Learning Techniques for Image Recognition',
            'P_authors' => 'John Doe, Alice Johnson, Robert Williams',
            'P_published_date' => '2024-02-28',
            'P_type' => 'Conference',
            'P_volume' => '78',
            'P_issues' => '0',
            'P_pages' => '491',
            'P_publisher' => 'CVPR',
            'P_description' => 'This conference paper presents deep learning techniques for image recognition tasks and their performance evaluation.',
            'P_path' => 'https://openaccess.thecvf.com/content/CVPR2024/html/Doe_Deep_Learning_Techniques_for_Image_Recognition_CVPR_2024_paper.html',
        ]);

            Publication::create([
            'platinum_id' => Platinum::where('plat_name', 'Alice Johnson')->first()->id,
            'P_title' => 'Blockchain Technology: A Comprehensive Overview',
            'P_authors' => 'Alice Johnson',
            'P_published_date' => '2022-12-05',
            'P_type' => 'Book',
            'P_volume' => '20',
            'P_issues' => '0',
            'P_pages' => '352',
            'P_publisher' => 'O\'Reilly Media',
            'P_description' => 'This book provides a comprehensive overview of blockchain technology, covering its principles, applications, and challenges.',
            'P_path' => 'https://www.oreilly.com/library/view/blockchain-basics/9781789805147/',
        ]);
        
            Publication::create([
            'platinum_id' => Platinum::where('plat_name', 'Alice Johnson')->first()->id,    
            'P_title' => 'Cybersecurity Threats and Countermeasures',
            'P_authors' => 'Alice Johnson, Jane Doe',
            'P_published_date' => '2023-04-18',
            'P_type' => 'Journal',
            'P_volume' => '40',
            'P_issues' => '4',
            'P_pages' => '179',
            'P_publisher' => 'IEEE',
            'P_description' => 'This journal article discusses various cybersecurity threats and strategies to counter them, authored by Alice Johnson and Jane Doe.',
            'P_path' => 'https://ieeexplore.ieee.org/document/9509321',
        ]);
            
            Publication::create([
            'platinum_id' => Platinum::where('plat_name','Bob Smith')->first()->id,    
            'P_title' => 'The Role of Big Data in Business Analytics',
            'P_authors' => 'Bob Smith',
            'P_published_date' => '2023-11-30',
            'P_type' => 'Journal',
            'P_volume' => '25',
            'P_issues' => '1',
            'P_pages' => '56',
            'P_publisher' => 'Wiley',
            'P_description' => 'This journal article explores the role of big data in business analytics and its impact on decision-making processes.',
            'P_path' => 'https://onlinelibrary.wiley.com/doi/full/10.1002/cpe.5605',
        ]);
         
            Publication::create([
            'platinum_id' => Platinum::where('plat_name', 'Bob Smith')->first()->id,    
            'P_title' => 'Data Privacy and Security in IoT: Challenges and Solutions',
            'P_authors' => 'Bob Smith, Alice Johnson',
            'P_published_date' => '2023-03-28',
            'P_type' => 'Journal',
            'P_volume' => '30',
            'P_issues' => '3',
            'P_pages' => '215',
            'P_publisher' => 'Springer',
            'P_description' => 'This journal article examines the challenges of data privacy and security in the Internet of Things (IoT) environment and proposes solutions.',
            'P_path' => 'https://link.springer.com/article/10.1007/s11277-023-08731-w',
        ]);

             Publication::create([
            'platinum_id' => Platinum::where('plat_name', 'Robert Williams')->first()->id,    
            'P_title' => 'Natural Language Processing: Techniques and Applications',
            'P_authors' => 'Robert Williams, Jane Doe',
            'P_published_date' => '2023-09-18',
            'P_type' => 'Book',
            'P_volume' => '15',
            'P_issues' => '0',
            'P_pages' => '280',
            'P_publisher' => 'Springer',
            'P_description' => 'This book provides an overview of natural language processing techniques and their applications in various domains.',
            'P_path' => 'https://link.springer.com/book/10.1007/978-3-030-67100-3',
        ]);
                
            Publication::create([
            'platinum_id' => Platinum::where('plat_name', 'Robert Williams')->first()->id,    
            'P_title' => 'Emerging Trends in Artificial Intelligence',
            'P_authors' => 'Robert Williams, Alice Johnson',
            'P_published_date' => '2024-04-10',
            'P_type' => 'Conference',
            'P_volume' => '9',
            'P_issues' => '0',
            'P_pages' => '147',
            'P_publisher' => 'AAAI',
            'P_description' => 'This conference paper discusses emerging trends in artificial intelligence research and their potential impact on various applications.',
            'P_path' => 'https://aaai.org/ojs/index.php/AAAI/article/view/17390',
            ]);
        }
    }