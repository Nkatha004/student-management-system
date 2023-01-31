@include('dashboard.dashboardSideNav')
<main>
	<div class = "text-center table-schools">
	<table class="table table-striped">
			<thead>
				<tr>
					<th scope="col">Payment Date</th>
					<th scope="col">Transaction ID</th>
					<th scope="col">Payer ID</th>
					<th scope="col">Payer Email</th>
					<th scope="col">Amount</th>
                    <th scope="col">Currency</th> 
				</tr>
			</thead>
			<tbody>
				@foreach($transactions as $transaction)
				<tr>
					<td>{{ date('d/m/Y' ,strtotime($transaction->created_at)) }}</td>
					<td>{{ $transaction->transaction_id }}</td>
					<td>{{ $transaction->payer_id }}</td>
                    <td>{{ $transaction->payer_email }}</td>
					<td>{{ $transaction->amount }}</td>
                    <td>{{ $transaction->currency }}</td> 
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</main>