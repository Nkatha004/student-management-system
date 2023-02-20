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
					@if (Auth::user()->role_id == \App\Models\Role::IS_SUPERADMIN or Auth::user()->role_id == \App\Models\Role::IS_PRINCIPAL)
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

						<td>
							@can('update', $mark)
								<a href = "{{ url('/editmark/'.$mark->id.'/'.$classID) }}" class = "btn btn-sm btn-warning">Update</a>
							@endcan
							@can('delete', $mark)
								<a href = "{{ url('/deletemark/'.$mark->id.'/'.$classID) }}" class = "btn btn-sm btn-danger">Delete</a>
							@endcan
						</td>
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