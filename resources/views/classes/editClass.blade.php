@include('common/header')

<main>
   
    <form action = "{{ url('/updateclass/'.$class->id) }}" method = "post" id = "addEmployeeForm" class="row g-3 form">
        @csrf
        @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif

        <h3 class = "text-center">Edit Class</h3>

        <div class="col-12">
            <label for="classid" class="form-label">Class ID</label>
            <input type="number" class="form-control" id="classid" name = "classid" readonly value = "{{$class->id}}">
        </div>

        @if($errors->has('classname'))
            <div class = "alert alert-danger" role = "alert">
                {{ $errors->first('classname') }}
            </div>
        @endif
        <div class="col-12">
            <label for="classname" class="form-label">Class Name</label>
            <input type="text" class="form-control" id="classname" name = "classname" value = "{{ $class->class_name }}">
        </div>

        @if($errors->has('year'))
            <div class = "alert alert-danger" role = "alert">
                {{ $errors->first('year') }}
            </div>
        @endif
        <div class="col-12">
            <label for="year" class="form-label">Year</label>
            <input type="text" class="form-control" id="year" name = "year" value = "{{ $class->year }}">
        </div>
        
        @if($errors->has('school'))
            <div class = "alert alert-danger" role = "alert">
                {{ $errors->first('school') }}
            </div>
        @endif
        <div class="col-12">
            <label for="inputState" class="form-label">School Name</label>
            <select id="inputState" class="form-select" name = "school">
                <option selected disabled>Choose the school</option>
                @foreach($schools as $school)
                <option value = "{{ $school->id}} ">{{ $school->school_name}}</option>
                @endforeach
            </select>
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