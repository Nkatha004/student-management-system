@include('dashboard.dashboardSideNav')
<main>
	<div>
		<table id = "classesView" class="compact stripe row-border">
			<thead>
				<tr>
					<th scope="col">Class Name</th>
                    <th scope="col">Year</th>
					@if(Auth::user()->role_id == \App\Models\Role::IS_SUPERADMIN)
                    <th scope="col">School Name</th>
					@endif
					<th scope="col">Class Teacher</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>
				@foreach($classes as $class)
				<tr>
					<td>{{ $class->class_name }}</td>
                    <td>{{ $class->year }}</td>

					@if(Auth::user()->role_id == \App\Models\Role::IS_SUPERADMIN)
					<td>{{App\Http\Controllers\SchoolsController::getSchoolName($class->school_id) }}</td>
					@endif

					<td>{{ App\Http\Controllers\EmployeesController::getEmployeeName($class->class_teacher) }}</td>
                
					<td>
						@can('update', $class)
							<a href = "{{ url('/editclass/'.$class->id) }}" class = "btn btn-sm btn-warning">Update</a>
						@endcan
						@can('delete', $class)
							<a href = "{{ url('/deleteclass/'.$class->id) }}" class = "btn btn-sm btn-danger">Delete</a>
						@endcan

						<a href = "{{ url('/viewclassmarks/'.$class->id) }}" class = "btn btn-sm btn-success">View Class Performance</a>
					</td>

				</tr>
				@endforeach
			</tbody>
		</table>
		<script>
			$(document).ready( function () {
    			$('#classesView').DataTable();
			} );
		</script>
	</div>
</main>