<?php

namespace App\Policies;

use App\Models\Classes;
use App\Models\Employee;
use App\Models\Role;
use Illuminate\Auth\Access\HandlesAuthorization;
use Auth;

class ClassesPolicy
{
    use HandlesAuthorization;

    public function viewAny(Employee $employee)
    {
        //All but teacher can view classes
        return $employee->role_id != Role::IS_TEACHER;
    }

    public function view(Employee $employee, Classes $class)
    {
        //admin can view all classes
        //principal can view all classes linked to their school
        //classteacher can view class if they are the class teacher
        if(Auth::user()->role_id == Role::IS_SUPERADMIN){
            return true;
        }else if(Auth::user()->role_id == Role::IS_PRINCIPAL){
            $school = Classes::find($class->id)->school_id;
            return $employee->school_id == $school;
        }else{
            $classTeacher = Classes::find($class->id)->class_teacher;
            return $employee->id == $classTeacher;
        }
    }

    public function create(Employee $employee)
    {
        //Only principal and admin can add class to their school
        return in_array($employee->role_id, [Role::IS_SUPERADMIN, Role::IS_PRINCIPAL]);
    }

    public function update(Employee $employee, Classes $class)
    {
        //Only principal and admin can update class in their school
        $school = Classes::find($class->id)->school_id;
        return $employee->role_id == Role::IS_SUPERADMIN || ($employee->role_id == Role::IS_PRINCIPAL && $school == $employee->school_id);
    }

    public function delete(Employee $employee, Classes $class)
    {
        //Only principal and admin can delete class
        $school = Classes::find($class->id)->school_id;
        return $employee->role_id == Role::IS_SUPERADMIN || ($employee->role_id == Role::IS_PRINCIPAL && $school == $employee->school_id);
    }

    public function restore(Employee $employee)
    {
        //Only principal and admin can restore a class
        return in_array($employee->role_id, [Role::IS_SUPERADMIN, Role::IS_PRINCIPAL]);
    }
    public function restoreOne(Employee $employee, Classes $class)
    {
        //admin can restore all/any subject
        //principal can restore all subject linked to their school
        $school = Classes::find($class->id)->school_id;
        return $employee->role_id == Role::IS_SUPERADMIN || ($employee->role_id == Role::IS_PRINCIPAL && $school == $employee->school_id);
    }
}
