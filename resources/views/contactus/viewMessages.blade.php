@include('dashboard.dashboardSideNav')
<main>
	<div>
		<table id= "messagesView" class="compact stripe row-border">
			<thead>
				<tr>
					<th scope="col">First Name</th>
					<th scope="col">Last Name</th>
					<th scope="col">Email</th>
					<th scope="col">Message</th>
					<th scope="col">Responded To</th>
					<th scope="col">Actions</th>
				</tr>
			</thead>
			<tbody>
				@foreach($contacts as $contact)
				<tr>
					<td>{{ $contact->first_name }}</td>
					<td>{{ $contact->last_name }}</td>
					<td>{{ $contact->email }}</td>
                    <td>{{ $contact->message }}</td>
                   
                	@if($contact->responded_to == 0)
                		<td>No</td>
                	@else
                    	<td>Yes</td>
                    @endif

					<td>
						@if($contact->responded_to == 0)
							<a href = "{{ url('/respondmessage/'.$contact->id) }}" class = "btn btn-sm btn-warning">Respond</a>
						@endif
						<a href = "{{ url('/deletemessage/'.$contact->id) }}" class = "btn btn-sm btn-danger">Delete</a>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
	<script>
		$(document).ready( function () {
			$('#messagesView').DataTable();
		} );
	</script>
</main>
