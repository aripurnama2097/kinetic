<?php


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ResetPasswordController;
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
use App\Http\Controllers\UserSettingController;
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
Route::get('/login/reset_password',[ResetPasswordController::class, 'index']);
Route::post('/login/reset_password',[ResetPasswordController::class, 'resetPassword']);
Route::post('/logout', [LoginController::class, 'logout']); // method lgogout


// Routing Register User
Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'store'])->middleware('guest');


Route::get('/dashboardMenu', [DashboardController::class,'index'])->middleware('auth');
// FORGOT PASSWORD
Route::get('/forgot_password', [ForgotController::class, 'index'])->middleware('guest');
Route::resource('/dashboard/help', DashboardHelpController::class);



// ========================================STD PACK ROUTE===========================
Route::get('/stdpack',[StdpackController::class, 'index']);
Route::post('/stdpack/create/',[StdpackController::class, 'create']);
Route::post('/stdpack/upload-stdpack',[StdpackController::class, 'uploadstdpack']);
Route::post('/stdpack/update/{id}',[StdpackController::class, 'update']);
Route::get('stdpack/{id}/destroy', [StdpackController::class,'destroy']);
Route::get('/stdpack/delete_all',[StdpackController::class, 'delete_all']);
Route::get('/stdpack/download',[StdpackController::class, 'download']);


// ========================================SCHEDULE TENTATIVE ROUTING===========================
Route::get('/schedule_tentative',[SchTentativeController::class, 'index']);
Route::get('/schedule_tentative/skdpart',[SchTentativeController::class, 'skdpart']);
Route::get('schedule_tentative/skdpart/delete',[SchTentativeController::class, 'deleteskd']);

Route::post('/schedule_tentative/skdpart/importskd',[SchTentativeController::class, 'import_skd']);



Route::get('/schedule_tentative/master_scheduleTemp',[SchTentativeController::class, 'view_tempschedule']);
Route::get('/schedule_tentative/check_data',[SchTentativeController::class, 'viewstdpack']);
Route::post('/schedule_tentative/master_scheduleTemp/importsch',[SchTentativeController::class, 'importsch_temp']);
Route::get('schedule_tentative/schTemp/delete',[SchTentativeController::class, 'reset_mastersch']);
Route::get('schedule_tentative/headersch',[SchTentativeController::class, 'headersch']);



// ========================================SB98 ROUTING===========================
Route::get('/schedule_tentative/SB98',[SchTentativeController::class, 'view_sB98']);
Route::post('/schedule_tentative/SB98/upload',[SchTentativeController::class, 'importSB98']);
Route::get('/schedule_tentative/SB98/sumsb98',[SchTentativeController::class, 'sumsb98']);
Route::get('schedule_tentative/SB98/delete',[SchTentativeController::class, 'reset_sb98']);

// ========================================SA90 ROUTING===========================
Route::get('/schedule_tentative/SA90',[SchTentativeController::class, 'view_sa90']);
Route::post('schedule_tentative/SA90/upload',[SchTentativeController::class, 'importSA90']);
Route::get('schedule_tentative/SA90/delete',[SA90Controller::class, 'delete']);

Route::get('/schedule_tentative/inhouse',[SchTentativeController::class, 'view_inhouse']);
Route::post('/schedule_tentative/inhouse/upload',[SchTentativeController::class, 'import_Inhouse']);
Route::get('schedule_tentative/inhouse/delete',[SchTentativeController::class, 'deleteInhouse']);



// ========================================VIEW RESULT COMPARE SCH===========================
Route::get('/schedule_tentative/result',[SchTentativeController::class, 'result']);
Route::post('/schedule_tentative/result/generate',[SchTentativeController::class, 'generateschedule']);
Route::post('/schedule_tentative/result/generateinhouse',[SchTentativeController::class, 'generateInhouse']);


// ========================================MASTER SCHEDULE  RELEASE ROUTING===========================
Route::get('schedule', [ScheduleController::class,'index']);
Route::post('/schedule/filter',[ScheduleController::class, 'filter']);
Route::post('schedule/partlist',[ScheduleController::class, 'partlist']);
Route::post('schedule/email',[EmailController::class, 'index']);
Route::post('schedule/sharesch',[ScheduleController::class, 'share_schedule']);

Route::get('schedule/release_schedule',[ScheduleController::class, 'view_schrelease']);
Route::post('schedule/cancel_partlist',[ScheduleController::class, 'cancel_partlist']);
Route::post('schedule/add_dic', [ScheduleController::class,'add_dic']);
Route::get('schedule/check_data',[ScheduleController::class, 'viewcheck_data']);

// ========================================MASTER SCHEDULE  RELEASE ROUTING===========================
Route::get('partlist',[PartlistController::class,'index']);
Route::get('partlist/view',[PartlistController::class,'view']);
Route::post('partlist/filterProdno',[PartlistController::class,'filterProdno']);
Route::post('partlist/filter_scan',[PartlistController::class,'filter_scan']);
Route::post('partlist/scan_issue',[PartlistController::class,'scan_issue']);
Route::post('partlist/looseCarton',[PartlistController::class,'looseCarton']);
Route::post('partlist/scan_continue',[PartlistController::class,'scan_continue']);
Route::post('partlist/scan_end_continue',[PartlistController::class,'scan_end_continue']);
Route::get('partlist/showscan',[PartlistController::class,'showscan']);
Route::get('partlist/inhouse',[PartlistController::class,'view_inhouse']);
Route::post('partlist/inhouse/scanin',[PartlistController::class,'scan_inhouse']);
Route::post('partlist/inhouse/input_inhouse',[PartlistController::class,'input_inhouse']);
Route::get('partlist/inhouse_data',[PartlistController::class,'inhouse_data']);

