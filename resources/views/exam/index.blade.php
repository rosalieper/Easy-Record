@extends('layouts.content')

@section('forms')

<div class="panel panel-default">
	<div class="panel-body">
		<div class="text-warning">
			<h3>Exams Insersion</h3><hr>
		</div>
		<div>
			<form method="post" class="form-group col-md-6" action="{{url('/exam/create')}}">
				{{ csrf_field() }}
				<label for="courseCode">Course Code:</label>
				<input type="text" name="course_code" placeholder="Enter Course Code" class="form-control" required><br>
				<label for="courseCode">Exam Code (first entry):</label>
				<input type="text" name="exam_code" placeholder="Enter Course Code" class="form-control" required><br>
				<label for="option">Select option</label>
			    <select class="form-control" id="exampleFormControlSelect1" name='course_option'required>
			      <option>Software Engineering</option>
			      <option>Network Engineering</option>
			      <option>Telecom Engineering</option>
			    </select><br>
			    <button type="submit" class="btn btn-warning btn-right">Send</button>
			</form>
		</div>
	</div>
</div>

@endsection