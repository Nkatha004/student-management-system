@include('dashboard.dashboardSideNav')
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
                    <label class="form-label">First Name</label>
                    <input type="text" class="form-control" value="{{$employee->first_name}}" aria-label="First name" name = "firstName" readonly>
                </div>
                <div class="col">
                    <label class="form-label">Last Name</label>
                    <input type="text" class="form-control" value="{{$employee->last_name}}" aria-label="Last name" name = "lastName" readonly>
                </div>
            </div><br/>
            <div class="row g-3">
                <div class="col-12">
                    <label class="form-label">Email Address</label>
                    <input type="email" class="form-control" id="inputAddress" value="{{$employee->email}}" name = "email" readonly>
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