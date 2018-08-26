<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\StudentCourse;
use App\Student;
use App\Course;
use Validator;
use Response;
use Session;
use Illuminate\Support\Facades\Input;
use Excel;
use File;
use DB;

class ExamController extends Controller
{
    public $exam_code;
    public $course_code;
   
    //display the view to start exam recording
    public function index()
    {
        //
        return view('exam.index');

    }

    public function showCA()
    {
        $data = Null;
        return view('exam.ca')->withData($data);
    }

    public function showExam()
    {
        return view('exam.exam_marks');
    }

    //Get the values from the exam.index view and set the ExamController properties then return
    // a form to create new entries
    public function create(Request $request) {
        $this->course_code = $request->course_code;
        $this->exam_code = $request->exam_code;


        $exam_session = ['course_code'=>$request->course_code, 'exam_code'=>$request->exam_code];
        $request->session()->put('exam_session', $exam_session);
        $request->session()->put('exam_code', $this->exam_code);

        
        //read existing entries from database and return it to a table view
    	 $data = StudentCourse::where('course_code',$exam_session['course_code'])->get();
        return view('exam.create')->withData($data);
    }

//store exam codes and mape to students
    public function store(Request $request) 
    {
         $rules = array (
            'faculty_code' => 'required',
            'year'=>'required',
            'letter_code'=>'required',
            'matricule'=>'required|max:999|digits:3'
        );
        $request->matricule = $request->faculty_code.$request->year.$request->letter_code.$request->matricule;
        $validator = Validator::make ( Input::all (), $rules );
        if ($validator->fails ())
        {
            return Response::json ( array (
                        
                    'errors' => $validator->getMessageBag ()->toArray ()
            ) );
        
        } else 
        {
            $exam_session = $request->session()->get('exam_session');
            $exam_code1 = $request->session()->get('exam_code');
            $course = Course::where('course_code',$exam_session['course_code'])->first();
            $student = Student::where('student_id_num', $request->matricule)->first();

            if($course && $student){
                DB::table('student_has_course')
                    ->where([['student_id_num', $student->student_id_num],
                            ['course_code', $exam_session['course_code']],])
                    ->update(['exam_code' => $exam_code1]);
                $data = StudentCourse::where('course_code',$exam_session['course_code'])->get();
                //var_dump($data);
                $request->session()->forget('exam_code');
                $exam_code1++;
                $request->session()->put('exam_code', $exam_code1);
                return view('exam.create')->withData($data);    

            }
            Session::flash('Data Error:', 'Your Data was not imported');
        //return back();
        }

    }

    public function delete(Request $req)
    {
        StudentCourse::find($req->id)->delete();
        //return response()->json();
        $data = StudentCourse::all();
        return view('exam.create')->withData($data);
    }

    public function uploadCA(Request $request)
    {
        $rules = array (
            'course_code' => 'required',
            'file'=>'required'
        );
        $validator = Validator::make ( Input::all (), $rules );
        error_log('message');
        if($request->hasFile('file'))
        {

            $path = $request->file('file')->getRealPath();
            $file_data = Excel::load($path, function($reader) {})->get();

            if(!empty($file_data) && $file_data->count())
            {
                error_log('message2');
                foreach ($file_data->toArray() as $key => $value)
                {
                    if(!empty($value))
                    {
                        $insert = ['course_code'=>$request->course_code, 'student_name'=>$value['student_name'], 'student_id_num' => $value['student_matricule'], 'ca_mark' => $value['ca_mark']];
                        $course = course::where('course_code', $request->course_code)->first();
                        $student = Student::where('student_id_num', $value['student_matricule'])->first();
                        if($course && $student)
                        {
                            $data = new StudentCourse();
                            $data->student_id = $student->id;
                            $data->course_id = $course->id;
                            $data->course_code = $insert['course_code'];
                            $data->student_id_num = $insert['student_id_num'];
                            $data->ca_mark = $insert['ca_mark'];
                            $data->save();
                        }
                        else{
                            $data = "Oops! The course does not exist or some of the students in the file do not exist";
                            return view('exam.ca')->withData($data);    
                        }

                    }
                    else{
                        $data = "Oops! The file is empty";
                        return view('exam.ca')->withData($data);    
                    }
                }       
            }
            else{
                $data = "Oops! The file is empty";
                return view('exam.ca')->withData($data);    
            }
        }
        else{
            $data = "Oops! upload an excel file";
            return view('exam.ca')->withData($data);    
        }
        $data = "Successfull upload!!!";
        return view('exam.ca')->withData($data);
    }

    public function uploadExam(Request $request)
    {

        $rules = array (
            'course_code' => 'required',
            'file'=>'required'
        );
        $validator = Validator::make ( Input::all (), $rules );
        error_log('message');
        if($request->hasFile('file'))
        {

            $path = $request->file('file')->getRealPath();
            $file_data = Excel::load($path, function($reader) {})->get();

            if(!empty($file_data) && $file_data->count())
            {
                error_log('message2');
                foreach ($file_data->toArray() as $key => $value)
                {
                    if(!empty($value))
                    {
                        $insert = ['course_code'=>$request->course_code, 'exam_code'=>$value['exam_code'], 'exam_mark' => $value['exam_mark']];
                        $course = course::where('course_code', $request->course_code)->first();
                        $student = StudentCourse::where([['exam_code', $value['exam_code']],
                                                        ['course_code', $request->course_code],])->first();
                        if($course && $student)
                        {
                            $total = $value['exam_mark'] + $student->ca_mark;
                            DB::table('student_has_course')
                                ->where([['exam_code', $value['exam_code']],
                                        ['course_code', $request->course_code],])
                                ->update(['exam_mark' => $value['exam_mark'], 'total_mark' => $total]);
                        }
                        else{
                            $data = "Oops! The course does not exist or some of the codes in the file do not exist";
                            return view('exam.ca')->withData($data);    
                        }

                    }
                    else{
                        $data = "Oops! The file is empty";
                        return view('exam.ca')->withData($data);    
                    }
                }       
            }
            else{
                $data = "Oops! The file is empty";
                return view('exam.ca')->withData($data);    
            }
        }
        else{
            $data = "Oops! upload an excel file";
            return view('exam.ca')->withData($data);    
        }
        $data = "Successfull upload!!!";
        return view('exam.ca')->withData($data);
    }
}