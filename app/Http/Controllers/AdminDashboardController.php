<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

    public function forms()
    {
        return view('admin.index');
    }

    public function cards()
    {
        return view('admin.index');
    }
}
