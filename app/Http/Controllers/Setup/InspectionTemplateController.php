<?php

namespace App\Http\Controllers\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InspectionTemplateController extends Controller
{
    public function index()
    {
        return view('admin.setup.inspection_temp.index');
    }
}
