<?php

namespace App\Policies;

use App\Models\Employee;
use App\Models\Role;
use App\Models\School;
use Illuminate\Auth\Access\HandlesAuthorization;

class SchoolPolicy
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

    public function update(Employee $employee, School $school)
    {
        //Only admin
        return $employee->role_id == Role::IS_SUPERADMIN;
    }

    public function delete(Employee $employee, School $school)
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
