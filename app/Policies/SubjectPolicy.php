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

    public function view(Employee $employee, Subject $subject)
    {
        //admin can view all subjects
        //principal can view all subjects linked to their school
        return $employee->role_id == Role::IS_SUPERADMIN || ($employee->role_id == Role::IS_PRINCIPAL && $subject->school_id == $employee->school_id);
    }

    public function create(Employee $employee)
    {
        //Only principal and admin can add subject
        return in_array($employee->role_id, [Role::IS_SUPERADMIN, Role::IS_PRINCIPAL]);
    }

    public function update(Employee $employee, Subject $subject)
    {
        //admin can update all/any subjects
        //principal can update all subjects linked to their school
        return $employee->role_id == Role::IS_SUPERADMIN || ($employee->role_id == Role::IS_PRINCIPAL && $subject->school_id == $employee->school_id);
    }

    public function delete(Employee $employee, Subject $subject)
    {
        //admin can update all/any subjects
        //principal can update all subjects linked to their school
        return $employee->role_id == Role::IS_SUPERADMIN || ($employee->role_id == Role::IS_PRINCIPAL && $subject->school_id == $employee->school_id);
    }

    public function restore(Employee $employee)
    {
        //admin can restore all/any subjects
        //principal can restore all subjects linked to their school 
        return in_array($employee->role_id, [Role::IS_SUPERADMIN, Role::IS_PRINCIPAL]);
    }
}
