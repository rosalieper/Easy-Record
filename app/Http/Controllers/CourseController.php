<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Excel;
use App\Student;
use App\Course;
use DB;
use Input;
use File;
use Session;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('course.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function courseResult()
    {
        //
        return view('course.download_result');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $student = new Student();
        $course = new Course();
        $data = $this->validate($request, [
            'course_name'=> 'required',
            'course_code'=>'required',
            'course_cv'=>'required',
            'course_instructor'=>'required',
            'course_status'=>'required',
            'course_level'=>'required',
            'course_option' => 'required',
            'import_file' => 'required'

        ]);
        error_log('Store');
        if($request->hasFile('import_file')){
            $extension = File::extension($request->import_file->getClientOriginalName());
         $course->saveCourse($data);  
       
        if($extension == "xlsx" || $extension == "xls" || $extension == "csv")
        {
        error_log('message');
            $path = $request->file('import_file')->getRealPath();
            $file_data = Excel::load($path, function($reader) {})->get();

            if(!empty($file_data) && $file_data->count())
            {

                foreach ($file_data->toArray() as $key => $value)
                {
                    if(!empty($value))
                    {
                        foreach ($value as$v)
                        {
                            
                            $insert[] = ['student_id_num' => $v['student_matricule'], 'student_name' => $v['student_name'], 'student_level' => $data['course_level'], 'student_option'=> $data['course_option']];
                        }
                    }
                }
                 
                if(!empty($insert))
                {
                    Student::insert($insert);
                }
            }
            Session::flash('success', 'Your Data has successfully imported');
            return redirect('/home')->with('success', 'New support Course has been created! Wait sometime to get resolved');
        }
    //return back()->with('error','Please Check your file, Something is wrong there.');
        else {
                Session::flash('error', 'File is a '.$extension.' file.!! Please upload a valid xls/csv file..!!');
                return back();
            }
        }
    }
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        return view('course.index');

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showResult(Request $request)
    {
        //
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
