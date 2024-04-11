<?php

use App\Http\Controllers\ChatController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\HomeAdminController;
use App\Http\Controllers\HomeSuperAdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MantenimientoController;
use App\Http\Controllers\PusherController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\TestWebsocketController;
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

// las rutas estan aqui
Route::get("/",function(){
    echo "Pagina en contruccion";
})->name("principal");
Route::middleware("authenticationUser")->group(function(){
    Route::get("/login/admin",[LoginController::class,"index"])->name("loginA");
    Route::post("/login/admin",[LoginController::class,"loginAdmin"])->name("loginA");

});
Route::get("/buscarproducto",[ClienteController::class,"viewfolio"])->name("buscarequipo");
Route::post("/buscarproducto",[ClienteController::class,"searchMantenimiento"])->name("buscarequipo");

Route::post("/logout/cliente",[ClienteController::class,"salir"])->name("salircliente");

Route::middleware("authclient")->group(function(){
 Route::get("/cliente/home/{id}",[ClienteController::class,"index"])->name("cliente");


});

Route::middleware("authallusers")->group(function(){
    Route::get("/allchats",[ChatController::class,"chat"])->name("allchats");
    Route::post("/broadcast",[PusherController::class,"broadcast"])->name("broadcast");
    Route::post("/receive",[PusherController::class,"receive"])->name("receive");
    // Route::get("/chat/{id}",[PusherController::class,"index"])->name("chat");
    Route::get("chat/{id}",[ClienteController::class,"viewChat"])->name("chatcliente");
});

Route::middleware("authalladmins")->group(function(){
    Route::get('/updateMantenimiento/{id}',[MantenimientoController::class,'update'])->name('updateMantenimiento');
    Route::middleware("authformupdate")->patch('/updateMantenimiento',[MantenimientoController::class,'updateMaintenance'])->name('updatemetho');
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
    Route::get("/maintancetecnico/{id}/{finish?}/{all?}",[HomeSuperAdminController::class,"showallTecnicoManteince"])->name("mantenimientoTecnicoforspecific");
    Route::get("/searchmantenimientotecnico",[HomeSuperAdminController::class,"serachForSpecificTecnico"])->name("searchMantenimientoTecnico");
    Route::get("/mantenimientotecnico/{id}",[HomeSuperAdminController::class,"mantenimientoTecnico"])->name("mantenimientoTecnico");
    Route::get("/allEquiposMantenimiento/{finish?}/{all?}",[HomeSuperAdminController::class,"allEquiposMantenimiento"])->name("allEquiposMantenimiento");
    Route::get("/searchmantenimiento",[HomeSuperAdminController::class,"search"])->name("searchMantenimiento");
    Route::get("/addmantenimiento",[HomeSuperAdminController::class,"mantenimentoview"])->name("addMantenimiento");
    Route::post("/addmantenimiento",[HomeSuperAdminController::class,"store"])->name("addMantenimiento");
    Route::get("/allclientes",[HomeSuperAdminController::class,"allclientesview"])->name("allClientes");
    Route::get("/searchcliente",[HomeSuperAdminController::class,"searchclientes"])->name("searchcliente");
    Route::get("/allclientesmantenimientos/{id}/{finish?}/{all?}",[MantenimientoController::class,"allmantenimientos"])->name("allmantenimientosclientes");
    Route::get("/searchmantenimientocliente",[MantenimientoController::class,"searchspecificcliente"])->name("searchmantenimienofcliente");

});



Route::middleware("authenticationAdmin")->group(function(){
    Route::get("/admin/{finish?}/{all?}",[HomeAdminController::class,"index"])->name("admin");
    Route::get("/equipo",[HomeAdminController::class,"equipo"])->name("equipo");
    Route::middleware("authformaddEquipo")->post("/equipo",[HomeAdminController::class,"store"])->name("newequipo");
    Route::get("/update/{idman}",[HomeAdminController::class,"update"])->name("update");
    Route::get("/equiposearch",[HomeAdminController::class,"search"])->name("searchequipo");



});


// Route::get("/test",[TestWebsocketController::class,"test"])->name("test");
// Route::get("/viewtes",function(){
//   return view("test");
// });

// Route::get('test',[TestController::class,'test']);
// Route::view('bbb','checkingWebsocket');






Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

