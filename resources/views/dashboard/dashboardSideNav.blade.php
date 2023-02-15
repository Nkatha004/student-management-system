<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Management System</title>
    <link href = "{{URL::asset('css/adminDashStyles.css')}}" rel = "stylesheet">
    <link href = "{{URL::asset('css/bityarn.css')}}" rel = "stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/090dc3fb10.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link rel = "stylesheet" href = "//cdn.datatables.net/1.13.2/css/jquery.dataTables.min.css">
</head>
<body>
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <script src = "//cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>
    
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
                @if (Auth::user()->role_id != 3 and Auth::user()->role_id != 4)
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
                @if(Auth::user()->role_id == 1)
                    <a href = "{{URL::to('/viewstudents')}}">
                        <li>
                            <i class="uil uil-book-reader"></i>
                            <span>Students</span>
                        </li>
                    </a>
                @else
                    @if (Auth::user()->role_id != 3)
                    <a class = "dropdown-btn">
                        <li>
                            <i class="uil uil-book-reader"></i>
                            <span>Students</span>
                        </li>
                    </a>
                    <div class = "dropdown-container">
                        <a href = "{{URL::to('/students')}}">Add Student</a>
                        <a href = "{{URL::to('/viewstudents')}}"><span>View Students</span></a>
                    </div>
                    @endif
                @endif
                @if (Auth::user()->role_id == 1)
                <a class = "dropdown-btn">
                    <li>
                        <i class="uil uil-user"></i>
                        <span>Roles</span>
                    </li>
                </a>
                <div class = "dropdown-container">
                    <a href = "{{URL::to('/roles')}}">Add Role</a>
                    <a href = "{{URL::to('/viewroles')}}"><span>View Roles</span></a>
                    <a href = "{{URL::to('/trashedroles')}}">Deleted Roles</a>
                </div>
                @endif
                @if (Auth::user()->role_id == 3 or Auth::user()->role_id == 4)
                <a href = "{{URL::to('/employeesubjects/'.Auth::user()->id)}}">
                    <li>
                        <i class="uil uil-books"></i>
                        <span>My Teaching Subjects</span>
                    </li>
                </a>
                @elseif(Auth::user()->role_id == 2)
                <a class = "dropdown-btn">
                    <li>
                        <i class="uil uil-books"></i>
                        <span>Subjects</span>
                    </li>
                </a>
                <div class = "dropdown-container">
                    <a href = "{{URL::to('/subjects')}}">Add Subject</a>
                    <a href = "{{URL::to('/viewsubjects')}}"><span>View Subjects</span></a>
                    <a href = "{{URL::to('/employeesubjects/'.Auth::user()->id)}}"><span>My Teaching Subjects</span></a>
                </div>
                @else
                <a class = "dropdown-btn">
                    <li>
                        <i class="uil uil-books"></i>
                        <span>Subjects</span>
                    </li>
                </a>
                <div class = "dropdown-container">
                    <a href = "{{URL::to('/subjects')}}">Add Subject</a>
                    <a href = "{{URL::to('/viewsubjects')}}"><span>View Subjects</span></a>
                </div>
                @endif
                @if (Auth::user()->role_id != 3 and Auth::user()->role_id != 4)
                <a class = "dropdown-btn">
                    <li>
                        <i class="uil uil-book-open"></i>
                        <span>Subject Categories</span>
                    </li>
                </a>
                <div class = "dropdown-container">
                    <a href = "{{URL::to('/subjectcategories')}}">Add Category</a>
                    <a href = "{{URL::to('/viewsubjectcategories')}}"><span>View Categories</span></a>
                </div>
                @endif    
                @if(Auth::user()->role_id == 1)
                    <a class = "dropdown-btn">
                        <li>
                            <i class="uil uil-presentation-edit"></i>
                            <span>Classes</span>
                        </li>
                    </a>
                    <div class = "dropdown-container">
                        <a href = "{{URL::to('/viewclasses')}}"><span>View Classes</span></a>
                        <a href = "{{URL::to('/trashedclasses')}}"><span>Trashed Classes</span></a>
                    </div>
                @elseif (Auth::user()->role_id != 3)
                    @if(Auth::user()->role_id != 2)
                        <a href = "{{URL::to('/viewclasses')}}">
                            <li>
                                <i class="uil uil-presentation-edit"></i>
                                <span>Classes</span>
                            </li>
                        </a>
                    @else
                        <a class = "dropdown-btn">
                            <li>
                                <i class="uil uil-presentation-edit"></i>
                                <span>Classes</span>
                            </li>
                        </a>
                        <div class = "dropdown-container">
                            <a href = "{{URL::to('/classes')}}">Add Class</a>
                            <a href = "{{URL::to('/viewclasses')}}"><span>View Classes</span></a>
                            <a href = "{{URL::to('/trashedclasses')}}"><span>Trashed Classes</span></a>
                        </div>

                    @endif
                @endif
                @if(Auth::user()->role_id == 2)
                    <a href = "{{URL::to('/viewclasses')}}">
                        <li>
                            <i class="uil uil-chart"></i>
                            <span>Exam Performance</span>
                        </li>
                    </a>
                @endif
                @if (Auth::user()->role_id != 3)
                    @if (Auth::user()->role_id == 1)
                        <a href = "{{URL::to('/viewpayments')}}">
                            <li>
                                <i class="uil uil-dollar-sign"></i>
                                <span>Payments</span>
                            </li>
                        </a>
                        <div class = "dropdown-container">
                            <a ><span>View Payments</span></a>
                        </div>
                    @elseif(Auth::user()->role_id == 2)
                        <a class = "dropdown-btn">
                            <li>
                                <i class="uil uil-dollar-sign"></i>
                                <span>Payments</span>
                            </li>
                        </a>
                        <div class = "dropdown-container">
                            <a href = "{{URL::to('/payments')}}">Add Payment</a>
                            <a href = "{{URL::to('/mytransactions')}}"><span>View my Payments</span></a>
                        </div>
                    @endif
                @endif
                
                <a href = "{{URL::to('/logout')}}">
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