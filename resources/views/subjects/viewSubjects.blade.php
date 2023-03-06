@can('viewAny', '\App\Models\Subject')
	@include('dashboard.dashboardSideNav')
	<main>
		<div>
			<table id = "subjectsView" class="stripe row-border">
				<thead>
					<tr>
						<th scope="col">Subject Name</th>
						<th scope="col">Subject Category</th>
						@if(Auth::user()->role_id == \App\Models\Role::IS_SUPERADMIN)
							<th scope="col">School</th>
						@endif
						<th scope="col">Actions</th>
					</tr>
				</thead>
				<tbody>
					@foreach($subjects as $subject)
						@can('view', $subject)
						<tr>
						
							<td>{{ $subject->subject_name }}</td>
							<td>{{ App\Http\Controllers\SubjectCategoriesController::getSubjectCategoryName($subject->category_id) }}</td>
							@if(Auth::user()->role_id == \App\Models\Role::IS_SUPERADMIN)
								<td>{{ App\Http\Controllers\SchoolsController::getSchoolName($subject->school_id) }}</td>
							@endif
							<td>
								@can('update', $subject)
									<a href = "{{ url('/editsubject/'.$subject->id) }}" class = "btn btn-sm btn-warning">Update</a>
								@endcan
								@can('delete', $subject)
									<a href = "{{ url('/deletesubject/'.$subject->id) }}" class = "btn btn-sm btn-danger">Delete</a>
								@endcan
							</td>
						</tr>
						@endcan
					@endforeach
				</tbody>
			</table>
			<script>
				$(document).ready( function () {
					$('#subjectsView').DataTable();
				} );
			</script>
		</div>
	</main>
@endcan