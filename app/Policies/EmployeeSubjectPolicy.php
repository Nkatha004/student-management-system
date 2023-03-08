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

    public function view(Employee $employee, EmployeeSubject $employeeSubject)
    {
        //Admin and principal can view all employee subjects
        //Classteacher and teacher can view their employee subjects only
        $employeeSubjectSchool = Employee::all()->where('id', $employeeSubject->employee_id)->first()->school_id;

        return in_array($employee->role_id, [Role::IS_SUPERADMIN, (Role::IS_PRINCIPAL && $employee->school_id == $employeeSubjectSchool)]) || (in_array($employee->role_id, [Role::IS_CLASSTEACHER, Role::IS_TEACHER]) && ($employee->id == $employeeSubject->employee_id));
    }

    public function hasEmployeeSubjects(Employee $employee)
    {
        //All can view employee subjects
        return in_array($employee->role_id, [Role::IS_PRINCIPAL, Role::IS_CLASSTEACHER, Role::IS_TEACHER]);
    }

    public function create(Employee $employee)
    {
        //Only principal and admin can create employee subjects
        return in_array($employee->role_id, [Role::IS_SUPERADMIN, Role::IS_PRINCIPAL]);
    }

    public function update(Employee $employee, EmployeeSubject $employeeSubject)
    {
        //admin can update all/any employee subjects
        //principal can update all employee subjects linked to their school
        return $employee->role_id == Role::IS_SUPERADMIN || ($employee->role_id == Role::IS_PRINCIPAL && $employeeSubject->school_id == $employee->school_id);
    }

    public function delete(Employee $employee, EmployeeSubject $employeeSubject)
    {
        //admin can delete all/any employee subjects
        //principal can delete all employee subjects linked to their school
        return $employee->role_id == Role::IS_SUPERADMIN || ($employee->role_id == Role::IS_PRINCIPAL && $employeeSubject->school_id == $employee->school_id);
    }

    public function restore(Employee $employee)
    {
        //Principal and admin can restore employee subject
        return in_array($employee->role_id, [Role::IS_SUPERADMIN, Role::IS_PRINCIPAL]);
    }
}
