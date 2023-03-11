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
            
            $teachingSubjects = array();

            foreach($teacherSubjects as $teacherSubject){
                $teachingSubjects[] = $teacherSubject->subject_id;
            }
            
            //subject done by student
            $studentsubject = StudentSubject::select('subject_id')->where('id', $mark->student_subject_id)->get()->first()->subject_id;
            
            //compare if subjects taught by teacher are done by student
            if(in_array($studentsubject, $teachingSubjects)){
                return true;
            }else{
                return false;
            }
        }
    }

    public function create(Employee $employee)
    {
        //All can add marks
        return in_array($employee->role_id, [Role::IS_SUPERADMIN, Role::IS_PRINCIPAL, Role::IS_CLASSTEACHER, Role::IS_TEACHER]);
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
        $school = Classes::select('school_id')->whereIn('id', Student::select('class_id')->whereIn('id', StudentSubject::select('student_id')->where('id', $mark->student_subject_id)))->get()->first()->school_id;
        return $employee->role_id == Role::IS_SUPERADMIN || ($employee->role_id == Role::IS_PRINCIPAL && $employee->school_id == $school);
    }

    public function restore(Employee $employee)
    {
        //Only principal and admin can restore marks
        return in_array($employee->role_id, [Role::IS_SUPERADMIN, Role::IS_PRINCIPAL]);
    }

    public function restoreOne(Employee $employee, ExamMark $mark)
    {
        //admin can restore all/any subject
        //principal can restore all subject linked to their school
        $school = Classes::select('school_id')->whereIn('id', Student::select('class_id')->whereIn('id', StudentSubject::select('student_id')->where('id', $mark->student_subject_id)))->get()->first()->school_id;
        return $employee->role_id == Role::IS_SUPERADMIN || ($employee->role_id == Role::IS_PRINCIPAL && $employee->school_id == $school);
    }
}
