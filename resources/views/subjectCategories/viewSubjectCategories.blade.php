@include('dashboard.dashboardSideNav')
<main>
	<div>
		<table class="compact row-border stripe" id = "subjectCategoriesView">
			<thead>
				<tr>
					<th scope="col">Category Name</th>
					<th scope="col">Category Description</th>
					@if(Auth::user()->role_id == 1)
					<th scope = "col">Actions</th>
					@endif
				</tr>
			</thead>
			<tbody>
				@foreach($categories as $category)
				<tr>
					<td>{{ $category->category_name }}</td>
                    <td>{{ $category->description }}</td>

					@if(Auth::user()->role_id == 1)
					<td>
						<a href = "{{ url('/editsubjectcategory/'.$category->id) }}" class = "btn btn-sm btn-warning">Update</a>
						<a href = "{{ url('/deletesubjectcategory/'.$category->id) }}" class = "btn btn-sm btn-danger">Delete</a>
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