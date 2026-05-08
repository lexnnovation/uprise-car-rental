<?php

namespace App\Http\Controllers;

use App\Models\Faq;

class FaqController extends Controller
{
    public function __invoke()
    {
        $faqs = Faq::active()->ordered()->get();

        $grouped = $faqs->groupBy('category')->sortKeys();

        return view('pages.faq', compact('grouped'));
    }
}
