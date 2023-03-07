@include('dashboard.dashboardSideNav')

<main>
   
    <form action = "{{ url('/students') }}" method = "post" class="row g-3 form">
        @csrf
        @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif

        <h3 class = "text-center">Register New Student</h3>

        @if($errors->has('admNo'))
            <div class = "alert alert-danger" role = "alert">
                {{ $errors->first('admNo') }}
            </div>
        @endif
        <div class="col-12">
            <label for="admNo" class=" form-label">Admission Number</label>
            <input type="text" class="form-control" id="admNo" name = "admNo">
        </div>

        @if($errors->has('fname'))
            <div class = "alert alert-danger" role = "alert">
                {{ $errors->first('fname') }}
            </div>
        @endif
        <div class="col-md-6">
            <label for="fname" class="form-label">Student First Name</label>
            <input type="text" class="form-control" id="fname" name = "fname">
        </div>
        @if($errors->has('lname'))
            <div class = "alert alert-danger" role = "alert">
                {{ $errors->first('lname') }}
            </div>
        @endif
        <div class="col-md-6">
            <label for="lname" class="form-label">Student Last Name</label>
            <input type="text" class="form-control" id="lname" name = "lname">
        </div>

        @if($errors->has('guardianname'))
            <div class = "alert alert-danger" role = "alert">
                {{ $errors->first('guardianname') }}
            </div>
        @endif
        <div class="col-12">
            <label for="guardianname" class=" form-label">Guardian Full Name</label>
            <input type="text" class="form-control" id="guardianname" name = "guardianname">
        </div>

        @if($errors->has('phoneNo'))
            <div class = "alert alert-danger" role = "alert">
                {{ $errors->first('phoneNo') }}
            </div>
        @endif
        <div class="col-md-6">
            <label for="phoneNo" class="form-label">Guardian Phone Number</label>
            <input type="text" class="form-control" id="phoneNo" name = "phoneNo">
        </div>

        @if($errors->has('email'))
            <div class = "alert alert-danger" role = "alert">
                {{ $errors->first('email') }}
            </div>
        @endif
        <div class="col-md-6">
            <label for="email" class="form-label">Guardian Email Address</label>
            <input type="email" class="form-control" id="email" name = "email">
        </div>

        @if($errors->has('class'))
            <div class = "alert alert-danger" role = "alert">
                {{ $errors->first('class') }}
            </div>
        @endif
        <div class="col-12">
            <label for="inputState" class="form-label">Class Name</label>
            <select id="inputState" class="form-select" name = "class">
                <option selected disabled>Choose the class</option>
                @foreach($classes as $class)
                    @if(Auth::user()->role_id == \App\Models\Role::IS_SUPERADMIN)
                        <option value = "{{ $class->id}} ">{{ $class->class_name.' - '.\App\Http\Controllers\SchoolsController::getSchoolNameByClassID($class->id)}}</option>
                    @else
                        <option value = "{{ $class->id}} ">{{ $class->class_name }}</option>
                    @endif

                @endforeach
            </select>
        </div>

        <div class="col-12 text-center">
            <button type="submit">Add Student</button>
        </div>
    </form>
</main>