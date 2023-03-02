<!DOCTYPE html>
<html>
<head>
    <link href = "{{URL::asset('css/loginTrial.css')}}" rel = "stylesheet">  
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <title>School Management System | Login</title>
    <link href = "{{URL::asset('css/loginTrial.css')}}" rel = "stylesheet">  
</head>
<body>
	<div class="container">
		<div class="forms-container">
            <div class="signin-signup">
                <form action = "{{ url('/login') }}" method = "post" class="sign-in-form">
                    
                    <h2 class="title">Sign in</h2>

                    <div class="input-field">
                        <i class="fas fa-envelope"></i>
                        <input type = "email" placeholder = "Email Address" name = "email">
                    </div>
                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input type = "password" placeholder = "Password" name = "password">
                    </div>
                    <input type = "submit" value = "Login" class = "btn solid"/>
                </form>

                <form action = "{{ url('/register') }}" method = "post" class="sign-up-form">
                    
                    <h2 class="title">Sign up</h2>

                    <h4 class = "subtitle">School's Details</h4>

                    <div class="input-field">
                        <i class="fas fa-home"></i>
                        <input type = "text" placeholder = "School Name" name = "schoolname">
                    </div>
                    <div class="input-field">
                        <i class="fas fa-envelope"></i>
                        <input type = "email" placeholder = "School Email Address" name = "school_email">
                    </div>
                    <div class="input-field">
                        <i class="fas fa-phone"></i>
                        <input type = "text" placeholder = "School Telephone Number" name = "school_telNo">
                    </div>

                    <h4 class = "subtitle">Principal's Details</h4>

                    <div class="input-field">
                        <i class="fas fa-user"></i>
                        <input type = "text" placeholder = "Principal First Name" name = "principal_fname">
                    </div>
                    <div class="input-field">
                        <i class="fas fa-user"></i>
                        <input type = "text" placeholder = "Principal Last Name" name = "principal_lname">
                    </div>
                    <div class="input-field">
                        <i class="fa fa-id-card"></i>
                        <input type = "text" placeholder = "Principal TSC Number" name = "principal_tscNo">
                    </div>
                    <div class="input-field">
                        <i class="fas fa-envelope"></i>
                        <input type = "email" placeholder = "Principal Email Address" name = "principal_email">
                    </div>
                    <div class="input-field">
                        <i class="fas fa-phone"></i>
                        <input type = "text" placeholder = "Principal Telephone Number" name = "principal_telNo">
                    </div>
                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input type = "password" placeholder = "Password" name = "password">
                    </div>
                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input type = "password" placeholder = "Password Confirmation" name = "password_confirmation">
                    </div>
                    <input type = "submit" value = "Register" class = "btn solid"/>
                </form>
            </div>
        </div>

        <div class="panels-container">
            <div class="panel left-panel">
                <div class="content">
                    <h3>New here ?</h3>
                    <p>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. 
                        Temporibus illo quibusdam nobis pariatur fugit voluptas numquam optio.
                    </p>
                    <button class="btn transparent" id = "sign-up-btn">Sign up</button>
                    <img src="{{ URL::asset('images/maker_launch.svg') }}" alt="" class="image">
                </div>
            </div>

            <div class="panel right-panel">
                <div class="content">
                    <h3>One of us ?</h3>
                    <p>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. 
                        Temporibus illo quibusdam nobis pariatur fugit voluptas numquam optio.
                    </p>
                    <button class="btn transparent" id = "sign-in-btn">Sign in</button>
                    <img src="{{ URL::asset('images/press_play.svg') }}" alt="" class="image">
                </div>
            </div>
        </div>
    </div>
    <script src="https://kit.fontawesome.com/090dc3fb10.js" crossorigin="anonymous"></script>

    <script src = "{{ URL::asset('js/loginTrial.js') }}"></script>
</body>
</html>