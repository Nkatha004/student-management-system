@include('common/header')

<main>
    <form method = "post" action = "{{ url('/resetpassword') }}" id = "addForm" class="row g-3 form">
        @csrf
        
        @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif
        <h3 class = "text-center">Password Reset</h3>

        <input type="hidden" name="token" value="{{ $token }}">
        <div class="col-12">
            @if($errors->has('email'))
                <div class = "alert alert-danger" role = "alert">
                    {{ $errors->first('email') }}
                </div>
            @endif
            <label for="email" class="form-label">Email Address</label>
            <input type="email" class="form-control" id="email" name = "email" value = "{{ $email ?? old('email')}}">
        </div>
        <div class="col-12">
            @if($errors->has('password'))
                <div class = "alert alert-danger" role = "alert">
                    {{ $errors->first('password') }}
                </div>
            @endif
            <label for="password" class="form-label">New Password</label>
            <input type="password" class="form-control" id="password" name = "password">
        </div>
        <div class="col-12">
            @if($errors->has('confirm_password'))
                <div class = "alert alert-danger" role = "alert">
                    {{ $errors->first('confirm_password') }}
                </div>
            @endif
            <label for="confirm_password" class="form-label">Confirm Password</label>
            <input type="password" class="form-control" id="confirm_password" name = "confirm_password">
        </div>

        <div class="col-12 text-center">
            <button type="submit">Reset Password</button>
        </div>
    </form>
</main>