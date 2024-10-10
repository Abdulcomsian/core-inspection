<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BillingController extends Controller
{
    function index()
    {
        return view('admin.billing.index');
    }

    function create()
    {
        return view('admin.billing.create');
    }

    function show()
    {
        return view('admin.billing.show');
    }
}
