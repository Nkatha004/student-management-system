@include('dashboard.dashboardSideNav')

<main>
    <div class="cards-teachers">
		@if (Auth::user()->role_id == \App\Models\Role::IS_CLASSTEACHER)
	    	<div class="single-card">
		        <a href = "{{ URL::to('/viewclasses') }}"><div>
		            <span>Class Teacher</span>
		            <h2>{{$classes->class_name. ' '.$classes->year}}</h2>
		        </div></a>
		        <i class="uil uil-dollar-sign-alt"></i>
		    </div>
		    <div class="single-card">
		        <a href = "{{ URL::to('/employeesubjects/'.Auth::user()->id) }}"><div>
		            <span>Teaching Subjects and Assigned Classes</span>
		            <h2>{{$assignedClasses}}</h2>
		        </div></a>
		        <i class="uil uil-presentation-edit"></i>
		    </div>
			<div class="single-card">
		        <a href = "{{ URL::to('/viewstudents') }}"><div>
		            <span>Total Number of Students</span>
		            <h2>{{$students}}</h2>
		        </div></a>
		        <i class="uil uil-graduation-cap"></i>
		    </div>
		@else
			<div class="single-card">
		        <a href = "{{ URL::to('/employeesubjects/'.Auth::user()->id) }}"><div>
		            <span>Teaching Subjects and Assigned Classes</span>
		            <h2>{{$assignedClasses}}</h2>
		        </div></a>
		        <i class="uil uil-presentation-edit"></i>
		    </div>
		@endif
    </div>
</main>
</div>

<script>
    let sideBar = document.getElementById('sidebar');
    let menuIcon = document.getElementById('menu-icon');
    let mainContent = document.getElementById('main-content');

    menuIcon.onclick = () => {
        sideBar.classList.toggle('toggleMenu');
        mainContent.classList.toggle('toggleContent');
    }
</script>
</body>
</html>