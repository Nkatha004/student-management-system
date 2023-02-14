@include('dashboard.dashboardSideNav')
<main>	
	<div>
		<table id = "schoolsView" class="stripe row-border">
			<thead>
				<tr>
					<th scope="col">School Name</th>
					<th scope="col">Email</th>
					<th scope="col">Phone Number</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>
				@foreach($schools as $school)
				<tr>
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
		<script>
			$(document).ready( function () {
    			$('#schoolsView').DataTable();
			} );
		</script>
	</div>
</main>