<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Comunacontroller; // Importa el controlador Comunacontroller
use App\Models\Comuna;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/comuna', [Comunacontroller::class, 'index']) ->name ('comuna.index');
Route ::post('/comuna',[Comunacontroller :: class, 'store']) -> name ('comuna.store'); 
Route ::get ('/comuna/create',[Comunacontroller :: class, 'create']) -> name ('comuna.create');
Route :: delete ('/comuna/{comuna}',[Comunacontroller :: class, 'destroy']) -> name ('comuna.destroy');
// Ruta para mostrar el listado de comunas