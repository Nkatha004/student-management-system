<!DOCTYPE html>
<html>
<head>  
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <title>School Management System | Registration</title>
    <link href = "{{URL::asset('css/register.css')}}" rel = "stylesheet">  
</head>
<body>
	<div class="container">
		<div class="forms-container">
            <div class="signin-signup">
                <form action = "{{ url('/schools') }}" method = "post" class="sign-up-form">
                @csrf
                    @if(session()->has('message'))
                        <div class="alert-info text-center">
                            {{ session()->get('message') }}
                        </div>
                    @endif

                    @if(session()->has('messageWarning'))
                        <div class="alert-warning text-center">
                            {{ session()->get('messageWarning') }}
                        </div>
                    @endif
                    <h2 class="title">Sign up</h2>

                    <h4 class = "subtitle">School Details</h4>

                    @if($errors->has('schoolname'))
                        <div class = "alert-danger" role = "alert">
                            {{ $errors->first('schoolname') }}
                        </div>
                    @endif
                    <div class="input-field">
                        <i class="fas fa-home"></i>
                        <input type = "text" placeholder = "School Name" name = "schoolname">
                    </div>
                    
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

                    <h4 class = "subtitle">Principal Details</h4>

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

                    @if($errors->has('principal_tscNo'))
                        <div class = "alert-danger" role = "alert">
                            {{ $errors->first('principal_tscNo') }}
                        </div>
                    @endif
                    <div class="input-field">
                        <i class="fa fa-id-card"></i>
                        <input type = "number" placeholder = "Principal TSC Number" name = "principal_tscNo">
                    </div>

                    @if($errors->has('gender'))
                        <div class = "alert alert-danger" role = "alert">
                            {{ $errors->first('gender') }}
                        </div>
                    @endif
                    <label>Gender: </label>
                    <div class = "radio">
                        <div class = "radio-items">
                            <input type="radio" id="male" name="gender" value="male">
                            <label for="male">Male</label>
                        </div>

                        <div class = "radio-items">
                            <input type="radio" id="female" name="gender" value="female">
                            <label for="female">Female</label>
                        </div>
                    </div>
            
                    <input type = "submit" value = "Register" class = "btn solid"/>
                </form>
            </div>
        </div>

        <div class="panels-container">
            <div class="panel right-panel">
                <div class="content">
                    <div class = "call-to-action">
                        <h3>One of us ?</h3>
                        <p>
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. 
                            Temporibus illo quibusdam nobis pariatur fugit voluptas numquam optio.
                        </p>
                        <a href = "{{ URL::to('/login') }}"><button class="btn transparent" id = "sign-in-btn">Sign in</button></a>
                    </div>
                    <img src="{{ URL::asset('images/maker_launch.svg') }}" alt="" class="image">
                </div>
            </div>
        </div>
    </div>
    <script src="https://kit.fontawesome.com/090dc3fb10.js" crossorigin="anonymous"></script>
</body>
</html>