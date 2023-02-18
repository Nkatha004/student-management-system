<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/090dc3fb10.js" crossorigin="anonymous"></script>
    <title>School Management System</title>
    <link href = "{{URL::asset('css/styles.css')}}" rel = "stylesheet">
    <link href = "{{URL::asset('css/bityarn.css')}}" rel = "stylesheet">
</head>
<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <header>
        <nav class="navbar fixed-top navbar-expand-lg py-4">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{URL::to('/')}}">Student Management System</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="navbarNavAltMarkup">
                    <div class="navbar-nav">
                        <a id = "active"class="nav-link active" aria-current="page" href="{{URL::to('/#section1')}}">Home</a>
                        <a class="nav-link" href="{{URL::to('/#section2')}}">Features</a>
                        <a class="nav-link" href="{{URL::to('/#section3')}}">Contact us</a>
                        <a class="nav-link" href="{{URL::to('/login')}}">Registration | Login</a>
                        @if (Auth::check())
                            <div class="dropdown">
                                <a id = "user" class="nav-link dropdown-toggle" data-bs-toggle= "dropdown" href = "" id = "dropdownMenuButton">
                                    <i class="uil uil-user-circle"></i>
                                    {{ Auth::user()->first_name.' '.Auth::user()->last_name }}
                                </a>
                                <ul class="dropdown-menu">
                                    <!-- <li><a class="dropdown-item" href="#">My Profile</a></li> -->
                                    <li><a class="dropdown-item" href="{{URL::to('/logout')}}">Log out</a></li>
                                </ul>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </nav>
    </header>