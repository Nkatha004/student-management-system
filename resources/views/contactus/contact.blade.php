@include('common/header')   
<div id = "section3" class="contact">
    <div class="row">
        <form method = "POST" id = "addForm" action = "{{ url('/contact') }}">
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