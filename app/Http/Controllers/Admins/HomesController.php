<?php

namespace App\Http\Controllers\Admins;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomesController extends Controller
{
    public function index()
    {
        return view('admins.index');
    }
}
