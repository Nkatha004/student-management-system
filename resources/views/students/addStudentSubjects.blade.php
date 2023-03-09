@include('dashboard.dashboardSideNav')
<main>
    <table id = "studentSubjectsView" class="stripe row-border">
        <thead>
            <tr>
                <th scope="col">Name</th>
                <th scope = "col">Class</th>
                <th scope="col">Student Subjects</th>
                @if(Auth::user()->role_id != \App\Models\Role::IS_TEACHER)
                <th scope="col">Actions</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach($studentsubjects as $s_subject)
                @can('view', $s_subject)
                <tr>
                    <td>{{ $student->first_name.' '.$student->last_name }}</td>                
                    <td>{{App\Http\Controllers\ClassesController::getClassName($student->class_id) }}</td>
                    <td><p>{{App\Http\Controllers\SubjectsController::getSubjectName($s_subject->subject_id)}} </p></td>
                    <td>
                        @can('update', $s_subject)
                            <a href = "{{ url('/editstudentsubject/'.$s_subject->id) }}" class = "btn btn-sm btn-warning">Update</a>
                        @endcan
                        @can('delete', $s_subject)
                            <a href = "{{ url('/deletestudentsubject/'.$s_subject->id) }}" class = "btn btn-sm btn-danger">Delete</a>
                        @endcan
                    </td>
                </tr>
                @endcan
            @endforeach
        </tbody>
    </table>
    <script>
        $(document).ready( function () {
            $('#studentSubjectsView').DataTable();
        });
    </script>
    @can('view', $student)
        <form method = "post" action = "{{ url('/studentsubjects') }}" id = "teachingSubjects" class="row g-3 form">
            @csrf
            @if(session()->has('message'))
                <div class="alert alert-info">
                    {{ session()->get('message') }}
                </div>
            @endif
            <h3 class = "text-center">Assign Student Subjects</h3>
            
            <div class="col-12">
                @if($errors->has('student'))
                    <div class = "alert alert-danger" role = "alert">
                        {{ $errors->first('student') }}
                    </div>
                @endif
                <label for="student" class="form-label">Student Name</label>
                <input type="text" class="form-control" id="student" name = "student" value = "{{$student->id}}" hidden>
                <input type="text" class="form-control" id="studentName" name = "studentName" value = "{{$student->first_name.' '.$student->last_name}}" readonly>
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
                <button type="submit">Assign Subject</button>
            </div>
        </form>
    @endcan
</main>