<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExamController extends Controller
{
    //
    public function index()
    {
        //
        return view('exam.index');
    }
    public function create(){
    	return view('exam.create');
    }
}
