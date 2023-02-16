@include('dashboard.dashboardSideNav')
<main>
    <div>
        <a href = "{{URL::to('/restoreemployeesubjects')}}"class = "btn btn-success">Restore all</a>
    </div><br>
    <div>
	   <table id= "trashedEmployeeSubjects" class="stripe row-border">
			<thead>
				<tr>
					<th scope="col">Employee Name</th>
					<th scope="col">Subject Name</th>
                    <th scope="col">Class</th>
                    @if(Auth::user()->role_id == 1)
                    <th scope="col">School</th>
                    @endif
                    <th scope="col">Actions</th>
				</tr>
			</thead>
			<tbody>
                @foreach($employeesubjects as $e_subject)
				<tr>
					<td>{{ App\Http\Controllers\EmployeesController::getEmployeeName($e_subject->employee_id) }}</td>
                    <td><p>{{App\Http\Controllers\SubjectsController::getSubjectName($e_subject->subject_id)}} </p></td>
                    <td>{{App\Http\Controllers\ClassesController::getClassName($e_subject->class_id)}}</td>
                    @if(Auth::user()->role_id == 1)
                        <td>{{App\Http\Controllers\SchoolsController::getSchoolNameByClassID($e_subject->class_id)}}</td>
                    @endif

                    <td>
                        <a href = "{{ url('/restoreemployeesubject/'.$e_subject->id) }}" class = "btn btn-sm btn-success">Restore</a>
                    </td>
				</tr>
                @endforeach
			</tbody>
		</table>
	</div>
    <script>
        $(document).ready( function () {
            $('#trashedEmployeeSubjects').DataTable();
        });
    </script>
</main>