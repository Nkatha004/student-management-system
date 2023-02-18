@include('dashboard.dashboardSideNav')
<main>
	@can('restore', '\App\Models\Classes')
	    <div>
	        <a href = "{{URL::to('/restoreclasses')}}"class = "btn btn-success">Restore all</a>
	    </div><br>
    @endcan
	<div>
		<table id = "classesView" class="compact stripe row-border">
			<thead>
				<tr>
					<th scope="col">Class Name</th>
                    <th scope="col">Year</th>
					@if(Auth::user()->id == App\Models\Role::IS_SUPERADMIN)
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
						@if(Auth::user()->id  == App\Models\Role::IS_SUPERADMIN)
							<td>{{App\Http\Controllers\SchoolsController::getSchoolName($class->school_id) }}</td>
						@endif
						<td>{{ App\Http\Controllers\EmployeesController::getEmployeeName($class->class_teacher) }}</td>
						@can('restore', 'App\Models\Classes')
							<td><a href = "{{ url('/restoreclass/'.$class->id) }}" class = "btn btn-sm btn-success">Restore</a></td>
						@endcan
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