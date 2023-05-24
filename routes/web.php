<?php


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ForgotController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\StdpackController;
use App\Http\Controllers\EmailController;



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
Route::get('/schedule',[ScheduleController::class, 'index']);
Route::post('/schedule/upload',[ScheduleController::class, 'importCSV']);
Route::post('/schedule/uploadSB98',[ScheduleController::class, 'importSB98']);
Route::get('/schedule/sumsb98',[ScheduleController::class, 'sumsb98']);
Route::post('/schedule/uploadsa90',[ScheduleController::class, 'importSA90']);
Route::get('/schedule/generate',[ScheduleController::class, 'generate']);

Route::post('/schedule/filter',[ScheduleController::class, 'filter']);
Route::get('schedule/email',[EmailController::class, 'index']); 



// Route::post('/stdpack/multi-delete', [StdpackController::class, 'multiDelete'])->name('posts.multi-delete');

