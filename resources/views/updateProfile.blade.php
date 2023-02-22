@include('dashboard.dashboardSideNav')

<main>
    <div class="container profile">

        <div class="row">
             <div class = "col">
                <center>
                    <!-- If there is an existing image in db -->
                    <!-- <img id = "profileImage" src = "{{URL::asset('images/student_bg.jpg')}}"> -->

                    <!-- If there is no file in db -->
                    <i class="green-color fa-solid fa-user fa-6x"></i>
                    <input id="upload" type="file" hidden accept="image/*"/>
                    <a href="" id="upload_link"><i class="green-color uil uil-plus-circle"></i></a>
                </center>

                <form method = "post" action = "{{ url('/updateprofile') }}" class="row g-3 form profileForm">
                    <h4 class = "green-color text-center">My Profile</h4>
                    @csrf
                    @if(session()->has('messageprofile'))
                        <div class="alert alert-success">
                            {{ session()->get('messageprofile') }}
                        </div>
                    @endif

                    @if($errors->has('fname'))
                        <div class = "alert alert-danger" role = "alert">
                            {{ $errors->first('fname') }}
                        </div>
                    @endif
                    <div class="col-md-6">
                        <label for="fname" class="form-label">First Name</label>
                        <input type="text" class="form-control" id="fname" name = "fname" value = "{{Auth::user()->first_name}}">
                    </div>
                    @if($errors->has('lname'))
                        <div class = "alert alert-danger" role = "alert">
                            {{ $errors->first('lname') }}
                        </div>
                    @endif
                    <div class="col-md-6">
                        <label for="lname" class="form-label">Last Name</label>
                        <input type="text" class="form-control" id="lname" name = "lname" value = "{{Auth::user()->last_name}}">
                    </div>

                    @if(Auth::user()->role_id != \App\Models\Role::IS_SUPERADMIN)
                        @if($errors->has('tscNo'))
                            <div class = "alert alert-danger" role = "alert">
                                {{ $errors->first('tscNo') }}
                            </div>
                        @endif
                        <div class="col-12">
                            <label for="tscNo" class=" form-label">TSC Number</label>
                            <input type="text" class="form-control" id="tscNo" name = "tscNo" value = "{{Auth::user()->tsc_number}}">
                        </div>
                    @endif

                    @if($errors->has('telNo'))
                        <div class = "alert alert-danger" role = "alert">
                            {{ $errors->first('telNo') }}
                        </div>
                    @endif
                    <div class="col-md-6">
                        <label for="telNo" class=" form-label">Phone Number</label>
                        <input type="text" class="form-control" id="telNo" name = "telNo" value = "{{Auth::user()->telephone_number}}">
                    </div>

                    @if($errors->has('email'))
                        <div class = "alert alert-danger" role = "alert">
                            {{ $errors->first('email') }}
                        </div>
                    @endif
                    <div class="col-md-6">
                        <label for="email" class="form-label">Email Address</label>
                        <input type="email" class="form-control" id="email" name = "email" value = "{{Auth::user()->email}}">
                    </div>

                    @if($errors->has('role'))
                        <div class = "alert alert-danger" role = "alert">
                            {{ $errors->first('role') }}
                        </div>
                    @endif
                    <br>
                    <div class="col-12">
                        <label for="role" class="form-label">Role</label>
                        <input type="text" class="form-control" id="role" name = "role" readonly value = "{{\App\Http\Controllers\RolesController::getRoleName(Auth::user()->role_id)}}">
                    </div>
                    <div class="col-12 text-center">
                        <button type="submit">Update Profile</button>
                    </div>
                </form>
            </div>
            <div class="col">
                <form method = "post" action = "{{ url('/changepassword') }}" class="row g-3 form " id = "profilePasswordForm">
                    <h4 class = "text-center green-color">Change Password</h4>
                    @csrf
                    @if(session()->has('message'))
                        <div class="alert alert-success">
                            {{ session()->get('message') }}
                        </div>
                    @endif

                    @if($errors->has('currentPassword'))
                        <div class = "alert alert-danger" role = "alert">
                            {{ $errors->first('currentPassword') }}
                        </div>
                    @endif
                    <div class="col-12">
                        <label for="currentPassword" class="form-label">Current Password</label>
                        <input type="password" class="form-control" id="currentPassword" name = "currentPassword">
                    </div>

                    @if($errors->has('password'))
                        <div class = "alert alert-danger" role = "alert">
                            {{ $errors->first('password') }}
                        </div>
                    @endif
                    <div class="col-12">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name = "password">
                    </div>

                    @if($errors->has('password_confirmation'))
                        <div class = "alert alert-danger" role = "alert">
                            {{ $errors->first('password_confirmation') }}
                        </div>
                    @endif
                    <div class="col-12">
                        <label for="password_confirmation" class="form-label">Password Confirmation</label>
                        <input type="password" class="form-control" id="password_confirmation" name = "password_confirmation">
                    </div>
                    <div class="col-12 text-center">
                        <button type="submit">Change Password</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
<script type="text/javascript">
    $(function(){
        $("#upload_link").on('click', function(e){
            e.preventDefault();
            $("#upload:hidden").trigger('click');
        });
    }); 
</script>