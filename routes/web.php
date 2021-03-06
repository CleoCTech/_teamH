<?php

use App\Http\Livewire\Auth\Login;
use App\Http\Livewire\Auth\Register;
use App\Http\Livewire\Auth\UserLogout;
use App\Http\Livewire\Dashboard;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/show-report', [App\Http\Controllers\ShowReportController::class, 'showReport'])->name('get-report');
Route::get('/generate-report/{id}', [App\Http\Controllers\ShowReportController::class, 'generateRpt'])->name('generate-report');



Route::group(['middleware'=>['AuthCheck']], function(){
    Route::get('/', Login::class)->name('login');
    Route::get('/register', Register::class)->name('register');
    Route::get('/dashboard', Dashboard::class)->name('dashboard');
    Route::get('/logout', UserLogout::class)->name('logout');
    Route::post('upload', [\App\Http\Controllers\UploadController::class, 'store']);
});
