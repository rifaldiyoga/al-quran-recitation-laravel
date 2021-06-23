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
Route::post('/grup/detail/{slug}/list', 'GrupController@updateRole')->middleware('auth')->name('grup.updateRole');
Route::get('/grup/detail/{slug}', 'GrupController@detail')->middleware('auth')->name('grup.detail');
Route::get('/grup/detail/{slug}/setor', 'GrupController@setorCreate')->middleware('auth')->name('grup.setorCreate');
Route::post('/grup/detail/{slug}/setor', 'GrupController@setorStore')->middleware('auth')->name('grup.setorStore');
Route::post('/grup/{slug}', 'GrupController@join')->middleware('auth')->name('grup.join');
Route::post('/grup/invite/{slug}', 'GrupController@inviteMember')->middleware('auth')->name('grup.inviteMember');
Route::resource('grup', 'GrupController')->middleware('auth');

// Route::get('/surah/{id}/{id}', 'SurahController@saveLastRead')->name('last-read');

//kemajuan belajar
Route::get('/kemajuan-belajar', 'KemajuanBelajarController@index')
    ->name('kemajuan-belajar')->middleware('auth');
    Route::get('/kemajuan-belajar/{slug}', 'KemajuanBelajarController@progresGrup')
    ->name('kemajuan-belajar.grup')->middleware('auth');

//setoran
Route::get('/setoran-bacaan', 'SetoranBacaanController@index')
    ->name('setoran.index')->middleware('auth');
Route::get('/setoran-bacaan/search', 'SetoranBacaanController@search')
    ->name('setoran.search')->middleware('auth');
Route::post('/setoran-bacaan', 'SetoranBacaanController@updateStatus')
    ->name('setoran.status')->middleware('auth');

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