<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function Index()
    {
        return view('admin.users.index');
    }
}
