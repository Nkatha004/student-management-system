@include('dashboard.dashboardSideNav')
<main>
    <table id = "employeeSubjectsView" class="stripe row-border">
        <thead>
            <tr>
                @if(Auth::user()->role_id != \App\Models\Role::IS_CLASSTEACHER and Auth::user()->role_id != \App\Models\Role::IS_TEACHER and Auth::user()->role_id != $employee->id)
                   <th scope="col">Name</th>
                @endif
                
                <th scope="col">Teaching Subjects</th>
                <th scope="col">Class</th>
                @can('restore', '\App\Models\EmployeeSubject')
                    <th scope="col">Actions</th>
                @endcan
                @if(Auth::user()->role_id == \App\Models\Role::IS_TEACHER)
                    <th scope="col">Actions</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach($employeesubjects as $e_subject)
                @can('view', $e_subject)
                    <tr>
                        @if(Auth::user()->role_id != \App\Models\Role::IS_CLASSTEACHER and Auth::user()->role_id != \App\Models\Role::IS_TEACHER and Auth::user()->role_id != $employee->id)
                            <td>{{ $employee->first_name.' '. $employee->last_name}}</td>
                        @endif
                        <td><p>{{App\Http\Controllers\SubjectsController::getSubjectName($e_subject->subject_id)}} </p></td>
                        <td>{{App\Http\Controllers\ClassesController::getClassName($e_subject->class_id)}}</td>
                        
                        @can('restore', '\App\Models\EmployeeSubject')
                            <td>
                                @can('update', $e_subject)
                                    <a href = "{{ url('/editemployeesubject/'.$e_subject->id) }}" class = "btn btn-sm btn-warning">Update</a>
                                @endcan
                                @can('delete', $e_subject)
                                    <a href = "{{ url('/deleteemployeesubject/'.$e_subject->id) }}" class = "btn btn-sm btn-danger">Delete</a>
                                @endcan
                                @if($employee->id == Auth::user()->id)
                                    @can('create', '\App\Models\ExamMark')
                                        <a href = "{{ url('/viewstudents/'.$e_subject->id) }}" class = "btn btn-sm btn-secondary">Add Students Marks</a>
                                    @endcan
                                @endif
                            </td>
                        @endcan
                        @if(Auth::user()->role_id == \App\Models\Role::IS_TEACHER)
                            <td><a href = "{{ url('/viewstudents/'.$e_subject->id) }}" class = "btn btn-sm btn-secondary">Add Students Marks</a></td>
                        @endif
                    </tr>
                @endcan
            @endforeach
        </tbody>
    </table>
    <script>
        $(document).ready( function () {
            $('#employeeSubjectsView').DataTable();
        } );
    </script>


    @can('create', '\App\Models\EmployeeSubject')
        <form method = "post" action = "{{ url('/employeesubjects') }}" id = "teachingSubjects" class="row g-3 form">
            @csrf
            @if(session()->has('message'))
                <div class="text-center alert alert-info">
                    {{ session()->get('message') }}
                </div>
            @endif
            <h3 class = "text-center">Assign Teaching Subjects</h3>
            
            <input type="text" hidden class="form-control" id="employee" name = "employee" value = "{{$employee->id}}">

            <div class="col-12">
                @if($errors->has('name'))
                    <div class = "alert alert-danger" role = "alert">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <label for="name" class="form-label">Employee Name</label>
                <input type="text" class="form-control" id="name" name = "name" value = "{{$employee->first_name.' '.$employee->last_name}}" readonly>
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

            <div class="col-12 text-center">
                <button type="submit">Assign Subject</button>
            </div>
        </form>
    @endcan
</main>