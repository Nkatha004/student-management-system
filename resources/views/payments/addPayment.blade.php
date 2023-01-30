@include('dashboard.dashboardSideNav')

<div>
    <form action = "{{ URL('/payments') }}" method = "post" id = "payments" class = "text-center">
        @csrf
        <h5 class = "text-center">Making Payments</h5>
        <p>Hello. Thank you for registering with us!</p>

        <p>To get started with our system, you need to make a registration payment of 50 U.S. Dollars</p>
        <b>Registration Payment: </b><span>$50 </span>
        <br/><br/>
        <p>If you have any questions or encounter any challenges, you can reach us through <a href = "mailto: nkatha.dev@gmail.com">email</a> or simply give us a <a href = "tel: +254XXXXXXXXX">call.</a> We are glad and more than ready to help</p>
        <input type="hidden"name="amount"value="50">
        <div class = "text-center">
            <button id = "paypal" type = "submit"><i>Pay with</i> <b>PayPal</b></button>
        </div>

    </form>
</div>