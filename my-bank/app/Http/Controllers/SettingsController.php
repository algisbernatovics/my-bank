<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class SettingsController extends Controller
{
    public function showSettings(): view
    {
        return view('settings');
    }
}
