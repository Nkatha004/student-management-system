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
       
        <div class="col-12 text-center">
            <button type="submit">Add Subject Category</button>
        </div>
    </form>
</main>