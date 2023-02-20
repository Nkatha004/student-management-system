<?php

namespace App\Policies;

use App\Models\Employee;
use App\Models\Role;
use App\Models\StudentSubject;
use Illuminate\Auth\Access\HandlesAuthorization;

class StudentSubjectPolicy
{
    use HandlesAuthorization;

    public function viewAny(Employee $employee)
    {
        //All can view student subjects
        return in_array($employee->role_id, [Role::IS_SUPERADMIN, Role::IS_PRINCIPAL, Role::IS_CLASSTEACHER, Role::IS_TEACHER]);
    }

    public function create(Employee $employee)
    {
        //All but teacher can create student subject
        return $employee->role_id != Role::IS_TEACHER;
    }

    public function update(Employee $employee, StudentSubject $studentSubject)
    {
        //All but teacher can update student subject
        return $employee->role_id != Role::IS_TEACHER;
    }

    public function delete(Employee $employee, StudentSubject $studentSubject)
    {
        //Principal and admin can delete student subject
        return in_array($employee->role_id, [Role::IS_SUPERADMIN, Role::IS_PRINCIPAL]);
    }

    public function restore(Employee $employee)
    {
        //Principal and admin can restore student subject
        return in_array($employee->role_id, [Role::IS_SUPERADMIN, Role::IS_PRINCIPAL]);
    }
}