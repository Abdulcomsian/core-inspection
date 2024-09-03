<?php

namespace App\Http\Controllers\Report;

use App\Models\Role;
use App\Http\Controllers\Controller;

class ScheduleController extends Controller
{
    public function index()
    {
        $roles = Role::with(['permissions'])->get();
        return view('admin.report.schedule.index', compact('roles'));
    }
}
