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
Route::get('/Roles',[HomeController::class, 'Roles'])->middleware('can:TI')->name('Roles');
Route::post('/RolesRegister',[HomeController::class, 'RolesRegister'])->middleware('can:TI')->name('RolesRegister');
Route::get('/EditRol/{id}',[HomeController::class, 'EditRol'])->middleware('can:TI')->name('EditRol');
Route::post('/EditRol',[HomeController::class, 'EditRolP'])->middleware('can:TI')->name('EditRolP');
/*******************USUARIOS******************************* */
Route::get('/RegistroUsuarios',[HomeController::class, 'RegistroUsuarios'])->middleware('can:TI')->name('RegistroUsuarios');
Route::post('/EditarInfoUser',[HomeController::class, 'EditarInfoUser'])->middleware('can:TI')->name('EditarInfoUser');
Route::post('/ViewAddAdminRegister',[HomeController::class, 'ViewAddAdminRegister'])->middleware('can:TI')->name('ViewAddAdminRegister');
Route::post('/UpdateRole',[HomeController::class, 'UpdateRole'])->middleware('can:TI')->name('UpdateRole');
Route::post('/UpdatePassword',[HomeController::class, 'UpdatePassword'])->middleware('can:TI')->name('UpdatePassword');
/*******************COMPRAS******************************* */
Route::get('/Compras',[HomeController::class, 'compras'])->name('Compras');
/*******************SGC******************************* */
Route::get('/SGC',[HomeController::class, 'SGC'])->name('SGC');
/*******************Etiquetas******************************* */
Route::get('/Etiquetas',[HomeController::class, 'Etiquetas'])->name('Etiquetas');
/*******************SISTEMAS******************************* */
Route::get('/Sistemas',[HomeController::class, 'Sistemas'])->name('Sistemas');
Route::post('/Panel',[HomeController::class, 'Panelp'])->name('Panelp'); 
Route::get('/CrearAsignacion',[HomeController::class, 'CrearAsignacion'])->middleware('can:TI')->name('CrearAsignacion');
Route::post('/RegistroEquipo',[HomeController::class, 'RegistroEquipo'])->middleware('can:TI')->name('RegistroEquipo');
Route::post('/CrearAsignacion',[HomeController::class, 'RegistroPasswords'])->middleware('can:TI')->name('RegistroPasswords');
Route::post('/CrearAsignaciond',[HomeController::class, 'RegistroDispositivos'])->middleware('can:TI')->name('RegistroDispositivos');
Route::get('/ConsultarAsignaciones',[HomeController::class, 'ConsultarAsignaciones'])->middleware('can:TI')->name('ConsultarAsignaciones');
Route::get('/VerAsignacion/{id}',[HomeController::class, 'VerAsignacion'])->middleware('can:TI')->name('VerAsignacion');
Route::post('/VerAsignacion/{id}',[HomeController::class, 'VerAsignacionPost'])->middleware('can:TI')->name('VerAsignacionpost');
Route::post('/VerAsignacion2/{id}',[HomeController::class, 'VerAsignacionPost2'])->middleware('can:TI')->name('VerAsignacionpost2');
Route::post('/contrasenas/{id}',[HomeController::class, 'contrasenas'])->middleware('can:TI')->name('contrasenas');
Route::get('/ActivosTI',[HomeController::class, 'ActivosTI'])->middleware('can:TI')->name('ActivosTI');
Route::post('/ActivosTI',[HomeController::class, 'ActivosTIPost'])->middleware('can:TI')->name('ActivosTIPost');
Route::post('/ActivosTIEdit',[HomeController::class, 'UpdateActivosTIPost'])->middleware('can:TI')->name('UpdateActivosTIPost');
Route::get('/EstadisticasEquipos',[HomeController::class, 'Incidencias2'])->middleware('can:TI')->name('Incidencias2');
Route::post('/ResumenTi',[HomeController::class, 'Incidencias2post'])->middleware('can:TI')->name('Incidencias2post');
Route::get('/Incidencias',[HomeController::class, 'IncidenciasAsignacion'])->middleware('can:TI')->name('IncidenciasAsignacion');
Route::post('/Asignar',[HomeController::class, 'Asignar'])->middleware('can:TI')->name('Asignar');
Route::post('/CompletarSoporte',[HomeController::class, 'CompletarSoporte'])->middleware('can:TI')->name('CompletarSoporte');
Route::get('/ImgIncidencia/{id}',[HomeController::class, 'ImgIncidencia'])->middleware('can:TI')->name('ImgIncidencia');
Route::post('/Cancelar',[HomeController::class, 'Cancelar'])->middleware('can:TI')->name('Cancelar');
Route::get('/IncidenciasGraficas',[HomeController::class, 'Incidencias'])->middleware('can:TI')->name('IncidenciasGraficas');
Route::post('/Incidencias',[HomeController::class, 'IncidenciasFiltro'])->middleware('can:TI')->name('IncidenciasFiltro');
// ******************************HISTORIAL GENERAL*****************************
Route::get('/HistorialGeneral', [HomeController::class, 'HistorialGeneral'])->name('HistorialGeneral');
Route::post('/HistorialGeneral', [HomeController::class, 'HistorialGeneralP'])->name('HistorialGeneralP');
Route::get('/ValidarPdf/{id}',[HomeController::class, 'ValidarPdf'])->middleware('can:TI')->name('ValidarPdf');
Route::get('/VerSolicitud/{id}',[HomeController::class, 'VerSolicitud'])->middleware('can:TI')->name('VerSolicitud');
Route::get('/GenerarCoa/{id}',[HomeController::class, 'generateInvoicePDF'])->middleware('can:TI')->name('generate.invoice.pdf');
Route::get('/GenerarCoaIng/{id}',[HomeController::class, 'generateInvoicePDFIng'])->middleware('can:TI')->name('generatePdfIng');
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
Route::get('ListaPaseSalida',[HomeController::class, 'ListaPaseSalida'])->middleware('can:PaseSalida')->name('ListaPaseSalida');
Route::post('Vigilancia',[HomeController::class, 'Vigilancia'])->name('Vigilancia');
Route::post('ListaPaseSalida',[HomeController::class, 'ListaPaseSalidaP'])->name('ListaPaseSalidaP');
