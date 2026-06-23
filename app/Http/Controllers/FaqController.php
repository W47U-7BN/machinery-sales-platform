<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use Illuminate\View\View;

class FaqController extends Controller
{
    public function index(): View
    {
        $categories = Faq::where('is_active', true)
            ->whereNotNull('category')
            ->distinct('category')
            ->pluck('category');

        $faqs = Faq::where('is_active', true)
            ->orderBy('sort_order')
            ->get()
            ->groupBy('category');

        return view('faq.index', compact('faqs', 'categories'));
    }
}
