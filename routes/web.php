<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\NetworkController;
use App\Http\Controllers\OfficeController;
use App\Http\Controllers\StaffController;
use Illuminate\Support\Facades\Route;

Route::match(['get', 'post'], 'register', [AuthController::class, 'register'])->name('register');
Route::middleware('guest')->group(function () {
	Route::match(['get', 'post'], 'login', [AuthController::class, 'login'])->name('login');
});

Route::middleware(['auth'])->group(function(){
	Route::post('logout', [AuthController::class, 'logout'])->name('logout');
	Route::get('/', [AdminController::class, 'index'])->name('admin.index');

	Route::get('offices', [OfficeController::class, 'index'])->name('offices.index');
	Route::match(['get', 'post'], 'offices/insert', [OfficeController::class, 'insert'])->name('offices.insert');
	Route::match(['get', 'put'], 'offices/{id}/edit', [OfficeController::class, 'edit'])->name('offices.edit');
	Route::delete('offices/{id}', [OfficeController::class, 'delete'])->name('offices.delete');

	Route::get('staffs', [StaffController::class, 'index'])->name('staffs.index');
	Route::match(['get', 'post'], 'staffs/insert', [StaffController::class, 'insert'])->name('staffs.insert');
	Route::match(['get', 'put'], 'staffs/{id}/edit', [StaffController::class, 'edit'])->name('staffs.edit');
	Route::delete('staffs/{id}', [StaffController::class, 'delete'])->name('staffs.delete');

	Route::get('networks', [NetworkController::class, 'index'])->name('networks.index');
	Route::match(['get', 'post'], 'networks/insert', [NetworkController::class, 'insert'])->name('networks.insert');
	Route::match(['get', 'put'], 'networks/{id}/edit', [NetworkController::class, 'edit'])->name('networks.edit');
	Route::delete('networks/{id}', [NetworkController::class, 'delete'])->name('networks.delete');

	Route::get('devices', [DeviceController::class, 'index'])->name('devices.index');
	Route::match(['get', 'post'], 'devices/insert', [DeviceController::class, 'insert'])->name('devices.insert');
	Route::match(['get', 'put'], 'devices/{id}/edit', [DeviceController::class, 'edit'])->name('devices.edit');
	Route::post('devices/exportcsv', [DeviceController::class, 'exportcsv'])->name('devices.exportcsv');
	Route::post('devices/exportexcel', [DeviceController::class, 'exportexcel'])->name('devices.exportexcel');
	Route::get('devices/exportpdf', [DeviceController::class, 'exportpdf'])->name('devices.exportpdf');
	Route::delete('devices/{id}', [DeviceController::class, 'delete'])->name('devices.delete');
});