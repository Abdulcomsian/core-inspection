<?php

namespace App\Http\Controllers\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SummaryTemplateController extends Controller
{
    public function index()
    {
        return view('admin.setup.summary_temp.index');
    }
}
