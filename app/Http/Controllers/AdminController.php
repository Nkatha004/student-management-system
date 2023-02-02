<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\School;
use App\Models\Employee;
use App\Models\Student;

class AdminController extends Controller
{
    public function adminDashboard(){
        $paymentsSum = Payment::all()->sum('amount');
        $schools = School::all()->count('id') - 1;
        $employees = Employee::all()->count('id') - 1;
        $students = Student::all()->count('id');

        //select the pending payments
        $pendingpayments = School::all()->where('payment_status', 'Payment Pending')->where('id', '!=', 1)->take(5);
        //select the recently made payments
        $recentpayments = Payment::orderBy('created_at','desc')->take(5)->get();
        
        return view('dashboard/adminDashboard', ['totalpayments'=>$paymentsSum, 'schoolsCount'=>$schools, 'employees'=>$employees, 'students'=>$students, 'pendingpayments'=>$pendingpayments, 'recentpayments'=>$recentpayments]);
    }
}
