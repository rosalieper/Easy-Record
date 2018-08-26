<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OptionController extends Controller
{
    //

    public function addOption()
    {
    	return view('option.add_option');
    }
}
