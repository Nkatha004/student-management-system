@include('dashboard.dashboardSideNav')
<main>
	@can('restore', '\App\Models\StudentSubject')
	    <div>
	        <a href = "{{URL::to('/restorestudentsubjects')}}"class = "btn btn-success">Restore all</a>
	    </div><br>
	@endcan
	<div>
		<table id = "trashedStudentSubjects" class="compact stripe row-border">
			<thead>
				<tr>
					<th scope="col">Student Name</th>
					<th scope="col">Subject</th>
					<th scope="col">Actions</th>
				</tr>
			</thead>
			<tbody>
				
				@foreach($studentsubjects as $studentsubject)
					<tr>
						<td>{{ App\Http\Controllers\StudentsController::getStudentName($studentsubject->student_id) }}</td>
						<td>{{ App\Http\Controllers\SubjectsController::getSubjectName($studentsubject->subject_id) }}</td>
						
						@can('restoreOne', $studentsubject)
							<td><a href = "{{ url('/restorestudentsubject/'.$studentsubject->id) }}" class = "btn btn-sm btn-success">Restore</a></td>
						@endcan
					</tr>
				@endforeach
			</tbody>
		</table>
		<script>
			$(document).ready( function () {
				$('#trashedStudentSubjects').DataTable();
			} );
		</script>
	</div>
</main>