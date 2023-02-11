@include('dashboard/dashboardSideNav')

<main>
	<div class = "text-center table-employees">
	<table class="table table-striped">
			<thead>
				<tr>
					<th scope="col">TSC Number</th>
					<th scope="col">Name</th>
                    <th scope="col">School Name</th>
                    <th scope="col">Role Name</th>
				</tr>
			</thead>
			<tbody>
				@foreach($employees as $employee)
				<tr>
					@if ($employee->role_id == 1)
					<td>Not Applicable</td>
					@else
					<td>{{ $employee->tsc_number }}</td>
					@endif

					<td>
						{{ $employee->first_name }}
                    	{{ $employee->last_name }}
					</td>
				
					@if ($employee->role_id == 1)
						<td>Not Applicable</td>
					@else
						<td>{{App\Http\Controllers\SchoolsController::getSchoolName($employee->school_id) }}</td>
					@endif

                    <td>{{App\Http\Controllers\RolesController::getRoleName($employee->role_id) }}</td>
					<!-- If logged in user is an admin -->
					@if(Auth::user()->role_id == 1)

						<!-- If the current employee is not an admin perform all CRUD and assign teaching subjects-->
						@if ($employee->role_id != 1)
							<td>
								<a href = "{{ url('/employeesubjects/'.$employee->id) }}" class = "btn btn-sm btn-info">Teaching Subjects</a>
								<a href = "{{ url('/editemployee/'.$employee->id) }}" class = "btn btn-sm btn-warning">Update</a>
								<a href = "{{ url('/deleteemployee/'.$employee->id) }}" class = "btn btn-sm btn-danger">Delete</a>
							
							</td>
						<!-- If the current employee is an admin update admin only-->
						@else
							<td>
								<a href = "{{ url('/editemployee/'.$employee->id) }}" class = "btn btn-sm btn-warning">Update</a>
							</td>
						@endif
					<!-- If logged in user is a principal -->
					@elseif(Auth::user()->role_id == 2)
						<!-- If the current employee is not an admin perform all CRUD and assign teaching subjects-->
						@if ($employee->role_id != 2)
							<td>
								<a href = "{{ url('/employeesubjects/'.$employee->id) }}" class = "btn btn-sm btn-info">Teaching Subjects</a>
								<a href = "{{ url('/editemployee/'.$employee->id) }}" class = "btn btn-sm btn-warning">Update</a>
								<a href = "{{ url('/deleteemployee/'.$employee->id) }}" class = "btn btn-sm btn-danger">Delete</a>
							
							</td>
						<!-- If the current employee is a principal, block delete functionality-->
						@else
							<td>
								<a href = "{{ url('/employeesubjects/'.$employee->id) }}" class = "btn btn-sm btn-info">Teaching Subjects</a>
								<a href = "{{ url('/editemployee/'.$employee->id) }}" class = "btn btn-sm btn-warning">Update</a>
							</td>
						@endif
					@endif
				</tr>
				@endforeach
			</tbody>
		</table>

		<div class="d-flex justify-content-center">
            {{ $employees->links() }}
        </div>
	</div>
</main>