@extends('layouts.content')

@section('forms')
<div class="panel panel-defaut">
	<div class="panel-heading text-primary">
			<div class="btn-group mr-2" role="group" aria-label="First group">
                <a href="{{action('CourseController@index')}}" class="btn btn-primary">Add Course </a>
                <a href="{{action('StudentController@addStudent')}}" class="btn btn-primary">Add Student</a>
                <a href="{{action('OptionController@addOption')}}" class="btn btn-primary">Add Option </a>
                <a href="{{action('LecturerController@addLecturer')}}" class="btn btn-primary">Add Lecturer </a>
                <a href="#" class="btn btn-primary">Add Department </a>
                <a href="{{action('UserController@addUser')}}" class="btn btn-primary">Add User </a>
                </div>
            <h3>Add A student to a course</h3><hr>
	</div>
	<div class="panel-body">
		<div class="col-md-6">
			<label>Student Name:</label>
			<input type="text" name="student_name" class="form-control" placeholder="please enter name" required>
			<label>Student matricule</label>
			<input type="text" name="student matricule" class="form-control" placeholder="please enter matricule" required>
			<label>Level</label>
			<input type="text" name="level" class="form-control" placeholder="please enter level" required>
			<label>Course Code:</label>
			<input type="text" name="course_code" class="form-control" placeholder="please enter course code" required>
			
			 <br><input type="submit" name="send" class="btn btn-primary">
		</div>
		<div class="col-md-5">
			<img src="{{asset('images/student.jpeg')}}">
		</div>
	</div>
	
</div>
@endsection