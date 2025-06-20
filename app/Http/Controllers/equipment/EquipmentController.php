<?php

namespace App\Http\Controllers\equipment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EquipmentController extends Controller
{
    public function index()
    {
        return view('admin.equipments.index');
    }

    public function create()
    {
        return view('admin.equipments.create');
    }

    public function show()
    {
        return view('admin.equipments.show');
    }
}
