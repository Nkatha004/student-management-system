@include('common/header')
<div class = "text-center table-schools">
	<main>
	<table class="table table-striped">
			<thead>
				<tr>
					<th scope="col">Subject ID</th>
					<th scope="col">Subject Name</th>
					<th scope="col">Subject Category</th>
					<th scope="col">Status</th>
				</tr>
			</thead>
			<tbody>
				@foreach($subjects as $subject)
				<tr>
			
					<td>{{ $subject->id }}</td>
					<td>{{ $subject->subject_name }}</td>
                    <td>{{ App\Http\Controllers\SubjectCategoriesController::getSubjectCategoryName($subject->category_id) }}</td>
					<td>{{ $subject->status }}</td>

					<td>
						<a href = "{{ url('/editsubject/'.$subject->id) }}" class = "btn btn-sm btn-warning">Update</a>
						<a href = "{{ url('/deletesubject/'.$subject->id) }}" class = "btn btn-sm btn-danger">Delete</a>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</main>
</div>