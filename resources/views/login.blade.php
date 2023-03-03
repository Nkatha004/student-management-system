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
                    @if($errors->has('login_password'))
                        <div class = "alert-danger" role = "alert">
                            {{ $errors->first('login_password') }}
                        </div>
                    @endif
                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input type = "password" placeholder = "Password" name = "login_password">
                    </div>
                    <input type = "submit" value = "Login" class = "btn solid"/>
                </form>

                <form action = "{{ url('/schools') }}" method = "post" class="sign-up-form">
                    @csrf
                    @if(session()->has('message'))
                        <div class="alert-info">
                            {{ session()->get('message') }}
                        </div>
                    @endif
                    <h2 class="title">Sign up</h2>

                    <h4 class = "subtitle">School and Principal Details</h4>

                    @if($errors->has('schoolname'))
                        <div class = "alert-danger" role = "alert">
                            {{ $errors->first('schoolname') }}
                        </div>
                    @endif
                    <div class="input-field">
                        <i class="fas fa-home"></i>
                        <input type = "text" placeholder = "School Name" name = "schoolname">
                    </div>
                    <div class="form-group">
                        @if($errors->has('school_email'))
                            <div class = "alert-danger" role = "alert">
                                {{ $errors->first('school_email') }}
                            </div>
                        @endif
                        <div class="form-name-input input-field">
                            <i class="fas fa-envelope"></i>
                            <input type = "email" placeholder = "School Email Address" name = "school_email">
                        </div>
                        @if($errors->has('school_telNo'))
                            <div class = "alert-danger" role = "alert">
                                {{ $errors->first('school_telNo') }}
                            </div>
                        @endif
                        <div class="form-name-input input-field">
                            <i class="fas fa-phone"></i>
                            <input type = "tel" placeholder = "School Telephone No." name = "school_telNo">
                        </div>
                    </div>
                    <div class="form-group">
                        @if($errors->has('principal_fname'))
                            <div class = "alert-danger" role = "alert">
                                {{ $errors->first('principal_fname') }}
                            </div>
                        @endif
                        <div class="form-name-input input-field">
                            <i class="fas fa-user"></i>
                            <input type = "text" placeholder = "Principal First Name" name = "principal_fname">
                        </div>

                        @if($errors->has('principal_lname'))
                            <div class = "alert-danger" role = "alert">
                                {{ $errors->first('principal_lname') }}
                            </div>
                        @endif
                        <div class="form-name-input input-field">
                            <i class="fas fa-user"></i>
                            <input type = "text" placeholder = "Principal Last Name" name = "principal_lname">
                        </div> 
                    </div>
                    <div class="form-group">
                        @if($errors->has('principal_email'))
                            <div class = "alert-danger" role = "alert">
                                {{ $errors->first('principal_email') }}
                            </div>
                        @endif
                        <div class="form-name-input input-field">
                            <i class="fas fa-envelope"></i>
                            <input type = "email" placeholder = "Principal Email Address" name = "principal_email">
                        </div>
                        @if($errors->has('principal_telNo'))
                            <div class = "alert-danger" role = "alert">
                                {{ $errors->first('principal_telNo') }}
                            </div>
                        @endif
                        <div class="form-name-input input-field">
                            <i class="fas fa-phone"></i>
                            <input type = "tel" placeholder = "Principal Telephone No." name = "principal_telNo">
                        </div>
                    </div>

                    <div class="form-group">
                        @if($errors->has('password'))
                            <div class = "alert-danger" role = "alert">
                                {{ $errors->first('password') }}
                            </div>
                        @endif
                        <div class="form-name-input input-field">
                            <i class="fas fa-lock"></i>
                            <input type = "password" placeholder = "Password" name = "password">
                        </div>
                        @if($errors->has('password_confirmation'))
                            <div class = "alert-danger" role = "alert">
                                {{ $errors->first('password_confirmation') }}
                            </div>
                        @endif
                        <div class="form-name-input input-field">
                            <i class="fas fa-lock"></i>
                            <input type = "password" placeholder = "Password Confirmation" name = "password_confirmation">
                        </div> 
                    </div>
                    @if($errors->has('principal_tscNo'))
                        <div class = "alert-danger" role = "alert">
                            {{ $errors->first('principal_tscNo') }}
                        </div>
                    @endif
                    <div class="input-field">
                        <i class="fa fa-id-card"></i>
                        <input type = "number" min="6" placeholder = "Principal TSC Number" name = "principal_tscNo">
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
                    <img src="{{ URL::asset('images/maker_launch.svg') }}" alt="" class="image">
                </div>
            </div>
        </div>
    </div>
    <script src="https://kit.fontawesome.com/090dc3fb10.js" crossorigin="anonymous"></script>

    <script src = "{{ URL::asset('js/login.js') }}"></script>
</body>
</html>