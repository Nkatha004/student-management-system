@include('common/header')

<main>
    <form method = "post" action = "{{ url('/sendresetlink') }}" id = "addForm" class="row g-3 form">
        @csrf
        
        @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif
        <h3 class = "text-center">Forgot Password</h3>

        <div class="alert alert-info">
            Input your registered email and we will send you a link to reset your password 
        </div>
        <div class="col-12">
            @if($errors->has('email'))
                <div class = "alert alert-danger" role = "alert">
                    {{ $errors->first('email') }}
                </div>
            @endif

            <label for="email" class="form-label">Email Address</label>
            <input type="email" class="form-control" id="email" name = "email">
        </div>

        <div class="col-12 text-center">
            <button type="submit">Reset Password</button>
        </div>
    </form>
</main>