// =======================================REPACKING ROUTING===========================
Route::get('repacking',[RepackingController::class,'index']);
Route::get('repacking/viewscan',[RepackingController::class,'view']);
Route::get('repacking/kitdata',[RepackingController::class,'kitdata']);
Route::get('repacking/printlbl_kit',[RepackingController::class,'printlbl_kit']);
Route::get('repacking/printlbl_kit_combine',[RepackingController::class,'printlbl_kitcombine']);
Route::get('repacking/printlbl_assy',[RepackingController::class,'printlbl_assy']);

Route::post('repacking/printassy/{id}',[RepackingController::class,'printassy']);
Route::get('repacking/logPrintOrg',[RepackingController::class,'logPrintOrg']);
Route::post('repacking/logPrintOrg/{id}',[RepackingController::class,'get_Print']);

Route::get('repacking/scanIn',[RepackingController::class,'scanIn']);
Route::post('repacking/scanIn/inputData',[RepackingController::class,'inputData']);

Route::get('repacking/scan_assy',[RepackingController::class,'view_scanassy']);
Route::post('repacking/scanassy/input_assy',[RepackingController::class,'inputassy_mecha']);
Route::post('/repacking/scanassy/input_assypanel',[RepackingController::class,'inputassy_panel']);

Route::get('repacking/cancel',[RepackingController::class,'view_cancel_scanin']);
Route::post('repacking/cancel_scanin',[RepackingController::class,'cancel_scanin']);


Route::get('repacking/scanCombine',[RepackingController::class,'scanCombine']);
Route::post('repacking/scanCombine/inputCombine',[RepackingController::class,'inputCombine']);

Route::get('repacking/scanCombine/printMaster',[RepackingController::class,'printMaster']);
Route::get('repacking/cancelation',[RepackingController::class,'view_borrow_cancelation']);
Route::post('repacking/printNew/{id}',[RepackingController::class,'printNewlabel']);
Route::get('repacking/scanCombine/delete',[RepackingController::class,'reset_tbltmp']);


// =======================================FINISH GOOD ROUTING===========================
Route::get('finishgood',[FinishGoodController::class,'index']);
Route::post('finishgood/scanout_box',[FinishGoodController::class,'scanout_box']);
Route::get('finishgood/printID',[FinishGoodController::class,'printid_box']);
Route::get('/finishgood/scanoutData',[FinishGoodController::class,'scanout_data']);
Route::get('finishgood/masterlist',[FinishGoodController::class,'masterlist']);

Route::get('finishgood/viewSkid',[FinishGoodController::class,'viewSkid']);
Route::get('finishgood/viewSkid/printSkid',[FinishGoodController::class,'printSkid']);
Route::get('/finishgood/viewSkid/{id}/destroy',[FinishGoodController::class,'destroy']);
Route::post('finishgood/viewSkid/scanout_skid',[FinishGoodController::class,'scanout_skid']);
Route::get('finishgood/viewSkid/printMaster',[FinishGoodController::class,'printMasterlist']);
Route::get('/finishgood/viewSkid/logprintMaster',[FinishGoodController::class,'viewlogMaster']);
Route::post('/finishgood/viewSkid/logprintMaster/{id}',[FinishGoodController::class,'logmaster']);
Route::post('/finishgood/viewSkid/changemaster/{id}',[FinishGoodController::class,'changemaster']);



Route::get('/finishgood/viewDummy',[FinishGoodController::class,'view_dummy']);
Route::get('/finishgood/view_check',[FinishGoodController::class,'view_check']);
Route::get('finishgood/viewSkid/checkData',[FinishGoodController::class,'check_data']);




// =======================================PROBLEM FOUND  ROUTING===========================
Route::get('problem',[ProblemFoundController::class,'index']);
Route::post('problem/create',[ProblemFoundController::class,'create']);
Route::get('problem/view',[ProblemFoundController::class,'view']);
Route::post('problem/update/{id}',[ProblemFoundController::class,'responProblem']);



// =======================================BORROW  ROUTING===========================
Route::get('borrow',[BorrowController::class,'index']);
Route::post('borrow/takeout',[BorrowController::class,'takeout']);
Route::post('borrow/return',[BorrowController::class,'return_borrow']);
Route::get('borrow/cancelation',[BorrowController::class,'view_cancelation']);
Route::post('borrow/cancelation/return',[BorrowController::class,'cancelationAll']);


// =======================================PROBLEM FOUND  ROUTING===========================
Route::get('kitmonitoring',[KitmonitorController::class,'index']);
Route::post('kitmonitoring/update/{prodno}',[KitmonitorController::class,'update_invoice']);

Route::get('kitmonitoring/shippout',[KitmonitorController::class,'view_shippedout']);
Route::get('/user_setting',[UserSettingController::class,'index'])->middleware(['checkRole:Admin Planning,admin']);;
Route::post('/user_setting/add',[UserSettingController::class,'create'])->middleware(['checkRole:Admin Planning,admin']);;
Route::post('/user_setting/update/{id}',[UserSettingController::class,'update'])->middleware(['checkRole:Admin Planning,admin']);;

// Route::post('borrow/takeout',[BorrowController::class,'takeout'])->middleware('checkRole:admin');
