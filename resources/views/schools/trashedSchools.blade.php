@include('dashboard.dashboardSideNav')
<main>
	@can('restore', '\App\Models\School')
		<div>
	        <a href = "{{URL::to('/restoreschools')}}"class = "btn btn-success">Restore all</a>
	    </div><br>	
	@endcan
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
					@can('restore', '\App\Models\School')
						<td>
							<a href = "{{ url('/restoreschool/'.$school->id) }}" class = "btn btn-sm btn-success">Restore</a>
						</td>
					@endcan
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