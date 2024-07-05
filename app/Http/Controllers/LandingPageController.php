<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    //index

    public function index()
    {
        // get one active hero
        $hero = \App\Models\Hero::where('is_active', true)->first();
        [$mainTitle, $animationTitle] = explode('#', $hero->title);
        $animationTitle = explode('|', $animationTitle);

        // get all services
        $services = \App\Models\Service::all();

        return view('welcome', compact('hero', 'mainTitle', 'animationTitle', 'services'));
    }
}
