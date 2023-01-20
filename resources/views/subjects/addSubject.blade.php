@include('common/header')

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
       
        <div class="col-12 text-center">
            <button type="submit">Add Subject</button>
        </div>
    </form>
</main>