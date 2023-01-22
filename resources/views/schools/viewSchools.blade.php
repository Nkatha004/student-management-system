@include('common/header')
<div class = "text-center table-schools">
	<main>
	<table class="table table-striped">
			<thead>
				<tr>
					<th scope="col">School ID</th>
					<th scope="col">School Name</th>
					<th scope="col">Email</th>
					<th scope="col">Phone Number</th>
					<th scope="col">Status</th>
				</tr>
			</thead>
			<tbody>
				@foreach($schools as $school)
				<tr>
			
					<td>{{ $school->id }}</td>
					<td>{{ $school->school_name }}</td>
					<td>{{ $school->email }}</td>
					<td>{{ $school->phone_number }}</td>
					<td>{{ $school->status }}</td>

					<td>
						<a href = "{{ url('/editschool/'.$school->id) }}" class = "btn btn-sm btn-warning">Update</a>
						<a href = "{{ url('/deleteschool/'.$school->id) }}" class = "btn btn-sm btn-danger">Delete</a>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</main>
</div>