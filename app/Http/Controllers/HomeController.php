<?php

namespace App\Http\Controllers;

use App\Models\Datawakif;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function welcome()
    {
        $data = Datawakif::all();

        return view('welcome', compact('data'));
    }
}
