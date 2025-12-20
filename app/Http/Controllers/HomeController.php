<?php

namespace App\Http\Controllers;

use App\Models\HomePageSetting;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Get all home page sections
        $sections = HomePageSetting::all()->keyBy('section_name');

        // dd($sections);
        
        return view('welcome', compact('sections'));
    }
}