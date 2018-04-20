<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index(){
    	$title = 'Welcome to SHOWCHAN!';
    	return view('pages.index')->with('title', $title);
    }

    public function about(){
    	return view('pages.about');
    }

    public function error(){
    	$data = array(
    	'title' => 'Errors',
    	'services' => ['Bug', 'Something']
    	);
    	return view('pages.error')->with($data);
    }
}
