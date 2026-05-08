<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;

class AboutController extends Controller
{
    public function __invoke()
    {
        $testimonials = Testimonial::featured()->active()->ordered()->limit(3)->get();

        return view('pages.about', compact('testimonials'));
    }
}
