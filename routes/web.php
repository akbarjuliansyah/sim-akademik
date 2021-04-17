<?php

use App\Http\Controllers\StudentsController;
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

Route::get('/dashboard-admin', 'DashboardController@index')->name('dashboard-admin');


Route::get('/daftar-siswa', 'StudentsController@index')->name('daftar-siswa');
Route::post('/daftar-siswa', 'StudentsController@store')->name('store-siswa');
Route::delete('/daftar-siswa/{student}', 'StudentsController@destroy')->name('destroy-siswa');
Route::get('/daftar-siswa/edit/{student}/show', 'StudentsController@edit')->name('edit-siswa');
Route::patch('/daftar-siswa/edit/{student}/update', 'StudentsController@update')->name('update-siswa');

Route::get('/daftar-guru', 'TeachersController@index')->name('daftar-guru');
Route::post('/daftar-guru', 'TeachersController@store')->name('store-guru');
Route::delete('/daftar-guru/{teacher}', 'TeachersController@destroy')->name('destroy-guru');
Route::get('/daftar-guru/edit/{teacher}/show', 'TeachersController@edit')->name('edit-guru');
Route::patch('/daftar-guru/edit/{teacher}/update', 'TeachersController@update')->name('update-guru');

Route::get('/daftar-pelajaran', 'CoursesController@index')->name('daftar-pelajaran');
Route::post('/daftar-pelajaran', 'CoursesController@store')->name('store-pelajaran');
Route::delete('/daftar-pelajaran/{course}', 'CoursesController@destroy')->name('destroy-pelajaran');
Route::get('/daftar-pelajaran/edit/{course}/show', 'CoursesController@edit')->name('edit-pelajaran');
Route::patch('/daftar-pelajaran/edit/{course}/update', 'CoursesController@update')->name('update-pelajaran');


Route::get('/daftar-kelas', 'ClassroomsController@index')->name('daftar-kelas');
Route::post('/daftar-kelas', 'ClassroomsController@store')->name('store-kelas');
Route::get('/daftar-kelas/create', 'ClassroomsController@create')->name('create-kelas');
Route::delete('/daftar-kelas/{classroom}', 'ClassroomsController@destroy')->name('destroy-kelas');
Route::get('/daftar-kelas/edit/{classroom}/show', 'ClassroomsController@edit')->name('edit-kelas');
Route::patch('/daftar-kelas/edit/{classroom}/update', 'ClassroomsController@update')->name('update-kelas');
