<?php

namespace App\Http\Controllers;

class PageController extends Controller
{
    public function home()
    {
        return view('home');
    }

    public function about()
    {
        return view('about');
    }

    public function umraHaj()
    {
        return view('umra-haj');
    }

    public function contact()
    {
        return view('contact');
    }
	public function features()
    {
        return view('features');
    }
	public function book_call()
    {
        return view('book_call');
    }
}
