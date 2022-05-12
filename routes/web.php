<?php

use App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Vendor;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');


///**********************Admin Controller**************************/

///login page
Route::get('admin/login', [Admin::class, 'Load_Login_Page'])->middleware('admin_logged_in');

///login page
Route::get('admin/dashboard', [Admin::class, 'Load_Dashboard'])->middleware('admin_auth');

///logout
Route::get('admin/logout', [Admin::class, 'admin_logout']);

///post request
Route::post('admin/login-request', [Admin::class, 'Login_Process']);
// Route::post('vendor/signup-request', [Vendor::class, 'Register_Process']);



///**********************Vendor Controller**************************/

///login page
Route::get('vendor/login', [Vendor::class, 'Load_Login_Page'])->middleware('vendor_logged_in');

///login page
Route::get('vendor/dashboard', [Vendor::class, 'Load_Dashboard'])->middleware('vendor_auth');

///logout
Route::get('vendor/logout', [Vendor::class, 'vendor_logout']);

///post request
Route::post('vendor/login-request', [Vendor::class, 'Login_Process']);
Route::post('vendor/signup-request', [Vendor::class, 'Register_Process']);
require __DIR__ . '/auth.php';
