@include('dashboard.dashboardSideNav')

<main>
   
    <form action = "{{ url('/updateemployee/'.$employee->id) }}" method = "post" id = "addEmployeeForm" class="row g-3 form">
        @csrf
        @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif

        <h3 class = "text-center">Edit Employee</h3>
        <div class="col-12">
            <label for="employeeID" class="form-label">Employee ID</label>
            <input type="number" class="form-control" id="employeeid" name = "employeeid" readonly value = "{{$employee->id}}">
        </div>
        @if($errors->has('fname'))
            <div class = "alert alert-danger" role = "alert">
                {{ $errors->first('fname') }}
            </div>
        @endif
        <div class="col-md-6">
            <label for="fname" class="form-label">First Name</label>
            <input type="text" class="form-control" id="fname" name = "fname" value = "{{ $employee->first_name }}">
        </div>
        @if($errors->has('lname'))
            <div class = "alert alert-danger" role = "alert">
                {{ $errors->first('lname') }}
            </div>
        @endif
        <div class="col-md-6">
            <label for="lname" class="form-label">Last Name</label>
            <input type="text" class="form-control" id="lname" name = "lname" value = "{{ $employee->last_name }}">
        </div>

        @if($errors->has('telNo'))
            <div class = "alert alert-danger" role = "alert">
                {{ $errors->first('telNo') }}
            </div>
        @endif
        <div class="col-md-6">
            <label for="telNo" class=" form-label">Telephone Number</label>
            <input type="text" class="form-control" id="telNo" name = "telNo" value = "{{ $employee->telephone_number }}">
        </div>

        @if($errors->has('email'))
            <div class = "alert alert-danger" role = "alert">
                {{ $errors->first('email') }}
            </div>
        @endif
        <div class="col-md-6">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name = "email" value = "{{ $employee->email }}">
        </div>

        @if($employee->role_id != \App\Models\Role::IS_SUPERADMIN)
            @if($errors->has('tscNo'))
                <div class = "alert alert-danger" role = "alert">
                    {{ $errors->first('tscNo') }}
                </div>
            @endif
            <div class="col-12">
                <label for="tscNo" class=" form-label">TSC Number</label>
                <input type="text" class="form-control" id="tscNo" name = "tscNo" value = "{{ $employee->tsc_number }}">
            </div>
        @endif
        
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

        @if($errors->has('role'))
            <div class = "alert alert-danger" role = "alert">
                {{ $errors->first('role') }}
            </div>
        @endif
        <div class="col-12">
            <label for="inputState" class="form-label">Role</label>
            <select id="inputState" class="form-select" name = "role">
                <option selected disabled>Choose the role</option>
                @foreach($roles as $role)
                <option value = "{{ $role->id}} ">{{ $role->role_name}}</option>
                @endforeach
            </select>
        </div>
        
        <div class="col-12 text-center">
            <button type="submit">Save</button>
        </div>
    </form>
</main>