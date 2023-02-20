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

    public function create(Employee $employee)
    {
        //Only principal and admin can add subject categories
        return in_array($employee->role_id, [Role::IS_SUPERADMIN, Role::IS_PRINCIPAL]);
    }

    public function update(Employee $employee, subjectCategories $subjectCategories)
    {
        //Only admin can update subject categories
        return $employee->role_id == Role::IS_SUPERADMIN;
    }

    public function delete(Employee $employee, subjectCategories $subjectCategories)
    {
        //Only admin can delete subject categories
        return $employee->role_id == Role::IS_SUPERADMIN;
    }

    public function restore(Employee $employee)
    {
        //Only admin can restore subject categories
        return $employee->role_id == Role::IS_SUPERADMIN;
    }
}
