<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function __invoke()
    {
        return view('users.index');
    }
}
