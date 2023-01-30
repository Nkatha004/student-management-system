@include('dashboard.dashboardSideNav')
<main>
   
    <form action = "{{ url('/subjects') }}" method = "post" id = "addEmployeeForm" class="row g-3 form">
        @csrf
        @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif

        <h3 class = "text-center">Add New Subject</h3>
        @if($errors->has('name'))
            <div class = "alert alert-danger" role = "alert">
                {{ $errors->first('name') }}
            </div>
        @endif
        <div class="col-12">
            <label for="name" class="form-label">Subject Name</label>
            <input type="text" class="form-control" id="name" name = "name">
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

        <div class="col-12 text-center">
            <button type="submit">Add Subject</button>
        </div>
    </form>
</main>