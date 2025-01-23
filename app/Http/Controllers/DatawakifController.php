<?php

namespace App\Http\Controllers;

use App\Models\Datawakif;
use Illuminate\Http\Request;


class DatawakifController extends Controller
{
    public function index()
    {
        $data = Datawakif::all();

        return view('welcome', compact('data'));
    }
}
