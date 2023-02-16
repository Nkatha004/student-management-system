@include('dashboard.dashboardSideNav')
<main>
	<div>
		<table id = "pendingPayments" class="stripe row-border">
			<thead>
				<tr>
					<th scope="col">School Name</th>
					<th scope="col">School Email</th>
					<th scope="col">School Phone Number</th>
					<th scope="col">Registration Date</th>
                    <th scope="col">Registration Time</th>
				</tr>
			</thead>
			<tbody>
				@foreach($pendingpayments as $pendingpayment)
				<tr>
					
					<td>{{ $pendingpayment->school_name }}</td>
					<td>{{ $pendingpayment->email }}</td>
					<td>{{ $pendingpayment->phone_number }}</td>
					<td>{{ date('d/m/Y' ,strtotime($pendingpayment->created_at)) }}</td>
					<td>{{ date('H:i' ,strtotime($pendingpayment->created_at)) }}</td>
					
				</tr>
				@endforeach
			</tbody>
		</table>
		<script>
			$(document).ready( function () {
    			$('#pendingPayments').DataTable();
			} );
		</script>
	</div>
</main>