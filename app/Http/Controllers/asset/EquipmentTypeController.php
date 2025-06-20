<?php

namespace App\Http\Controllers\asset;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EquipmentTypeController extends Controller
{
    public function index()
    {
        return view("admin.asset.equipment_type.index");
    }

    public function create()
    {
        return view("admin.asset.equipment_type.create");
    }

    public function show()
    {
        return view("admin.asset.equipment_type.show");
    }
}
