@include('common.header')
<main>
    <div class="container">
        <div class="row signincontainer">
            <div class = "col welcome text-center">
                <h3>Welcome Back!</h3>
                <medium>Hello there,<br/></br>If you are new, you may consider registering your school with us.</medium>
                <div class = "text-center">
                    <a href = "{{URL::to('/register')}}"><button id = "signup">SIGN UP</button></a>
                </div>
            </div>
            
            <form action = "{{ url('/login') }}" method = "post" class = "col text-center" id = "signindiv">
                @csrf
                @if(session()->has('message'))
                    <div class="alert alert-info">
                        {{ session()->get('message') }}
                    </div>
                @endif
                <h3 id = "signinheader">Sign In</h3>
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