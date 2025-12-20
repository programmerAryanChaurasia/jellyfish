<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomePageSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class HomePageController extends Controller
{
    /**
     * Display the home page management form
     */
    public function index()
    {
        // Get all existing settings
        $sections = HomePageSetting::all()->keyBy('section_name');
        
        return view('admin.home.manage', compact('sections'));
    }

    /**
     * Store or update home page settings (single method for both)
     */
    public function storeOrUpdate(Request $request)
    {

        //     dd([
        //     'services_count' => count($request->services ?? []),
        //     'services_data' => $request->services,
        //     'hero_slider_count' => count($request->hero_slider ?? []),
        //     'team_count' => count($request->team ?? []),
        //     'team_data' => $request->team,
        //     'hero_slider_data' => $request->hero_slider,
        //     'hero_slider_images' => $request->hero_slider_images,
        //     'team_images' => $request->team_images,
        //     'philosophy_image' => $request->philosophy_image,
        //     'jumbotron_description' => $request->jumbotron_description,
        //     'jumbotron_button_text' => $request->jumbotron_button_text,
        //     'built_with_ease_heading' => $request->built_with_ease_heading,
        //     'built_with_ease_description' => $request->built_with_ease_description,
        //     'request_data' => $request->all(),
        // ]);
     
        $request->validate([
            'hero_slider.*.heading' => 'nullable|string|max:255',
            'hero_slider.*.sub_heading' => 'nullable|string|max:255',
            'hero_slider_images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            
            'jumbotron_description' => 'nullable|string',
            'jumbotron_button_text' => 'nullable|string|max:100',
            
            'built_with_ease_heading' => 'nullable|string|max:255',
            'built_with_ease_description' => 'nullable|string',
            
            'services.*.icon' => 'nullable|string|max:100',
            'services.*.title' => 'nullable|string|max:255',
            'services.*.description' => 'nullable|string',
            
            'team.*.name' => 'nullable|string|max:255',
            'team.*.description' => 'nullable|string',
            'team_images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            
            'philosophy_description' => 'nullable|string',
            'philosophy_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
        ]);

        // Process and save each section
        $this->processHeroSlider($request);
        $this->processJumbotron($request);
        $this->processBuiltWithEase($request);
        $this->processServices($request);
        $this->processTeam($request);
        $this->processPhilosophy($request);

        return redirect()->back()->with('success', 'Home page settings saved successfully!');
    }

    /**
     * Process Hero Slider Section
     */
    private function processHeroSlider(Request $request)
    {
        $sliders = [];
        $existingImages = [];
        
        // Get existing data if any
        $existing = HomePageSetting::where('section_name', 'hero_slider')->first();
        if ($existing && isset($existing->images['sliders'])) {
            $existingImages = $existing->images['sliders'];
        }

        if ($request->has('hero_slider')) {
            foreach ($request->hero_slider as $index => $slider) {
                $sliderData = [
                    'heading' => $slider['heading'] ?? '',
                    'sub_heading' => $slider['sub_heading'] ?? '',
                ];

                // Handle image upload
                if ($request->hasFile("hero_slider_images.{$index}")) {
                    $image = $request->file("hero_slider_images.{$index}");
                    $path = $image->store('home/slider', 'public');
                    $sliderData['image'] = $path;
                } elseif (isset($existingImages[$index])) {
                    $sliderData['image'] = $existingImages[$index];
                }

                $sliders[] = $sliderData;
            }
        }

        $this->saveSection('hero_slider', ['sliders' => $sliders], ['sliders' => array_column($sliders, 'image')]);
    }

    /**
     * Process Jumbotron Section
     */
    private function processJumbotron(Request $request)
    {
        $content = [
            'description' => $request->jumbotron_description ?? '',
            'button_text' => $request->jumbotron_button_text ?? '',
        ];

        $this->saveSection('jumbotron', $content);
    }

    /**
     * Process Built With Ease Section
     */
    private function processBuiltWithEase(Request $request)
    {
        $content = [
            'heading' => $request->built_with_ease_heading ?? 'Built with ease.',
            'description' => $request->built_with_ease_description ?? '',
        ];

        $this->saveSection('built_with_ease', $content);
    }

    /**
     * Process Services Section
     */
    private function processServices(Request $request)
    {
        $services = [];
        
        if ($request->has('services')) {
            foreach ($request->services as $service) {
                if (!empty($service['title']) || !empty($service['description'])) {
                    $services[] = [
                        'icon' => $service['icon'] ?? '',
                        'title' => $service['title'] ?? '',
                        'description' => $service['description'] ?? '',
                    ];
                }
            }
        }

        $this->saveSection('services', ['services' => $services]);
    }

    /**
     * Process Team Section
     */
    private function processTeam(Request $request)
    {
        $teamMembers = [];
        $existingImages = [];
        
        $existing = HomePageSetting::where('section_name', 'team')->first();
        if ($existing && isset($existing->images['members'])) {
            $existingImages = $existing->images['members'];
        }

        if ($request->has('team')) {
            foreach ($request->team as $index => $member) {
                $memberData = [
                    'name' => $member['name'] ?? '',
                    'description' => $member['description'] ?? '',
                ];

                // Handle image upload
                if ($request->hasFile("team_images.{$index}")) {
                    $image = $request->file("team_images.{$index}");
                    $path = $image->store('home/team', 'public');
                    $memberData['image'] = $path;
                } elseif (isset($existingImages[$index])) {
                    $memberData['image'] = $existingImages[$index];
                }

                $teamMembers[] = $memberData;
            }
        }

        $this->saveSection('team', ['members' => $teamMembers], ['members' => array_column($teamMembers, 'image')]);
    }

    /**
     * Process Philosophy Section
     */
    private function processPhilosophy(Request $request)
    {
        $content = ['description' => $request->philosophy_description ?? ''];
        $images = [];

        // Handle philosophy image
        if ($request->hasFile('philosophy_image')) {
            $image = $request->file('philosophy_image');
            $path = $image->store('home/philosophy', 'public');
            $images['main_image'] = $path;
        } else {
            $existing = HomePageSetting::where('section_name', 'philosophy')->first();
            if ($existing && isset($existing->images['main_image'])) {
                $images['main_image'] = $existing->images['main_image'];
            }
        }

        $this->saveSection('philosophy', $content, $images);
    }

    /**
     * Save section to database (create or update)
     */
    private function saveSection($sectionName, $content, $images = [])
    {
        HomePageSetting::updateOrCreate(
            ['section_name' => $sectionName],
            [
                'content' => $content,
                'images' => $images
            ]
        );
    }
}