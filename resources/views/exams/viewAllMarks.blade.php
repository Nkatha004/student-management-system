@include('dashboard.dashboardSideNav')
<main>
	<div class = "text-center table-schools">
		<h3>Term 1</h3>
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
		<h3>Term 2</h3>
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
		<h3>Term 3</h3>
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
	</div>
</main>