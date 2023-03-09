@include('dashboard.dashboardSideNav')
<main>
	@can('restore', '\App\Models\ExamMark')
		<div>
	        <a href = "{{URL::to('/restoremarks')}}"class = "btn btn-success">Restore all</a>
	    </div><br>
	@endcan
	<div>
		<h4 class = "text-center">Student Marks</h4>
		<table id = "viewAllMarks" class="stripe row-border">
			<thead>
				<tr>
					<th scope="col">Name</th>
					<th scope="col">Subject</th>
					<th scope="col">Term</th>
					<th scope="col">Mark</th>
					<th scope="col">Actions</th>
				</tr>
			</thead>
			<tbody>
				@foreach($marks as $mark)
					<tr>
						<td>{{ App\Http\Controllers\StudentSubjectsController::getStudentName($mark->student_subject_id) }}</td>
						<td>{{ App\Http\Controllers\StudentSubjectsController::getSubject($mark->student_subject_id) }}</td>
						<td>{{ $mark->term }}</td>
						<td>{{ $mark->mark }}</td>
						@can('restoreOne', $mark)
							<td>
								<a href = "{{ url('/restoremark/'.$mark->id) }}" class = "btn btn-sm btn-success">Restore</a>
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