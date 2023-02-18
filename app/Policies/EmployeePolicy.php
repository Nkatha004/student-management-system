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

    public function create(Employee $employee)
    {
        //Admin and principal can add employees
        return in_array($employee->role_id, [Role::IS_SUPERADMIN, Role::IS_PRINCIPAL]);
    }

    public function update(Employee $employee, Employee $update)
    {
        //Admin and principal can update employees
        return in_array($employee->role_id, [Role::IS_SUPERADMIN, Role::IS_PRINCIPAL]);
    }

    public function delete(Employee $employee, Employee $delete)
    {
        //Admin and principal can delete employees
        return in_array($employee->role_id, [Role::IS_SUPERADMIN, Role::IS_PRINCIPAL]) && $employee->id != $delete->id;
    }

    public function restore(Employee $employee)
    {
        //Admin and principal can restore employees
        return in_array($employee->role_id, [Role::IS_SUPERADMIN, Role::IS_PRINCIPAL]);
    }
}
