<?php

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

/** @var Illuminate\Routing\Router $router */

Auth::routes();

// ホームページ
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// アカウントページ
Route::get('/accounts', [App\Http\Controllers\AccountController::class, 'index'])->name('account');

// アカウント作成ページ
Route::get('/accounts/create', [App\Http\Controllers\AccountController::class, 'create'])->name('account');
Route::post('/accounts/insert', [App\Http\Controllers\AccountController::class, 'store'])->name('account');

Route::get('/accounts/{id}/edit', [App\Http\Controllers\AccountController::class, 'edit'])->name('account');
Route::post('/accounts/{id}/update',[App\Http\Controllers\AccountController::class, 'update'])->name('account');

// アカウントのステータス変更
Route::post('/accounts/{id}/status_change',[App\Http\Controllers\AccountController::class, 'status_change'])->name('account');
Route::post('/accounts/{id}/delete',[App\Http\Controllers\AccountController::class, 'destroy'])->name('account');

// アカウントをCSV出力
Route::get('/accounts/exports',[App\Http\Controllers\AccountController::class, 'csv_exports'])->name('account');

// アクティベートページ
Route::get('/activates', [App\Http\Controllers\ActivateController::class, 'index'])->name('account');
Route::post('/activates/{id}/delete',[App\Http\Controllers\ActivateController::class, 'destroy'])->name('account');
Route::post('/activates/{id}/unlock',[App\Http\Controllers\ActivateController::class, 'unlock'])->name('account');

// PUSHメッセージページ
Route::get('/push', [App\Http\Controllers\PushController::class, 'index'])->name('push');
Route::get('/push/{id}/confirm', [App\Http\Controllers\PushController::class, 'confirm'])->name('push');
Route::get('/push/create', [App\Http\Controllers\PushController::class, 'create'])->name('push');
Route::post('/push/insert', [App\Http\Controllers\PushController::class, 'store'])->name('push');

// グループ管理ページ
Route::get('/groups',[App\Http\Controllers\GroupController::class, 'index'])->name('groups');
Route::get('/groups/{id}/edit',[App\Http\Controllers\GroupController::class, 'edit'])->name('groups');
Route::post('/groups/{id}/update',[App\Http\Controllers\GroupController::class, 'update'])->name('groups');
Route::get('/groups/{id}/confirm',[App\Http\Controllers\GroupController::class, 'confirm'])->name('groups');
Route::get('/groups/create',[App\Http\Controllers\GroupController::class, 'create'])->name('groups');
Route::post('/groups/insert',[App\Http\Controllers\GroupController::class, 'store'])->name('groups');