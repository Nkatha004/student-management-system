@include('dashboard.dashboardSideNav')
<main>
	<form method="POST" action = "{{ URL::to('/filterpaymentsbymethod') }}">
    	@csrf
	    <div class = "col-12">
	        <b><label for="inputState" class="form-label">Filter by Payment Method</label></b>
	    </div>
	    <div class="input-group">
	    	<div class = "col-md-6">
				<select id="inputState" class="form-select col-md-6" name = "paymentMethod">
					<option selected value = "all">All Payments</option>
					<option value = "mpesa">MPESA</option>
		            <option value = "paypal">PayPal</option>
				</select>
			</div>
			<div class="input-group-append">
				<button class="btn btn-success">Filter</button>
			</div>
		</div>
	</form><br/><br/>
	<div class = "text-center table-schools">
		<table class="table table-striped">
			<thead>
				<tr>
					<th scope="col">Payment Date</th>
					<th scope="col">Transaction ID</th>
					<th scope="col">School Name</th>
					<th scope="col">Amount</th>
                    <th scope="col">Currency</th>
				</tr>
			</thead>
			<tbody>
				@foreach($transactions as $transaction)
				<tr>
					<td>{{ date('d/m/Y' ,strtotime($transaction->created_at)) }}</td>
					<td>{{ $transaction->transaction_id }}</td>
					<td>{{ App\Http\Controllers\SchoolsController::getSchoolName($transaction->paid_by) }}</td>

					@if($transaction->currency == 'USD')
						<td>{{ App\Http\Controllers\PaymentsController::exchangeRates($transaction->amount, 'USD') }}</td>
					@else
						<td>{{ $transaction->amount }}</td>
					@endif

                    <td>KES</td>
				</tr>
				@endforeach
			</tbody>
		</table>
		<div class="d-flex justify-content-center">
            {{ $transactions->links() }}
        </div>
	</div>
</main>