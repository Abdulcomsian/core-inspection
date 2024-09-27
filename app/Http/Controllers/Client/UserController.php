<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return view('admin.client.user.index');
    }

    public function create()
    {
        return view('admin.client.user.create');
    }
}
