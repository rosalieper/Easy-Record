@extends('layouts.content')

@section('forms')
<div class="">
	@if (is_string($data))
	    <div class="alert alert-danger">
	        <ul>
	                <li>{{ $data }}</li>
	        </ul>
	    </div>
	@endif

	<div class="col-md-8">
		<h3>Hello</h3>
		<div class="table-responsive text-center">
  			<table class="table table-borderless" id="table">
  				<thead>
  					<tr>
  						<th class="text-center">#Code</th>
  						<th class="text-center">Matricule</th>
  						<th class="text-center">Actions</th>
  					</tr>
  				</thead>
  			@if(!is_string($data))
  				@foreach($data as $item)
  				<tr class="item{{$item->id}}">
  					<td>{{$item->exam_code}}</td>
  					<td>{{$item->student_id_num}}</td>
  					<td><button class="edit-modal btn btn-primary" data-id="{{$item->exam_code}}"
  							data-name="{{$item->student_id_num}}">
  							<span class="glyphicon glyphicon-edit"></span> Edit
  						</button>
  						<button class="delete-modal btn"
  							data-id="{{$item->exam_code}}" data-name="{{$item->student_id_num}}">
  							<span class="glyphicon glyphicon-trash"></span> Delete
  						</button></td>
  				</tr>
  				@endforeach
  			@endif
  			</table>
  		</div>
	</div>
	<div class="col-md-4">
		<form method="post" action="{{action('ExamController@store')}}">
			<div class="panel panel-default">
			<div class="panel-heading text-warning">
				<h3>Add Record</h3>
			</div>
			<div class="panel-body form-group add">
				{{ csrf_field() }}
				<label for="option">Faculty code</label>
			    <select class="form-control" id="exampleFormControlSelect1" name='faculty_code'required>
			      <option>FE</option>
			      <option>CO</option>
			      <option>SC</option>
			    </select><br>
			    <label for="option">Year</label>
			    <select class="form-control" id="exampleFormControlSelect1" name='year'required>
			      <option>09</option>
			      <option>10</option>
			      <option>11</option>
			      <option>12</option>
			      <option>13</option>
			      <option>14</option>
			      <option>15</option>
			      <option>16</option>
			      <option>17</option>
			      <option>18</option>
			      <option>19</option>
			    </select><br>
			    <label for="option">Lettercode</label>
			    <select class="form-control" id="exampleFormControlSelect1" name='letter_code'required>
			      <option>A</option>
			      <option>B</option>
			      <option>C</option>
			    </select><br>
			    <label>Matricule number</label>
			    <input type="text" name="matricule" class="form-control" id="matricule"><br>
			    <button class="btn btn-warning" type="submit" id="add">
    					<span class="glyphicon glyphicon-plus"></span> ADD
    				</button>
			</div>
		</div>
		</form>
		
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function() {
		$("#add").click(function() {
 	console.log("enter");
    $.ajax({
        type: 'post',
        url: '/exam/store',
        data: {
            '_token': $('input[name=_token]').val(),
            'faculty_code': $('input[faculty=faculty_code]').val(),
            'year':$('input[year=year]').val(),
            'letter_code':$('input[letter_code=letter_code]').val(),
            'matricule':$('input[matricule=matricule]').val()
        },
        success: function(data) {
            if ((data.errors)) {
                $('.error').removeClass('hidden');
                $('.error').text(data.errors.student_id_num);
            } else {
                $('.error').remove();
                $('#table').append("<tr class='item" + data.exam_code + "'><td>" + data.exam_code + "</td><td>" + data.student_id_num + "</td><td><button class='edit-modal btn btn-info' data-id='" + data.exam_code + "' data-name='" + data.student_id_num + "'><span class='glyphicon glyphicon-edit'></span> Edit</button> <button class='delete-modal btn btn-danger' data-id='" + data.exam_code + "' data-name='" + data.student_id_num + "'><span class='glyphicon glyphicon-trash'></span> Delete</button></td></tr>");
            }
        },
    });
    $('#matricule').val('');
	});
	});
</script>
<script src="{{ asset('js/script.js') }}"></script>
@endsection