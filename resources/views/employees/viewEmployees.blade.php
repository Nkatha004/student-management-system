@include('dashboard/dashboardSideNav')

<main>
	<div>
		<table id = "employeesView" class="compact stripe row-border">
			<thead>
				<tr>
					<th scope="col">TSC Number</th>
					<th scope="col">Name</th>
                    <th scope="col">School Name</th>
                    <th scope="col">Role Name</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>
				@foreach($employees as $employee)
					<tr>
						@if ($employee->role_id == \App\Models\Role::IS_SUPERADMIN)
							<td>Not Applicable</td>
						@else
							<td>{{ $employee->tsc_number }}</td>
						@endif

						<td>{{ $employee->first_name.' '.$employee->last_name }}</td>
					
						@if ($employee->role_id == \App\Models\Role::IS_SUPERADMIN)
							<td>Not Applicable</td>
						@else
							<td>{{App\Http\Controllers\SchoolsController::getSchoolName($employee->school_id) }}</td>
						@endif

	                    <td>{{App\Http\Controllers\RolesController::getRoleName($employee->role_id) }}</td>

						<td>
							<a href = "{{ url('/employeesubjects/'.$employee->id) }}" class = "btn btn-sm btn-info">Subjects</a>
							@can('update', $employee)
								<a href = "{{ url('/editemployee/'.$employee->id) }}" class = "btn btn-sm btn-warning">Update</a>
							@endcan
							@can('delete', $employee)
								<a href = "{{ url('/deleteemployee/'.$employee->id) }}" class = "btn btn-sm btn-danger">Delete</a>
							@endcan
						
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>

		<script>
			$(document).ready( function () {
    			$('#employeesView').DataTable();
			} );
		</script>
	</div>
</main>