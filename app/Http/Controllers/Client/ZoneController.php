<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ZoneController extends Controller
{
    public function index()
    {
        return view('admin.client.zone.index');
    }

    public function create()
    {
        return view('admin.client.zone.create');
    }

    public function show()
    {
        return view('admin.client.zone.show');
    }
}
