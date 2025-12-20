<?php

namespace Database\Seeders;

use App\Models\HomePageSetting;
use Illuminate\Database\Seeder;

class HomePageSettingsSeeder extends Seeder
{
    public function run()
    {
        // Hero Slider
        HomePageSetting::updateOrCreate(
            ['section_name' => 'hero_slider'],
            [
                'content' => [
                    'sliders' => [
                        [
                            'heading' => 'Welcome to Our Website',
                            'sub_heading' => 'Complete Website Layout',
                            'image' => ''
                        ]
                    ]
                ],
                'images' => [
                    'sliders' => ['']
                ]
            ]
        );

        // Jumbotron
        HomePageSetting::updateOrCreate(
            ['section_name' => 'jumbotron'],
            [
                'content' => [
                    'description' => 'A web hosting service allows individuals and organizations to make their website accessible via the World Wide Web.',
                    'button_text' => 'Web Hosting'
                ]
            ]
        );

        // Built With Ease
        HomePageSetting::updateOrCreate(
            ['section_name' => 'built_with_ease'],
            [
                'content' => [
                    'heading' => 'Built with ease.',
                    'description' => 'Welcome to my website tutorial! Bootstrap is a free and open-source front-end library with HTML and CSS based designs.'
                ]
            ]
        );

        // Services
        HomePageSetting::updateOrCreate(
            ['section_name' => 'services'],
            [
                'content' => [
                    'services' => [
                        [
                            'icon' => 'fas fa-code',
                            'title' => 'HTML5',
                            'description' => 'Built with the latest version of HTML, HTML5.'
                        ],
                        [
                            'icon' => 'fas fa-bold',
                            'title' => 'BOOTSTRAP',
                            'description' => 'Built with the latest version of Bootstrap, Bootstrap 4.'
                        ],
                        [
                            'icon' => 'fab fa-css3',
                            'title' => 'CSS3',
                            'description' => 'Built with the latest version of CSS, CSS3.'
                        ]
                    ]
                ]
            ]
        );

        // Team
        HomePageSetting::updateOrCreate(
            ['section_name' => 'team'],
            [
                'content' => [
                    'members' => [
                        [
                            'name' => 'John Doe',
                            'description' => 'John is an Internet entrepreneur with almost 20 years of experience.',
                            'image' => ''
                        ],
                        [
                            'name' => 'Mary Jo',
                            'description' => 'Mary is a designer with almost 10 years of digital design experience.',
                            'image' => ''
                        ],
                        [
                            'name' => 'Phil Ho',
                            'description' => 'Phil is a developer with over 5 years of web development experience.',
                            'image' => ''
                        ]
                    ]
                ],
                'images' => [
                    'members' => ['', '', '']
                ]
            ]
        );

        // Philosophy
        HomePageSetting::updateOrCreate(
            ['section_name' => 'philosophy'],
            [
                'content' => [
                    'description' => 'We know that greatness in a disruptive era requires bold ambition, curious talent and a culture that believes we\'re smarter together. We approach every challenge holistically, with best-in-class expertise in data, creativity, media, technology, search, social and more.'
                ],
                'images' => [
                    'main_image' => ''
                ]
            ]
        );
    }
}