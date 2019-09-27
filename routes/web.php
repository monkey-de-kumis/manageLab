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

Route::get('/', function () {
    return view('home');
});

Route::get('components', function (){
  return view('master');
});

Route::resource('/satuan', 'UnitController',['except'=>'create', 'show']);
Route::resource('/penetapan', 'ActivityController',['except'=>'create', 'show']);
Route::resource('/kemasan', 'PackageController',['except'=>'create', 'show']);
Route::resource('/tocsin', 'TocsinController',['except'=>'create', 'show']);
Route::resource('/bahan', 'MaterialController',['except'=>'create', 'show']);
Route::resource('/stocks', 'StockController',['except'=>'create', 'show']);
Route::resource('/kimia', 'ChemicalsController');
//Route::group(['middleware' => ['role:operator']], function(){
  Route::get('/kegiatan', 'AnalysisController@addAnalys')->name('analisa.kegiatan');
  Route::get('/checkout', 'AnalysisController@checkout')->name('analisa.checkout');
  Route::post('/checkout', 'AnalysisController@storeAnalysis')->name('analisa.storeOrder');
//});
Route::get('/home', 'HomeController@index')->name('home');
