@include('dashboard.dashboardsideNav')

<main>
	<div class = "text-center table-schools">

	    <table class="table table-striped">
			<thead>
				<tr>
					<th scope="col">First Name</th>
					<th scope="col">Last Name</th>
                    <th scope = "col">Admission Number</th>
				</tr>
			</thead>
			<tbody>
                
				<tr>
					<td>{{ $student->first_name }}</td>
					<td>{{ $student->last_name }}</td>
                    <td>{{ $student->admission_number }}</td>
				</tr>
               
			</tbody>
		</table>
	</div>
    <form method = "post" action = "{{ url('/marks') }}" id = "teachingSubjects" class="row g-3 form">
        @csrf
        @if(session()->has('message'))
            <div class="alert alert-warning text-center">
                {{ session()->get('message') }}
            </div>
        @endif
        <h3 class = "text-center">Add Marks</h3>
        <div class = "alert alert-info" role = "alert">
            Ensure marks entered are correct before submitting. Marks submitted cannot be edited!
        </div>

        <input type="text" class="form-control" id="student_id" name = "student_id" value = "{{$student->id}}" hidden>
        <input type="text" class="form-control" id="studentSubject" name = "studentSubject" value = "{{$studentsubjects->id}}" hidden>
        
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
            <input type="text" class="form-control" id="subject" name = "subject" value = "{{$subject->subject_name}}" readonly>
        </div>

        
        @if($errors->has('term'))
            <div class = "alert alert-danger" role = "alert">
                {{ $errors->first('term') }}
            </div>
        @endif
        <div class="col-12">
            <label for="inputState" class="form-label">Marks for Term:</label>
            <select id="inputState" class="form-select" name = "term">
                <option selected disabled>Choose the term</option>
                <option value = "Term 1">Term 1</option>
                <option value = "Term 2">Term 2</option>
                <option value = "Term 3">Term 3</option>
            </select>
        </div>

        @if($errors->has('mark'))
            <div class = "alert alert-danger" role = "alert">
                {{ $errors->first('mark') }}
            </div>
        @endif
        <div class="col-12">
            <label for="mark" class="form-label">Subject Mark</label>
            <input type="number" class="form-control" id="mark" name = "mark">
        </div>
        
        <div class="col-12 text-center">
            <button type="submit">Add Mark</button>
        </div>
    </form>
</main>