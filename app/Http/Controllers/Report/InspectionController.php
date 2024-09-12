<?php

namespace App\Http\Controllers\Report;

use App\Models\Role;
use App\Http\Controllers\Controller;

class InspectionController extends Controller
{
    public function index()
    {
        return view('admin.report.inspection.index');
    }
}
