@include('dashboard.dashboardSideNav')
<main>
	<div>
		<table id = "studentsView" class="compact stripe row-border">
			<thead>
				<tr>
					<th scope="col">Admission Number</th>
					<th scope="col">Name</th>

					<!-- Display guardian phone number to all except admin  -->
					@if (Auth::user()->role_id != 1)
						<th scope="col">Phone Number</th>
					@endif
					<th scope="col">Class</th>

					<!-- Display school name to admin only -->
					@if (Auth::user()->role_id == 1)
					<th scope="col">School</th>
					@endif
					<th scope="col">Actions</th>
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
						<td>{{ $student->first_name.' '.$student->last_name }}</td>

						<!-- Display phone number to all users except from admin -->
						@if (Auth::user()->role_id != 1)
						<td>{{ $student->guardian_phone_number }}</td>
						@endif

						<td>{{App\Http\Controllers\ClassesController::getClassName($student->class_id) }}</td>

						<!-- Display school name only when admin is logged in -->
						@if (Auth::user()->role_id == 1)
							<td>{{App\Http\Controllers\SchoolsController::getSchoolNameByClassID($student->class_id) }}</td>
						@endif
						
						<td>
							<a href = "{{ url('/studentsubjects/'.$student->id) }}" class = "btn btn-sm btn-info">Subjects</a>
						
							@if (Auth::user()->role_id != 3)
							<a href = "{{ url('/editstudent/'.$student->id) }}" class = "btn btn-sm btn-warning">Update</a>
								@if (Auth::user()->role_id != 4)
								<a href = "{{ url('/deletestudent/'.$student->id) }}" class = "btn btn-sm btn-danger">Delete</a>
								@endif
							@endif
						</td>
					</tr>
					@endforeach
				@endif
			</tbody>
		</table>
		<script>
			$(document).ready( function () {
				$('#studentsView').DataTable();
			} );
		</script>
	</div>
</main>