<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function bidan()
    {
        return view('bidan.dashboard');
    }
    public function asisten()
    {
        return view('asisten.dashboard');
    }
}