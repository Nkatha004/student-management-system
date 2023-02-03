@include('dashboard.dashboardSideNav')
<main>
	<div class = "text-center table-schools">
	<table class="table table-striped">
			<thead>
				<tr>
					<th scope="col">Category ID</th>
					<th scope="col">Category Name</th>
					<th scope="col">Category Description</th>
				</tr>
			</thead>
			<tbody>
				@foreach($categories as $category)
				<tr>
					<td>{{ $category->id }}</td>
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
	</div>
</main>