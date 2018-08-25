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
        
        return view('exam.ca');
    }

    public function showMerge()
    {
        return view('exam.merge_marks');
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
                $data = new StudentCourse ();
                $data->student_id = $student->id;
                $data->course_id = $course->id;
                $data->exam_code = $exam_code1;
                $data->course_code = $exam_session['course_code'];
                $data->student_id_num = $request->matricule;
                $data->save ();
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
        $data = $this->validate($request, [
            'course_code'=>'required',
            'file'=>'required|mimes:xls,xlsx,csv'
        ]);
        if($request->hasFile('file'))
        {

            $path = $request->file('file')->getRealPath();
            $file_data = Excel::load($path, function($reader) {})->get();

            if(!empty($file_data) && $file_data->count())
            {

                foreach ($file_data->toArray() as $key => $value)
                {
                    if(!empty($value))
                    {
                        foreach ($value as$v)
                        {
                            
                            $insert[] = ['course_code'=>$data['course_code'], 'student_id_num' => $v['student_matricule'], 'ca_mark' => $v['C.A.']];
                        }
                    }
                }
                 
                if(!empty($insert))
                {
                    Student::insert($insert);
                }

            }
        }
    }
}