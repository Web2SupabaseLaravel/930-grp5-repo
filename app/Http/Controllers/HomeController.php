<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Certificate; 

class HomeController extends Controller
{
    public function index()
    {
        $certificates = Certificate::all();

        return view('home', compact('certificates'));
    }
}
