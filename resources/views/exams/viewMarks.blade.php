@include('dashboard.dashboardSideNav')
<main>
	<div class = "text-center table-schools">
	<table class="table table-striped">
			<thead>
				<tr>
					<th scope="col">Student Name</th>
                    <th scope="col">Term</th>
                    <th scope="col">Subject</th>
                    <th scope="col">Mark</th>
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
                @if (Auth::user()->role_id != 1)
                <tr>
                    <td colspan = "6">
                        <a href = "{{ url('/employeesubjects/'.Auth::user()->id) }}" class = "btn btn-sm btn-secondary">Back to Students</a>
                    </td>
                </tr>
                @endif
			</tbody>
		</table>
	</div>
</main>