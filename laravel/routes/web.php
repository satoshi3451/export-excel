<?php

use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/','Controller@index');

Route::get('users/export', 'Controller@export')->name('users.export');

// Excelインポート
Route::post('/students_import','StudentsController@import')->name('import');
Route::post('/students_export','StudentsController@export')->name('export'); //追加