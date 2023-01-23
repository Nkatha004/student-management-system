@include('common/header')

<main>
    
    <form method = "post" action = "{{ url('/schools') }}" id = "addSchoolForm" class="row g-3 form">
        @csrf
        @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif
        <h3 class = "text-center">Register New School</h3>
        <div class="col-12">
            @if($errors->has('schoolname'))
                <div class = "alert alert-danger" role = "alert">
                    {{ $errors->first('schoolname') }}
                </div>
            @endif
            <label for="schoolname" class="form-label">School Name</label>
            <input type="text" class="form-control" id="schoolname" name = "schoolname" placeholder="School Name">
        </div>
        <div class="col-md-6">
            @if($errors->has('email'))
                <div class = "alert alert-danger" role = "alert">
                    {{ $errors->first('email') }}
                </div>
            @endif
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name = "email" placeholder="Email Address">
        </div>
        <div class="col-md-6">
            @if($errors->has('telNo'))
                <div class = "alert alert-danger" role = "alert">
                    {{ $errors->first('telNo') }}
                </div>
            @endif
            <label for="telNo" class=" form-label">Telephone Number</label>
            <input type="text" class="form-control" id="telNo" name = "telNo" placeholder="Phone Number">
        </div>
        
        <div class="col-12 text-center">
            <button type="submit">Add School</button>
        </div>
    </form>
</main>