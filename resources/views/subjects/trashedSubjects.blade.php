@include('dashboard.dashboardSideNav')
<main>
	<div>
        <a href = "{{URL::to('/restoresubjects')}}"class = "btn btn-success">Restore all</a>
    </div><br>
	<div>
		<table id = "subjectsView" class="stripe row-border">
			<thead>
				<tr>
					<th scope="col">Subject Name</th>
					<th scope="col">Subject Category</th>
					@if(Auth::user()->role_id == 1)
					<th scope="col">Actions</th>
					@endif
				</tr>
			</thead>
			<tbody>
				@foreach($subjects as $subject)
				<tr>
					<td>{{ $subject->subject_name }}</td>
                    <td>{{ App\Http\Controllers\SubjectCategoriesController::getSubjectCategoryName($subject->category_id) }}</td>
					
					@if(Auth::user()->role_id == 1)
					<td>
						<a href = "{{ url('/restoresubject/'.$subject->id) }}" class = "btn btn-sm btn-success">Restore</a>
					</td>
					@endif
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