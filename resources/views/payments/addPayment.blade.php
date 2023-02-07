@if($message == "Payment Complete")
    @include('dashboard.dashboardSideNav')
@else
    @include('common.header')
@endif
<body>
    <main>
        <div>
            <div id = "payments" class = "text-center">
                @csrf
                <h5 class = "text-center">Making Payments</h5>
                <p>Hello. Thank you for registering with us!</p>

                <p>To get started with our system, you need to make a registration payment of 50 U.S. Dollars or 5, 000 Kenyan shillings</p>
                <b>Registration Payment: </b><span>$50 or Kshs 5, 000/=</span>
                <br/><br/>
                <p>If you have any questions or encounter any challenges, you can reach us through <a href = "mailto: nkatha.dev@gmail.com">email</a> or simply give us a <a href = "tel: +254XXXXXXXXX">call.</a> We are glad and more than ready to help</p>
                <form action = "{{ URL::to('/payments') }}" method = "POST">
                    @csrf
                    <div class = "text-center">
                        <input hidden type = "number" value = 50 name = "amount">
                        <button id = "paypal" type = "submit"><span id = 'payWith'>Pay with </span><b><span id = "Pay">Pay</span><span id = "Pal">Pal</span></b></button>
                    </div>
                </form>
                <form action = "{{ URL::to('/payments') }}" method = "POST">
                    @csrf
                    <div class = "text-center">
                        <input hidden type = "number" value = 50 name = "amount">
                        <button id = "mpesa" type = "submit"><b>Pay with Mpesa</b></button>
                    </div>
                </form>

            </div>
        </div>
    </main>
</body>