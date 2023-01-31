<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Management System</title>
    <link href = "{{URL::asset('css/adminDashStyles.css')}}" rel = "stylesheet">
    <link href = "{{URL::asset('css/styles.css')}}" rel = "stylesheet">
    <link href = "{{URL::asset('css/bityarn.css')}}" rel = "stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/090dc3fb10.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
</head>
<body>
    <div class="sidebar" id="sidebar">
        <div class="logo text-center">
            <h2>Bityarn</h2>
        </div>
        <div class="sidebar-menu">
            <ul>
                @if (Auth::user()->role_id == 1)
                <a href = "{{URL::to('/admindashboard')}}">
                    <li id = "activeDash" >
                        <i class="uil uil-chart-line"></i>
                        <span>Dashboard</span>
                    </li>
                </a>
                @elseif (Auth::user()->role_id == 2)    
                <a href = "{{URL::to('/principaldashboard')}}">
                    <li id = "activeDash" >
                        <i class="uil uil-chart-line"></i>
                        <span>Dashboard</span>
                    </li>
                </a>
                @else
                <a href = "{{URL::to('/teacherdashboard')}}">
                    <li id = "activeDash">
                        <i class="uil uil-chart-line"></i>
                        <span>Dashboard</span>
                    </li>
                </a>
                @endif
                @if (Auth::user()->role_id == 1)
               
                <a class = "dropdown-btn">
                    <li>
                        <i class="uil uil-university"></i>
                        <span>Schools</span>
                    </li>
                    
                </a>
                <div class = "dropdown-container">
                    <a href = "{{URL::to('/schools')}}">Add School</a>
                    <a href = "{{URL::to('/viewschools')}}"><span>View Schools</span></a>
                </div>

                @endif
                @if (Auth::user()->role_id != 3)
                <a class = "dropdown-btn">
                    <li>
                        <i class="uil uil-users-alt"></i>
                        <span>Employees</span>
                    </li>
                </a>
                <div class = "dropdown-container">
                    <a href = "{{URL::to('/employees')}}">Add Employee</a>
                    <a href = "{{URL::to('/viewemployees')}}"><span>View Employees</span></a>
                </div>
                @endif
                <a class = "dropdown-btn">
                    <li>
                        <i class="uil uil-book-reader"></i>
                        <span>Students</span>
                    </li>
                </a>
                <div class = "dropdown-container">
                    <a href = "{{URL::to('/schools')}}">Add School</a>
                    <a href = "{{URL::to('/viewschools')}}"><span>View Schools</span></a>
                </div>
                @if (Auth::user()->role_id == 1)
                <a class = "dropdown-btn">
                    <li>
                        <i class="uil uil-user"></i>
                        <span>Roles</span>
                    </li>
                </a>
                <div class = "dropdown-container">
                    <a href = "{{URL::to('/schools')}}">Add School</a>
                    <a href = "{{URL::to('/viewschools')}}"><span>View Schools</span></a>
                </div>
                @endif
                <a class = "dropdown-btn">
                    <li>
                        <i class="uil uil-books"></i>
                        <span>Subjects</span>
                    </li>
                </a>
                <div class = "dropdown-container">
                    <a href = "{{URL::to('/schools')}}">Add School</a>
                    <a href = "{{URL::to('/viewschools')}}"><span>View Schools</span></a>
                </div>
                @if (Auth::user()->role_id != 3)
                <a class = "dropdown-btn">
                    <li>
                        <i class="uil uil-book-open"></i>
                        <span>Subject Categories</span>
                    </li>
                </a>
                <div class = "dropdown-container">
                    <a href = "{{URL::to('/schools')}}">Add School</a>
                    <a href = "{{URL::to('/viewschools')}}"><span>View Schools</span></a>
                </div>
                @endif
                <a class = "dropdown-btn">
                    <li>
                        <i class="uil uil-presentation-edit"></i>
                        <span>Classes</span>
                    </li>
                </a>
                <div class = "dropdown-container">
                    <a href = "{{URL::to('/schools')}}">Add School</a>
                    <a href = "{{URL::to('/viewschools')}}"><span>View Schools</span></a>
                </div>
                @if (Auth::user()->role_id != 3)
                    @if(Auth::user()->role_id == 1)
                        <a class = "dropdown-btn">
                            <li>
                                <i class="uil uil-dollar-sign"></i>
                                <span>Payments</span>
                            </li>
                        </a>
                        <div class = "dropdown-container">
                            <a href = "{{URL::to('/schools')}}">Add School</a>
                            <a href = "{{URL::to('/viewschools')}}"><span>View Schools</span></a>
                        </div>
                    @elseif(Auth::user()->role_id == 2)
                        <a class = "dropdown-btn">
                            <li>
                                <i class="uil uil-dollar-sign"></i>
                                <span>Payments</span>
                            </li>
                        </a>
                        <div class = "dropdown-container">
                            <a href = "{{URL::to('/schools')}}">Add School</a>
                            <a href = "{{URL::to('/viewschools')}}"><span>View Schools</span></a>
                        </div>  
                    @endif
                @endif
                <a class = "dropdown-btn">
                    <li>
                        <i class="uil uil-signin"></i>
                        <span>Logout</span>
                    </li>
                </a>
            </ul>
        </div>
        <script>
            var dropdown = document.getElementsByClassName('dropdown-btn');
    
            for(var i = 0; i < dropdown.length; i++){
                dropdown[i].addEventListener('click', function(){
                    this.classList.toggle("active");

                    var dropdowncontent = this.nextElementSibling;

                    if(dropdowncontent.style.display === "block"){
                        dropdowncontent.style.display = "none";
                    }else{
                        dropdowncontent.style.display = "block";
                    }
                });
            }
        </script>
    </div>
    <div class="main-content" id="main-content">
        <header class="flex">
            @if(Auth::user()->role_id != 1)
            <h4>{{App\Http\Controllers\SchoolsController::getSchoolName(Auth::user()->school_id)}}</h4>
            @else
                <h2>Dashboard</h2>
            @endif
            <!-- <div class="search-box">
            <i class="uil uil-search"></i>
            <input type="text" placeholder="Search Here...">
            </div> -->

            <div class="admin-box flex" >
            @if (Auth::check())
                <i class="fa-solid fa-circle-user"></i>
                <span>{{ Auth::user()->first_name.' '.Auth::user()->last_name }}<span>
            @endif
            </div>
        </header>