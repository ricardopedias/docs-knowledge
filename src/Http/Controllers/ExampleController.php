<?php

namespace Plexi\Foundation\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class ExampleController extends Controller
{
    //
    public function add($a, $b)
    {
        $result = $a + $b;
	return view('foundation::add', compact('result'));
    }

    public function subtract($a, $b)
    {
    	echo $a - $b;
    }
}