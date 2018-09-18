@extends('layouts.app')

@section('content')

<style type="text/css">
    

body {
    font-family: 'Poppins', sans-serif;
    background: #fafafa;
}

p {
    font-family: 'Poppins', sans-serif;
    font-size: 1.1em;
    font-weight: 300;
    color: #999;
}

a, a:hover, a:focus {
    color: inherit;
    text-decoration: none;
    transition: all 0.3s;
}

/* ---------------------------------------------------
    SIDEBAR STYLE
----------------------------------------------------- */

.wrapper {
    margin-top: -25px;
    display: flex;
    width: 100
    align-items: stretch;
    perspective: 1500px;
}


#sidebar {
    min-width: 100%
    max-width: 100%;
    background: #007bff;
    color: #fff;
    transition: all 0.6s cubic-bezier(0.945, 0.020, 0.270, 0.665);
    transform-origin: bottom left;
    border-radius: 2px;
    position: fixed;
    top: 0;
    left: 0;
    height: 100vh;
    z-index: 999;
}

#sidebar .sidebar-header {
    padding: 20px;
    background: #007bff;
}

#sidebar ul.components {
    padding: 20px 0;
    border-bottom: 1px solid #868e96;
}

#sidebar ul p {
    color: #fff;
    padding: 10px;
}

#sidebar ul li a {
    padding: 10px;
    font-size: 1.1em;
    display: block;
}
#sidebar ul li a:hover {
    color: #7386D5;
    background: #fff;
}

#sidebar ul li.active > a, a[aria-expanded="true"] {
    color: #fff;
    background: #6d7fcc;
}


a[data-toggle="collapse"] {
    position: relative;
}

.dropdown-toggle::after {
    display: block;
    position: absolute;
    top: 50%;
    right: 20px;
    transform: translateY(-50%);
}

ul ul a {
    font-size: 0.9em !important;
    padding-left: 30px !important;
    background: #6d7fcc;
}

ul.CTAs {
    padding: 40px;
}

ul.CTAs a {
    text-align: center;
    font-size: 0.9em !important;
    display: block;
    border-radius: 5px;
    margin-bottom: 5px;
}

a.download, a.article:hover  {
    background: #fff;
    color: #7386D5;
}

a.article{
    background: #8d9fcc !important;
    color: #fff !important;
}
.container{
    width: calc(100% - 275px);
    transition: all 0.3s;
    position: absolute;
    right: 0;
}

</style>

    <div class="row">
        <div class="col-md-3">
            <div class="wrapper">
            <!-- Sidebar Holder -->
            <nav id="sidebar">
                <div class="sidebar-header">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSxxVmdMW9Gno0D5DiL0L5K8qiHjRWhkHaIprMYzYYlWmoEEVQz" style="width: 100%; height: 85px">
                </div>
                <ul class="list-unstyled components">
                    <p>Faculty of Engineering and Technology</p>
                    <li class="active">
                        <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Home Options</a>
                        <ul class="collapse list-unstyled" id="homeSubmenu">
                            <li>
                                <a href="{{url('/home')}}">Home</a>
                            </li>
                            <li>
                                <a href="#">Courses</a>
                            </li>
                            <li>
                                <a href="#">Students</a>
                            </li>
                            <li>
                                <a href="#">Course Instructors</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#">Process Statistics</a>
                        <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Other options</a>
                        <ul class="collapse list-unstyled" id="pageSubmenu">
                            <li>
                                <a href="#">Transaction</a>
                            </li>
                            <li>
                                <a href="#">Users</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#">User Manual</a>
                    </li>
                    <li>
                        <a href="#">Contact</a>
                    </li>
                </ul>

                <ul class="list-unstyled CTAs">
                    <li>
                        <a href="{{ asset('file/course_template.xls') }}" class="download">Download class template</a>
                    </li>
                    <li>
                        <a href="{{ asset('file/CA_Marks_Template.xls') }}" class="article">Download CA template</a>
                    </li>
                </ul>
            </nav>
            </div>
        </div>
        <div class="container">
            <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-headin">
                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                <div class="btn-group mr-2" role="group" aria-label="First group">
                    <a href="{{action('CourseController@index')}}" class="btn btn-primary">Add Course </a>
                    <a href="{{action('StudentController@addStudent')}}" class="btn btn-primary">Add Student</a>
                    <a href="{{action('OptionController@addOption')}}" class="btn btn-primary">Add Option </a>
                    <a href="{{action('LecturerController@addLecturer')}}" class="btn btn-primary">Add Lecturer </a>
                    <a href="#" class="btn btn-primary">Add Department </a>
                    <a href="{{action('UserController@addUser')}}" class="btn btn-primary">Add User </a>
                </div><br><hr>
                <div class="btn-group mr-2" role="group" aria-label="First group">
                    <a href="{{action('ExamController@showCA')}}" class="btn btn-warning">Add CA Marks</a>
                    <a href="{{action('ExamController@index')}}" class="btn btn-warning">Add Exam Codes </a>
                    <a href="{{action('ExamController@showExam')}}" class="btn btn-warning">Exam Marks </a>
                <a href="{{action('CourseController@courseResult')}}" class="btn btn-warning">Generate results table </a>
                </div><br><hr>
                <div class="btn-group mr-2" role="group" aria-label="First group">
                    <a href="#" class="btn btn-default text-primary">Class List </a>
                    <a href="#" class="btn btn-default text-primary">Course List</a>
                    <a href="#" class="btn btn-default text-primary">Class results </a>
                    <a href="#" class="btn btn-default text-primary">Course results</a>
                </div>
            </div>
            </div>
        </div>
        </div>
        
    </div>
</div>

@endsection
