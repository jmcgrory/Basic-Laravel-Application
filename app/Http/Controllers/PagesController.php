<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index(){
        $title = 'Welcome to the Jungle';
        // return view('pages.index', compact('title'));
        return view('pages.index')->with('title', $title);
    }
    
    public function about(){
        $title = 'All About That Action';
        return view('pages.about')->with('title', $title);
    }

    public function services(){
        $data = array(
            'title' => 'Services',
            'services' => ['Gardening', 'DIY', 'Cleaning']
        );
        return view('pages.services')->with($data);
    }
}
