<?php

use App\Http\Controllers\CellMemberController;
use App\Http\Controllers\ReportController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['middleware'=>'auth'],function(){
    Route::get('reports', [ReportController::class,'graphShow'])->name('api.report.show');
    Route::get('cell_members/{cell_id}', [CellMemberController::class,'list'])->name('api.cell.members');
    Route::get('assistance', [ReportController::class,'assistance'])->name('api.cell.assistance');
});
