@include('common/header')

<main>
   
    <form action = "{{ url('/updateemployee/'.$employee->id) }}" method = "post" id = "addEmployeeForm" class="row g-3 form">
        @csrf
        @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif

        <h3 class = "text-center">Edit Employee</h3>
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

        @if($errors->has('tscNo'))
            <div class = "alert alert-danger" role = "alert">
                {{ $errors->first('tscNo') }}
            </div>
        @endif
        <div class="col-12">
            <label for="tscNo" class=" form-label">TSC Number</label>
            <input type="text" class="form-control" id="tscNo" name = "tscNo" value = "{{ $employee->tsc_number }}">
        </div>
        
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

        @if($errors->has('role'))
            <div class = "alert alert-danger" role = "alert">
                {{ $errors->first('role') }}
            </div>
        @endif
        <div class="col-12">
            <label for="inputState" class="form-label">Role Name</label>
            <select id="inputState" class="form-select" name = "role">
                <option selected disabled>Choose the role</option>
                @foreach($roles as $role)
                <option value = "{{ $role->id}} ">{{ $role->role_name}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-12">
            @if($errors->has('status'))
                <div class = "alert alert-danger" role = "alert">
                    {{ $errors->first('status') }}
                </div>
            @endif
            <label for="status" class=" form-label">Status</label>
            <select id="inputState" class="form-select" name = "status">
                <option value = "Active">Active</option>
                <option value = "Deleted">Deleted</option>
                <option value = "Archived">Archived</option>
            </select>
        </div>
        <div class="col-12 text-center">
            <button type="submit">Save</button>
        </div>
    </form>
</main>