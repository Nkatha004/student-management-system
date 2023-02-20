@include('dashboard.dashboardSideNav')
<main>
	<div>
		<table class="compact row-border stripe" id = "subjectCategoriesView">
			<thead>
				<tr>
					<th scope="col">Category Name</th>
					<th scope="col">Category Description</th>
					@if(Auth::user()->role_id == \App\Models\Role::IS_SUPERADMIN)
						<th scope = "col">Actions</th>
					@endif
				</tr>
			</thead>
			<tbody>
				@foreach($categories as $category)
				<tr>
					<td>{{ $category->category_name }}</td>
                    <td>{{ $category->description }}</td>

					@if(Auth::user()->role_id == \App\Models\Role::IS_SUPERADMIN)
						<td>
							@can('update', $category)
								<a href = "{{ url('/editsubjectcategory/'.$category->id) }}" class = "btn btn-sm btn-warning">Update</a>
							@endcan
							@can('delete', $category)
								<a href = "{{ url('/deletesubjectcategory/'.$category->id) }}" class = "btn btn-sm btn-danger">Delete</a>
							@endcan
						</td>
					@endif
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