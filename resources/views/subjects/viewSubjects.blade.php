@include('dashboard.dashboardSideNav')
<main>
	<div class = "text-center table-schools">
	<table class="table table-striped">
			<thead>
				<tr>
					<th scope="col">Subject Name</th>
					<th scope="col">Subject Category</th>
				</tr>
			</thead>
			<tbody>
				@foreach($subjects as $subject)
				<tr>
					<td>{{ $subject->subject_name }}</td>
                    <td>{{ App\Http\Controllers\SubjectCategoriesController::getSubjectCategoryName($subject->category_id) }}</td>
					
					@if(Auth::user()->role_id == 1)
					<td>
						<a href = "{{ url('/editsubject/'.$subject->id) }}" class = "btn btn-sm btn-warning">Update</a>
						<a href = "{{ url('/deletesubject/'.$subject->id) }}" class = "btn btn-sm btn-danger">Delete</a>
					</td>
					@endif
				</tr>
				@endforeach
			</tbody>
		</table>
		<div class="d-flex justify-content-center">
            {{ $subjects->links() }}
        </div>
	</div>
</main>