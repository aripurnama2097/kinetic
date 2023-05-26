<?php


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ForgotController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SchTentativeController;
use App\Http\Controllers\StdpackController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\ScheduleController;



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
    return view(
        'home',
        ["title" => "Home"]
    );
});




// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');// penggunaan middleware untuk akses ke class

Route::get('/home', function() {
    return view('home'); })->name('home');

// LOGIN
Route::get('/login',[LoginController::class, 'index'])->name('login');// penamaan route login
Route::post('/login',[LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']); // method lgogout

// Routing Register User
Route::get('/register', [RegisterController::class, 'index']);
Route::post('/register', [RegisterController::class, 'store']);


Route::get('/dashboardMenu', [DashboardController::class,'index']);
// FORGOT PASSWORD
Route::get('/forgot_password', [ForgotController::class, 'index']);
Route::resource('/dashboard/help', DashboardHelpController::class);



// ========================================STD PACK ROUTE===========================
Route::get('/stdpack',[StdpackController::class, 'index']);
Route::post('/stdpack/create/',[StdpackController::class, 'create']);
Route::post('/stdpack/upload-stdpack',[StdpackController::class, 'uploadstdpack']);

Route::get('stdpack/delete', [StdpackController::class,'multiDelete']);




// ========================================MASTER SCHEDULE ROUTING===========================
Route::get('/schedule_tentative',[SchTentativeController::class, 'index']);
Route::post('/schedule_tentative/upload',[SchTentativeController::class, 'importCSV']);
Route::post('/schedule_tentative/uploadSB98',[SchTentativeController::class, 'importSB98']);
Route::get('/schedule_tentative/sumsb98',[SchTentativeController::class, 'sumsb98']);
Route::post('/schedule_tentative/uploadsa90',[SchTentativeController::class, 'importSA90']);
Route::get('/schedule_tentative/generate',[SchTentativeController::class, 'generate']);
Route::get('/schedule_tentative/SKDall',[SchTentativeController::class, 'SKDall']);
Route::get('/schedule_tentative/SKDmodel',[SchTentativeController::class, 'SKDmodel']);
Route::get('schedule_tentative/serviceNG',[SchTentativeController::class, 'serviceNG']);
Route::get('schedule_tentative/serviceOK',[SchTentativeController::class, 'serviceOK']);

Route::get('schedule', [ScheduleController::class,'index']);




Route::post('/schedule/filter',[SchTentativeController::class, 'filter']);
Route::get('schedule/email',[EmailController::class, 'index']); 



// Route::post('/stdpack/multi-delete', [StdpackController::class, 'multiDelete'])->name('posts.multi-delete');

