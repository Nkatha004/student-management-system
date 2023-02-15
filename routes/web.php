<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\EmployeesController;
use App\Http\Controllers\SchoolsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SubjectsController;
use App\Http\Controllers\SubjectCategoriesController;
use App\Http\Controllers\ClassesController;
use App\Http\Controllers\StudentsController;
use App\Http\Controllers\PaymentsController;
use App\Http\Controllers\EmployeeSubjectsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StudentSubjectsController;
use App\Http\Controllers\ExamMarksController;
use App\Http\Controllers\FiltersController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::controller(HomeController::class)->group(function(){
    Route::get('/', 'index');
    Route::get('/login', 'login')->name('login');
    Route::post('/login', 'processLogin');
});

Route::controller(SchoolsController::class)->group(function(){
    Route::post('/schools', 'store');
    Route::get('/schools', 'index');
    Route::get('/register', 'index');
});

Route::controller(EmployeesController::class)->group(function(){
    Route::get('/employees', 'index');
    Route::post('/employees', 'store');
});

Route::controller(RolesController::class)->group(function(){
    Route::get('/roles', 'index');
    Route::post('/roles', 'store');
});

Route::controller(SubjectCategoriesController::class)->group(function(){
    Route::get('/subjectcategories', 'index');
    Route::post('/subjectcategories', 'store');
});

Route::controller(SubjectsController::class)->group(function(){
    Route::get('/subjects', 'index');
    Route::post('/subjects', 'store');
});

Route::controller(ClassesController::class)->group(function(){
    Route::get('/classes', 'index');
    Route::post('/classes', 'store');
});

Route::controller(StudentsController::class)->group(function(){
    Route::get('/students', 'index');
    Route::post('/students', 'store');
});

//Require authentication to access routes
Route::group(['middleware' => ['auth']], function() {

    Route::controller(HomeController::class)->group(function(){
        Route::get('/logout', 'logout');
    });

    Route::controller(DashboardController::class)->group(function(){
        Route::get('/teacherdashboard', 'teacherDashboard');
        Route::get('/principaldashboard', 'principalDashboard');
        Route::get('/admindashboard', 'adminDashboard');
    });

    Route::controller(SchoolsController::class)->group(function(){
        Route::get('/editschool/{id}', 'edit');
        Route::get('/viewschools', 'viewSchools');
        Route::post('/updateschool/{id}', 'update');
        Route::get('/deleteschool/{id}', 'destroy');
    });

    Route::controller(EmployeesController::class)->group(function(){
        Route::get('/editemployee/{id}', 'edit');
        Route::get('/viewemployees', 'viewEmployees');
        Route::post('/updateemployee/{id}', 'update');
        Route::get('/deleteemployee/{id}', 'destroy');
    });

    Route::controller(EmployeeSubjectsController::class)->group(function(){
        Route::get('/employeesubjects/{id}', 'index');
        Route::post('/employeesubjects', 'store');
        Route::get('/editemployeesubject/{id}', 'edit');
        Route::post('/updateemployeesubject/{id}', 'update');
        Route::get('/deleteemployeesubject/{id}', 'destroy');
    });

    Route::controller(PaymentsController::class)->group(function(){
        Route::get('/payments', 'payment');
        Route::get('/mpesapayment', 'mpesaPayment');
        Route::post('/payments', 'pay');
        Route::get('/success', 'success');
        Route::get('/error', 'errorOccured');
        Route::get('/paymentsuccess', 'paymentSuccess');
        Route::get('/cancelpayment', 'cancelPayment');
        Route::get('/mytransactions', 'myTransactions');
        Route::get('/viewpayments', 'viewPayments');
        Route::get('/mpesaconfirmation', 'mpesaConfirmation');
        Route::post('/checktransaction', 'checkTransaction');
    });

    Route::controller(RolesController::class)->group(function(){
        Route::get('/editrole/{id}', 'edit');
        Route::get('/viewroles', 'viewRoles');
        Route::post('/updaterole/{id}', 'update');
        Route::get('/deleterole/{id}', 'destroy');
        Route::get('/trashedroles', 'trashedRoles');
        Route::get('/restorerole/{id}', 'restoreRole');
        Route::get('/restoreroles', 'restoreRoles');
    });

    Route::controller(SubjectCategoriesController::class)->group(function(){
        Route::get('/editsubjectcategory/{id}', 'edit');
        Route::get('/viewsubjectcategories', 'viewSubjectCategories');
        Route::post('/updatesubjectcategory/{id}', 'update');
        Route::get('/deletesubjectcategory/{id}', 'destroy');
    });

    Route::controller(SubjectsController::class)->group(function(){
        Route::get('/editsubject/{id}', 'edit');
        Route::get('/viewsubjects', 'viewSubjects');
        Route::post('/updatesubject/{id}', 'update');
        Route::get('/deletesubject/{id}', 'destroy');
    });
    
    Route::controller(ClassesController::class)->group(function(){
        Route::get('/editclass/{id}', 'edit');
        Route::get('/viewclasses', 'viewClasses');
        Route::post('/updateclass/{id}', 'update');
        Route::get('/deleteclass/{id}', 'destroy');
        Route::get('/trashedclasses', 'trashedClasses');
        Route::get('/restoreclass/{id}', 'restoreClass');
        Route::get('/restoreclasses', 'restoreClasses');
    });
    
    Route::controller(StudentsController::class)->group(function(){
        Route::get('/editstudent/{id}', 'edit');
        Route::get('/viewstudents', 'viewStudents')->name('viewstudents');
        Route::get('/viewstudents/{id}', 'viewStudentsTaughtByEmployee');
        Route::get('/addstudentmarks', 'viewStudentsToAddMarks');
        Route::post('/updatestudent/{id}', 'update');
        Route::get('/deletestudent/{id}', 'destroy');
    });

    Route::controller(StudentSubjectsController::class)->group(function(){
        Route::get('/studentsubjects/{id}', 'index');
        Route::post('/studentsubjects', 'store');
        Route::get('/editstudentsubject/{id}', 'edit');
        Route::post('/updatestudentsubject/{id}', 'update');
        Route::get('/deletestudentsubject/{id}', 'destroy');
    });

    Route::controller(ExamMarksController::class)->group(function(){
        Route::get('/marks/{student}/{subject}', 'index');
        Route::post('/marks', 'store');
        Route::get('/viewmarks/{id}', 'viewMarks');
        Route::get('/viewclassmarks', 'viewClassMarks');
        Route::get('/editmark/{id}', 'edit');
        Route::post('/updatemark/{id}', 'update');
        Route::post('/deletestudentmark/{id}', 'destroy');
    });
});
