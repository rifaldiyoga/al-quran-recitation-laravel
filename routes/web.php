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

    Route::get('/dashboard', 'DashboardController@index')
    ->name('dashboard');

//Surah

Route::get('/surah', 'SurahController@index')
    ->name('surah');
Route::get('/surah/{id}', 'SurahController@showDetail')
    ->name('surah.detail');
Route::post('/surah/bookmark', 'SurahController@saveLastRead')
    ->name('surah.bookmark')->middleware('auth');

//grup

Route::get('/grup/detail/{slug}/list', 'GrupController@listMember')->middleware('auth')->name('grup.listMember');
Route::get('/grup/detail/{slug}', 'GrupController@detail')->middleware('auth')->name('grup.detail');
Route::get('/grup/detail/{slug}/setor', 'GrupController@setorCreate')->middleware('auth')->name('grup.setorCreate');
Route::post('/grup/detail/{slug}/setor', 'GrupController@setorStore')->middleware('auth')->name('grup.setorStore');
Route::post('/grup/{slug}', 'GrupController@join')->middleware('auth')->name('grup.join');
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