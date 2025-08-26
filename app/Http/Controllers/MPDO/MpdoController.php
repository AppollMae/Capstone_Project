<?php

namespace App\Http\Controllers\MPDO;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MpdoController extends Controller
{
    public function index(){
        return view('MPDO.dashboard.index');
    }
}
