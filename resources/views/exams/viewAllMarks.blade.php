@include('dashboard.dashboardSideNav')
<main>
	<div>
		<h4 class = "text-center">Student Marks</h4>
		<table id = "viewAllMarks" class="stripe row-border">
			<thead>
				<tr>
					<th scope="col">Name</th>
					<th scope="col">Subject</th>
					<th scope="col">Term</th>
					<th scope="col">Mark</th>
					@if (Auth::user()->role_id == 2 or Auth::user()->role_id == 1)
						<th scope="col">Actions</th>
					@endif
				</tr>
			</thead>
			<tbody>
				@foreach($marks as $mark)
					<tr>
						<td>{{ App\Http\Controllers\StudentSubjectsController::getStudentName($mark->student_subject_id) }}</td>
						<td>{{ App\Http\Controllers\StudentSubjectsController::getSubject($mark->student_subject_id) }}</td>
						<td>{{ $mark->term }}</td>
						<td>{{ $mark->mark }}</td>
						@if (Auth::user()->role_id == 2 or Auth::user()->id == 1)
							<td>
	
								@if (Auth::user()->role_id != 1)
								<a href = "{{ url('/editmark/'.$mark->id.'/'.$classID) }}" class = "btn btn-sm btn-warning">Update</a>
								@endif
								<a href = "{{ url('/deletemark/'.$mark->id.'/'.$classID) }}" class = "btn btn-sm btn-danger">Delete</a>
							
						</td>
					@endif
					</tr>
				@endforeach
			</tbody>
		</table>
		<script>
			$(document).ready( function () {
				$('#viewAllMarks').DataTable();
			});
		</script>
	</div>
</main>