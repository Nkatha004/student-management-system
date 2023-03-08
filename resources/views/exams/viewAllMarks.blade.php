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
					@can('restore', '\App\Models\ExamMark')
						<th scope="col">Actions</th>
					@endcan
				</tr>
			</thead>
			<tbody>
				@foreach($marks as $mark)
					<tr>
						<td>{{ App\Http\Controllers\StudentSubjectsController::getStudentName($mark->student_subject_id) }}</td>
						<td>{{ App\Http\Controllers\StudentSubjectsController::getSubject($mark->student_subject_id) }}</td>
						<td>{{ $mark->term }}</td>
						<td>{{ $mark->mark }}</td>
						@can('restore', '\App\Models\ExamMark')
						<td>
							@can('update', $mark)
								<a href = "{{ url('/editmark/'.$mark->id.'/'.$classID) }}" class = "btn btn-sm btn-warning">Update</a>
							@endcan
							@can('delete', $mark)
								<a href = "{{ url('/deletemark/'.$mark->id.'/'.$classID) }}" class = "btn btn-sm btn-danger">Delete</a>
							@endcan
						</td>
						@endcan
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