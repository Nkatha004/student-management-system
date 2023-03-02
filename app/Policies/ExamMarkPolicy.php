<?php

namespace App\Policies;

use App\Models\ExamMark;
use App\Models\Employee;
use App\Models\Role;
use Illuminate\Auth\Access\HandlesAuthorization;

class ExamMarkPolicy
{
    use HandlesAuthorization;

    public function viewAny(Employee $employee)
    {
        //All can view marks
        return in_array($employee->role_id, [Role::IS_SUPERADMIN, Role::IS_PRINCIPAL, Role::IS_CLASSTEACHER, Role::IS_TEACHER]);
    }

    public function create(Employee $employee)
    {
        //Only admin cannot add marks
        return $employee->role_id != Role::IS_SUPERADMIN;
    }

    public function update(Employee $employee, ExamMark $mark)
    {
        //Only principal can change marks
        return $employee->role_id == Role::IS_PRINCIPAL;
    }

    public function delete(Employee $employee, ExamMark $mark)
    {
        //Only principal and admin can delete marks
        return in_array($employee->role_id, [Role::IS_SUPERADMIN, Role::IS_PRINCIPAL]);
    }

    public function restore(Employee $employee)
    {
        //Only principal and admin can restore marks
        return in_array($employee->role_id, [Role::IS_SUPERADMIN, Role::IS_PRINCIPAL]);
    }
}
