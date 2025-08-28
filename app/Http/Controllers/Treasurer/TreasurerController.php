<?php

namespace App\Http\Controllers\Treasurer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TreasurerController extends Controller
{
    public function index(){
        return view('treasurer.dashboard.index');
    }
}
