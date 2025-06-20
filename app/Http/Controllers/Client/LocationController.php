<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function index()
    {
        return view('admin.client.location.index');
    }

    public function create()
    {
        return view('admin.client.location.create');
    }

    public function show()
    {
        return view('admin.client.location.show');
    }
}
