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
					@if (Auth::user()->role_id == 2)
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
		<script>
			$(document).ready( function () {
				$('#viewAllMarks').DataTable();
			});
		</script>
	</div>
</main>