<?php

namespace App\Policies;

use App\Models\ExamMark;
use App\Models\Employee;
use App\Models\Role;
use App\Models\Classes;
use App\Models\Student;
use App\Models\StudentSubject;
use App\Models\EmployeeSubject;
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
        //Principal can view marks in their school
        //Class Teacher can view class performance / all students in the class
        //teacher can view marks of their students only
        if($employee->role_id == Role::IS_SUPERADMIN){
            return true;
        }else if($employee->role_id == Role::IS_PRINCIPAL){
            $schoolID = Classes::select('school_id')->whereIn('id', Student::select('class_id')->whereIn('id', StudentSubject::select('student_id')->where('id', $mark->student_subject_id))) ->get()->first()->school_id;
            return $employee->school_id == $schoolID;
        }else if($employee->role_id == Role::IS_CLASSTEACHER){
            $classID = Classes::select('id')->where('class_teacher', $employee->id)->get()->first()->id;
            $studentClass = Student::select('class_id')->whereIn('id', StudentSubject::select('student_id')->where('id', $mark->student_subject_id))->get()->first()->class_id;
           
            return $classID == $studentClass;
        }else{
            $teacherSubjects = EmployeeSubject::select('subject_id')->where('employee_id', $employee->id)->get();
            $teacherClasses = EmployeeSubject::select('class_id')->where('employee_id', $employee->id)->get();
            
            //subject done by student
            $Studentsubject = StudentSubject::select('subject_id')->where('id', $mark->student_subject_id)->get()->first()->subject_id;
            return in_array($studentSubject, $teacherSubjects); 
        }
    }

    public function create(Employee $employee)
    {
        //All can add marks
        return in_array($employee->role_id, [Role::IS_SUPERADMIN, Role::IS_PRINCIPAL, Role::IS_CLASSTEACHER, Role::IS_TEACHER]);
    }

    public function createMark(Employee $employee, ExamMark $mark)
    {
        //All can add marks
        //Admin can add all marks
        //Principal can add marks in their school
        //Class Teacher/teacher can add marks of their students only
        if($employee->role_id == Role::IS_SUPERADMIN){
            return true;
        }else if($employee->role_id == Role::IS_PRINCIPAL){
            $schoolID = Classes::select('school_id')->whereIn('id', Student::select('class_id')->whereIn('id', StudentSubject::select('student_id')->where('id', $mark->student_subject_id))) ->get()->first()->school_id;
            return $employee->school_id == $schoolID;
        }else if($employee->role_id == Role::IS_CLASSTEACHER){
            $classID = Classes::select('id')->where('class_teacher', $employee->id)->get()->first()->id;
            $studentClass = Student::select('class_id')->whereIn('id', StudentSubject::select('student_id')->where('id', $mark->student_subject_id))->get()->first()->class_id;
           
            return $classID == $studentClass;
        }else{
            $teacherSubjects = EmployeeSubject::select('subject_id')->where('employee_id', $employee->id)->get();
            $teacherClasses = EmployeeSubject::select('class_id')->where('employee_id', $employee->id)->get();
            
            //subject done by student
            $Studentsubject = StudentSubject::select('subject_id')->where('id', $mark->student_subject_id)->get()->first()->subject_id;
            return true;
            // return in_array($Studentsubject, $teacherSubjects); 
        }
        // return in_array($employee->role_id, [Role::IS_SUPERADMIN, Role::IS_PRINCIPAL, Role::IS_CLASSTEACHER, Role::IS_TEACHER]);
    }
    
    public function update(Employee $employee, ExamMark $mark)
    {
        //Only principal and admin can change marksif($employee->role_id == Role::IS_SUPERADMIN){
        if($employee->role_id == Role::IS_SUPERADMIN){
            return true;
        }else if($employee->role_id == Role::IS_PRINCIPAL){
            $schoolID = Classes::select('school_id')->whereIn('id', Student::select('class_id')->whereIn('id', StudentSubject::select('student_id')->where('id', $mark->student_subject_id))) ->get()->first()->school_id;
            return $employee->school_id == $schoolID;
        }
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
