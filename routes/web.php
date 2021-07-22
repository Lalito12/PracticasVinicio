<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AlumnosController;
use App\Http\Controllers\PrincipalController;
use App\Http\Controllers\ProductosController;

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

Route::name('index')->get('index',[AlumnosController::class, 'index']);
Route::name('editar')->get('editar/{id}',[AlumnosController::class,'edit']);
Route::name('store')->post('store/',[AlumnosController::class,'store']);
Route::name('destroy')->delete('destroy/{id}',[AlumnosController::class,'destroy']);


// ------------------------------- Carrito ----------------------------------
Route::name('productos')->get('productos',[ProductosController::class,'index']);
Route::name('carrito')->get('carrito',[ProductosController::class,'carrito']);
Route::name('agregar')->get('agregar/{id}',[ProductosController::class,'agregar']);
Route::name('actualizar')->patch('actualizar',[ProductosController::class,'actualizar']);
Route::name('borrar')->delete('borrar',[ProductosController::class,'borrar']);


// ------------------------------ PDF
Route::name('pdfalumnos')->get('pdfalumnos',[AlumnosController::class,'getPdfAlumnos']);

// ------------------------------ Excel
Route::name('export')->get('export',[AlumnosController::class,'export']);
Route::name('import')->post('import',[AlumnosController::class,'import']);

// ------------------------------ QrCode
Route::name('qrcode')->get('qrcode',[AlumnosController::class,'QrCode']);
Route::view('escanerqr', 'escanerqr');

//------------------------Principal-----------------
Route::get('/',[PrincipalController::class,'principal'])->name('principal');

