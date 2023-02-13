<?php

namespace App\Http\Controllers;

use App\Http\Controllers\PaymentsController;
use Illuminate\Http\Request;
use App\Models\Classes;
use App\Models\EmployeeSubject;
use App\Models\Student;
use App\Models\Employee;
use App\Models\School;
use App\Models\PaypalPayment;
use App\Models\MpesaPayment;
use Auth;

class DashboardController extends Controller
{
    public function teacherDashboard(){
        $classes = Classes::all()->where('status', 'Active')->where('class_teacher', Auth::user()->id)->first();
        $assignedClasses = EmployeeSubject::all()->where('status', 'Active')->where('employee_id', Auth::user()->id)->count('id');
        $students = Student::select("*")
                    ->whereIn('class_id', Classes::select('id')->where('status', 'Active')->where('class_teacher', Auth::user()->id)->get())
                    ->get()->count('id');

        return view('dashboard/teacherDashboard', ['classes'=>$classes, 'assignedClasses'=>$assignedClasses, 'students'=>$students]);
    }

    public function principalDashboard(){
        $classes = Classes::all()->where('status', 'Active')->where('school_id', Auth::user()->school_id)->count('id');
        $teachers = Employee::all()->where('status', 'Active')->where('school_id', Auth::user()->school_id)->count('id');
        $students = Student::select("*")
                    ->whereIn('class_id', Classes::select('id')
                    ->where('status', 'Active')
                    ->where('school_id', Auth::user()->school_id)->get())
                    ->get()->count('id');

        $mpesapayments = MpesaPayment::all()->where('status', 'Active')->where('paid_by', Auth::user()->school_id)->sum('amount');
        $paypalpayments = PaymentsController::exchangeRates(PaypalPayment::all()->where('status', 'Active')->where('paid_by', Auth::user()->school_id)->sum('amount'), 'USD');

        $payments = $mpesapayments + $paypalpayments;
        return view('dashboard/principalDashboard', ['classes'=>$classes, 'teachers'=>$teachers, 'students'=>$students, 'payments'=>$payments]);
    }

    public function adminDashboard(){
        $mpesaSum = MpesaPayment::all()->sum('amount');
        $paypalSum = PaymentsController::exchangeRates(PaypalPayment::all()->sum('amount'), 'USD');
        $paymentsSum = $paypalSum + $mpesaSum;  
        $schools = School::all()->count('id') - 1;
        $employees = Employee::all()->count('id') - 1;
        $students = Student::all()->count('id');

        //select the pending payments
        $pendingpayments = School::all()->where('payment_status', 'Payment Pending')->where('id', '!=', 1)->take(5);

        //select the recently made payments
        $paypalrecentpayments = PaypalPayment::orderBy('created_at','desc')->take(5)->get();
        $mpesarecentpayments = MpesaPayment::orderBy('created_at','desc')->take(5)->get();

        return view('dashboard/adminDashboard', ['totalpayments'=>$paymentsSum, 'schoolsCount'=>$schools, 'employees'=>$employees, 'students'=>$students, 'pendingpayments'=>$pendingpayments, 'paypalrecentpayments'=>$paypalrecentpayments, 'mpesarecentpayments'=>$mpesarecentpayments]);
    }
}
