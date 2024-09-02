<?php

namespace App\Http\Controllers\Configuration;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ZoneMaintenanceController extends Controller
{
    public function index()
    {
        return view("admin.configuration.zone_maintenance.index");
    }
}
