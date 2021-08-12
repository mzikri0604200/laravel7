<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $name =  request('name');

        // $theName = "kiki";
        // ['name' => $theName] // ['blade' => 'variableController' ]
        return view('home', compact("name"));
    }
}
