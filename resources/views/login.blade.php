@include('common.header')
<main>
    <div class="container">
        <div class="row signincontainer">
            <div class = "col welcome">
                <h4 id = "welcome-back"class = "text-center">Welcome back!</h4>
                <p><a href = "{{URL::to('/register')}}">Register a new school</a> or <a href = "{{URL::to('/#section3')}}">contact us. </a>You can reach us via <a href = "mailto: admin@admin.com">email</a> or <a href = "tel: +254XXXXXXXXX">phone</a></p>
                <p>If your school is registered, please proceed to <a href = "{{URL::to('/login')}}">login</a></p>
            </div>
            
            <form action = "{{ url('/login') }}" method = "post" class = "col text-center" id = "signindiv">
                @csrf
                @if(session()->has('message'))
                    <div class="alert alert-info">
                        {{ session()->get('message') }}
                    </div>
                @endif
                <h3 id = "signinheader">Sign in</h3>
                @if($errors->has('email'))
                    <div class = "alert alert-danger" role = "alert">
                        {{ $errors->first('email') }}
                    </div>
                @endif
                <div class="row">
                    <div class="col-12">
                        <input type="email" class="form-control" id="email" name = "email" placeholder="Email Address">
                    </div>
                </div><br/>
                @if($errors->has('password'))
                    <div class = "alert alert-danger" role = "alert">
                        {{ $errors->first('password') }}
                    </div>
                @endif
                    <div class="row">
                    <div class="mb-3">
                        <input type="password" class="form-control" id="password" name = "password" placeholder="Password">
                    </div>
                </div>
                <div class = "text-center">
                    <p><a href = "{{ URL::to('/forgotpassword') }}" id = "forgot-password" class = "green-color text-center">forgot your password?</a></p>
                    <button id = "signin">SIGN IN</button>
                </div>
            
            </form>
            
        </div>
    </div>
</main>