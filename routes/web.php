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
use App\Http\Controllers\FinishGoodController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\PartlistController;
use App\Http\Controllers\ProblemFoundController;
use App\Http\Controllers\SchServiceNGController;
use App\Http\Controllers\SchSKDNGController;
use App\Http\Controllers\SB98Controller;
use App\Http\Controllers\SA90Controller;
use App\Http\Controllers\RepackingController;
use App\Http\Controllers\BorrowController;
use App\Http\Controllers\KitmonitorController;

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
Route::get('/stdpack',[StdpackController::class, 'index'])->middleware('checkRole:admin');
Route::post('/stdpack/create/',[StdpackController::class, 'create'])->middleware('checkRole:admin');
Route::post('/stdpack/upload-stdpack',[StdpackController::class, 'uploadstdpack'])->middleware('checkRole:admin');
Route::post('/stdpack/update/{id}',[StdpackController::class, 'update'])->middleware('checkRole:admin');
Route::get('stdpack/{id}/destroy', [StdpackController::class,'destroy'])->middleware('checkRole:admin');
Route::get('/stdpack/delete_all',[StdpackController::class, 'delete_all'])->middleware('checkRole:admin');


// ========================================SCHEDULE TENTATIVE ROUTING===========================
Route::get('/schedule_tentative',[SchTentativeController::class, 'index'])->middleware('checkRole:admin');
Route::get('/schedule_tentative/master_scheduleTemp',[SchTentativeController::class, 'view_tempschedule'])->middleware('checkRole:admin');
Route::post('/schedule_tentative/master_scheduleTemp/importsch',[SchTentativeController::class, 'importsch_temp'])->middleware('checkRole:admin');
Route::get('schedule_tentative/schTemp/delete',[SchTentativeController::class, 'reset_mastersch'])->middleware('checkRole:admin');
Route::get('schedule_tentative/headersch',[SchTentativeController::class, 'headersch'])->middleware('checkRole:admin');


// ========================================SB98 ROUTING===========================
Route::get('/schedule_tentative/SB98',[SchTentativeController::class, 'view_sB98'])->middleware('checkRole:admin');
Route::post('/schedule_tentative/SB98/upload',[SchTentativeController::class, 'importSB98'])->middleware('checkRole:admin');
Route::get('/schedule_tentative/SB98/sumsb98',[SchTentativeController::class, 'sumsb98'])->middleware('checkRole:admin');
Route::get('schedule_tentative/SB98/delete',[SchTentativeController::class, 'reset_sb98'])->middleware('checkRole:admin');

// ========================================SA90 ROUTING===========================
Route::get('/schedule_tentative/SA90',[SchTentativeController::class, 'view_sa90'])->middleware('checkRole:admin');
Route::post('schedule_tentative/SA90/upload',[SchTentativeController::class, 'importSA90'])->middleware('checkRole:admin');
Route::get('schedule_tentative/SA90/delete',[SA90Controller::class, 'delete'])->middleware('checkRole:admin');

Route::get('/schedule_tentative/inhouse',[SchTentativeController::class, 'view_inhouse'])->middleware('checkRole:admin');
Route::post('/schedule_tentative/inhouse/upload',[SchTentativeController::class, 'import_Inhouse'])->middleware('checkRole:admin');

// ========================================VIEW RESULT COMPARE SCH===========================
Route::get('/schedule_tentative/servicePart',[SchServiceNGController::class, 'index'])->middleware('checkRole:admin');
Route::get('schedule_tentative/skdPart',[SchSKDNGController::class, 'index'])->middleware('checkRole:admin');
Route::get('/schedule_tentative/generate',[SchTentativeController::class, 'generate'])->middleware('checkRole:admin');



// ========================================MASTER SCHEDULE  RELEASE ROUTING===========================
Route::get('schedule', [ScheduleController::class,'index'])->middleware(['checkRole:admin,user']);
Route::post('/schedule/filter',[ScheduleController::class, 'filter'])->middleware(['checkRole:admin,user']);
Route::post('schedule/partlist',[ScheduleController::class, 'partlist'])->middleware('checkRole:admin');
Route::post('schedule/email',[EmailController::class, 'index'])->middleware('checkRole:admin');



