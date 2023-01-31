@include('dashboard.dashboardSideNav')
<main>
    <div class="cards">
    <div class="single-card">
        <div>
            <span>Total payments made</span>
            <h2>{{ $totalpayments. ' USD' }}</h2>
        </div>
        <i class="uil uil-dollar-sign-alt"></i>
    </div>
    <div class="single-card">
        <div>
            <span>Number of schools</span>
            <h2>{{$schoolsCount}}</h2>
        </div>
        <i class="uil uil-bus"></i>
    </div>
    <div class="single-card">
        <div>
            <span>Number of employees</span>
            <h2>{{$employees}}</h2>
        </div>
        <i class="uil uil-book-reader"></i>
    </div>
    <div class="single-card">
        <div>
            <span>Number of students</span>
            <h2>{{ $students }}</h2>
        </div>
        <i class="uil uil-graduation-cap"></i>
    </div>
    </div>


    <div class="wrapper flex">
    <div class="projects">
        <div class="card-header flex">
            <h4>Pending Payments</h4>
            <!-- <button>See all <i class="uil uil-angle-right"></i></button> -->
        </div>

        <table>
            <thead>
                <th>
                <tr>
                    <td>School Name</td>
                    <td>Registration Date</td>
                    <td>Registration Time</td>
                </tr>
                </th>
            </thead>

            <tbody>
                @foreach ($pendingpayments as $pending) 
                <tr>
                    <td>{{$pending->school_name}}</td>
                    <td>{{date('d/m/Y' ,strtotime($pending->created_at))}}</td>
                    <td>{{date('h:i a' ,strtotime($pending->created_at))}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="customers">
        <div class="card-header flex">
            <h4>Recent Payments</h4>
            <!-- <button>See all <i class="uil uil-angle-right"></i></button> -->
        </div>

        <table>
            <thead>
                <th>
                    <tr>
                        <td>School Name</td>
                        <td>Payment Date</td>
                    </tr>
                </th>
            </thead>
            <tbody>
                @foreach ($recentpayments as $recent) 
                <tr>
                    <td>{{App\Http\Controllers\SchoolsController::getSchoolName($recent->paid_by)}}</td>
                    <td>{{date('d/m/Y' ,strtotime($recent->created_at))}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
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