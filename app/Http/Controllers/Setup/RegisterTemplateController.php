<?php

namespace App\Http\Controllers\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RegisterTemplateController extends Controller
{
    public function index()
    {
        return view('admin.setup.register_temp.index');
    }
}
