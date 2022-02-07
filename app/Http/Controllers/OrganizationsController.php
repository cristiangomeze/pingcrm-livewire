<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use Illuminate\Http\Request;

class OrganizationsController extends Controller
{
    public function __invoke()
    {
        return view('organizations.index');
    }
}
