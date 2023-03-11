<?php

namespace App\Policies;

use App\Models\Employee;
use App\Models\Role;
use App\Models\Student;
use App\Models\StudentSubject;
use App\Models\EmployeeSubject;
use App\Models\Classes;
use Illuminate\Auth\Access\HandlesAuthorization;
use Auth;

class StudentPolicy
{
    use HandlesAuthorization;

    public function viewAny(Employee $employee)
    {
        return $employee->role_id != Role::IS_TEACHER;
    }

    public function view(Employee $employee, Student $student)
    {
        //admin can view all students
        //principal can view all students linked to their school
        //class teacher can view all students in the class and those they teach
        //teacher can view students they teach
        if(Auth::user()->role_id == Role::IS_SUPERADMIN){
            return true;
        }else if(Auth::user()->role_id == Role::IS_PRINCIPAL){

            $school = Classes::find($student->class_id)->school_id;
            return $school == $employee->school_id;
    
        }else if(Auth::user()->role_id == Role::IS_CLASSTEACHER){

            $teacher = Classes::find($student->class_id)->class_teacher;
            return $employee->id == $teacher;

        }else if(Auth::user()->role_id == Role::IS_CLASSTEACHER || Auth::user()->role_id == Role::IS_TEACHER){
            $teachingSubjects = array();
            $found = false;
            //subjects taught by teacher
            $teacherSubjects = EmployeeSubject::select('subject_id')->where('class_id', $student->class_id)->where('employee_id', $employee->id)->get();
            foreach($teacherSubjects as $teacherSubject){
                $teachingSubjects[] = $teacherSubject->subject_id;
            }
            //subjects done by student
            $studentSubjects = StudentSubject::select('subject_id')->where('student_id', $student->id)->get();

            foreach($studentSubjects as $studentSubject){
                //compare if subjects taught by teacher are done by student
                if(in_array($studentSubject->subject_id, $teachingSubjects)){
                    $found = true;
                    break;
                }
            }
            return $found;
        }
    }

    public function create(Employee $employee)
    {
        //Only teacher cannot add student
        return $employee->role_id != Role::IS_TEACHER;
    }

    public function update(Employee $employee, Student $student)
    {
        //Only teacher cannot update a student
        if(Auth::user()->role_id == Role::IS_SUPERADMIN){
            return true;
        }else if(Auth::user()->role_id == Role::IS_PRINCIPAL){
            $school = Classes::find($student->class_id)->school_id;
            return $employee->school_id == $school;
        }else if(Auth::user()->role_id == Role::IS_CLASSTEACHER){
            $teacher = Classes::find($student->class_id)->class_teacher;
            return $employee->id == $teacher;
        }
        
    }

    public function delete(Employee $employee, Student $student)
    {
        //Only admin and principal can delete student
        $school = Classes::find($student->class_id)->school_id;
        return $employee->id == Role::IS_SUPERADMIN || ($employee->id == Role::IS_PRINCIPAL && $employee->school_id = $school);
    }

    public function restore(Employee $employee)
    {
        //Only admin and principal can restore students
        return in_array($employee->role_id, [Role::IS_SUPERADMIN, Role::IS_PRINCIPAL]);
    }

    public function restoreOne(Employee $employee, Student $student)
    {
        //admin can restore all/any student
        //principal can restore all student linked to their school
        $school = Classes::find($student->class_id)->school_id;
        return $employee->role_id == Role::IS_SUPERADMIN || ($employee->role_id == Role::IS_PRINCIPAL && $school == $employee->school_id);
    }
}
