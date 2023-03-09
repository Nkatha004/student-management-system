<?php

namespace App\Policies;

use App\Models\Employee;
use App\Models\Role;
use App\Models\StudentSubject;
use App\Models\EmployeeSubject;
use App\Models\Student;
use App\Models\Classes;
use Illuminate\Auth\Access\HandlesAuthorization;

class StudentSubjectPolicy
{
    use HandlesAuthorization;

    public function viewAny(Employee $employee)
    {
        //All but teacher can view student subjects
        return $employee->role_id != Role::IS_TEACHER;
    }

    public function view(Employee $employee, StudentSubject $studentSubject)
    {
        //Admin and principal can view all student subjects
        //Classteacher and teacher can view student subject of their students only
        if($employee->role_id == Role::IS_SUPERADMIN){
            return true;
        }else if($employee->role_id == Role::IS_PRINCIPAL){
            $classID = Student::select('class_id')->where('id', $studentSubject->student_id)->get()->first()->class_id;
            $studentSubjectSchool = Classes::select('school_id')->where('id', $classID)->get()->first()->school_id;

            return $employee->school_id == $studentSubjectSchool;
        }else if($employee->role_id == Role::IS_CLASSTEACHER){
            $teacherClass = Classes::select('id')->where('class_teacher', $employee->id)->get()->first()->id;
            $studentClass = Student::find($studentSubject->student_id)->class_id;

            return $teacherClass == $studentClass;
        }
    }

    public function create(Employee $employee)
    {
        //All but teacher can create student subject
        return $employee->role_id != Role::IS_TEACHER;
    }

    public function update(Employee $employee, StudentSubject $studentSubject)
    {
        //All but teacher can update student subject
        if($employee->role_id == Role::IS_SUPERADMIN){
            return true;
        }else if($employee->role_id == Role::IS_PRINCIPAL){
            $classID = Student::select('class_id')->where('id', $studentSubject->student_id)->get()->first()->class_id;
            $studentSubjectSchool = Classes::select('school_id')->where('id', $classID)->get()->first()->school_id;

            return $employee->school_id == $studentSubjectSchool;
        }else if($employee->role_id == Role::IS_CLASSTEACHER){
            $employeeClass = Classes::select('id')->where('class_teacher', $employee->id)->get()->first()->id;
            
            return $employeeClass == Student::find($studentSubject->student_id)->class_id;
        }
    }

    public function delete(Employee $employee, StudentSubject $studentSubject)
    {
        //Principal and admin can delete student subject
        if($employee->role_id == Role::IS_SUPERADMIN){
            return true;
        }else if($employee->role_id == Role::IS_PRINCIPAL){
            $classID = Student::select('class_id')->where('id', $studentSubject->student_id)->get()->first()->class_id;
            $studentSubjectSchool = Classes::select('school_id')->where('id', $classID)->get()->first()->school_id;

            return $employee->school_id == $studentSubjectSchool;
        }
    }

    public function restore(Employee $employee)
    {
        //Principal and admin can restore student subject
        return in_array($employee->role_id, [Role::IS_SUPERADMIN, Role::IS_PRINCIPAL]);
    }

    public function restoreOne(Employee $employee, StudentSubject $studentSubject)
    {
        //admin can restore all/any student subject
        //principal can restore all student subjects linked to their school
        $classID = Student::select('class_id')->where('id', $studentSubject->student_id)->get()->first()->class_id;
        $studentSubjectSchool = Classes::select('school_id')->where('id', $classID)->get()->first()->school_id;

        return $employee->role_id == Role::IS_SUPERADMIN || ($employee->role_id == Role::IS_PRINCIPAL && $studentSubjectSchool == $employee->school_id);
    }
}
