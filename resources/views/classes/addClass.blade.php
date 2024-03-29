@include('dashboard.dashboardSideNav')

<main>
   
    <form action = "{{ url('/classes') }}" method = "post" id = "addEmployeeForm" class="row g-3 form">
        @csrf
        @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif

        <h3 class = "text-center">Add New Class</h3>
        @if($errors->has('classname'))
            <div class = "alert alert-danger" role = "alert">
                {{ $errors->first('classname') }}
            </div>
        @endif
        <div class="col-12">
            <label for="classname" class="form-label">Class Name</label>
            <input type="text" class="form-control" id="classname" name = "classname">
        </div>
        @if($errors->has('year'))
            <div class = "alert alert-danger" role = "alert">
                {{ $errors->first('year') }}
            </div>
        @endif
        <div class="col-12">
            <label for="year" class="form-label">Year</label>
            <select id='date-dropdown' class="form-select" name = "year"></select>
            <script>
                let dateDropdown = document.getElementById('date-dropdown'); 
                    
                let currentYear = new Date().getFullYear();    
                let earliestYear = 2017;     
                while (currentYear >= earliestYear) {      
                    let dateOption = document.createElement('option');          
                    dateOption.text = currentYear;      
                    dateOption.value = currentYear;        
                    dateDropdown.add(dateOption);      
                    currentYear -= 1;    
                }
            </script>
        </div>

        @if($errors->has('teacher'))
            <div class = "alert alert-danger" role = "alert">
                {{ $errors->first('teacher') }}
            </div>
        @endif
        <div class="col-12">
            <label for="inputState" class="form-label">Class Teacher Name</label>
            <select id="inputState" class="form-select" name = "teacher">
                <option selected disabled>Choose the teacher</option>
                @foreach($teachers as $teacher)
                    @if(Auth::user()->role_id == \App\Models\Role::IS_SUPERADMIN)
                        <option value = "{{ $teacher->id}} ">{{ $teacher->first_name. ' '. $teacher->last_name.' - '.\App\Http\Controllers\SchoolsController::getSchoolName($teacher->school_id)}}</option>
                    @else
                        <option value = "{{ $teacher->id}} ">{{ $teacher->first_name. ' '. $teacher->last_name }}</option>
                    @endif
                @endforeach
            </select>
        </div>
        
        <div class="col-12 text-center">
            <button type="submit">Add Class</button>
        </div>
    </form>
</main>