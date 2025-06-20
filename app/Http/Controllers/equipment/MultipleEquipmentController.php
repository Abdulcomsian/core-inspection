<?php

namespace App\Http\Controllers\equipment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MultipleEquipmentController extends Controller
{
    public function create()
    {
        return view('admin.equipments.multiple.create');
    }
}
