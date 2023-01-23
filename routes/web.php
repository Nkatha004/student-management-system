<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\EmployeesController;
use App\Http\Controllers\SchoolsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SubjectsController;
use App\Http\Controllers\SubjectCategoriesController;
use App\Http\Controllers\ClassesController;
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
    Route::get('/login', 'login');
    Route::post('/login', 'processLogin');
});

Route::controller(EmployeesController::class)->group(function(){
    Route::get('/employees', 'index');
    Route::post('/employees', 'store');
    Route::get('/editemployee/{id}', 'edit');
    Route::get('/viewemployees', 'viewEmployees');
    Route::post('/updateemployee/{id}', 'update');
    Route::get('/deleteemployee/{id}', 'destroy');
});

Route::controller(RolesController::class)->group(function(){
    Route::get('/roles', 'index');
    Route::post('/roles', 'store');
    Route::get('/editrole/{id}', 'edit');
    Route::get('/viewroles', 'viewRoles');
    Route::post('/updaterole/{id}', 'update');
    Route::get('/deleterole/{id}', 'destroy');
});

Route::controller(SchoolsController::class)->group(function(){
    Route::get('/schools', 'index');
    Route::post('/schools', 'store');
    Route::get('/editschool/{id}', 'edit');
    Route::get('/viewschools', 'viewSchools');
    Route::post('/updateschool/{id}', 'update');
    Route::get('/deleteschool/{id}', 'destroy');
});

Route::controller(SubjectsController::class)->group(function(){
    Route::get('/subjects', 'index');
    Route::post('/subjects', 'store');
    Route::get('/editsubject/{id}', 'edit');
    Route::get('/viewsubjects', 'viewSubjects');
    Route::post('/updatesubject/{id}', 'update');
    Route::get('/deletesubject/{id}', 'destroy');
});

Route::controller(SubjectCategoriesController::class)->group(function(){
    Route::get('/subjectcategories', 'index');
    Route::post('/subjectcategories', 'store');
    Route::get('/editsubjectcategory/{id}', 'edit');
    Route::get('/viewsubjectcategories', 'viewSubjectCategories');
    Route::post('/updatesubjectcategory/{id}', 'update');
    Route::get('/deletesubjectcategory/{id}', 'destroy');
});

Route::controller(ClassesController::class)->group(function(){
    Route::get('/classes', 'index');
    Route::post('/classes', 'store');
    Route::get('/editclass/{id}', 'edit');
    Route::get('/viewclasses', 'viewClasses');
    Route::post('/updateclass/{id}', 'update');
    Route::get('/deleteclass/{id}', 'destroy');
});

Route::group(['middleware' => ['auth']], function() {
    Route::get('/logout', [HomeController::class, 'logout']);
 });