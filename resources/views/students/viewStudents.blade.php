@include('common/header')
<div class = "text-center table-employees">
	<main>
	<table class="table table-striped">
			<thead id = "viewstudents">
				<tr>
					<th scope="col">Admission Number</th>
					<th scope="col">First Name</th>
                    <th scope="col">Last Name</th>
					<th scope="col">Guardian Name</th>
					<th scope="col">Guardian Email</th>
					<th scope="col">Guardian Phone Number</th>
					<th scope="col">Class Name</th>
                	<th scope="col">Status</th>
				</tr>
			</thead>
			<tbody>
				@foreach($students as $student)
				<tr>
					<td>{{ $student->admission_number }}</td>
					<td>{{ $student->first_name }}</td>
                    <td>{{ $student->last_name }}</td>
					<td>{{ $student->guardian_name }}</td>
					<td>{{ $student->guardian_email }}</td>
					<td>{{ $student->guardian_phone_number }}</td>
					<td>{{App\Http\Controllers\ClassesController::getClassName($student->class_id) }}</td>
					<td>{{ $student->status }}</td>

					<td>
						<a href = "{{ url('/editstudent/'.$student->id) }}"><i class="fa fa-pencil" aria-hidden="true"></i></a>
					</td>
					<td><a href = "{{ url('/deletestudent/'.$student->id) }}"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
					
				</tr>
				@endforeach
			</tbody>
		</table>
	</main>
</div>