@include('dashboard.dashboardSideNav')
<main>
	<div>
		<h4 class = "text-center">Student Marks</h4>
		<div class = "table-data">
			<form action = "" method = "GET">
				<div class="row">
					<div class="col-md-3">
						<label>Filter by Subject</label>
						<select name = "subject" class = "form-select">
							<option value = "">Select subject</option>
							@foreach($subjects as $subject)
								<option value = "{{$subject->id}}">{{$subject->subject_name}}</option>
							@endforeach
						</select>
					</div>
					<div class="col-md-3">
						<label>Filter by Term</label>
						<select name = "term" class = "form-select">
							<option value = "">Select term</option>
							<option value = "First Term">First Term</option>
							<option value = "Second Term">Second Term</option>
							<option value = "Third Term">Third Term</option>
						</select>
					</div>
					<div class="col-md-6">
						<br/>
						<button type = "submit" class = "btn btn-primary">Filter</button>
					</div>
				</div>
			</form><br/>

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
						@can('view', $mark)
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
						@endcan
					@endforeach
				</tbody>
			</table>
			<script>
				$(document).ready( function () {
					$('#viewAllMarks').DataTable();
				});
			</script>
		</div>
	</div>
</main>