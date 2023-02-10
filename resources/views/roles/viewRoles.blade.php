@include('dashboard.dashboardSideNav')
<main>
	<div class = "text-center table-schools">

		<table class="table table-striped">
			<thead>
				<tr>
					<th scope="col">Role ID</th>
					<th scope="col">Role Name</th>
					<th scope="col">Role Description</th>
				</tr>
			</thead>
			<tbody>
				@foreach($roles as $role)
				<tr>
			
					<td>{{ $role->id }}</td>
					<td>{{ $role->role_name }}</td>
                    <td>{{ $role->role_description }}</td>

					<td>
						<a href = "{{ url('/editrole/'.$role->id) }}" class = "btn btn-sm btn-warning">Update</a>
						<a href = "{{ url('/deleterole/'.$role->id) }}" class = "btn btn-sm btn-danger">Delete</a>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
		<div class="paginate d-flex justify-content-center">
			{{ $roles->links() }}
		</div>
	</div>

</main>
