@include('common/header')

<main>
	<div class = "text-center table-employees">
	<table class="table table-striped">
			<thead>
				<tr>
					<th scope="col">TSC Number</th>
					<th scope="col">First Name</th>
                    <th scope="col">Last Name</th>
					<th scope="col">Email</th>
					<th scope="col">Phone Number</th>
                    <th scope="col">School Name</th>
                    <th scope="col">Role Name</th>
					<th scope="col">Status</th>
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

					<td>{{ $employee->first_name }}</td>
                    <td>{{ $employee->last_name }}</td>
					<td>{{ $employee->email }}</td>
					<td>{{ $employee->telephone_number }}</td>
                    <td>{{App\Http\Controllers\SchoolsController::getSchoolName($employee->school_id) }}</td>
                    <td>{{App\Http\Controllers\RolesController::getRoleName($employee->role_id) }}</td>
					<td>{{ $employee->status }}</td>
					@if ($employee->role_id != 1)
					<td>
						<a href = "{{ url('/employeesubjects/'.$employee->id) }}" class = "btn btn-sm btn-info">Teaching Subjects</a>
						<a href = "{{ url('/editemployee/'.$employee->id) }}" class = "btn btn-sm btn-warning">Update</a>
						<a href = "{{ url('/deleteemployee/'.$employee->id) }}" class = "btn btn-sm btn-danger">Delete</a>
					</td>
					@else
					<td>
					<a style = "width: 100%"href = "{{ url('/editemployee/'.$employee->id) }}" class = "btn btn-warning">Update Admin</a>
					</td>
					@endif
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</main>