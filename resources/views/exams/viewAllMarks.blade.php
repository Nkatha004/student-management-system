@include('dashboard.dashboardSideNav')
<main>
    <form method="POST" action = "{{ URL::to('/filterclassbyterm') }}">
    	@csrf
	    <div class = "col-12">
	        <b><label for="inputState" class="form-label">Filter by Term</label></b>
	    </div>
	    <div class="input-group">
	    	<div class = "col-md-6">
				<select id="inputState" class="form-select col-md-6" name = "term">
					<option selected value = "all">All Terms</option>
		            <option value = "Term 1">Term 1</option>
		            <option value = "Term 2">Term 2</option>
		            <option value = "Term 3">Term 3</option>
				</select>
			</div>
			<div class="input-group-append">
				<button class="btn btn-success">Filter</button>
			</div>
		</div>
	</form>
	<br/><br/>
	<div class = "text-center table-schools">
		@if($term == 'all')
			<h4>Term 1</h4>
			<table class="table table-striped table-hover">
				<thead>
					<tr>
						<th scope="col">Name</th>
	                    <th scope="col">Subject</th>
	                    <th scope="col">Mark</th>
					</tr>
				</thead>
				<tbody>
					@foreach($marks as $mark)
						@if($mark->term == 'Term 1')
						<tr>
							<td>{{ App\Http\Controllers\StudentSubjectsController::getStudentName($mark->student_subject_id) }}</td>
							<td>{{ App\Http\Controllers\StudentSubjectsController::getSubject($mark->student_subject_id) }}</td>
							<td>{{ $mark->mark }}</td>
							@if (Auth::user()->role_id == 2)
							<td>
								<a href = "{{ url('/editmark/'.$mark->id) }}" class = "btn btn-sm btn-warning">Update</a>
								<a href = "{{ url('/deletemark/'.$mark->id) }}" class = "btn btn-sm btn-danger">Delete</a>
							</td>
							@endif
						</tr>
						@endif
					@endforeach
	                
				</tbody>
			</table>
			<h4>Term 2</h4>
			<table class="table table-striped">
				<thead>
					<tr>
						<th scope="col">Name</th>
	                    <th scope="col">Subject</th>
	                    <th scope="col">Mark</th>
					</tr>
				</thead>
				<tbody>
					@foreach($marks as $mark)
						@if($mark->term == 'Term 2')
						<tr>
							<td>{{ App\Http\Controllers\StudentSubjectsController::getStudentName($mark->student_subject_id) }}</td>
							<td>{{ App\Http\Controllers\StudentSubjectsController::getSubject($mark->student_subject_id) }}</td>
							<td>{{ $mark->mark }}</td>
							@if (Auth::user()->role_id == 2)
							<td>
								<a href = "{{ url('/editmark/'.$mark->id) }}" class = "btn btn-sm btn-warning">Update</a>
								<a href = "{{ url('/deletemark/'.$mark->id) }}" class = "btn btn-sm btn-danger">Delete</a>
							</td>
							@endif
						</tr>
						@endif
					@endforeach
	                
				</tbody>
			</table>
			<h4>Term 3</h4>
			<table class="table table-striped">
				<thead>
					<tr>
						<th scope="col">Name</th>
	                    <th scope="col">Subject</th>
	                    <th scope="col">Mark</th>
					</tr>
				</thead>
				<tbody>
					@foreach($marks as $mark)
						@if($mark->term == 'Term 3')
						<tr>
							<td>{{ App\Http\Controllers\StudentSubjectsController::getStudentName($mark->student_subject_id) }}</td>
							<td>{{ App\Http\Controllers\StudentSubjectsController::getSubject($mark->student_subject_id) }}</td>
							<td>{{ $mark->mark }}</td>
							@if (Auth::user()->role_id == 2)
							<td>
								<a href = "{{ url('/editmark/'.$mark->id) }}" class = "btn btn-sm btn-warning">Update</a>
								<a href = "{{ url('/deletemark/'.$mark->id) }}" class = "btn btn-sm btn-danger">Delete</a>
							</td>
							@endif
						</tr>
						@endif
					@endforeach
	                
				</tbody>
			</table>
		@else
			<h3>{{$term}}</h3>
		
			<table class="table table-striped table-hover">
				<thead>
					<tr>
						<th scope="col">Name</th>
	                    <th scope="col">Subject</th>
	                    <th scope="col">Mark</th>
					</tr>
				</thead>
				<tbody>
					@foreach($marks as $mark)
						
						<tr>
							<td>{{ App\Http\Controllers\StudentSubjectsController::getStudentName($mark->student_subject_id) }}</td>
							<td>{{ App\Http\Controllers\StudentSubjectsController::getSubject($mark->student_subject_id) }}</td>
							<td>{{ $mark->mark }}</td>
							@if (Auth::user()->role_id == 2)
							<td>
								<a href = "{{ url('/editmark/'.$mark->id) }}" class = "btn btn-sm btn-warning">Update</a>
								<a href = "{{ url('/deletemark/'.$mark->id) }}" class = "btn btn-sm btn-danger">Delete</a>
							</td>
							@endif
						</tr>
						
					@endforeach
	                
				</tbody>
			</table>
			@endif
		</div>
	</main>