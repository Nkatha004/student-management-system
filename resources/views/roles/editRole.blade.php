@include('common/header')

<main>
    
    <form method = "post" action = "{{ url('/updaterole/'.$role->id) }}" id = "addRoleForm" class="row g-3 form">
        @csrf
        @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif
        <h3 class = "text-center">Edit Role</h3>
        <div class="col-12">
            <label for="roleid" class="form-label">Role ID</label>
            <input type="number" class="form-control" id="roleid" name = "roleid" readonly value = "{{$role->id}}">
        </div>
        <div class="col-12">
            @if($errors->has('rolename'))
                <div class = "alert alert-danger" role = "alert">
                    {{ $errors->first('rolename') }}
                </div>
            @endif
            <label for="rolename" class="form-label">Role Name</label>
            <input type="text" class="form-control" id="rolename" name = "rolename" value = "{{$role->role_name}}">
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
            <textarea class="form-control" id="roleDesc" name = "roleDesc" style="height: 100px">{{ $role->role_description}}</textarea>
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