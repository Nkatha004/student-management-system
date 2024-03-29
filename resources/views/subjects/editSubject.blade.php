@include('dashboard.dashboardSideNav')

<main>
   
    <form action = "{{ url('/updatesubject/'.$subject->id) }}" method = "post" id = "addEmployeeForm" class="row g-3 form">
        @csrf
        @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif

        <h3 class = "text-center">Edit Subject</h3>
        <div class="col-12">
            <label for="subject" class="form-label">Subject ID</label>
            <input type="number" class="form-control" id="subjectid" name = "subjectid" readonly value = "{{$subject->id}}">
        </div>
        @if($errors->has('name'))
            <div class = "alert alert-danger" role = "alert">
                {{ $errors->first('name') }}
            </div>
        @endif
        <div class="col-12">
            <label for="name" class="form-label">Subject Name</label>
            <input type="text" class="form-control" id="name" name = "name" value = "{{ $subject->subject_name }}">
        </div>
       
        @if($errors->has('category'))
            <div class = "alert alert-danger" role = "alert">
                {{ $errors->first('category') }}
            </div>
        @endif
        <div class="col-12">
            <label for="inputState" class="form-label">Subject Category Name</label>
            <select id="inputState" class="form-select" name = "category">
                <option selected disabled>Choose the category</option>
                @foreach($categories as $category)
                <option value = "{{ $category->id}} ">{{ $category->category_name}}</option>
                @endforeach
            </select>
        </div>

        @if(Auth::user()->role_id != \App\Models\Role::IS_SUPERADMIN)
            <input hidden name = "school" value = "{{ Auth::user()->school_id }}">
        @else
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
        @endif

        <div class="col-12 text-center">
            <button type="submit">Save</button>
        </div>
    </form>
</main>