@extends('layouts.content')

@section('forms')
<div class="panel panel-default">
	<div class="panel-heading text-primary">
		<h3>Add A Course</h3>
	</div>
	<div class="panel-body">
		<form class="form-group col-md-6" method="post" action="{{action('CourseController@store')}}" enctype="multipart/form-data">
			 {{ csrf_field() }}
			<label for="exampleInputEmail1">Course Name:</label>
			<input type="text" name="course_name" placeholder="course name" class="form-control" required>
			<label for="exampleInputEmail1">Course Code:</label>
			<input type="text" name="course_code" placeholder="course code" class="form-control" required>
			<label for="exampleInputEmail1">Course Status:</label>
			<input type="text" name="course_status" placeholder="course status" class="form-control" required>
			<label for="exampleInputEmail1">Course Credit Value:</label>
			<input type="text" name="course_cv" placeholder="course credit value" class="form-control" required>
			<label for="exampleInputEmail1">Course Instructor:</label>
			<input type="text" name="course_instructor" placeholder="course instructor" class="form-control" required>
			<label for="exampleInputEmail1">Course Level</label>
			<input type="text" name="course_level" placeholder="course level" class="form-control" required>
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
	</div>
</div>
@endsection