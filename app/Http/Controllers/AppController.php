<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AppController extends Controller
{
    public function index() {
        $title = 'Home';
        return view('index', compact('title'));
    }
}
