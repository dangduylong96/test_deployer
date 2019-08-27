<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index(){
    	$a = 3;
    	return view('welcome');
    }
}
