<?php

namespace App\Policies;

use App\Models\Employee;
use App\Models\Role;
use Illuminate\Auth\Access\HandlesAuthorization;

class RolePolicy
{
    use HandlesAuthorization;

    public function viewAny(Employee $employee)
    {
        //Only admin
        return $employee->role_id == Role::IS_SUPERADMIN;
    }

    public function create(Employee $employee)
    {
        //Only admin
        return $employee->role_id == Role::IS_SUPERADMIN;
    }

    public function update(Employee $employee, Role $role)
    {
        //Only admin
        return $employee->role_id == Role::IS_SUPERADMIN;
    }

    public function delete(Employee $employee, Role $role)
    {
        //Only admin
        return $employee->role_id == Role::IS_SUPERADMIN;
    }

    public function restore(Employee $employee)
    {
        //Only admin
        return $employee->role_id == Role::IS_SUPERADMIN;
    }
}
