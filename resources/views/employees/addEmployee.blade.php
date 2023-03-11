@include('dashboard.dashboardSideNav')

<main>
   
    <form action = "{{ url('/employees') }}" method = "post" id = "addEmployeeForm" class="row g-3 form">
        @csrf
        @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif

        <h3 class = "text-center">Register New Employee</h3>
        @if($errors->has('fname'))
            <div class = "alert alert-danger" role = "alert">
                {{ $errors->first('fname') }}
            </div>
        @endif
        <div class="col-md-6">
            <label for="fname" class="form-label">First Name</label>
            <input type="text" class="form-control" id="fname" name = "fname">
        </div>
        @if($errors->has('lname'))
            <div class = "alert alert-danger" role = "alert">
                {{ $errors->first('lname') }}
            </div>
        @endif
        <div class="col-md-6">
            <label for="lname" class="form-label">Last Name</label>
            <input type="text" class="form-control" id="lname" name = "lname">
        </div>

        @if($errors->has('telNo'))
            <div class = "alert alert-danger" role = "alert">
                {{ $errors->first('telNo') }}
            </div>
        @endif
        <div class="col-md-6">
            <label for="telNo" class=" form-label">Telephone Number</label>
            <input type="text" class="form-control" id="telNo" name = "telNo">
        </div>

        @if($errors->has('email'))
            <div class = "alert alert-danger" role = "alert">
                {{ $errors->first('email') }}
            </div>
        @endif
        <div class="col-md-6">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name = "email">
        </div>

        @if($errors->has('password'))
            <div class = "alert alert-danger" role = "alert">
                {{ $errors->first('password') }}
            </div>
        @endif
        <div class="col-md-6">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name = "password">
        </div>

        @if($errors->has('password_confirmation'))
            <div class = "alert alert-danger" role = "alert">
                {{ $errors->first('password_confirmation') }}
            </div>
        @endif
        <div class="col-md-6">
            <label for="password_confirmation" class="form-label">Password Confirmation</label>
            <input type="password" class="form-control" id="password_confirmation" name = "password_confirmation">
        </div>

        @if($errors->has('tscNo'))
            <div class = "alert alert-danger" role = "alert">
                {{ $errors->first('tscNo') }}
            </div>
        @endif
        <div class="col-12">
            <label for="tscNo" class=" form-label">TSC Number</label>
            <input type="text" class="form-control" id="tscNo" name = "tscNo">
        </div>

        @if($errors->has('gender'))
            <div class = "alert alert-danger" role = "alert">
                {{ $errors->first('gender') }}
            </div>
        @endif
        <div class="col-12">
            <label for="gender" class=" form-label">Gender</label>
            <select class="form-select" name = "gender">
                <option selected disabled value = "">Select gender</option>
                <option value = "male">Male</option>
                <option value = "female">Female</option>
            </select>
        </div>

        @if (Auth::check())
        <input value = '{{\App\Models\Role::IS_TEACHER}}' name = "role" hidden>
        @endif

        @if (Auth::user()->role_id != \App\Models\Role::IS_SUPERADMIN)
        <input value = '{{Auth::user()->school_id}}' name = "school" hidden>
        @else
            @if($errors->has('school'))
                <div class = "alert alert-danger" role = "alert">
                    {{ $errors->first('school') }}
                </div>
            @endif
            <div class="col-12">
                <label for="inputState" class="form-label">School Name</label>
                <select id="inputState" class="form-select" name = "school">
                    <option selected disabled>Choose the school</option>
                    @foreach($schools as $school)
                    <option value = "{{ $school->id}} ">{{ $school->school_name}}</option>
                    @endforeach
                </select>
            </div>
        @endif
        
        <div class="col-12 text-center">
            <button type="submit">Add Employee</button>
        </div>
    </form>
</main>