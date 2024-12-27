<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Soportes;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Carbon;
use App\Http\Controllers\CalendarioTiController;
use App\Http\Controllers\HomeController;
Route::get('register', function () {
    return redirect()->route('login');
});

Route::get('',[HomeController::class, 'Panel'])->name('Panel');
Route::get('/Panel',[HomeController::class, 'Panel'])->name('Panel');
/*********************************************ROLES************************************************** */
Route::get('/Roles',[HomeController::class, 'Roles'])->name('Roles');
Route::post('/RolesRegister',[HomeController::class, 'RolesRegister'])->name('RolesRegister');
Route::get('/EditRol/{id}',[HomeController::class, 'EditRol'])->name('EditRol');
Route::post('/EditRol',[HomeController::class, 'EditRolP'])->name('EditRolP');
/*******************USUARIOS******************************* */
Route::get('/RegistroUsuarios',[HomeController::class, 'RegistroUsuarios'])->name('RegistroUsuarios');
Route::post('/EditarInfoUser',[HomeController::class, 'EditarInfoUser'])->name('EditarInfoUser');
Route::post('/ViewAddAdminRegister',[HomeController::class, 'ViewAddAdminRegister'])->name('ViewAddAdminRegister');
Route::post('/UpdateRole',[HomeController::class, 'UpdateRole'])->name('UpdateRole');
Route::post('/UpdatePassword',[HomeController::class, 'UpdatePassword'])->name('UpdatePassword');
/*******************COMPRAS******************************* */
Route::get('/Compras',[HomeController::class, 'compras'])->name('Compras');
/*******************SGC******************************* */
Route::get('/SGC',[HomeController::class, 'SGC'])->name('SGC');
/*******************SISTEMAS******************************* */
Route::get('/Sistemas',[HomeController::class, 'Sistemas'])->name('Sistemas');
Route::post('/Panel',[HomeController::class, 'Panelp'])->name('Panelp'); 
Route::get('/CrearAsignacion',[HomeController::class, 'CrearAsignacion'])->name('CrearAsignacion');
Route::post('/RegistroEquipo',[HomeController::class, 'RegistroEquipo'])->name('RegistroEquipo');
Route::post('/CrearAsignacion',[HomeController::class, 'RegistroPasswords'])->name('RegistroPasswords');
Route::post('/CrearAsignaciond',[HomeController::class, 'RegistroDispositivos'])->name('RegistroDispositivos');
Route::get('/ConsultarAsignaciones',[HomeController::class, 'ConsultarAsignaciones'])->name('ConsultarAsignaciones');
Route::get('/VerAsignacion/{id}',[HomeController::class, 'VerAsignacion'])->name('VerAsignacion');
Route::post('/VerAsignacion/{id}',[HomeController::class, 'VerAsignacionPost'])->name('VerAsignacionpost');
Route::post('/VerAsignacion2/{id}',[HomeController::class, 'VerAsignacionPost2'])->name('VerAsignacionpost2');
Route::post('/contrasenas/{id}',[HomeController::class, 'contrasenas'])->name('contrasenas');
Route::get('/ActivosTI',[HomeController::class, 'ActivosTI'])->name('ActivosTI');
Route::post('/ActivosTI',[HomeController::class, 'ActivosTIPost'])->name('ActivosTIPost');
Route::post('/ActivosTIEdit',[HomeController::class, 'UpdateActivosTIPost'])->name('UpdateActivosTIPost');
Route::get('/EstadisticasEquipos',[HomeController::class, 'Incidencias2'])->name('Incidencias2');
Route::post('/ResumenTi',[HomeController::class, 'Incidencias2post'])->name('Incidencias2post');
Route::get('/Incidencias',[HomeController::class, 'IncidenciasAsignacion'])->name('IncidenciasAsignacion');
Route::post('/Asignar',[HomeController::class, 'Asignar'])->name('Asignar');
Route::post('/CompletarSoporte',[HomeController::class, 'CompletarSoporte'])->name('CompletarSoporte');
Route::get('/ImgIncidencia/{id}',[HomeController::class, 'ImgIncidencia'])->name('ImgIncidencia');
Route::post('/Cancelar',[HomeController::class, 'Cancelar'])->name('Cancelar');
Route::get('/IncidenciasGraficas',[HomeController::class, 'Incidencias'])->name('IncidenciasGraficas');
Route::post('/Incidencias',[HomeController::class, 'IncidenciasFiltro'])->name('IncidenciasFiltro');
// ******************************HISTORIAL GENERAL*****************************
Route::get('/HistorialGeneral', [HomeController::class, 'HistorialGeneral'])->name('HistorialGeneral');
Route::post('/HistorialGeneral', [HomeController::class, 'HistorialGeneralP'])->name('HistorialGeneralP');
Route::get('/ValidarPdf/{id}',[HomeController::class, 'ValidarPdf'])->name('ValidarPdf');
Route::get('/VerSolicitud/{id}',[HomeController::class, 'VerSolicitud'])->name('VerSolicitud');
Route::get('/GenerarCoa/{id}',[HomeController::class, 'generateInvoicePDF'])->name('generate.invoice.pdf');
Route::get('/GenerarCoaIng/{id}',[HomeController::class, 'generateInvoicePDFIng'])->name('generatePdfIng');
// ******************************Pase de salida*****************************
Route::get('/PaseSalida/{id}',[HomeController::class, 'PaseSalida'])->name('PaseSalida');
Route::get('/PaseSalidaPDF/{id}',[HomeController::class, 'PaseSalidaPDF'])->name('PaseSalidaPDF');
Route::post('/PaseSalidaPDF',[HomeController::class, 'PostPaseSalidaPDF'])->name('PostPaseSalidaPDF');
// ****************Calendario soprotes ti*********
Route::get('/CalendarioMttosTI',[HomeController::class, 'CalendarioMttosTI'])->name('CalendarioMttosTI');
Route::get( '/cmindex',[CalendarioTiController::class, 'cmindex'])->name('cmindex');
Route::post( '/cmistore',[CalendarioTiController::class, 'cmistore'])->name('cmistore');
Route::get('/BuscarEquipo/{id}',[HomeController::class, 'BuscarEquipo'])->name('BuscarEquipo');
// ******************************Calendario*****************************
Route::get('/Calendario',[HomeController::class, 'Calendario'])->name('Calendario');
Route::get( '/index',[EventController::class, 'index'])->name('event.get');
Route::post( '/store',[EventController::class, 'store'])->name('event.store');
// ******************************SM Calendario*****************************
Route::get( '/index2',[EventosController::class, 'index2'])->name('event.getx');
Route::post( '/storex',[EventosController::class, 'storex'])->name('event.storex');
Route::get('/CalendarioDoctor',[HomeController::class, 'CalendarioDoctor'])->name('CalendarioDoctor');
Route::get('ListaPaseSalida',[HomeController::class, 'ListaPaseSalida'])->name('ListaPaseSalida');
Route::post('Vigilancia',[HomeController::class, 'Vigilancia'])->name('Vigilancia');
Route::post('ListaPaseSalida',[HomeController::class, 'ListaPaseSalidaP'])->name('ListaPaseSalidaP');
