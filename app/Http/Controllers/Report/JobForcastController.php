<?php

namespace App\Http\Controllers\Report;

use App\Models\Role;
use App\Http\Controllers\Controller;

class JobForcastController extends Controller
{
    public function index()
    {
        $roles = Role::with(['permissions'])->get();
        return view('admin.report.forcast.index', compact('roles'));
    }

    public function create()
    {
        return view('admin.report.forcast.create');
    }
}
