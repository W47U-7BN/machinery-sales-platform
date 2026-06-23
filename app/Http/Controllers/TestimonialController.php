<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use Illuminate\View\View;

class TestimonialController extends Controller
{
    public function index(): View
    {
        $testimonials = Testimonial::where('is_approved', true)
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        $featuredTestimonials = Testimonial::where('is_approved', true)
            ->where('is_featured', true)
            ->limit(3)
            ->get();

        return view('testimonials.index', compact('testimonials', 'featuredTestimonials'));
    }
}
