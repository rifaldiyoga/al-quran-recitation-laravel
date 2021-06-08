<?php

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

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

//frontend

Route::get('/', 'HomeController@index')
    ->name('home');

//Surah

Route::get('/surah', 'SurahController@index')
    ->name('surah');
Route::get('/surah/{id}', 'SurahController@showDetail')
    ->name('surah.detail');
Route::post('/surah/bookmark', 'SurahController@saveLastRead')
    ->name('surah.bookmark')->middleware('auth');

//grup

Route::get('/grup/detail/{slug}', 'GrupController@detail')->middleware('auth')->name('grup.detail');
Route::resource('grup', 'GrupController')->middleware('auth');

// Route::get('/surah/{id}/{id}', 'SurahController@saveLastRead')->name('last-read');

//kemajuan belajar
Route::get('/kemajuan-belajar', 'KemajuanBelajarController@index')
    ->name('kemajuan-belajar')->middleware('auth');

//admin

Route::prefix('admin')
    ->namespace('Admin')
    ->middleware('auth','admin')
    ->group(function(){
        Route::get('/', 'DashboardController@index')
            ->name('dashboard');
        
        Route::resource('group-ngaji', 'GroupNgajisController');
    });

Auth::routes();