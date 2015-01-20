<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return View::make('hello');
});

$homeCtrl = 'HomeController';
Route::get('/showview', ['uses' => $homeCtrl . '@showview']); 
Route::get('/simplejson', ['uses' => $homeCtrl . '@simplejson']); 
Route::get('/simpleeloquent/{numIteration}', ['uses' => $homeCtrl . '@simpleeloquent']); 
Route::get('/simplepdo/{numIteration}', ['uses' => $homeCtrl . '@simplepdo']); 
