@include('dashboard.dashboardSideNav')

<main>
   
    <form action = "{{ url('/subjectcategories') }}" method = "post" id = "addEmployeeForm" class="row g-3 form">
        @csrf
        @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif

        <h3 class = "text-center">Add New Subject Category</h3>
        @if($errors->has('category_name'))
            <div class = "alert alert-danger" role = "alert">
                {{ $errors->first('category_name') }}
            </div>
        @endif
        <div class="col-12">
            <label for="category_name" class="form-label">Subject Category Name</label>
            <input type="text" class="form-control" id="category_name" name = "category_name">
        </div>

        @if($errors->has('description'))
            <div class = "alert alert-danger" role = "alert">
                {{ $errors->first('description') }}
            </div>
        @endif
        <div class="col-12">
            <label for="description" class="form-label">Subject Category Description</label>
            <div class="form-floating">
                <textarea class="form-control" id="description" name = "description" style="height: 100px"></textarea>
            </div>
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
            <button type="submit">Add Subject Category</button>
        </div>
    </form>
</main>