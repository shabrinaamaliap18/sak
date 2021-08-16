<?php

namespace App\Http\Controllers\daftarreport;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Auth\Authenticatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DkrthController extends Controller
{
    public function index()
    {
        return view('daftarreport.dkrth');
    }
}