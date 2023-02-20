<?php

namespace App\Policies;

use App\Models\Employee;
use App\Models\Role;
use App\Models\EmployeeSubject;
use Illuminate\Auth\Access\HandlesAuthorization;

class EmployeeSubjectPolicy
{
    use HandlesAuthorization;

    public function viewAny(Employee $employee)
    {
        //All can view employee subjects
        return in_array($employee->role_id, [Role::IS_SUPERADMIN, Role::IS_PRINCIPAL, Role::IS_CLASSTEACHER, Role::IS_TEACHER]);
    }

    public function hasEmployeeSubjects(Employee $employee)
    {
        //All can view employee subjects
        return in_array($employee->role_id, [Role::IS_PRINCIPAL, Role::IS_CLASSTEACHER, Role::IS_TEACHER]);
    }

    public function create(Employee $employee)
    {
        //Only principal can create employee subject
        return $employee->role_id == Role::IS_PRINCIPAL;
    }

    public function update(Employee $employee, EmployeeSubject $employeeSubject)
    {
        //Only principal can update employee subject
        return $employee->role_id == Role::IS_PRINCIPAL;
    }

    public function delete(Employee $employee, EmployeeSubject $employeeSubject)
    {
        //Principal and admin can delete employee subject
        return in_array($employee->role_id, [Role::IS_SUPERADMIN, Role::IS_PRINCIPAL]);
    }

    public function restore(Employee $employee)
    {
        //Principal and admin can restore employee subject
        return in_array($employee->role_id, [Role::IS_SUPERADMIN, Role::IS_PRINCIPAL]);
    }
}
