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

//LARAVEL
// Route::get('/', function () {
//     return view('reference');
// });

Route::group(['middleware' => ['auth']], function() {
    Route::get('/', 'ReferenceController@reference');
});

//HISTORYCAL
Route::get('/historycal', ['uses'=>'HistorycalController@index', 'as'=>'historycal.index']);
Route::resource('historycal', 'HistorycalController');
Route::post('/historycal/update', 'HistorycalController@update')->name('historycal.update');
Route::post('/historycal/autofill_editor', 'HistorycalController@autofill_editor')->name('historycal.autofill_editor');
Route::get('/historycal/autocomplete', 'HistorycalController@autocomplete')->name('historycal.autocomplete');
Route::post('/historycal/booth', 'HistorycalController@booth')->name('historycal.booth');

//REPORT
Route::get('/report', 'ReportController@report');
Route::get('/report/fetch_data', 'ReportController@fetch_data')->name('report.fetch_data');


Route::get('/test', 'TestController@test');
Route::get('/test/fetch_data_test', 'TestController@fetch_data_test')->name('test.fetch_data_test');


//REFERENCE
Route::get('/reference/store_R', 'ReferenceController@store_R');
Route::post('/reference/fetch', 'ReferenceController@fetch')->name('reference.fetch');
Route::post('/reference/fetchs', 'ReferenceController@fetchs')->name('reference.fetchs');
Route::post('/reference/autofill', 'ReferenceController@autofill')->name('reference.autofill');
Route::get('/reference/search', ['uses'=>'ReferenceController@search', 'as'=>'reference.search']);
Route::post('/reference/autofill_editor', 'ReferenceController@autofill_editor')->name('reference.autofill_editor');
Route::get('/reference/autocomplete', 'ReferenceController@autocomplete')->name('reference.autocomplete');
Route::post('/reference/booth', 'ReferenceController@booth')->name('reference.booth');

//NON - REFERENCE
Route::get('/non_reference', 'NonReferenceController@non_reference');
Route::get('/non_reference/store_NR', 'NonReferenceController@store_NR');
Route::post('/non_reference/fetch_NR', 'NonReferenceController@fetch_NR')->name('non_reference.fetch_NR');
Route::post('/non_reference/fetchs_NR', 'NonReferenceController@fetchs_NR')->name('non_reference.fetchs_NR');
Route::post('/non_reference/autofill_NR', 'NonReferenceController@autofill_NR')->name('non_reference.autofill_NR');
Route::get('/non_reference/autocomplete', 'NonReferenceController@autocomplete')->name('non_reference.autocomplete');
Route::post('/non_reference/booth', 'NonReferenceController@booth')->name('non_reference.booth');

Route::get('/non_reference/search_N', ['uses'=>'NonReferenceController@search_N', 'as'=>'non_reference.search_N']);
Route::post('/non_reference/autofill_editorNR', 'NonReferenceController@autofill_editorNR')->name('non_reference.autofill_editorNR');

//LOGIN SSO
Route::get('/loginSSO', 'LoginController@loginSSO')->name('login');
Route::get('/callback', 'LoginController@callback');
Route::get('/logout', 'LoginController@logout');
Route::post('/logout', 'LoginController@logout')->name('logout');