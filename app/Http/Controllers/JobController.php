<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class JobController extends Controller
{
    public function index()
    {
        return view('admin.jobs.index');
    }

    public function create()
    {
        return view('admin.jobs.create');
    }
}
