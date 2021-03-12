<?php

namespace App\Http\Controllers;

use App\Auth;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('checklogin');
    }

    public function index()
    {
        echo Auth::user()->name;
    }
}