// ========================================MASTER SCHEDULE  RELEASE ROUTING===========================
Route::get('partlist',[PartlistController::class,'index'])->middleware(['checkRole:user,admin']);
Route::get('partlist/view',[PartlistController::class,'view'])->middleware(['checkRole:user,admin']);
Route::post('partlist/filterProdno',[PartlistController::class,'filterProdno'])->middleware(['checkRole:user,admin']);
Route::post('partlist/filter_scan',[PartlistController::class,'filter_scan'])->middleware(['checkRole:user,admin']);
Route::post('partlist/scan_issue',[PartlistController::class,'scan_issue'])->middleware(['checkRole:user,admin']);
Route::post('partlist/looseCarton',[PartlistController::class,'looseCarton'])->middleware(['checkRole:user,admin']);
Route::post('partlist/scan_continue',[PartlistController::class,'scan_continue'])->middleware(['checkRole:user,admin']);
Route::get('partlist/showscan',[PartlistController::class,'showscan'])->middleware(['checkRole:user,admin']);

// =======================================REPACKING ROUTING===========================
Route::get('repacking',[RepackingController::class,'index'])->middleware('checkRole:admin');
Route::get('repacking/kitdata',[RepackingController::class,'kitdata'])->middleware('checkRole:admin');
// Route::post('repacking/printOriginal/{id}/',[RepackingController::class,'printOriginal'])->middleware('checkRole:admin');
Route::get('repacking/printlbl_kit',[RepackingController::class,'printlbl_kit'])->middleware('checkRole:admin');
// Route::post('repacking/printkit',[RepackingController::class,'printkit'])->middleware('checkRole:admin');

Route::get('repacking/logPrintOrg',[RepackingController::class,'logPrintOrg'])->middleware('checkRole:admin');
Route::post('repacking/logPrintOrg/{id}',[RepackingController::class,'get_Print'])->middleware('checkRole:admin');

Route::get('repacking/scanIn',[RepackingController::class,'scanIn'])->middleware('checkRole:admin');
Route::post('repacking/scanIn/inputData',[RepackingController::class,'inputData'])->middleware('checkRole:admin');
Route::get('repacking/cancel',[RepackingController::class,'view_cancel_scanin'])->middleware('checkRole:admin');
Route::post('repacking/cancel_scanin',[RepackingController::class,'cancel_scanin'])->middleware('checkRole:admin');


Route::get('repacking/scanCombine',[RepackingController::class,'scanCombine'])->middleware('checkRole:admin');
Route::post('repacking/scanCombine/inputCombine',[RepackingController::class,'inputCombine'])->middleware('checkRole:admin');
Route::get('repacking/scanCombine/printMaster',[RepackingController::class,'printMaster'])->middleware('checkRole:admin');



// =======================================FINISH GOOD ROUTING===========================
Route::get('finishgood',[FinishGoodController::class,'index'])->middleware('checkRole:admin');
Route::post('finishgood/scanout_box',[FinishGoodController::class,'scanout_box'])->middleware('checkRole:admin');
Route::get('finishgood/printID',[FinishGoodController::class,'printid_box'])->middleware('checkRole:admin');
Route::get('/finishgood/scanoutData',[FinishGoodController::class,'scanout_data'])->middleware('checkRole:admin');

Route::get('finishgood/viewSkid',[FinishGoodController::class,'viewSkid'])->middleware('checkRole:admin');
Route::get('finishgood/viewSkid/printSkid',[FinishGoodController::class,'printSkid'])->middleware('checkRole:admin');
Route::post('finishgood/viewSkid/scanout_skid',[FinishGoodController::class,'scanout_skid'])->middleware('checkRole:admin');
Route::get('finishgood/viewSkid/printMaster',[FinishGoodController::class,'printMasterlist'])->middleware('checkRole:admin');
Route::get('/finishgood/viewDummy',[FinishGoodController::class,'view_dummy'])->middleware('checkRole:admin');
Route::get('/finishgood/view_check',[FinishGoodController::class,'view_check'])->middleware('checkRole:admin');
Route::get('finishgood/viewSkid/checkData',[FinishGoodController::class,'check_data'])->middleware('checkRole:admin');


// =======================================PROBLEM FOUND  ROUTING===========================
Route::get('problem',[ProblemFoundController::class,'index'])->middleware('checkRole:admin');
Route::post('problem/create',[ProblemFoundController::class,'create'])->middleware('checkRole:admin');
Route::get('problem/view',[ProblemFoundController::class,'view'])->middleware(['checkRole:user,admin']);
Route::post('problem/update/{id}',[ProblemFoundController::class,'responProblem'])->middleware('checkRole:user');



// =======================================BORROW  ROUTING===========================
Route::get('borrow',[BorrowController::class,'index'])->middleware('checkRole:admin');
Route::post('borrow/takeout',[BorrowController::class,'takeout'])->middleware('checkRole:admin');


// =======================================PROBLEM FOUND  ROUTING===========================
Route::get('kitmonitoring',[KitmonitorController::class,'index'])->middleware('checkRole:admin');
// Route::post('borrow/takeout',[BorrowController::class,'takeout'])->middleware('checkRole:admin');