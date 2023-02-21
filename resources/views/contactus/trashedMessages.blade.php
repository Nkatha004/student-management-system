@include('dashboard.dashboardSideNav')
<main>
    <div>
        <a href = "{{URL::to('/restoremessages')}}"class = "btn btn-success">Restore all</a>
    </div><br>
	<div>
		<table id= "deletedMessagesView" class="stripe row-border">
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
						<a href = "{{ url('/restoremessage/'.$contact->id) }}" class = "btn btn-sm btn-success">Restore</a>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
	<script>
		$(document).ready( function () {
			$('#deletedMessagesView').DataTable();
		} );
	</script>
</main>
