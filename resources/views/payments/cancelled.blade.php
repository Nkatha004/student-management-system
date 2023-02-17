@include('common/header')
<main>
    <div id = "payments" class = "text-center">
        <i class="fa fa-times-circle-o" aria-hidden="true"></i>
        <h2>Payment cancelled!</h2>
        <h6>Your payment has been <span>cancelled</span></h6>
        <div class = "btns cancel text-center">
            <a href = "{{ route('myTransactions') }}"><button>View my Transactions</button></a>
            <a href = "{{ URL::to('/payments') }}"><button>Try Again</button></a>
        </div>
    </div>
</main>