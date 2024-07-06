<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Auth::routes(['verfiy' => true]);

Route::get('/', function () {
    return redirect('/welcome');
});
Route::get('/welcome', [App\Http\Controllers\HomeController::class, 'welcome'])->name('welcome');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'home'])->name('home');

Route::get('/perfil', [App\Http\Controllers\PerfilController::class, 'index'])->name('perfil');
Route::get('/perfil/editar', [App\Http\Controllers\PerfilController::class, 'edit'])->name('perfil.editar');
Route::put('/perfil', [App\Http\Controllers\PerfilController::class, 'update'])->name('perfil.update');
Route::get('/perfil/password', [App\Http\Controllers\PerfilController::class, 'editPassword'])->name('perfil.password');
Route::put('/perfil/password', [App\Http\Controllers\PerfilController::class, 'updatePassword'])->name('perfil.password.update');

Route::get('/admin/users', [App\Http\Controllers\AdminController::class, 'admUsers'])->name('admin.users');
Route::get('/admin/users/crear', [App\Http\Controllers\AdminController::class, 'create'])->name('admin.users.create');
Route::get('/admin/users/{user}', [App\Http\Controllers\AdminController::class, 'admUser'])->name('admin.users.show');
Route::get('/admin/users/{user}/editar', [App\Http\Controllers\AdminController::class, 'edit'])->name('admin.users.edit');
Route::put('/admin/users/{user}', [App\Http\Controllers\AdminController::class, 'update'])->name('admin.users.update');
Route::delete('/admin/users/{user}', [App\Http\Controllers\AdminController::class, 'destroy'])->name('admin.users.destroy');
Route::post('/admin/users', [App\Http\Controllers\AdminController::class, 'store'])->name('admin.users.store');
Route::get('/admin/users/{user}/password', [App\Http\Controllers\AdminController::class, 'editPassword'])->name('admin.users.password');
Route::put('/admin/users/{user}/password', [App\Http\Controllers\AdminController::class, 'updatePassword'])->name('admin.users.password.update');
Route::put('/admin/users/{user}/roles', [App\Http\Controllers\AdminController::class, 'updateRoles'])->name('admin.users.roles.update');

Route::get('/vehiculos/tipos', [App\Http\Controllers\TiposVehiculosController::class, 'index'])->name('tiposVehiculos.index');
Route::get('/vehiculos/tipos/crear', [App\Http\Controllers\TiposVehiculosController::class, 'create'])->name('tiposVehiculos.create');
Route::get('/vehiculos/tipos/{tipo}', [App\Http\Controllers\TiposVehiculosController::class, 'show'])->name('tiposVehiculos.show');
Route::get('/vehiculos/tipos/{tipo}/editar', [App\Http\Controllers\TiposVehiculosController::class, 'edit'])->name('tiposVehiculos.edit');
Route::put('/vehiculos/tipos/{tipo}', [App\Http\Controllers\TiposVehiculosController::class, 'update'])->name('tiposVehiculos.update');
Route::delete('/vehiculos/tipos/{tipo}', [App\Http\Controllers\TiposVehiculosController::class, 'destroy'])->name('tiposVehiculos.destroy');
Route::post('/vehiculos/tipos', [App\Http\Controllers\TiposVehiculosController::class, 'store'])->name('tiposVehiculos.store');

Route::put('/vehiculos/{vehiculo}/updateEstado', [App\Http\Controllers\VehiculosController::class, 'updateEstado'])->name('vehiculos.update.estado');
Route::get('/vehiculos/{vehiculo}/editarEstado', [App\Http\Controllers\VehiculosController::class, 'editEstado'])->name('vehiculos.edit.estado');
Route::get('/vehiculos', [App\Http\Controllers\VehiculosController::class, 'index'])->name('vehiculos.index');
Route::get('/vehiculos/crear', [App\Http\Controllers\VehiculosController::class, 'create'])->name('vehiculos.create');
Route::get('/vehiculos/{vehiculo}', [App\Http\Controllers\VehiculosController::class, 'show'])->name('vehiculos.show');
Route::get('/vehiculos/{vehiculo}/editar', [App\Http\Controllers\VehiculosController::class, 'edit'])->name('vehiculos.edit');
Route::put('/vehiculos/{vehiculo}', [App\Http\Controllers\VehiculosController::class, 'update'])->name('vehiculos.update');
Route::delete('/vehiculos/{vehiculo}', [App\Http\Controllers\VehiculosController::class, 'destroy'])->name('vehiculos.destroy');
Route::post('/vehiculos', [App\Http\Controllers\VehiculosController::class, 'store'])->name('vehiculos.store');

Route::get('/clientes', [App\Http\Controllers\ClientesController::class, 'index'])->name('clientes.index');
Route::get('/clientes/crear', [App\Http\Controllers\ClientesController::class, 'create'])->name('clientes.create');
Route::get('/clientes/{cliente}', [App\Http\Controllers\ClientesController::class, 'show'])->name('clientes.show');
Route::get('/clientes/{cliente}/editar', [App\Http\Controllers\ClientesController::class, 'edit'])->name('clientes.edit');
Route::put('/clientes/{cliente}', [App\Http\Controllers\ClientesController::class, 'update'])->name('clientes.update');
Route::delete('/clientes/{cliente}', [App\Http\Controllers\ClientesController::class, 'destroy'])->name('clientes.destroy');
Route::post('/clientes', [App\Http\Controllers\ClientesController::class, 'store'])->name('clientes.store');

Route::get('/arriendos', [App\Http\Controllers\ArriendosController::class, 'index'])->name('arriendos.index');
Route::get('/arriendos/crear', [App\Http\Controllers\ArriendosController::class, 'create'])->name('arriendos.create');
Route::get('/arriendos/{arriendo}', [App\Http\Controllers\ArriendosController::class, 'show'])->name('arriendos.show');
Route::get('/arriendos/{arriendo}/editar', [App\Http\Controllers\ArriendosController::class, 'edit'])->name('arriendos.edit');
Route::put('/arriendos/{arriendo}', [App\Http\Controllers\ArriendosController::class, 'update'])->name('arriendos.update');
Route::delete('/arriendos/{arriendo}', [App\Http\Controllers\ArriendosController::class, 'destroy'])->name('arriendos.destroy');
Route::post('/arriendos', [App\Http\Controllers\ArriendosController::class, 'store'])->name('arriendos.store');
Route::post('/arriendos/{arriendo}/storePhotoEntrega', [App\Http\Controllers\ArriendosController::class, 'storePhotoEntrega'])->name('arriendos.fotos.entrega.store');
Route::post('/arriendos/{arriendo}/storePhotoDevolucion', [App\Http\Controllers\ArriendosController::class, 'storePhotoDevolucion'])->name('arriendos.fotos.devolucion.store');
Route::delete('/arriendos/{arriendo}/destroyPhotoEntrega', [App\Http\Controllers\ArriendosController::class, 'destroyPhotoEntrega'])->name('arriendos.fotos.entrega.destroy');
Route::delete('/arriendos/{arriendo}/destroyPhotoDevolucion', [App\Http\Controllers\ArriendosController::class, 'destroyPhotoDevolucion'])->name('arriendos.fotos.devolucion.destroy');
