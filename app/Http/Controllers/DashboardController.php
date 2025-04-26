<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;


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