@include('dashboard.dashboardSideNav')
<main>
	@can('restore', '\App\Models\SubjectCategories')
		<div>
	        <a href = "{{URL::to('/restorecategories')}}"class = "btn btn-success">Restore all</a>
	    </div><br>
    @endcan
	<div>
		<table class="compact row-border stripe" id = "subjectCategoriesView">
			<thead>
				<tr>
					<th scope="col">Category Name</th>
					<th scope="col">Category Description</th>
					@if(Auth::user()->role_id == \App\Models\Role::IS_SUPERADMIN)
						<th scope = "col">School</th>
					@endif
					<th scope = "col">Actions</th>
				</tr>
			</thead>
			<tbody>
				@foreach($categories as $category)
				<tr>
					<td>{{ $category->category_name }}</td>
                    <td>{{ $category->description }}</td>
					@if(Auth::user()->role_id == \App\Models\Role::IS_SUPERADMIN)
						<td>{{ App\Http\Controllers\SchoolsController::getSchoolName($category->school_id) }}</td>
					@endif

                    @can('restoreOne', $category)
						<td>
							<a href = "{{ url('/restorecategory/'.$category->id) }}" class = "btn btn-sm btn-success">Restore</a>
						</td>
					@endcan
				</tr>
				@endforeach
			</tbody>
		</table>
		<script>
			$(document).ready( function () {
    			$('#subjectCategoriesView').DataTable();
			} );
		</script>
	</div>
</main>