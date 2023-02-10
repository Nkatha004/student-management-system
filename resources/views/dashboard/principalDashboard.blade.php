@include('dashboard.dashboardSideNav')

<main>
    <div class="cards-teachers">
    	<div class="single-card">
	        <a href = "{{ URL::to('/mytransactions') }}"><div>
	            <span>Total payments made</span>
	            <h2>{{$payments. ' Kshs'}}</h2>
	        </div></a>
	        <i class="uil uil-dollar-sign-alt"></i>
	    </div>
	    <div class="single-card">
	        <a href = "{{ URL::to('/viewemployees') }}"><div>
	            <span>Number of teachers</span>
	            <h2>{{$teachers}}</h2>
	        </div></a>
	        <i class="uil uil-book-reader"></i>
	    </div>
	    <div class="single-card">
	        <a href = "{{ URL::to('/viewclasses') }}"><div>
	            <span>Number of classes</span>
	            <h2>{{$classes}}</h2>
	        </div></a>
	        <i class="uil uil-presentation-edit"></i>
	    </div>
	    <div class="single-card">
	        <a href = "{{ URL::to('/viewstudents') }}"><div>
	            <span>Number of students</span>
	            <h2>{{ $students }}</h2>
	        </div></a>
	        <i class="uil uil-graduation-cap"></i>
	    </div>
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