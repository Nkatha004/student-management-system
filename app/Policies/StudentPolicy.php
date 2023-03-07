<?php

namespace App\Policies;

use App\Models\Employee;
use App\Models\Role;
use App\Models\Student;
use Illuminate\Auth\Access\HandlesAuthorization;

class StudentPolicy
{
    use HandlesAuthorization;

    public function viewAny(Employee $employee)
    {
        //All can view students
        return in_array($employee->role_id, [Role::IS_SUPERADMIN, Role::IS_PRINCIPAL, Role::IS_CLASSTEACHER, Role::IS_TEACHER]);
    }

    public function create(Employee $employee)
    {
        //Only teacher cannot add student
        return $employee->role_id != Role::IS_TEACHER;
    }

    public function update(Employee $employee, Student $student)
    {
        //Only teacher cannot update a student
        return $employee->role_id != Role::IS_TEACHER;
    }

    public function delete(Employee $employee, Student $student)
    {
        //Only admin and principal can delete student
        return in_array($employee->role_id, [Role::IS_SUPERADMIN, Role::IS_PRINCIPAL]);
    }

    public function restore(Employee $employee)
    {
        //Only admin and principal can restore students
        return in_array($employee->role_id, [Role::IS_SUPERADMIN, Role::IS_PRINCIPAL]);
    }
}
