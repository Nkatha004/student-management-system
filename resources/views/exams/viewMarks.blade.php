@include('dashboard.dashboardSideNav')
<main>
	<div>
		<table id = "marksView" class="stripe row-border">
			<thead>
				<tr>
					<th scope="col">Student Name</th>
                    <th scope="col">Term</th>
                    <th scope="col">Subject</th>
                    <th scope="col">Mark</th>
					<th scope="col">Actions</th>
				</tr>
			</thead>
			<tbody>
				
				@foreach($marks as $mark)
					<tr>
						<td>{{ App\Http\Controllers\StudentSubjectsController::getStudentName($mark->student_subject_id) }}</td>
						
						<td>{{ $mark->term }}</td>
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
		@if (Auth::user()->role_id != 1)
			<div class = "text-center">
				<a href = "{{ url('/employeesubjects/'.Auth::user()->id) }}"><button>Continue Adding Marks</button></a>
			</div>
			
		@endif
		<script>
			$(document).ready( function () {
				$('#marksView').DataTable();
			});
		</script>
	</div>
</main>