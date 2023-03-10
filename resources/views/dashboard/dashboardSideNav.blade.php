<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>School Management System</title>
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
                @if (Auth::user()->role_id == \App\Models\Role::IS_SUPERADMIN)
                    <a href = "{{URL::to('/admindashboard')}}">
                        <li id = "activeDash" >
                            <i class="uil uil-chart-line"></i>
                            <span>Dashboard</span>
                        </li>
                    </a>
                    <a class = "dropdown-btn">
                        <li>
                            <i class="uil uil-comment-alt-message"></i>
                            <span>Messages</span>
                        </li>
                        
                    </a>
                    <div class = "dropdown-container">
                        <a href = "{{URL::to('/viewmessages')}}">All Messages</a>
                        <a href = "{{URL::to('/pendingmessages')}}"><span>Pending Messages</span></a>
                        <a href = "{{URL::to('/respondedmessages')}}"><span>Responded Messages</span></a>
                    </div>
                @elseif (Auth::user()->role_id == \App\Models\Role::IS_PRINCIPAL) 
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

                @can('viewAny', '\App\Models\School')
                    <a class = "dropdown-btn">
                        <li>
                            <i class="uil uil-university"></i>
                            <span>Schools</span>
                        </li>
                        
                    </a>
                    <div class = "dropdown-container">
                        @can('create', '\App\Models\School')
                            <a href = "{{URL::to('/schools')}}">Add School</a>
                        @endcan
                        @can('viewAny', '\App\Models\School')
                            <a href = "{{URL::to('/viewschools')}}"><span>View Schools</span></a>
                        @endcan
                        @can('restore', '\App\Models\School')
                            <a href = "{{URL::to('/trashedschools')}}"><span>Deleted Schools</span></a>
                        @endcan
                    </div>
                @endcan

                @can('viewAny', '\App\Models\Employee')
                    <a class = "dropdown-btn">
                        <li>
                            <i class="uil uil-users-alt"></i>
                            <span>Employees</span>
                        </li>
                    </a>
                    <div class = "dropdown-container">
                        @can('create', '\App\Models\Employee')
                            <a href = "{{URL::to('/employees')}}">Add Employee</a>
                        @endcan
                        @can('viewAny', '\App\Models\Employee')
                            <a href = "{{URL::to('/viewemployees')}}"><span>View Employees</span></a>
                        @endcan
                        @can('restore', '\App\Models\Employee')
                        <a href = "{{URL::to('/trashedemployees')}}"><span>Deleted Employees</span></a>
                        @endcan
                        <a href = "{{URL::to('/trashedemployeesubjects')}}"><span>Deleted Employee Subjects</span></a>                
                    </div>
                @endcan

                @can('viewAny', '\App\Models\Student')
                    <a class = "dropdown-btn">
                        <li>
                            <i class="uil uil-book-reader"></i>
                            <span>Students</span>
                        </li>
                    </a>
                    <div class = "dropdown-container">
                        @can('create', '\App\Models\Student')
                            <a href = "{{URL::to('/students')}}">Add Student</a>
                        @endcan
                        @can('viewAny', '\App\Models\Student')
                            <a href = "{{URL::to('/viewstudents')}}"><span>View Students</span></a>
                        @endcan
                        @can('restore', '\App\Models\Student')
                            <a href = "{{URL::to('/trashedstudents')}}"><span>Deleted Students</span></a>
                        @endcan
                        @can('restore', '\App\Models\StudentSubject')
                            <a href = "{{URL::to('/trashedstudentsubjects')}}"><span>Deleted Student Subjects</span></a>
                        @endcan
                    </div>
                @endcan

                @can('viewAny', '\App\Models\Role')
                    <a class = "dropdown-btn">
                        <li>
                            <i class="uil uil-user"></i>
                            <span>Roles</span>
                        </li>
                    </a>
                    <div class = "dropdown-container">
                        @can('create', '\App\Models\Role')
                            <a href = "{{URL::to('/roles')}}">Add Role</a>
                        @endcan
                        @can('viewAny', '\App\Models\Role')
                            <a href = "{{URL::to('/viewroles')}}"><span>View Roles</span></a>
                        @endcan
                        @can('restore', '\App\Models\Role')
                            <a href = "{{URL::to('/trashedroles')}}">Deleted Roles</a>
                        @endcan
                    </div>
                @endcan

                @can('hasEmployeeSubjects', '\App\Models\EmployeeSubject')
                    <a href = "{{URL::to('/employeesubjects/'.Auth::user()->id)}}">
                        <li>
                            <i class="uil uil-books"></i>
                            <span>My Teaching Subjects</span>
                        </li>
                    </a>
                @endcan

                @can('viewAny', '\App\Models\Subject')
                    <a class = "dropdown-btn">
                        <li>
                            <i class="uil uil-books"></i>
                            <span>Subjects</span>
                        </li>
                    </a>
                    <div class = "dropdown-container">
                        @can('create', '\App\Models\Subject')
                            <a href = "{{URL::to('/subjects')}}">Add Subject</a>
                        @endcan
                        @can('viewAny', '\App\Models\Subject')
                            <a href = "{{URL::to('/viewsubjects')}}"><span>View Subjects</span></a>
                        @endcan
                        @can('restore', '\App\Models\Subject')
                            <a href = "{{URL::to('/trashedsubjects')}}"><span>Deleted Subjects</span></a>
                        @endcan
                    </div>
                @endcan
            
                @can('viewAny', '\App\Models\SubjectCategories')
                    <a class = "dropdown-btn">
                        <li>
                            <i class="uil uil-book-open"></i>
                            <span>Subject Categories</span>
                        </li>
                    </a>
                    <div class = "dropdown-container">
                        @can('create', '\App\Models\SubjectCategories')
                            <a href = "{{URL::to('/subjectcategories')}}">Add Category</a>
                        @endcan
                        @can('viewAny', '\App\Models\SubjectCategories')
                            <a href = "{{URL::to('/viewsubjectcategories')}}"><span>View Categories</span></a>
                        @endcan
                        @can('restore', '\App\Models\SubjectCategories')
                            <a href = "{{URL::to('/trashedcategories')}}"><span>Deleted Categories</span></a>
                        @endcan
                    </div>
                @endcan

                <!--Classes-->
                @can('viewAny', '\App\Models\Classes')
                    <a class = "dropdown-btn">
                        <li>
                            <i class="uil uil-presentation-edit"></i>
                            <span>Classes</span>
                        </li>
                    </a>
                    <div class = "dropdown-container">
                        @can('create', '\App\Models\Classes')
                            <a href = "{{URL::to('/classes')}}">Add Class</a>
                        @endcan
                        @can('viewAny', '\App\Models\Classes')
                            <a href = "{{URL::to('/viewclasses')}}"><span>View Classes</span></a>
                        @endcan
                        @can('restore', '\App\Models\Classes')
                            <a href = "{{URL::to('/trashedclasses')}}"><span>Deleted Classes</span></a>
                        @endcan
                    </div>
                @endcan

                @can('viewAny', '\App\Models\Classes')
                    <a class = "dropdown-btn">
                        <li>
                            <i class="uil uil-chart"></i>
                            <span>Exam Performance</span>
                        </li>
                    </a>
                    <div class = "dropdown-container">
                        @can('viewAny', '\App\Models\ExamMark')
                            <a href = "{{URL::to('/viewclasses')}}">Class Performance</a>
                        @endcan
                        @can('restore', '\App\Models\ExamMark')
                            <a href = "{{URL::to('/trashedmarks')}}"><span>Deleted Exam Marks</span></a>
                        @endcan
                    </div>
                @endcan
               
                @if (Auth::user()->role_id == \App\Models\Role::IS_SUPERADMIN)
                    <a href = "{{route('allPayments')}}">
                        <li>
                            <i class="uil uil-dollar-sign"></i>
                            <span>Payments</span>
                        </li>
                    </a>
                    <div class = "dropdown-container">
                        <a ><span>View Payments</span></a>
                    </div>
                @elseif(Auth::user()->role_id == \App\Models\Role::IS_PRINCIPAL)
                    <a class = "dropdown-btn">
                        <li>
                            <i class="uil uil-dollar-sign"></i>
                            <span>Payments</span>
                        </li>
                    </a>
                    <div class = "dropdown-container">
                        <a href = "{{URL::to('/payments')}}">Add Payment</a>
                        <a href = "{{ route('myTransactions') }}"><span>View my Payments</span></a>
                    </div>
                @endif

                @if (Auth::user()->role_id == \App\Models\Role::IS_PRINCIPAL)
                    <a href = "{{URL::to('/contact')}}">
                        <li>
                            <i class="uil uil-comment-alt-message"></i>
                            <span>Leave us a Message</span>
                        </li>
                    </a>
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
            @if(Auth::user()->role_id != \App\Models\Role::IS_SUPERADMIN)
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
                    <div class="dropdown">
                        <a id = "user" class="nav-link dropdown-toggle" data-bs-toggle= "dropdown" href = "" id = "dropdownMenuButton">
                            <i class="uil uil-user-circle"></i>
                            {{ Auth::user()->first_name.' '.Auth::user()->last_name }}
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ URL::to('/updateprofile') }}">My Profile</a></li>
                            <li><a class="dropdown-item" href="{{URL::to('/logout')}}">Log out</a></li>
                        </ul>
                    </div>
                @endif
            </div>
        </header>