<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\View\View;

class ClientController extends Controller
{
    public function index(): View
    {
        $clients = Client::where('is_active', true)
            ->orderBy('sort_order')
            ->paginate(24);

        return view('clients.index', compact('clients'));
    }
}
