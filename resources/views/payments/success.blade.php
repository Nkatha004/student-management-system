@include('common/header')
<main>
    <div id = "payments" class = "text-center">
        <i class="fa-sharp fa-solid fa-circle-check"></i>
        <h2>Payment Successful!</h2>
        <h6>Hurray! Your payment has been made <span class = "green-color">successfully</span>.</h6>
        <div class = "btns text-center">
            <a href = "{{ URL::to('/mytransactions') }}"><button>View my Transactions</button></a>
            <a href = "{{ URL::to('/principaldashboard') }}"><button>Proceed to Dashboard</button></a>
        </div>
    </div>
</main>