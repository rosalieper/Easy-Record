@extends('layouts.content')

@section('forms')

<div class="panel panel-defaut">
	<div class="panel-heading text-warning">
			<div class="btn-group mr-2" role="group" aria-label="First group">
              <a href="{{action('ExamController@showCA')}}" class="btn btn-warning">Add CA Marks</a>
                <a href="{{action('ExamController@index')}}" class="btn btn-warning">Add Exam Codes </a>
                <a href="{{action('ExamController@showExam')}}" class="btn btn-warning">Exam Marks </a>
                <a href="{{action('CourseController@courseResult')}}" class="btn btn-warning">Generate results table </a>
            </div><br>
            <h3> Merge and Download Results</h3><hr>
	</div>
	<div class="panel-body">
		<div class="col-md-6">
			<label>Course Code:</label>
			<input type="text" name="course_code" class="form-control" placeholder="please enter course code" required><br>

			 <input type="submit" name="send" class="btn btn-warning">
		</div>
		<div class="col-md-5">
			<img src="{{asset('images/result_download.png')}}">
		</div>
	</div>
	
</div>

@endsection