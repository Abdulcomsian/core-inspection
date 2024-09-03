<?php

namespace App\Http\Controllers\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class JobTemplateController extends Controller
{
    public function index()
    {
        return view("admin.setup.job_type.index");
    }
}
