@if(Auth::check())
    @if(Auth::user()->role_id == \App\Models\Role::IS_SUPERADMIN)
        @include('dashboard.dashboardSideNav')
    @else
        @include('common/header')
    @endif
@else
    @include('common/header')
@endif
<main>    
    @if(Auth::check())
    <form method = "post" action = "{{ url('/schools') }}" class="row g-3 form normalForm">
    @else
    <form method = "post" action = "{{ url('/schools') }}" id = "addForm" class="row g-3 form">
    @endif
        @csrf
        @if(session()->has('message'))
            <div class="alert alert-success text-center">
                {{ session()->get('message') }}
            </div>
        @endif
        @if(session()->has('messageWarning'))
            <div class="alert alert-warning text-center">
                {{ session()->get('messageWarning') }}
            </div>
        @endif
        <h3 class = "text-center">Register New School</h3>
        <h5 class = "text-center">School's Details</h5>
        <div class="col-12">
            @if($errors->has('schoolname'))
                <div class = "alert alert-danger" role = "alert">
                    {{ $errors->first('schoolname') }}
                </div>
            @endif
            <label for="schoolname" class="form-label">School Name</label>
            <input type="text" class="form-control" id="schoolname" name = "schoolname">
        </div>
        <div class="col-md-6">
            @if($errors->has('school_email'))
                <div class = "alert alert-danger" role = "alert">
                    {{ $errors->first('school_email') }}
                </div>
            @endif
            <label for="school_email" class="form-label">School Email</label>
            <input type="school_email" class="form-control" id="school_email" name = "school_email">
        </div>
        <div class="col-md-6">
            @if($errors->has('school_telNo'))
                <div class = "alert alert-danger" role = "alert">
                    {{ $errors->first('school_telNo') }}
                </div>
            @endif
            <label for="school_telNo" class=" form-label">School Telephone Number</label>
            <input type="text" class="form-control" id="school_telNo" name = "school_telNo">
        </div>

        <h5 class = "text-center">Principal's Details</h5>

        @if($errors->has('principal_fname'))
            <div class = "alert alert-danger" role = "alert">
                {{ $errors->first('principal_fname') }}
            </div>
        @endif
        <div class="col-md-6">
            <label for="principal_fname" class="form-label">First Name</label>
            <input type="text" class="form-control" id="principal_fname" name = "principal_fname">
        </div>
        @if($errors->has('principal_lname'))
            <div class = "alert alert-danger" role = "alert">
                {{ $errors->first('principal_lname') }}
            </div>
        @endif
        <div class="col-md-6">
            <label for="principal_lname" class="form-label">Last Name</label>
            <input type="text" class="form-control" id="principal_lname" name = "principal_lname">
        </div>

        @if($errors->has('principal_tscNo'))
            <div class = "alert alert-danger" role = "alert">
                {{ $errors->first('principal_tscNo') }}
            </div>
        @endif
        <div class="col-12">
            <label for="principal_tscNo" class=" form-label">TSC Number</label>
            <input type="text" class="form-control" id="principal_tscNo" name = "principal_tscNo">
        </div>

        @if($errors->has('principal_telNo'))
            <div class = "alert alert-danger" role = "alert">
                {{ $errors->first('principal_telNo') }}
            </div>
        @endif
        <div class="col-md-6">
            <label for="principal_telNo" class=" form-label">Phone Number</label>
            <input type="text" class="form-control" id="principal_telNo" name = "principal_telNo">
        </div>

        @if($errors->has('principal_email'))
            <div class = "alert alert-danger" role = "alert">
                {{ $errors->first('principal_email') }}
            </div>
        @endif
        <div class="col-md-6">
            <label for="principal_email" class="form-label">Email Address</label>
            <input type="principal_email" class="form-control" id="principal_email" name = "principal_email">
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
            <p><a href = "{{URL::to('/login')}}" id = "haveAccount" class = "green-color text-center">Already have an account? Log in</a></p>
            <button type="submit">Register</button>
        </div>
    </form>
</main>