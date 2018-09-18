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
            <h3>Add A User</h3><hr>
	</div>
	<div class="panel-body">
		<div class="col-md-6">
			<label>User Name:</label>
			<input type="text" name="student_name" class="form-control" placeholder="please enter name" required>
			<label>Email: </label>
			<input type="email" name="email" class="form-control" placeholder="enter user email" required>
			<label>Phone</label>
			<input type="text" name="phone" class="form-control" placeholder="phone number" required>
			<label>Password</label>
			<input type="password" name="password" class="form-control" placeholder="password" required>
			<label>Confirm</label>
			<input type="password" name="password" class="form-control" placeholder="password" required>
			<br><label>User role</label>
			<div class="radio">
			  <label><input type="radio" name="optradio">Super Admin</label>
			</div>
			<div class="radio">
			  <label><input type="radio" name="optradio" checked>Partial Admin</label>
			</div>
			
			 <br><input type="submit" name="send" class="btn btn-primary">
		</div>
		<div class="col-md-5">
			<img src="{{asset('images/user.png')}}">
		</div>
	</div>
	
</div>
@endsection