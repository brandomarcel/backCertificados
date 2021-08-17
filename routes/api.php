<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\usuarios;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


//Route::get('devuelveUsuarios', 'usuarios@devuelveUsuarios');
Route::get('devuelveUsuarios',[usuarios::class, 'devuelveUsuarios']);
Route::get('devuelvecursosxUsuario/{usuario}',[usuarios::class, 'devuelvecursosxUsuario']);
Route::get('credenciales/{usuario}/{password}',[usuarios::class, 'credenciales']);
Route::get('devuelvecertificadosxcurso/{idCurso}',[usuarios::class, 'devuelvecertificadosxcurso']);

