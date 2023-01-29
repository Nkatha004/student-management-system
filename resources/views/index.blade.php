@include('common/header')
<main>
    <div class="container">
        <div class="row">
            <div id = "section1" class="col sms1">
                <h5 id = "sms" class = "green-color">Student Management System</h5>
                <h1>Manage student records with ease</h1>
                <p>
                    The platform is designed in a user-friendly and easy-to-use fashion enabling one to manage all your school and student records with ease. 
                    Starting with the registration process of new students, their classes and their performance. 
                </p>
                <div class = "text-center">
                    <a href = "{{URL::to('/register')}}"><button>Get Started</button></a>
                </div>
                
            </div>
            <div class="col sms1img text-center">
                <img id = "student_bg"src = "{{URL::asset('images/student_bg.jpg')}}">
            </div>
        </div>
    </div>
    <div id = "section2" class="features text-center">
        <h1>Features</h1>
        <div class="row">
            <div class="features-col col">
                <img id = "tick" src = "{{URL::asset('/images/tick.png')}}">
                <h3>Student Management</h3>
                <p>Makes it easier and efficient to manage all your student records. Starting with the registration process of new students, their classes and their performance.</p>
            </div>
            <div class="features-col col">
                <img id = "tick" src = "{{URL::asset('/images/tick.png')}}">
                <h3>Exam Results</h3>
                <p>Analyze the results of students, track their overall performance, class performance as well as subject performance.</p>
            </div>
            <div class="features-col col">
                <img id = "tick" src = "{{URL::asset('/images/tick.png')}}">
                <h3>Easy to use</h3>
                <p>The platform is designed in a user friendly manner to help you navigate easily and manage all your school records in one place. </p>
            </div>
        </div>
    </div>
    <div class="starting text-center">
        <h1>Getting Started</h1>
        <div class="row">
            <div class="getting-started col">
                <h3>Registration</h3>
                <p>The first step to getting started is register your school with us and fill in the principal details. After which, you will proceed to the login page.</p>
            </div>
            <div class="getting-started col">
                <h3>Make Payment</h3>
                <p>After successful registration, you are now one step away from accessing system's features. You will now be directed on how to make your initial payment.</p>
            </div>
            <div class="getting-started col">
                <h3>Access System Features</h3>
                <p>Congratulations! You have now unlocked the system's full functionality and are able to access all our features.</p>
            </div>
            <p>Do not hesitate to <a href = "mailto: admin@admin.com">reach out</a> if you encounter any challenges or need any clarification. Thank you.</p>
            <div class = "text-center">
                <a href = "{{URL::to('/register')}}"><button>Get Started</button></a>
            </div>
        </div>
    </div>
    <div id = "section3" class="contact">
        <div class="row">
            <h1>Contact Us</h1>
            <div class="row g-3">
                <div class="col">
                    <input type="text" class="form-control" placeholder="First name" aria-label="First name">
                </div>
                <div class="col">
                    <input type="text" class="form-control" placeholder="Last name" aria-label="Last name">
                </div>
            </div>
            <div class="row g-3">
                <div class="col-12">
                    <input type="email" class="form-control" id="inputAddress" placeholder="Email Address">
                </div>
            </div>
            <div class="row g-3">
                <div class="mb-3">
                    <label for="message" class="form-label">Message</label>
                    <textarea class="form-control" id="message" rows="3"></textarea>
                </div>
            </div>
            <div class = "text-center">
                <button>Send Message</button>
            </div>

        </div>
    </div>
</main>
@include('common/footer')