<?php

use App\Http\Controllers\HomeAdminController;
use App\Http\Controllers\HomeSuperAdminController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get("/",function(){
    echo "Pagina en contruccion";
})->name("principal");
Route::middleware("authenticationUser")->group(function(){
    Route::get("/login/admin",[LoginController::class,"index"])->name("loginA");
    Route::post("/login/admin",[LoginController::class,"loginAdmin"])->name("loginA");
});

Route::post("/logout/admin",[LoginController::class,"logoutAdmin"])->name("logoutA");
Route::middleware("authenticationSuperAdmin")->group(function(){
    Route::get("/suadmin",[HomeSuperAdminController::class,"index"])->name("superadmin");
    Route::get("/addtecnico",[HomeSuperAdminController::class,"addTecnico"])->name("addTecnico");
    Route::middleware("authformtecnico")->post("/addtecnico",[HomeSuperAdminController::class,"storeTecnico"])->name("newTecnico");
    Route::delete("/deletetecnico/{id}",[HomeSuperAdminController::class,"deleteTecnico"])->name("deleteTecnico");
    Route::get("/updateTecnico/{id}",[HomeSuperAdminController::class,"updateTecnico"])->name("updateTecnico");
    Route::middleware("authformupdatetec")->patch("/updateTecnico/{id}",[HomeSuperAdminController::class,"actualizarTecnico"])->name("actualizarTecnico");
    Route::post("/searchtecnico",[HomeSuperAdminController::class,"searchTecnico"])->name("searchTecnico");
});

Route::middleware("authenticationAdmin")->group(function(){
    Route::get("/admin",[HomeAdminController::class,"index"])->name("admin");
});





Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

