<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        // Load data from config/contact.php
        $data = config('contact');
        
        // Pass data to Vue component
        return Inertia::render('Home', [
            'contact' => $data
        ]);
    }
}
