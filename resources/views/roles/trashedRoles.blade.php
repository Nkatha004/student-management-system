@include('dashboard.dashboardSideNav')
<main>
    <div>
        <a href = "{{URL::to('/restoreroles')}}"class = "btn btn-success">Restore all</a>
    </div><br>
	<div>
		<table id= "deletedRolesView" class="stripe row-border">
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
						<a href = "{{ url('/restorerole/'.$role->id) }}" class = "btn btn-sm btn-success">Restore</a>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
	<script>
		$(document).ready( function () {
			$('#deletedRolesView').DataTable();
		} );
	</script>
</main>
