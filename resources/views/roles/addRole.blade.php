@include('common/header')

<main>
    
    <form method = "post" action = "{{ url('/roles') }}" id = "addRoleForm" class="row g-3 form">
        @csrf
        @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif
        <h3 class = "text-center">Add New Role</h3>
        
        <div class="col-12">
            @if($errors->has('rolename'))
                <div class = "alert alert-danger" role = "alert">
                    {{ $errors->first('rolename') }}
                </div>
            @endif
            <label for="rolename" class="form-label">Role Name</label>
            <input type="text" class="form-control" id="rolename" name = "rolename" placeholder="Role Name">
        </div>
        <div class="col-12">
            @if($errors->has('roleDesc'))
                <div class = "alert alert-danger" role = "alert">
                    {{ $errors->first('roleDesc') }}
                </div>
            @endif
            <label for="roleDesclabel" class="form-label">Role Description</label>
        </div>
        <div class="form-floating">
            <textarea class="form-control" id="roleDesc" name = "roleDesc" style="height: 100px"></textarea>
        </div>
        
        <div class="col-12 text-center">
            <button type="submit">Add Role</button>
        </div>
    </form>
</main>