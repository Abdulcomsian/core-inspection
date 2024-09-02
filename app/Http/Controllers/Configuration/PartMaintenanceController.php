<?php

namespace App\Http\Controllers\Configuration;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PartMaintenanceController extends Controller
{
    public function index()
    {
        return view("admin.configuration.part_maintenance.index");
    }
}
