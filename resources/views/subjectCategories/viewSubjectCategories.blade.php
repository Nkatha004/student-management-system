@include('common/header')
<main>
	<div class = "text-center table-schools">
	<table class="table table-striped">
			<thead>
				<tr>
					<th scope="col">Subject Category ID</th>
					<th scope="col">Subject Category Name</th>
					<th scope="col">Subject Category Description</th>
					<th scope="col">Status</th>
				</tr>
			</thead>
			<tbody>
				@foreach($categories as $category)
				<tr>
			
					<td>{{ $category->id }}</td>
					<td>{{ $category->category_name }}</td>
                    <td>{{ $category->description }}</td>
					<td>{{ $category->status }}</td>

					<td>
						<a href = "{{ url('/editsubjectcategory/'.$category->id) }}" class = "btn btn-sm btn-warning">Update</a>
						<a href = "{{ url('/deletesubjectcategory/'.$category->id) }}" class = "btn btn-sm btn-danger">Delete</a>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</main>