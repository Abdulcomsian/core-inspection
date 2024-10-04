<?php

namespace App\Http\Controllers\asset;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PartController extends Controller
{
    public function index()
    {
        return view("admin.asset.part.index");
    }

    public function create()
    {
        return view("admin.asset.part.create");
    }

    public function show()
    {
        return view("admin.asset.part.show");
    }
}
