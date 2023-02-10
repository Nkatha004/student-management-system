@if($message == "Payment Complete")
    @include('dashboard.dashboardSideNav')
@else
    @include('common.header')
@endif
<body>
    <main>
        <div>
            @if($message == "Payment Complete")
            <form method = "post" action = "{{ route('lipa') }}" class="row g-3 form">
            @else
            <form method = "post" action = "{{ route('lipa') }}" id = "addForm" class="row g-3 form">
            @endif
                @csrf
                <h3 class = "text-center">MPESA Payment</h3>
                @if(session()->has('message'))
                    <div class="alert alert-success">
                        {{ session()->get('message') }}
                    </div>
                @endif
                <div class="alert alert-info">
                    After entering your mpesa number and submitting, you will receive a pop-up on your phone. Kindly input your MPESA pin to complete the transaction.
                </div>
                
                <div class="col-12">
                    @if($errors->has('amount'))
                        <div class = "alert alert-danger" role = "alert">
                            {{ $errors->first('amount') }}
                        </div>
                    @endif
                    <label for="amount" class="form-label">Transaction Amount</label>
                    <input type="number" class="form-control" id="amount" name = "amount" value="5000.00" readonly>
                </div>
                <div class="col-12">
                    @if($errors->has('phoneNo'))
                        <div class = "alert alert-danger" role = "alert">
                            {{ $errors->first('phoneNo') }}
                        </div>
                    @endif
                    <label for="phoneNo" class="form-label">Phone Number</label>
                    <input type="text" class="form-control" id="phoneNo" name = "phoneNo" value = "{{ '0'.$phoneNumber }}">
                </div>
                
                <div class="col-12 text-center">
                    <button type="submit">Make Payment</button>
                </div>
            </form>
            
        </div>
    </main>
</body>