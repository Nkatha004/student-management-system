@include('dashboard.dashboardSideNav')
<main>
	<div class = "text-center table-employees">
	<table class="table table-striped">
			<thead>
				<tr>
					<th scope="col">Class ID</th>
					<th scope="col">Class Name</th>
                    <th scope="col">Year</th>
					<th scope="col">Class Teacher</th>
                    <th scope="col">School Name</th>
				</tr>
			</thead>
			<tbody>
				@foreach($classes as $class)
				<tr>
					<td>{{ $class->id }}</td>
					<td>{{ $class->class_name }}</td>
                    <td>{{ $class->year }}</td>
					<td>{{ App\Http\Controllers\EmployeesController::getEmployeeName($class->class_teacher) }}</td>
                    <td>{{App\Http\Controllers\SchoolsController::getSchoolName($class->school_id) }}</td>

					@if(Auth::user()->role_id != 1)
					<td>
						<a href = "{{ url('/editclass/'.$class->id) }}" class = "btn btn-sm btn-warning">Update</a>
						<a href = "{{ url('/deleteclass/'.$class->id) }}" class = "btn btn-sm btn-danger">Delete</a>
					</td>
					@endif
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</main>