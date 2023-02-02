@include('dashboard.dashboardSideNav')
<main>
    <form method = "post" action = "{{ url('/updateemployeesubject/'.$employeesubject->id) }}" id = "addRoleForm" class="row g-3 form">
        @csrf
        @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif
        <h3 class = "text-center">Edit Teaching Subjects</h3>
        
        <div class="col-12">
            @if($errors->has('employeesubject'))
                <div class = "alert alert-danger" role = "alert">
                    {{ $errors->first('employeesubject') }}
                </div>
            @endif
            <label for="employeesubject" class="form-label">Employee Subject ID</label>
            <input type="text" class="form-control" id="employeesubject" name = "employeesubject" value = "{{$employeesubject->id}}" readonly>
        </div>

        <div class="col-12">
            @if($errors->has('employee'))
                <div class = "alert alert-danger" role = "alert">
                    {{ $errors->first('employee') }}
                </div>
            @endif
            <label for="employee" class="form-label">Employee ID</label>
            <input type="text" class="form-control" id="employee" name = "employee" value = "{{$employeesubject->employee_id}}" readonly>
        </div>
        
        @if($errors->has('subject'))
            <div class = "alert alert-danger" role = "alert">
                {{ $errors->first('subject') }}
            </div>
        @endif
        <div class="col-12">
            <label for="inputState" class="form-label">Subject Name</label>
            <select id="inputState" class="form-select" name = "subject">
                <option selected disabled>Choose the subject</option>
                @foreach($subjects as $subject)
                <option value = "{{ $subject->id}} ">{{ $subject->subject_name}}</option>
                @endforeach
            </select>
        </div>

        @if($errors->has('class'))
            <div class = "alert alert-danger" role = "alert">
                {{ $errors->first('class') }}
            </div>
        @endif
        <div class="col-12">
            <label for="inputState" class="form-label">Class Name</label>
            <select id="inputState" class="form-select" name = "class">
                <option selected disabled>Choose the Class</option>
                @foreach($classes as $class)
                <option value = "{{ $class->id}} ">{{ $class->class_name}}</option>
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
                <option value = "Archived">Archived</option>
            </select>
        </div>
        
        <div class="col-12 text-center">
            <button type="submit">Save</button>
        </div>
    </form>
</main>