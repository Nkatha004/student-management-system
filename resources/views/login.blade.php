<!DOCTYPE html>
<html>
<head>  
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <title>School Management System | Login</title>
    <link href = "{{URL::asset('css/login.css')}}" rel = "stylesheet">  
</head>
<body>
	<div class="container">
		<div class="forms-container">
            <div class="signin-signup">
                <form action = "{{ url('/login') }}" method = "post" class="sign-in-form">
                    @csrf
                    <h2 class="title">Sign in</h2>
                    @if(session()->has('messageLogin'))
                        <div class="alert-info">
                            {{ session()->get('messageLogin') }}
                        </div>
                    @endif
                    @if($errors->has('email'))
                        <div class = "alert-danger" role = "alert">
                            {{ $errors->first('email') }}
                        </div>
                    @endif
                    <div class="input-field">
                        <i class="fas fa-envelope"></i>
                        <input type = "email" placeholder = "Email Address" name = "email">
                    </div>
                    @if($errors->has('password'))
                        <div class = "alert-danger" role = "alert">
                            {{ $errors->first('password') }}
                        </div>
                    @endif
                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input type = "password" placeholder = "Password" name = "password">
                    </div>
                    <input type = "submit" value = "Login" class = "btn solid"/>
                </form>
            </div>
        </div>

        <div class="panels-container">
            <div class="panel left-panel">
                <div class="content">
                    <h3>New here ?</h3>
                    <p>
                        You can consider registering your school with us by clicking the button below. 
                    </p>
                    <a href = "{{ URL::to('/register') }}"><button class="btn transparent" id = "sign-up-btn">Sign up</button></a>
                    <img src="{{ URL::asset('images/maker_launch.svg') }}" alt="" class="image">
                </div>
            </div>
        </div>
    </div>
    <script src="https://kit.fontawesome.com/090dc3fb10.js" crossorigin="anonymous"></script>
</body>
</html>