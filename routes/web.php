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
use App\Http\Controllers\PartlistController;

use App\Http\Controllers\SchServiceNGController;
use App\Http\Controllers\SchSKDNGController;
use App\Http\Controllers\SB98Controller;
use App\Http\Controllers\SA90Controller;

use App\Http\Controllers\RepackingController;


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
Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'store'])->middleware('guest');


Route::get('/dashboardMenu', [DashboardController::class,'index'])->middleware('auth');
// FORGOT PASSWORD
Route::get('/forgot_password', [ForgotController::class, 'index'])->middleware('guest');
Route::resource('/dashboard/help', DashboardHelpController::class);



// ========================================STD PACK ROUTE===========================
Route::get('/stdpack',[StdpackController::class, 'index'])->middleware('auth');
Route::post('/stdpack/create/',[StdpackController::class, 'create'])->middleware('auth');
Route::post('/stdpack/upload-stdpack',[StdpackController::class, 'uploadstdpack'])->middleware('auth');
Route::post('/stdpack/update/{id}',[StdpackController::class, 'update'])->middleware('auth');
Route::get('stdpack/{id}/destroy', [StdpackController::class,'destroy'])->middleware('auth');



// ========================================MASTER SCHEDULE TENTATIVE ROUTING===========================
Route::get('/schedule_tentative',[SchTentativeController::class, 'index'])->middleware('auth');
Route::post('/schedule_tentative/uploadSch',[SchTentativeController::class, 'importCSV'])->middleware('auth');
Route::post('/schedule_tentative/SB98/uploadSB98',[SchTentativeController::class, 'importSB98'])->middleware('auth');
Route::post('/schedule_tentative/uploadsa90',[SchTentativeController::class, 'importSA90'])->middleware('auth');
Route::get('/schedule_tentative/SB98/sumsb98',[SchTentativeController::class, 'sumsb98'])->middleware('auth');


Route::get('/schedule_tentative/SB98',[SB98Controller::class, 'index'])->middleware('auth');

Route::get('/schedule_tentative/SA90',[SA90Controller::class, 'index'])->middleware('auth');
Route::get('schedule_tentative/SA90/delete',[SA90Controller::class, 'delete'])->middleware('auth');



Route::get('/schedule_tentative/servicePart',[SchServiceNGController::class, 'index'])->middleware('auth');
Route::get('schedule_tentative/skdPart',[SchSKDNGController::class, 'index'])->middleware('auth');
Route::get('/schedule_tentative/generate',[SchTentativeController::class, 'generate'])->middleware('auth');

// Route::get('schedule_tentative/serviceNG',[SchServiceNGController::class, 'index'])->middleware('auth');
// Route::get('/schedule_tentative/SKDmodel',[SchSKDNGController::class, 'index'])->middleware('auth');






// ========================================MASTER SCHEDULE  RELEASE ROUTING===========================
Route::get('schedule', [ScheduleController::class,'index'])->middleware('auth');
Route::post('/schedule/filter',[ScheduleController::class, 'filter'])->middleware('auth');
Route::post('schedule/partlist',[ScheduleController::class, 'partlist'])->middleware('auth');
Route::post('schedule/email',[EmailController::class, 'index'])->middleware('auth');



// ========================================MASTER SCHEDULE  RELEASE ROUTING===========================
Route::get('partlist',[PartlistController::class,'index'])->middleware('auth');
Route::post('partlist/filterProdno',[PartlistController::class,'filterProdno'])->middleware('auth');
Route::post('partlist/filter_scan',[PartlistController::class,'filter_scan'])->middleware('auth');
Route::post('partlist/scan_issue',[PartlistController::class,'scan_issue'])->middleware('auth');
Route::post('partlist/looseCarton',[PartlistController::class,'looseCarton'])->middleware('auth');
Route::post('partlist/scan_continue',[PartlistController::class,'scan_continue'])->middleware('auth');



// =======================================REPACKING ROUTING===========================
Route::get('repacking',[RepackingController::class,'index'])->middleware('auth');
Route::get('repacking/kitdata',[RepackingController::class,'kitdata'])->middleware('auth');
// Route::post('repacking/printOriginal/{id}/',[RepackingController::class,'printOriginal'])->middleware('auth');
Route::post('repacking/printlbl_kit',[RepackingController::class,'printlbl_kit'])->middleware('auth');
// Route::post('repacking/printkit',[RepackingController::class,'printkit'])->middleware('auth');

Route::get('repacking/logPrintOrg',[RepackingController::class,'logPrintOrg'])->middleware('auth');
Route::get('repacking/scanIn',[RepackingController::class,'scanIn'])->middleware('auth');
Route::post('repacking/scanIn/inputData',[RepackingController::class,'inputData'])->middleware('auth');

Route::get('repacking/scanCombine/{id}',[RepackingController::class,'scanCombine'])->middleware('auth');

