<?php

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', function () {
    return view('auth/login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/preguntas_normales/{p}', [App\Http\Controllers\QuizController::class, 'preguntas_normales'])->name('preguntas_normales');

Route::get('logout', [LoginController::class, 'logout']);

Route::get('profile', [App\Http\Controllers\ProfileController::class, 'profile'])->name('profile');

Route::get('/gestionar_pregunta', [App\Http\Controllers\GestionPreguntaController::class, 'gestionar_pregunta'])->name('gestionar_pregunta');

Route::get('/gestionar_usuarios', [App\Http\Controllers\GestionUsuariosController::class, 'gestionar_usuarios'])->name('gestionar_usuarios');

Route::get('/buscar_usuarios', [App\Http\Controllers\GestionUsuariosController::class, 'buscar_usuarios'])->name('buscar_usuarios');

Route::get('pendientes', [App\Http\Controllers\PendientesController::class, 'pendientes'])->name('pendientes');

Route::get('desafio', [App\Http\Controllers\DesafioController::class, 'desafio'])->name('desafio');

Route::get('/editstate/{id}', [App\Http\Controllers\PreguntasController::class, 'edit_state'])->name('edit_state');

Route::post('/agregar_pregunta', [App\Http\Controllers\PreguntasController::class, 'agregar_pregunta'])->name('agregar_pregunta');

Route::post('/changePassword', [App\Http\Controllers\UserSettingsController::class, 'changePassword'])->name('changePassword');

Route::get('/approve_question/{id}', [App\Http\Controllers\PreguntasController::class, 'approve_question'])->name('approve_question');

Route::get('/disapprove_question/{id}', [App\Http\Controllers\PreguntasController::class, 'disapprove_question'])->name('disapprove_question');

Route::get('/borrar_categoria/{id}', [App\Http\Controllers\CategoriaController::class, 'borrar_categoria'])->name('borrar_categoria');

Route::post('/editar_categoria', [App\Http\Controllers\CategoriaController::class, 'editar_categoria'])->name('editar_categoria');

Route::post('/crear_categoria', [App\Http\Controllers\CategoriaController::class, 'crear_categoria'])->name('crear_categoria');

Route::get('/ver_pregunta/{id}', [App\Http\Controllers\VerPreguntasController::class, 'ver_pregunta'])->name('ver_pregunta');

Route::get('/ver_usuario', [App\Http\Controllers\HomeController::class, 'ver_usuario'])->name('ver_usuario');

Route::post('/update/{id}', [App\Http\Controllers\PreguntasController::class, 'update'])->name('update');

Route::get('/obtener_preguntas/{dificultad}', [App\Http\Controllers\PreguntasController::class, 'obtener_preguntas'])->name('obtener_preguntas');

Route::get('/registrar_respuesta', [App\Http\Controllers\PreguntasController::class, 'registrar_respuesta'])->name('registrar_respuesta');

Route::get('categorias', [App\Http\Controllers\CategoriaController::class, 'categoria'])->name('categorias');

Route::get('/quiz/{p}', [App\Http\Controllers\QuizController::class, 'quiz'])->name('quiz');

Route::get('/actualizarVidas', [App\Http\Controllers\UserSettingsController::class, 'actualizarVidas'])->name('actualizarVidas');

Route::get('/comprarVida', [App\Http\Controllers\UserSettingsController::class, 'comprarVida'])->name('comprarVida');

Route::get('/restarVida', [App\Http\Controllers\UserSettingsController::class, 'restarVida'])->name('restarVida');

Route::get('/comprarSubscripcion/{dato}', [App\Http\Controllers\UserSettingsController::class, 'comprarSubscripcion'])->name('comprarSubscripcion');

Route::get('/eliminar_usuario/{id}', [App\Http\Controllers\GestionUsuariosController::class, 'eliminar_usuario'])->name('eliminar_usuario');

Route::get('/ver_usuario/{id}', [App\Http\Controllers\GestionUsuariosController::class, 'ver_usuario_id'])->name('ver_usuario_id');

Route::post('/editar_usuario', [App\Http\Controllers\GestionUsuariosController::class, 'editar_usuario'])->name('editar_usuario');

Route::get('/obtener_pregunta_desafio', [App\Http\Controllers\DesafioController::class, 'obtener_pregunta_desafio'])->name('obtener_pregunta_desafio');

Route::get('/entrar_desafio', [App\Http\Controllers\DesafioController::class, 'entrar_desafio'])->name('entrar_desafio');

Route::get('/registrar_respuesta_desafio', [App\Http\Controllers\DesafioController::class, 'registrar_respuesta_desafio'])->name('registrar_respuesta_desafio');

Route::get('/restaurar_contrasena/{id}', [App\Http\Controllers\GestionUsuariosController::class, 'restaurar_contrasena'])->name('restaurar_contrasena');

Route::get('/reiniciar_desafio', [App\Http\Controllers\DesafioController::class, 'reiniciar_desafio'])->name('reiniciar_desafio');

Route::get('/validar_correo/{rut}', [App\Http\Controllers\BrevoController::class, 'validar_correo'])->name('validar_correo');

Route::get('/verificar', [App\Http\Controllers\VerificarController::class, 'verificar'])->name('verificar');

Route::post('/reenviar_correo', [App\Http\Controllers\VerificarController::class, 'reenviar_correo'])->name('reenviar_correo');

