@include('dashboard.dashboardSideNav')
<main>
	<div class = "text-center table-employees">
	<table class="table table-striped">
			<thead id = "viewstudents">
				<tr>
					<th scope="col">Admission Number</th>
					<th scope="col">First Name</th>
                    <th scope="col">Last Name</th>

					<!-- Display guardian phone number to all except admin  -->
					@if (Auth::user()->role_id != 1)
						<th scope="col">Phone Number</th>
					@endif
					
					<th scope="col">Class Name</th>

					<!-- Display school name to admin only -->
					@if (Auth::user()->role_id == 1)
					<th scope="col">School Name</th>
					@endif
				</tr>
			</thead>
			<tbody>
				@if ($message ?? null)
					<tr>
						<td colspan = "5">{{$message}}</td>
					</tr>
					<tr>
						<td colspan = "5">
							@if ($message ?? null == 'No classes and students found yet!')
							<div class = "text-center">
								<a href="{{URL::to('/classes')}}"><button>Add New Class</button></a>
							</div>
							@else
							<div class = "text-center">
								<a href="{{URL::to('/students')}}"><button>Add New Student</button></a>
							</div>
							@endif
						</td>
					</tr>
				@else
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
							</a>
							<a href = "{{ url('/deletestudent/'.$student->id) }}" class = "btn btn-sm btn-danger">Delete
							</a>
						</td>
						
					</tr>
					@endforeach
				@endif
			</tbody>
		</table>
	</div>
</main>