<?php

namespace App\Http\Controllers\Job;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RentalsController extends Controller
{
    public function index()
    {
        return view("admin.job.rentals.index");
    }

    public function create()
    {
        return view("admin.job.rentals.create");
    }
}
