@include('dashboard.dashboardSideNav')
<main>
	@can('restore', '\App\Models\Subject')
		<div>
	        <a href = "{{URL::to('/restoresubjects')}}"class = "btn btn-success">Restore all</a>
	    </div><br>
	@endcan
	<div>
		<table id = "subjectsView" class="stripe row-border">
			<thead>
				<tr>
					<th scope="col">Subject Name</th>
					<th scope="col">Subject Category</th>
					@if(Auth::user()->role_id == \App\Models\Role::IS_PRINCIPAL)
						<th scope = "col">School</th>
					@endif
					<th scope="col">Actions</th>
				</tr>
			</thead>
			<tbody>
				@foreach($subjects as $subject)
				<tr>
					<td>{{ $subject->subject_name }}</td>
                    <td>{{ App\Http\Controllers\SubjectCategoriesController::getSubjectCategoryName($subject->category_id) }}</td>
					@if(Auth::user()->role_id == \App\Models\Role::IS_PRINCIPAL)
						<td>{{ App\Http\Controllers\SchoolsController::getSchoolName($subject->school_id) }}</td>
					@endif
					@can('restore', '\App\Models\Subject')
						<td>
							<a href = "{{ url('/restoresubject/'.$subject->id) }}" class = "btn btn-sm btn-success">Restore</a>
						</td>
					@endcan
				</tr>
				@endforeach
			</tbody>
		</table>
		<script>
			$(document).ready( function () {
    			$('#subjectsView').DataTable();
			});
		</script>
	</div>
</main>