<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FeesController extends Controller
{
    public function Index()
    {
        return view('admin.fees.index');
    }
}
