<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function index()
    {
        return Inertia::render('Home/Home', [
            'cars' => [
                [
                    'name' => 'Toyota Avanza',
                    'year' => 2023,
                    'color' => 'Silver',
                    'capacity' => 7,
                    'transmission' => 'Manual',
                    'prices' => [
                        'daily' => '350K',
                        'weekly' => '2.2JT',
                        'monthly' => '7.5JT',
                    ],
                    'image' => 'https://images.unsplash.com/photo-1621007947382-bb3c3994e3fb',
                    'available' => true,
                ],
                [
                    'name' => 'Toyota Avanza',
                    'year' => 2023,
                    'color' => 'Silver',
                    'capacity' => 7,
                    'transmission' => 'Manual',
                    'prices' => [
                        'daily' => '350K',
                        'weekly' => '2.2JT',
                        'monthly' => '7.5JT',
                    ],
                    'image' => 'https://images.unsplash.com/photo-1621007947382-bb3c3994e3fb',
                    'available' => true,
                ],
                [
                    'name' => 'Toyota Avanza',
                    'year' => 2023,
                    'color' => 'Silver',
                    'capacity' => 7,
                    'transmission' => 'Manual',
                    'prices' => [
                        'daily' => '350K',
                        'weekly' => '2.2JT',
                        'monthly' => '7.5JT',
                    ],
                    'image' => 'https://images.unsplash.com/photo-1621007947382-bb3c3994e3fb',
                    'available' => true,
                ],
                // Innova, Fortuner, dst
            ]
        ]);
    }
}
