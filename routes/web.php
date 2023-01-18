<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\EmployeesController;
use App\Http\Controllers\SchoolsController;
use App\Http\Controllers\HomeController;

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
    Route::get('/bityarn/roles', 'index');
    Route::post('/bityarn/roles', 'store');
    Route::get('/bityarn/editrole/{id}', 'edit');
    Route::get('/bityarn/viewroles', 'viewRoles');
    Route::post('/bityarn/updaterole/{id}', 'update');
    Route::get('/bityarn/deleterole/{id}', 'destroy');
});

Route::controller(SchoolsController::class)->group(function(){
    Route::get('/bityarn/schools', 'index');
    Route::post('/bityarn/schools', 'store');
    Route::get('/bityarn/editschool/{id}', 'edit');
    Route::get('/bityarn/viewschools', 'viewSchools');
    Route::post('/bityarn/updateschool/{id}', 'update');
    Route::get('/bityarn/deleteschool/{id}', 'destroy');
});