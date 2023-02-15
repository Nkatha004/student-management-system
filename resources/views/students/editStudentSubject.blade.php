@include('dashboard.dashboardSideNav')
<main>
    <form method = "post" action = "{{ url('/updatestudentsubject/'.$studentsubject->id) }}" id = "addRoleForm" class="row g-3 form">
        @csrf
        @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif
        <h3 class = "text-center">Edit Student Subjects</h3>
        
        <div class="col-12">
            @if($errors->has('studentsubject'))
                <div class = "alert alert-danger" role = "alert">
                    {{ $errors->first('studentsubject') }}
                </div>
            @endif
            <label for="studentsubject" class="form-label">Student Subject ID</label>
            <input type="text" class="form-control" id="studentsubject" name = "studentsubject" value = "{{$studentsubject->id}}" readonly>
        </div>

        <div class="col-12">
            @if($errors->has('student'))
                <div class = "alert alert-danger" role = "alert">
                    {{ $errors->first('student') }}
                </div>
            @endif
            <label for="student" class="form-label">Student ID</label>
            <input type="text" class="form-control" id="student" name = "student" value = "{{$studentsubject->student_id}}" readonly>
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
        
        <div class="col-12 text-center">
            <button type="submit">Save</button>
        </div>
    </form>
</main>