<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\StudentCourse;
use App\Student;
use App\Course;
use Validator;
use Response;
use Illuminate\Support\Facades\Input;

class ExamController extends Controller
{
    public static $exam_code;
    public static $course_code;
   
    //display the view to start exam recording
    public function index()
    {
        //
        return view('exam.index');

    }

    //Get the values from the exam.index view and set the ExamController properties then return
    // a form to create new entries
    public function create(Request $request) {
        $this::$course_code = $request->course_code;
        $this::$exam_code = $request->exam_code;
        error_log($this::$course_code);
        error_log($this::$exam_code);
        //read existing entries from database and return it to a table view
    	$data = StudentCourse::all();
        return view('exam.create')->withData($data);
    }

    public function store(Request $request) {
         $rules = array (
            'faculty_code' => 'required',
            'year'=>'required',
            'letter_code'=>'required',
            'matricule'=>'required'
    );
    $request->matricule = $request->faculty_code.$request->year.$request->letter_code.$request->matricule;
    error_log($request->matricule);
    $validator = Validator::make ( Input::all (), $rules );
    if ($validator->fails ()){
        return Response::json ( array (
                    
                'errors' => $validator->getMessageBag ()->toArray ()
        ) );
        
        } else {
            $this::$course_code = 'CEF201';
            $this::$exam_code = '3333';
            $course = Course::where('course_code', $this::$course_code)->get()->first();
            $student = Student::where('student_id_num', $request->matricule)->get()->first();
            error_log($student);
            error_log($this::$course_code);
            $data = new StudentCourse ();
            $data->student_id = $student->id;
            $data->course_id = $course->id;
            $data->exam_code = $this::$exam_code;
            $data->course_code = $this::$course_code;
            $data->student_id_num = $request->matricule;
            $data->save ();
            $data = StudentCourse::all();
        return view('exam.create')->withData($data);
            //return response ()->json ( $data );
            $this::$exam_code++;
        }

    }

    public function deleteItem(Request $req)
    {
        StudentCourse::find($req->exam_code)->delete();
        //return response()->json();
        $data = StudentCourse::all();
        return view('exam.create')->withData($data);
    }
}
