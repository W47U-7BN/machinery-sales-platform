<?php

namespace App\Http\Controllers;

use App\Models\CompanyInformation;
use App\Models\Setting;
use Illuminate\View\View;

class PageController extends Controller
{
    public function about(): View
    {
        $company = CompanyInformation::first();
        $settings = Setting::all()->keyBy('key');

        return view('about', compact('company', 'settings'));
    }
}
