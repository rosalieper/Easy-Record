<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LecturerController extends Controller
{
    //
    public function addLecturer()
    {
    	return view('lecturer.add_lecturer');
    }
}
