<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class JobForcastController extends Controller
{
    public function index()
    {
        $roles = Role::with(['permissions'])->get();
        return view('admin.report.forcast.index', compact('roles'));
    }
}
