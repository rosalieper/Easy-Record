@extends('layouts.content')

@section('forms')
<div class="panel panel-default">
	<div class="panel-heading text-primary">
		<div class="btn-group mr-2" role="group" aria-label="First group">
                <a href="{{action('CourseController@index')}}" class="btn btn-primary">Add Course </a>
                <a href="{{action('StudentController@addStudent')}}" class="btn btn-primary">Add Student</a>
                <a href="{{action('OptionController@addOption')}}" class="btn btn-primary">Add Option </a>
                <a href="{{action('LecturerController@addLecturer')}}" class="btn btn-primary">Add Lecturer </a>
                <a href="#" class="btn btn-primary">Add Department </a>
                <a href="{{action('UserController@addUser')}}" class="btn btn-primary">Add User </a>
        </div><br>
		<h4>Add A Course</h4>
	</div>
	<div class="panel-body">
		<form class="form-group col-md-6" method="post" action="{{action('CourseController@store')}}" enctype="multipart/form-data">
			 {{ csrf_field() }}
			<label for="exampleInputEmail1">Course Name:</label>
			<input type="text" name="course_name" placeholder="course name" class="form-control" required>
			<label for="exampleInputEmail1">Course Code:</label>
			<input type="text" name="course_code" placeholder="course code" class="form-control" required>
			<label for="exampleInputEmail1">Course Credit Value:</label>
			<input type="text" name="course_cv" placeholder="course credit value" class="form-control" required>
			<label for="exampleInputEmail1">Course Instructor:</label>
			<input type="text" name="course_instructor" placeholder="course instructor" class="form-control" required>
			<label for="exampleInputEmail1">Course Status:</label>
			<select class="form-control" id="exampleFormControlSelect1" name='course_option'required>
		      <option>C</option>
		      <option>E</option>
		    </select>
			<label for="exampleInputEmail1">Course Level</label>
			<select class="form-control" id="exampleFormControlSelect1" name='course_option'required>
		      <option>200</option>
		      <option>300</option>
		      <option>400</option>
		      <option>500</option>
		      <option>600</option>
		      <option>700</option>
		    </select>
			<label for="option">Select option</label>
		    <select class="form-control" id="exampleFormControlSelect1" name='course_option'required>
		      <option>Software Engineering</option>
		      <option>Network Engineering</option>
		      <option>Telecom Engineering</option>
		    </select><br>
			<?php
		         //echo Form::open(array('url' => '/importExcel','files'=>'true', 'class'=>'btn btn-primary'));
				 echo 'Import class list for course. ';
		         echo 'The file selected must be an excel file.';
		    ?>
		    <input type="file" name="import_file">
		    <button type="submit" class="btn btn-primary btn-right">Send</button>
		</form>
		<div class="col-md-5">
			<img src="{{asset('images/course.png')}}">
		</div>
	</div>
</div>
@endsection