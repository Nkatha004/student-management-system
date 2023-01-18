@include('common/header')
<div class = "text-center table-employees">
	<main>
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
					<td>{{ $employee->tsc_number }}</td>
					<td>{{ $employee->first_name }}</td>
                    <td>{{ $employee->last_name }}</td>
					<td>{{ $employee->email }}</td>
					<td>{{ $employee->telephone_number }}</td>
                    <td>{{App\Http\Controllers\SchoolsController::getSchoolName($employee->school_id) }}</td>
                    <td>{{App\Http\Controllers\RolesController::getRoleName($employee->role_id) }}</td>
					<td>{{ $employee->status }}</td>

					<td>
						<a href = "{{ url('/editemployee/'.$employee->id) }}" class = "btn btn-sm btn-warning">Update</a>
						<a href = "{{ url('/deleteemployee/'.$employee->id) }}" class = "btn btn-sm btn-danger">Delete</a>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</main>
</div>