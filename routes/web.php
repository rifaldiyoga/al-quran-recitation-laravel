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

Route::get('/', 'HomeController@index')->name('home');
Route::get('/surah', 'SurahController@index')->name('surah');
Route::get('/surah/{id}', 'SurahController@showDetail')->name('detail-surah');



//admin/

Route::prefix('admin')
    ->namespace('Admin')
    ->middleware('auth','admin')
    ->group(function(){
        Route::get('/', 'DashboardController@index')
            ->name('dashboard');
        
        Route::resource('group-ngaji', 'GroupNgajisController');
    });

Auth::routes();