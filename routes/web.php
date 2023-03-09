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
use App\Http\Controllers\ContactUsController;

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
    Route::get('/register', 'register');
    Route::post('/login', 'processLogin');
    Route::get('/forgotpassword', 'forgotPassword');
    Route::post('/sendresetlink', 'sendResetLink');
    Route::get('/resetpassword/{token}', 'resetPassword')->name('resetPasswordForm');
    Route::post('/resetpassword', 'saveResetPassword');
    Route::post('/contact', 'contact');
    Route::post('/contact', 'viewcontact');
});

Route::controller(SchoolsController::class)->group(function(){
    Route::post('/schools', 'store');
});

Route::controller(ContactUsController::class)->group(function(){
    Route::get('/contact', 'index');
    Route::post('/contact', 'store');
});

//Require authentication to access routes
Route::group(['middleware' => ['auth']], function() {

    //Using isAdminMiddleware for admin related roles only
    Route::group([
        'middleware' => 'is_admin',
    ], function(){
        Route::get('/admindashboard', [DashboardController::class, 'adminDashboard']);
        Route::get('/addmarks/{id}', [StudentsController::class,'addMarksByAdmin']);
        Route::controller(PaymentsController::class)->group(function(){
            Route::get('/viewpayments', 'viewPayments')->name('allPayments');
            Route::get('/pendingpayments', 'pendingPayments');
        });

        Route::controller(SchoolsController::class)->group(function(){
            Route::get('/schools', 'index');
            Route::get('/editschool/{id}', 'edit');
            Route::get('/viewschools', 'viewSchools');
            Route::post('/updateschool/{id}', 'update');
            Route::get('/deleteschool/{id}', 'destroy');
            Route::get('/trashedschools', 'trashedSchools');
            Route::get('/restoreschool/{id}', 'restoreSchool');
            Route::get('/restoreschools', 'restoreSchools');
        });

        Route::controller(ContactUsController::class)->group(function(){
            Route::get('/viewmessages', 'viewMessages');
            Route::get('/pendingmessages', 'pendingMessages');
            Route::get('/respondedmessages', 'respondedMessages');
            Route::get('/deletemessage/{id}', 'destroy');
            Route::get('/trashedmessages', 'trashedMessages');
            Route::get('/restoremessage/{id}', 'restoreMessage');
            Route::get('/restoremessages', 'restoreMessages');
            Route::get('/respondmessage/{id}', 'respondMessage');
            Route::post('/sendemailresponse', 'sendEmailResponse');
        });

        Route::controller(RolesController::class)->group(function(){
            Route::get('/roles', 'index');
            Route::post('/roles', 'store');
            Route::get('/editrole/{id}', 'edit');
            Route::get('/viewroles', 'viewRoles');
            Route::post('/updaterole/{id}', 'update');
            Route::get('/deleterole/{id}', 'destroy');
            Route::get('/trashedroles', 'trashedRoles');
            Route::get('/restorerole/{id}', 'restoreRole');
            Route::get('/restoreroles', 'restoreRoles');
        });
    });

    //Using IsPrincipalMiddleware for principal related roles only
    Route::group([
        'middleware' => 'is_principal',
    ], function(){
        Route::controller(PaymentsController::class)->group(function(){
            Route::get('/payments', 'payment');
            Route::get('/mpesapayment', 'mpesaPayment');
            Route::post('/payments', 'pay');
            Route::get('/success', 'success');
            Route::get('/error', 'errorOccured');
            Route::get('/paymentsuccess', 'paymentSuccess');
            Route::get('/cancelpayment', 'cancelPayment');
            Route::get('/mytransactions', 'myTransactions')->name('myTransactions');
            Route::get('/mpesaconfirmation', 'mpesaConfirmation');
            Route::post('/checktransaction', 'checkTransaction');
        });
    });

    Route::controller(HomeController::class)->group(function(){
        Route::get('/updateprofile', 'showProfilePage');
        Route::post('/updateprofile', 'updateProfile');
        Route::post('/changepassword', 'changePassword');
        Route::get('/logout', 'logout');
    });

    Route::controller(DashboardController::class)->group(function(){
        Route::get('/teacherdashboard', 'teacherDashboard');
        Route::get('/principaldashboard', 'principalDashboard');    
    });

    Route::controller(EmployeesController::class)->group(function(){
        Route::get('/employees', 'index');
        Route::post('/employees', 'store');
        Route::get('/editemployee/{id}', 'edit');
        Route::get('/viewemployees', 'viewEmployees');
        Route::post('/updateemployee/{id}', 'update');
        Route::get('/deleteemployee/{id}', 'destroy');
        Route::get('/restoreemployee/{id}', 'restoreEmployee');
        Route::get('/restoreemployees', 'restoreEmployees');
        Route::get('/trashedemployees', 'trashedEmployees');
    });

    Route::controller(SubjectCategoriesController::class)->group(function(){
        Route::get('/subjectcategories', 'index');
        Route::post('/subjectcategories', 'store');
        Route::get('/viewsubjectcategories', 'viewSubjectCategories');
        Route::get('/editsubjectcategory/{id}', 'edit');
        Route::post('/updatesubjectcategory/{id}', 'update');
        Route::get('/deletesubjectcategory/{id}', 'destroy');
        Route::get('/trashedcategories', 'trashedCategories');
        Route::get('/restorecategory/{id}', 'restoreCategory');
        Route::get('/restorecategories', 'restoreCategories');
    });

    Route::controller(SubjectsController::class)->group(function(){
        Route::get('/subjects', 'index');
        Route::post('/subjects', 'store');
        Route::get('/viewsubjects', 'viewSubjects');
        Route::get('/editsubject/{id}', 'edit');
        Route::post('/updatesubject/{id}', 'update');
        Route::get('/deletesubject/{id}', 'destroy');
        Route::get('/trashedsubjects', 'trashedSubjects');
        Route::get('/restoresubject/{id}', 'restoreSubject');
        Route::get('/restoresubjects', 'restoreSubjects');
    });

    Route::controller(EmployeeSubjectsController::class)->group(function(){
        Route::get('/employeesubjects/{id}', 'index');
        Route::post('/employeesubjects', 'store');
        Route::get('/editemployeesubject/{id}', 'edit');
        Route::post('/updateemployeesubject/{id}', 'update');
        Route::get('/deleteemployeesubject/{id}', 'destroy');
        Route::get('/restoreemployeesubject/{id}', 'restoreEmployeeSubject');
        Route::get('/restoreemployeesubjects', 'restoreEmployeeSubjects');
        Route::get('/trashedemployeesubjects', 'trashedEmployeeSubjects');
    });
        
    Route::controller(ClassesController::class)->group(function(){
        Route::get('/classes', 'index');
        Route::post('/classes', 'store');
        Route::get('/editclass/{id}', 'edit');
        Route::get('/viewclasses', 'viewClasses');
        Route::post('/updateclass/{id}', 'update');
        Route::get('/deleteclass/{id}', 'destroy');
        Route::get('/trashedclasses', 'trashedClasses');
        Route::get('/restoreclass/{id}', 'restoreClass');
        Route::get('/restoreclasses', 'restoreClasses');
    });
    
    Route::controller(StudentsController::class)->group(function(){
        Route::get('/students', 'index');
        Route::post('/students', 'store');
        Route::get('/editstudent/{id}', 'edit');
        Route::get('/viewstudents', 'viewStudents')->name('viewstudents');
        Route::get('/viewstudents/{id}', 'viewStudentsTaughtByEmployee');
        Route::get('/addstudentmarks', 'viewStudentsToAddMarks');
        Route::post('/updatestudent/{id}', 'update');
        Route::get('/deletestudent/{id}', 'destroy');
        Route::get('/trashedstudents', 'trashedStudents');
        Route::get('/restorestudent/{id}', 'restoreStudent');
        Route::get('/restorestudents', 'restoreStudents');
    });

    Route::controller(StudentSubjectsController::class)->group(function(){
        Route::get('/studentsubjects/{id}', 'index');
        Route::post('/studentsubjects', 'store');
        Route::get('/editstudentsubject/{id}', 'edit');
        Route::post('/updatestudentsubject/{id}', 'update');
        Route::get('/deletestudentsubject/{id}', 'destroy');
        Route::get('/restorestudentsubject/{id}', 'restoreStudentSubject');
        Route::get('/restorestudentsubjects', 'restoreStudentSubjects');
        Route::get('/trashedstudentsubjects', 'trashedStudentSubjects');
    });

    Route::controller(ExamMarksController::class)->group(function(){
        Route::get('/marks/{student}/{subject}', 'index');
        Route::post('/marks', 'store');
        Route::get('/viewclassmarks/{id}', 'viewClassMarks');
        Route::get('/editmark/{id}/{class}', 'edit');
        Route::post('/updatemark/{id}/{class}', 'update');
        Route::get('/deletemark/{id}/{class}', 'destroy');
        Route::get('/restoremark/{id}', 'restoreExamMark');
        Route::get('/restoremarks', 'restoreExamMarks');
        Route::get('/trashedmarks', 'trashedExamMarks');
    });
});
