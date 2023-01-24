@include('common/header')

<main>
    <form method = "post" action = "{{ url('/updatepassword) }}" id = "addSchoolForm" class="row g-3 form">
        @csrf
        
        @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif
        <h3 class = "text-center">Edit School</h3>
        <div class="col-12">
            <label for="schoolname" class="form-label">School ID</label>
            <input type="number" class="form-control" id="schoolid" name = "schoolid" readonly value = "{{$school->id}}">
        </div>
        <div class="col-12">
            @if($errors->has('schoolname'))
                <div class = "alert alert-danger" role = "alert">
                    {{ $errors->first('schoolname') }}
                </div>
            @endif
            <label for="schoolname" class="form-label">School Name</label>
            <input type="text" class="form-control" id="schoolname" name = "schoolname" value = "{{$school->school_name}}">
        </div>
        <div class="col-md-6">
            @if($errors->has('email'))
                <div class = "alert alert-danger" role = "alert">
                    {{ $errors->first('email') }}
                </div>
            @endif
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name = "email" value = "{{$school->email}}">
        </div>
        <div class="col-md-6">
            @if($errors->has('telNo'))
                <div class = "alert alert-danger" role = "alert">
                    {{ $errors->first('telNo') }}
                </div>
            @endif
            <label for="telNo" class=" form-label">Telephone Number</label>
            <input type="text" class="form-control" id="telNo" name = "telNo" value = "{{$school->phone_number}}">
        </div>
        <div class="col-12">
            @if($errors->has('status'))
                <div class = "alert alert-danger" role = "alert">
                    {{ $errors->first('status') }}
                </div>
            @endif
            <label for="status" class=" form-label">Status</label>
            <select id="inputState" class="form-select" name = "status">
                <option value = "Active">Active</option>
                <option value = "Archived">Archived</option>
            </select>
        </div>
        
        <div class="col-12 text-center">
            <button type="submit">Save</button>
        </div>
    </form>
</main>