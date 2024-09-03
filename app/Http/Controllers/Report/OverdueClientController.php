<?php

namespace App\Http\Controllers\Report;

use App\Models\Role;
use App\Http\Controllers\Controller;

class OverdueClientController extends Controller
{
    public function index()
    {
        $roles = Role::with(['permissions'])->get();
        return view('admin.report.overdue_client.index', compact('roles'));
    }
}
