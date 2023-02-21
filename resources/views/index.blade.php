@include('common/header')
<main>
    <div class="container">
        <div class="row">
            <div id = "section1" class="col sms1">
                <h5 id = "sms" class = "green-color">School Management System</h5>
                <h1>Manage your school records with ease</h1>
                <large>
                    <p>
                        The platform is designed in a user-friendly and easy-to-use fashion enabling you to manage all your school records with ease. Starting with the registration process of new students, their classes and their exam performance. Manage your employee records including the subjects they teach. 
                    </p>
                </large>
                <div class = "text-center">
                    @if(Auth::check())
                    <a href = "{{URL::to('/logout')}}"><button>Logout</button></a>
                    @else
                    <a href = "{{URL::to('/register')}}"><button>Get Started</button></a>
                    @endif
                </div>
                
            </div>
            <div class="col sms1img text-center">
                <img id = "student_bg"src = "{{URL::asset('images/student_bg.jpg')}}">
            </div>
        </div>
    </div>
    <div id = "section2" class="features text-center">
        <h2>Features</h2>
        <div class="row">
            <div class="features-col col">
                <img id = "tick" src = "{{URL::asset('/images/tick.png')}}">
                <h4>Student Management</h4>
                <p>Makes it easier and efficient to manage all your student records. Starting with the registration process of new students, their classes and their performance.</p>
            </div>
           
            <div class="features-col col">
                <img id = "tick" src = "{{URL::asset('/images/tick.png')}}">
                <h4>Employee Management</h4>
                <p>Makes it easier and efficient to manage all your student records. Starting with the registration process of new students, their classes and their performance.</p>
            </div>

            <div class="features-col col">
                <img id = "tick" src = "{{URL::asset('/images/tick.png')}}">
                <h4>Exam Results</h4>
                <p>Analyze the results of students and track their overall performance, class performance as well as subject performance at your convenience and with ease.</p>
            </div>
        </div>
    </div>
    <div class="starting text-center">
        <h2>Getting Started</h2>
        <div class="row">
            <div class="getting-started col">
                <h4>Registration</h4>
                <p>The first step to getting started is register your school with us and fill in the principal details. After which, you will proceed to the login page.</p>
            </div>
            <div class="getting-started col">
                <h4>Make Payment</h4>
                <p>After successful registration, you are now one step away from accessing system's features. You will now be directed on how to make your initial payment.</p>
            </div>
            <div class="getting-started col">
                <h4>Access System Features</h4>
                <p>Congratulations! You have now unlocked the system's full functionality and are able to access all our features.</p>
            </div>
            <!-- <p>Do not hesitate to <a href = "mailto: admin@admin.com">reach out</a> if you encounter any challenges or need any clarification. Thank you.</p>
            <div class = "text-center">
                @if(Auth::check())
                <a href = "{{URL::to('/logout')}}"><button>Logout</button></a>
                @else
                <a href = "{{URL::to('/register')}}"><button>Get Started</button></a>
                @endif
            </div> -->
        </div>
    </div>
    <div id = "section3" class="contact">
        <div class="row">
            <form method = "POST" action = "{{ url('/contact') }}">
                @csrf
                @if(session()->has('message'))
                    <div class="alert alert-success text-center">
                        {{ session()->get('message') }}
                    </div>
                @endif
                <h2 class = "text-center">Contact Us</h2><br/>
                <div class="row g-3">
                    <div class="col">
                        <input type="text" class="form-control" placeholder="First name" aria-label="First name" name = "firstName">
                    </div>
                    <div class="col">
                        <input type="text" class="form-control" placeholder="Last name" aria-label="Last name" name = "lastName">
                    </div>
                </div><br/>
                <div class="row g-3">
                    <div class="col-12">
                        <input type="email" class="form-control" id="inputAddress" placeholder="Email Address" name = "email">
                    </div>
                </div><br/>
                <div class="row g-3">
                    <div class="mb-3">
                        <label for="message" class="form-label">Message</label>
                        <textarea class="form-control" id="message" rows="3" name = "message"></textarea>
                    </div>
                </div>
                <div class = "text-center">
                    <button>Send Message</button>
                </div>
            </form>

        </div>
    </div>
</main>
@include('common/footer')