@include('dashboard.dashboardSideNav')

<main>
   
    <form action = "{{ url('/updateclass/'.$class->id) }}" method = "post" id = "addEmployeeForm" class = "edit"class="row g-3 form">
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
        
        @if (Auth::check())
        <input value = "{{ Auth::user()->school_id }} " name = "school" hidden>
        @endif

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
                <option value = "{{ $teacher->id}} ">{{ $teacher->first_name. ' '. $teacher->last_name}}</option>
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