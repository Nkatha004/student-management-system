@include('dashboard.dashboardSideNav')
<main>
	<div>
		<table id= "rolesView" class="stripe row-border">
			<thead>
				<tr>
					<th scope="col">Role Name</th>
					<th scope="col">Role Description</th>
					<th scope="col">Actions</th>
				</tr>
			</thead>
			<tbody>
				@foreach($roles as $role)
				<tr>
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
        <div class="d-flex justify-content-center">
            {{ $roles->links() }}
        </div>
	</div>
	<script>
		$(document).ready( function () {
			$('#rolesView').DataTable();
		} );
	</script>
</main>
