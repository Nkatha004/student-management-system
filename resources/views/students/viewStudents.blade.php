@include('dashboard.dashboardSideNav')
<main>
	<div>
		<table id = "studentsView" class="compact stripe row-border">
			<thead>
				<tr>
					<th scope="col">Admission No.</th>
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
						
						<td>
							@can('create', '\App\Models\StudentSubject')
								<a href = "{{ url('/studentsubjects/'.$student->id) }}" class = "btn btn-sm btn-info">Subjects</a>
							@endcan
						
							@can('update', $student)
								<a href = "{{ url('/editstudent/'.$student->id) }}" class = "btn btn-sm btn-warning">Update</a>
							@endcan
							
							@can('delete', $student)
								<a href = "{{ url('/deletestudent/'.$student->id) }}" class = "btn btn-sm btn-danger">Delete</a>
							@endcan

							@if(Auth::user()->role_id == \App\models\Role::IS_SUPERADMIN)
								<a href = "{{ url('/addmarks/'.$student->id) }}" class = "btn btn-sm btn-secondary">Add Marks</a>
							@endif
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
		<script>
			$(document).ready( function () {
				$('#studentsView').DataTable();
			} );
		</script>
	</div>
</main>