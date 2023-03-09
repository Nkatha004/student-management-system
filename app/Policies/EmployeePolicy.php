<?php

namespace App\Policies;

use App\Models\Employee;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Models\Role;

class EmployeePolicy
{
    use HandlesAuthorization;

    public function viewAny(Employee $employee)
    {
        //Admin and principal can view employees
        return in_array($employee->role_id, [Role::IS_SUPERADMIN, Role::IS_PRINCIPAL]);
    }

    public function view(Employee $employee, Employee $emp2)
    {
        //Admin and principal can view employees
        return $employee->role_id == Role::IS_SUPERADMIN || ($employee->role_id == Role::IS_PRINCIPAL && $employee->school_id == $emp2->school_id);
    }

    public function create(Employee $employee)
    {
        //Admin and principal can add employees
        return in_array($employee->role_id, [Role::IS_SUPERADMIN, Role::IS_PRINCIPAL]);
    }

    public function update(Employee $employee, Employee $update)
    {
        //Admin and principal can update employees
        return $employee->role_id == Role::IS_SUPERADMIN || ($employee->role_id == Role::IS_PRINCIPAL && $employee->school_id == $update->school_id);
    }

    public function delete(Employee $employee, Employee $delete)
    {
        //Admin and principal can delete employees
        return $employee->role_id == Role::IS_SUPERADMIN || ($employee->role_id == Role::IS_PRINCIPAL && $employee->school_id == $delete->school_id);
    }

    public function restore(Employee $employee)
    {
        //Admin and principal can restore employees
        return in_array($employee->role_id, [Role::IS_SUPERADMIN, Role::IS_PRINCIPAL]);
    }

    public function restoreOne(Employee $employee, Employee $emp2)
    {
        //admin can restore all/any employee
        //principal can restore all employee linked to their school
        return $employee->role_id == Role::IS_SUPERADMIN || ($employee->role_id == Role::IS_PRINCIPAL && $emp2->school_id == $employee->school_id);
    }
}
