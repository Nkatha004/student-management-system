@include('dashboard.dashboardSideNav')
<main>	
	<div class = "text-center table-schools">
	<table class="table table-striped">
			<thead>
				<tr>
					<th scope="col">School ID</th>
					<th scope="col">School Name</th>
					<th scope="col">Email</th>
					<th scope="col">Phone Number</th>
				</tr>
			</thead>
			<tbody>
				@foreach($schools as $school)
				<tr>
			
					<td>{{ $school->id }}</td>
					<td>{{ $school->school_name }}</td>
					<td>{{ $school->email }}</td>
					<td>{{ $school->phone_number }}</td>
					<td>
						<a href = "{{ url('/editschool/'.$school->id) }}" class = "btn btn-sm btn-warning">Update</a>
						<a href = "{{ url('/deleteschool/'.$school->id) }}" class = "btn btn-sm btn-danger">Delete</a>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
		<div class="d-flex justify-content-center">
            {{ $schools->links() }}
        </div>
	</div>
</main>