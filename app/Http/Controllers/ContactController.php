<?php

namespace App\Http\Controllers;

use App\Enums\InquirySource;
use App\Models\Inquiry;
use App\Models\Service;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;

class ContactController extends Controller
{
    public function show(Request $request)
    {
        $services = Service::active()->ordered()->get(['id', 'name']);
        $vehicles = Vehicle::published()->available()->with('category')->ordered()->get(['id', 'name', 'vehicle_category_id']);

        $success = $request->session()->pull('inquiry_success', false);

        return view('pages.contact', compact('services', 'vehicles', 'success'));
    }

    public function store(Request $request)
    {
        $key = 'inquiry:' . $request->ip();

        if (RateLimiter::tooManyAttempts($key, config('uprise.inquiry.rate_limit_per_minute', 5))) {
            return back()
                ->withInput()
                ->withErrors(['rate_limit' => 'Too many requests. Please wait a moment and try again.']);
        }

        RateLimiter::hit($key, 60);

        $validated = $request->validate([
            'full_name'          => ['required', 'string', 'max:120'],
            'email'              => ['required', 'email', 'max:180'],
            'phone'              => ['nullable', 'string', 'max:40'],
            'pickup_location'    => ['required', 'string', 'max:200'],
            'destination'        => ['nullable', 'string', 'max:200'],
            'travel_date_start'  => ['required', 'date', 'after_or_equal:today'],
            'travel_date_end'    => ['nullable', 'date', 'after_or_equal:travel_date_start'],
            'passenger_count'    => ['required', 'integer', 'min:1', 'max:50'],
            'service_id'         => ['nullable', 'integer', 'exists:services,id'],
            'vehicle_id'         => ['nullable', 'integer', 'exists:vehicles,id'],
            'notes'              => ['nullable', 'string', 'max:2000'],
        ]);

        Inquiry::create([
            ...$validated,
            'source'     => InquirySource::WebForm->value,
            'ip'         => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return redirect()->route('contact')->with('inquiry_success', true);
    }
}
