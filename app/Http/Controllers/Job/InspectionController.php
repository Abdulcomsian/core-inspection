<?php

namespace App\Http\Controllers\Job;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InspectionController extends Controller
{
    public function index()
    {
        return view('admin.job.inspection.index');
    }

    public function show()
    {
        return view('admin.job.inspection.show');
    }

    public function create()
    {
        return view('admin.job.inspection.create');
    }

    public function edit()
    {
        return view('admin.job.inspection.edit');
    }
}
