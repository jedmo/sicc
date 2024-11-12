<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CellController;
use App\Http\Controllers\CellMemberController;
use App\Http\Controllers\ChurchAttendanceController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DistrictController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\PaginationController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SectorController;
use App\Http\Controllers\SupervisionAttendanceController;
use App\Http\Controllers\SupportController;
use App\Http\Controllers\TrackingController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ZoneController;
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

Route::group(['middleware'=>'guest'],function(){
    Route::get('/',[AuthController::class,'login'])->name('login');
    Route::get('/register',[AuthController::class,'register'])->name('register');
    Route::get('/forget-password',[AuthController::class,'forgetPassword'])->name('forget_password');
    Route::post('/authenticate',[AuthController::class,'authenticate'])->name('authenticate');
    Route::post('/signup',[AuthController::class,'signup'])->name('signup');
});

/************************ Custom Routes Start ******************************/
Route::group(['middleware'=>'auth'],function(){
    Route::get('/home',[DashboardController::class,'home'])->name('home');
    Route::resource('users', UserController::class);
    Route::resource('districts', DistrictController::class);
    Route::resource('zones', ZoneController::class);
    Route::resource('sectors', SectorController::class);
    Route::resource('cells', CellController::class);
    Route::resource('members', MemberController::class);
    Route::resource('cell-members', CellMemberController::class);
    Route::resource('reports', ReportController::class);
    Route::resource('roles',  RoleController::class);
    Route::resource('church-attendances',  ChurchAttendanceController::class);
    Route::resource('supervision-attendances',  SupervisionAttendanceController::class);
    Route::resource('events',  EventController::class);
    Route::resource('supports',  SupportController::class);
    Route::get('/trackings/create/{member_id}', TrackingController::class . '@create')->name('trackings.create');
    Route::post('/trackings', TrackingController::class .'@store')->name('trackings.store');
    Route::get('/trackings/{member_id}', TrackingController::class . '@show')->name('trackings.show');
    Route::get('/trackings/{tracking}/edit', TrackingController::class . '@edit')->name('trackings.edit');
    Route::put('/trackings/{tracking}', TrackingController::class . '@update')->name('trackings.update');
    Route::delete('/trackings/{tracking}/{member_id}', TrackingController::class .'@destroy')->name('trackings.destroy');
    Route::get('/zones/filter/{district_id}', ZoneController::class .'@index')->name('zones.search');
    Route::get('/sectors/filter/{zone_id}', SectorController::class .'@index')->name('sectors.search');
    Route::get('/cells/filter/{sector_id}', CellController::class .'@index')->name('cells.search');
    Route::get('/report/sectors', ReportController::class .'@sectors')->name('reports.sectors');
    Route::get('/report/zones', ReportController::class .'@zones')->name('reports.zones');
    Route::get('/report/districts', ReportController::class .'@districts')->name('reports.districts');
    Route::get('/report/general', ReportController::class .'@general')->name('reports.general');
    Route::get('/report/stat-general', ReportController::class .'@statGeneral')->name('reports.stat-general');
    // Route::get('/cell-members/filter/{sector_id}', CellMemberController::class .'@index')->name('cell-members.search');
    Route::get('/report/pdf/{sector_id}', PDFController::class .'@generatePDF')->name('report.pdf');

    Route::get('/report/graph-show', [ReportController::class,'graphShow'])->name('reports.graph-show');
    Route::get('/cell_members/list/{cell_id}', [CellMemberController::class,'list'])->name('cell_members.list');
    Route::get('/report/attendance', [ReportController::class,'attendance'])->name('reports.attendance');
});
/************************ Custom Routes Ends ******************************/

Route::post('/logout',[AuthController::class,'logout'])->name('logout')->middleware('auth');
Route::get('/lang/{lang}',[ LanguageController::class,'switchLang'])->name('switch_lang');
Route::get('/pagination-per-page/{per_page}',[ PaginationController::class,'set_pagination_per_page'])->name('pagination_per_page');
