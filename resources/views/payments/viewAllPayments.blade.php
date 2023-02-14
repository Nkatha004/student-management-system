@include('dashboard.dashboardSideNav')
<main>
	<div>
		<table id = "viewPayments" class="stripe row-border">
			<thead>
				<tr>
					<th scope="col">Payment Date</th>
					<th scope="col">Transaction ID</th>
					<th scope="col">School Name</th>
					<th scope="col">Amount</th>
                    <th scope="col">Payment Method</th>
				</tr>
			</thead>
			<tbody>
				@foreach($transactions as $transaction)
				<tr>
					<td>{{ date('d/m/Y' ,strtotime($transaction->created_at)) }}</td>
					<td>{{ $transaction->transaction_id }}</td>
					<td>{{ App\Http\Controllers\SchoolsController::getSchoolName($transaction->paid_by) }}</td>

					@if($transaction->currency == 'USD')
						<td>{{ App\Http\Controllers\PaymentsController::exchangeRates($transaction->amount, 'USD'). ' KES' }}</td>
						<td>Paypal</td>
					@else
						<td>{{ $transaction->amount.' KES' }}</td>
						<td>MPESA</td>
					@endif
				</tr>
				@endforeach
			</tbody>
		</table>
		<script>
			$(document).ready( function () {
    			$('#viewPayments').DataTable();
			} );
		</script>
	</div>
</main>