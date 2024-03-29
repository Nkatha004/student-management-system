@include('dashboard.dashboardSideNav')
<main>
	@can('restore', '\App\Models\Student')
		<div>
	        <a href = "{{URL::to('/restorestudents')}}"class = "btn btn-success">Restore all</a>
	    </div><br>
    @endcan
	<div>
		<table id = "studentsView" class="compact stripe row-border">
			<thead>
				<tr>
					<th scope="col">Admission Number</th>
					<th scope="col">Name</th>

					<!-- Display guardian phone number to all except admin  -->
					@if (Auth::user()->role_id != \App\Models\Role::IS_SUPERADMIN)
						<th scope="col">Phone Number</th>
					@endif
					<th scope="col">Class</th>

					<!-- Display school name to admin only -->
					@if (Auth::user()->role_id == \App\Models\Role::IS_SUPERADMIN)
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
						@if (Auth::user()->role_id != \App\Models\Role::IS_SUPERADMIN)
						<td>{{ $student->guardian_phone_number }}</td>
						@endif

						<td>{{App\Http\Controllers\ClassesController::getClassName($student->class_id) }}</td>

						<!-- Display school name only when admin is logged in -->
						@if (Auth::user()->role_id == \App\Models\Role::IS_SUPERADMIN)
							<td>{{App\Http\Controllers\SchoolsController::getSchoolNameByClassID($student->class_id) }}</td>
						@endif
						@can('restoreOne', $student)
							<td>
								<a href = "{{ url('/restorestudent/'.$student->id) }}" class = "btn btn-sm btn-success">Restore</a>
							</td>
						@endcan
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