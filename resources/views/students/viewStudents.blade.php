@include('dashboard.dashboardSideNav')
<main>
	<div class = "text-center table-employees">
	<table class="table table-striped">
			<thead id = "viewstudents">
				<tr>
					<th scope="col">Admission Number</th>
					<th scope="col">First Name</th>
                    <th scope="col">Last Name</th>
					@if (Auth::user()->role_id != 1)
					<th scope="col">Phone Number</th>
					@endif
					<th scope="col">Class Name</th>

					@if (Auth::user()->role_id == 1)
					<th scope="col">School Name</th>
					@endif
				</tr>
			</thead>
			<tbody>
				@foreach($students as $student)
				<tr>
					<td>{{ $student->admission_number }}</td>
					<td>{{ $student->first_name }}</td>
                    <td>{{ $student->last_name }}</td>

					<!-- Display phone number to all users except from admin -->
					@if (Auth::user()->role_id != 1)
					<td>{{ $student->guardian_phone_number }}</td>
					@endif

					<td>{{App\Http\Controllers\ClassesController::getClassName($student->class_id) }}</td>

					<!-- Display school name only when admin is logged in -->
					@if (Auth::user()->role_id == 1)
					<td>{{App\Http\Controllers\SchoolsController::getSchoolName($schoolID) }}</td>
					@endif
					
					<td><a href = "{{ url('/studentsubjects/'.$student->id) }}" class = "btn btn-sm btn-info">Student Subjects</a></td>
					<td>
						<a href = "{{ url('/editstudent/'.$student->id) }}" class = "btn btn-sm btn-warning">Update
							<!-- <i class="fa fa-pencil" aria-hidden="true"></i> -->
						</a>
						<a href = "{{ url('/deletestudent/'.$student->id) }}" class = "btn btn-sm btn-danger">Delete
							<!-- <i class="fa fa-trash" aria-hidden="true"></i> -->
						</a>
					</td>
					
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</main>