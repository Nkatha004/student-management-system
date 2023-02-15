@include('dashboard.dashboardSideNav')

<main>
    
    <form method = "post" action = "{{ url('/updatesubjectcategory/'.$category->id) }}" id = "addRoleForm" class="row g-3 form">
        @csrf
        @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif
        <h3 class = "text-center">Edit Subject Category</h3>
        <div class="col-12">
            <label for="category" class="form-label">Subject Category ID</label>
            <input type="number" class="form-control" id="categoryid" name = "categoryid" readonly value = "{{$category->id}}">
        </div>
        <div class="col-12">
            @if($errors->has('category_name'))
                <div class = "alert alert-danger" role = "alert">
                    {{ $errors->first('category_name') }}
                </div>
            @endif
            <label for="category_name" class="form-label">Subject Category Name</label>
            <input type="text" class="form-control" id="category_name" name = "category_name" value = "{{$category->category_name}}">
        </div>
        <div class="col-12">
            @if($errors->has('description'))
                <div class = "alert alert-danger" role = "alert">
                    {{ $errors->first('description') }}
                </div>
            @endif
            <label for="descriptionlabel" class="form-label">SUbject Category Description</label>
        </div>
        <div class="form-floating">
            <textarea class="form-control" id="description" name = "description" style="height: 100px">{{ $category->description}}</textarea>
        </div>
        
        <div class="col-12 text-center">
            <button type="submit">Save</button>
        </div>
    </form>
</main>