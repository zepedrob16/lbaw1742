<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function homepage(){
    	return view('pages.homepage');
    }

    public function about(){
    	return view('pages.about');
    }

    public function error404(){
    	return view('pages.error404');
    }
}
