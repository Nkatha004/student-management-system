<?php

namespace App\Policies;

use App\Models\Employee;
use App\Models\Role;
use App\Models\Subject;
use Illuminate\Auth\Access\HandlesAuthorization;

class SubjectPolicy
{
    use HandlesAuthorization;

    public function viewAny(Employee $employee)
    {
        //Only principal and admin can view subjects
        return in_array($employee->role_id, [Role::IS_SUPERADMIN, Role::IS_PRINCIPAL]);
    }

    public function create(Employee $employee)
    {
        //Only principal and admin can add subject
        return in_array($employee->role_id, [Role::IS_SUPERADMIN, Role::IS_PRINCIPAL]);
    }

    public function update(Employee $employee, Subject $subject)
    {
        //Only admin can update subject
        return $employee->role_id == Role::IS_SUPERADMIN;
    }

    public function delete(Employee $employee, Subject $subject)
    {
        //Only admin can delete subject
        return $employee->role_id == Role::IS_SUPERADMIN;
    }

    public function restore(Employee $employee)
    {
        //Only admin can restore subjects
        return $employee->role_id == Role::IS_SUPERADMIN;
    }
}
