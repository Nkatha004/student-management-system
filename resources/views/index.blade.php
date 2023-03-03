<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>School Management System</title>
    <link href = "{{URL::asset('css/index.css')}}" rel = "stylesheet">  
</head>
<body class = "stop-scrolling">
    <main>
        <div class = "big-wrapper light">
            <img src="{{ URL::asset('images/blue_image.png') }}" alt="" class = "shape">
            <header>
                <div class="container">
                    <div class="logo">
                        <h3>School Management System</h3>
                    </div>
                    <div class="links">
                        <ul>
                            <li><a href="{{ URL::to('/login') }}" class = "btn">Sign up</a></li>
                        </ul>
                    </div>

                    
                </div>
            </header>
            <div class="showcase-area">
                <div class="container">
                    <div class="left">
                        <div class="big-title">
                            <h2>Manage all your school</h2>
                            <h2>records with ease</h2>
                        </div>
                        <p class="text">
                            Manage all your school records, including students, teachers, and employees easily. 
                        </p>
                        <div class="cta">
                            <a href="{{ URL::to('/login')}}" class="btn">Get Started</a>
                        </div>
                    </div>
                    <div class="right">
                        <img src="{{URL::asset('images/student_bg.jpg') }}" alt="Person Image" class="person">
                    </div>
                </div>
            </div>
            <div class="bottom-area">
                <button class="toggle-btn">
                    <i class = "far fa-moon"></i>
                    <i class = "far fa-sun"></i>
                </button>
            </div>
        </div>
    </main>

    <script src="https://kit.fontawesome.com/090dc3fb10.js" crossorigin="anonymous"></script>
    <script src = "{{ URL::asset('js/index.js') }}"></script>
</body>
</html>