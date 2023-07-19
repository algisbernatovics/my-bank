<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class HomeController extends Controller
{
    public function welcome(): view
    {
        return view('welcome');
    }

    public function home(): view
    {
        return view('home');
    }
}
