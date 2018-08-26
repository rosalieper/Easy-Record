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
            <h3>Add Lecturer</h3><hr>
	</div>
	<div class="panel-body">
		<div class="col-md-6">
			<label>Lecturer Name:</label>
			<input type="text" name="lecturer_name" class="form-control" placeholder="please enter name" required>
			<label>Lecturer Phone:</label>
			<input type="text" name="lecturer_phone" class="form-control" placeholder="please enter phone number" required>
			<label>Lecturer email:</label>
			<input type="text" name="lecturer_email" class="form-control" placeholder="please enter email" required>
			<label>Department:</label>
			<select class="form-control" name='course_option'required>
		      <option>Computer</option>
		      <option>Electrical</option>
		      <option>Civil</option>
		    </select>
			<br><input type="submit" name="send" class="btn btn-primary">
		</div>
		<div class="col-md-5">
			<img src="{{asset('images/lecturer.png')}}">
		</div>
	</div>
	
</div>
@endsection