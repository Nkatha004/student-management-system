@include('common.header')
<main>
    <div class="container">
        <div class="row">
            <div id = "section1" class="col sms1">
                <h5 id = "sms" class = "green-color">Student Management System</h5>
                <h1>Manage student records with ease</h1>
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
                    Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. 
                    Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. 
                    Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                </p>
                <div class = "text-center">
                    <button>Get Started</button>
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
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
            </div>
            <div class="features-col col">
                <img id = "tick" src = "{{URL::asset('/images/tick.png')}}">
                <h3>Exam results</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
            </div>
            <div class="features-col col">
                <img id = "tick" src = "{{URL::asset('/images/tick.png')}}">
                <h3>Easy to use</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
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
@include('common.footer')