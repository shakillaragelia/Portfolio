<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    public function index()
    {
        // Load data from config/portfolio.php
        $data = config('portfolio');
        
        // Pass data to Vue component
        return Inertia::render('Home', [
            'portfolio' => $data
        ]);
    }
}
