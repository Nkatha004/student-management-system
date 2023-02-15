@include('dashboard.dashboardsideNav')

<main>
    <form method = "post" action = "{{ url('/updatemark/'.$marks->id) }}" id = "teachingSubjects" class="row g-3 form">
        @csrf
        @if(session()->has('message'))
            <div class="alert alert-info text-center">
                {{ session()->get('message') }}
            </div>
        @endif
        <h3 class = "text-center">Edit Marks</h3>
        
        <div class="col-12">
            @if($errors->has('admission'))
                <div class = "alert alert-danger" role = "alert">
                    {{ $errors->first('admission') }}
                </div>
            @endif
            <label for="admission" class="form-label">Student Admission Number</label>
            <input type="text" class="form-control" id="admission" name = "admission" value = "{{$student->admission_number}}" readonly>
        </div>

        @if($errors->has('subject'))
            <div class = "alert alert-danger" role = "alert">
                {{ $errors->first('subject') }}
            </div>
        @endif
        <div class="col-12">
            <label for="inputState" class="form-label">Subject Name</label>
            <input type="text" class="form-control" id="subject" name = "subject" value = "{{App\Http\Controllers\SubjectsController::getSubjectName($studentsubject->subject_id)}}" readonly>
            <input type="text" class="form-control" id="subject" name = "subjectID" value = "{{$studentsubject->subject_id}}" hidden>
        </div>

        
        @if($errors->has('term'))
            <div class = "alert alert-danger" role = "alert">
                {{ $errors->first('term') }}
            </div>
        @endif
        <div class="col-12">
            <label for="inputState" class="form-label">Term:</label>
            <input type="text" class="form-control" id="term" name = "term" value = "{{$marks->term}}" readonly>
        </div>

        @if($errors->has('mark'))
            <div class = "alert alert-danger" role = "alert">
                {{ $errors->first('mark') }}
            </div>
        @endif
        <div class="col-12">
            <label for="mark" class="form-label">Subject Mark</label>
            <input type="number" class="form-control" id="mark" name = "mark" value = "{{$marks->mark}}">
        </div>
        
        <div class="col-12 text-center">
            <button type="submit">Save</button>
        </div>
    </form>
</main>