<?php

namespace App\Http\Controllers\BFP;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BfpController extends Controller
{
    public function index(){
        return view('bfp.dashboard.index');
    }
}
