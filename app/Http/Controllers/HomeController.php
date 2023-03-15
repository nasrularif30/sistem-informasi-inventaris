<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        // you can call some model here
        // store data in a variable and
        // pass this data to your view file

        // passing data to view file
        return view('index');
    }
}