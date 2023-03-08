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

    public function view(Employee $employee, ExamMark $mark)
    {
        //Admin can view all marks
        //Others can view marks in their school
        $marks = ExamMark::all()->whereIn('student_subject_id', StudentSubject::select('id')->whereIn('student_id', Student::select('id')->whereIn('class_id', Classes::select('id')->where('school_id', Auth::user()->id))))->get();

        return in_array($employee->role_id, [Role::IS_SUPERADMIN, (Role::IS_PRINCIPAL && $employee->school_id == $employeeSubjectSchool)]) || (in_array($employee->role_id, [Role::IS_CLASSTEACHER, Role::IS_TEACHER]) && ($employee->id == $employeeSubject->employee_id));
    }

    public function create(Employee $employee)
    {
        //All can add marks
        return in_array($employee->role_id, [Role::IS_SUPERADMIN, Role::IS_PRINCIPAL, Role::IS_CLASSTEACHER, Role::IS_TEACHER]);
    }

    public function update(Employee $employee, ExamMark $mark)
    {
        //Only principal and admin can change marks
        return in_array($employee->role_id, [Role::IS_SUPERADMIN, Role::IS_PRINCIPAL]);
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
