<?php

namespace App\Policies;

use App\Models\Classes;
use App\Models\Employee;
use App\Models\Role;
use Illuminate\Auth\Access\HandlesAuthorization;

class ClassesPolicy
{
    use HandlesAuthorization;

    public function viewAny(Employee $employee)
    {
        //All but teacher can view classes
        return $employee->role_id != Role::IS_TEACHER;
    }

    public function create(Employee $employee)
    {
        //Only principal can add class to their school
        return $employee->role_id == ROLE::IS_PRINCIPAL;
    }

    public function update(Employee $employee, Classes $classes)
    {
        //Only principal can update class in their school
        return $employee->role_id == ROLE::IS_PRINCIPAL;
    }

    public function delete(Employee $employee, Classes $classes)
    {
        //Only principal and admin can delete class
        return in_array($employee->role_id, [ROLE::IS_SUPERADMIN, ROLE::IS_PRINCIPAL]);
    }

    public function restore(Employee $employee, Classes $classes)
    {
        //Only principal and admin can restore a class
        return in_array($employee->role_id, [ROLE::IS_SUPERADMIN, ROLE::IS_PRINCIPAL]);
    }
}
