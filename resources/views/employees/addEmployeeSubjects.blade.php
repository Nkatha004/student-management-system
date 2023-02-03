@include('dashboard.dashboardSideNav')
<main>
	<div class = "text-center table-schools">

	<table class="table table-striped">
			<thead>
				<tr>
                    @if(Auth::user()->role_id != 3 and Auth::user()->role_id != 4)
					<th scope="col">First Name</th>
					<th scope="col">Last Name</th>
                    @endif
                    <th scope="col">Teaching Subjects</th>
                    <th scope="col">Class</th>
                    @if(Auth::user()->role_id != 3 and Auth::user()->role_id != 4)
                    <th scope="col">Status</th>
                    @endif
				</tr>
			</thead>
			<tbody>
                @foreach($employeesubjects as $e_subject)
				<tr>
                    @if(Auth::user()->role_id != 3 and Auth::user()->role_id != 4)
					<td>{{ $employee->first_name }}</td>
					<td>{{ $employee->last_name }}</td>
                    @endif
                    <td><p>{{App\Http\Controllers\SubjectsController::getSubjectName($e_subject->subject_id)}} </p></td>
                    <td>{{App\Http\Controllers\ClassesController::getClassName($e_subject->class_id)}}</td>
                    
                    @if(Auth::user()->role_id == 2)
                    <td>
                        <a href = "{{ url('/editemployeesubject/'.$e_subject->id) }}" class = "btn btn-sm btn-warning">Update</a>
                        <a href = "{{ url('/deleteemployeesubject/'.$e_subject->id) }}" class = "btn btn-sm btn-danger">Delete</a>
						<a href = "{{ url('/viewstudents/'.$e_subject->id) }}" class = "btn btn-sm btn-secondary">View Students</a>
                    </td>
                    @elseif(Auth::user()->role_id != 3 and Auth::user()->role_id != 4)
                    <td>{{$e_subject->status}}</td>
                    <td>
						<a href = "{{ url('/editemployeesubject/'.$e_subject->id) }}" class = "btn btn-sm btn-warning">Update</a>
                        <a href = "{{ url('/deleteemployeesubject/'.$e_subject->id) }}" class = "btn btn-sm btn-danger">Delete</a>
                    </td>
                    @else
                    <td>
						<a href = "{{ url('/viewstudents/'.$e_subject->id) }}" class = "btn btn-sm btn-secondary">Add Students Marks</a>
                    </td>
                    @endif
				</tr>
                @endforeach
			</tbody>
		</table>
	</div>
    @if(Auth::user()->role_id != 3 and Auth::user()->role_id != 4)
    <form method = "post" action = "{{ url('/employeesubjects') }}" id = "teachingSubjects" class="row g-3 form">
        @csrf
        @if(session()->has('message'))
            <div class="text-center alert alert-info">
                {{ session()->get('message') }}
            </div>
        @endif
        <h3 class = "text-center">Assign Teaching Subjects</h3>
        
        <div class="col-12">
            @if($errors->has('employee'))
                <div class = "alert alert-danger" role = "alert">
                    {{ $errors->first('employee') }}
                </div>
            @endif
            <label for="employee" class="form-label">Employee ID</label>
            <input type="text" class="form-control" id="employee" name = "employee" value = "{{$employee->id}}" readonly>
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
    @endif
</main>