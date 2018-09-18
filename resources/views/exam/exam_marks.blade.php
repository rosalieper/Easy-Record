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
            <h3> Upload Exam Results</h3><hr>
	</div>
	<div class="panel-body">
		<div class="col-md-6">
			<form method="post" class="form-group" action="{{url('exam/upload/exam')}}" enctype="multipart/form-data">
				 {{ csrf_field() }}
			<label>Course Code:</label>
			<input type="text" name="course_code" class="form-control" placeholder="please enter course code" required>
			<?php
					 echo 'Import class list for course. ';
			         echo 'The file selected must be an excel file.';
			    ?>
			 <input type="file" name="file" required><br>
			 <input type="submit" name="send" class="btn btn-warning">
			</form>
		</div>
		<div class="col-md-5">
			<img src="{{asset('images/exam_result.png')}}">
		</div>
	</div>
	
</div>

@endsection