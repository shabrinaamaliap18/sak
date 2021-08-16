<?php

namespace App\Http\Controllers\daftarreport;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Auth\Authenticatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class Dp5aController extends Controller
{
    public function index()
    {
        return view('daftarreport.dp5a');
    }
}