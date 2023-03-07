<?php

namespace App\Policies;

use App\Models\Employee;
use App\Models\Role;
use App\Models\SubjectCategories;
use Illuminate\Auth\Access\HandlesAuthorization;

class SubjectCategoriesPolicy
{
    use HandlesAuthorization;

    public function viewAny(Employee $employee)
    {
        //Only principal and admin can view subject categories
        return in_array($employee->role_id, [Role::IS_SUPERADMIN, Role::IS_PRINCIPAL]);
    }

    public function view(Employee $employee, SubjectCategories $subjectCategories)
    {
        //admin can view all subject categories
        //principal can view all subject categories linked to their school
        return $employee->role_id == Role::IS_SUPERADMIN || ($employee->role_id == Role::IS_PRINCIPAL && $subjectCategories->school_id == $employee->school_id);
    }

    public function create(Employee $employee)
    {
        //Only principal and admin can add subject categories
        return in_array($employee->role_id, [Role::IS_SUPERADMIN, Role::IS_PRINCIPAL]);
    }

    public function update(Employee $employee, subjectCategories $subjectCategories)
    {
        //admin can update all/any subject categories
        //principal can update all subject categories linked to their school
        return $employee->role_id == Role::IS_SUPERADMIN || ($employee->role_id == Role::IS_PRINCIPAL && $subjectCategories->school_id == $employee->school_id);
    }

    public function delete(Employee $employee, subjectCategories $subjectCategories)
    {
        //admin can update all/any subject categories
        //principal can update all subject categories linked to their school
        return $employee->role_id == Role::IS_SUPERADMIN || ($employee->role_id == Role::IS_PRINCIPAL && $subjectCategories->school_id == $employee->school_id);
    }

    public function restore(Employee $employee)
    {
        //Only principal and admin can restore subject categories
        return in_array($employee->role_id, [Role::IS_SUPERADMIN, Role::IS_PRINCIPAL]);
    }
}
