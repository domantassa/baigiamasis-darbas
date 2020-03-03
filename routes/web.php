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

// Example Routes

Auth::routes();

Route::get('/', 'ProfilesController@index', ['user' => Auth::user()])->middleware('auth');
Route::get('/dashboard/deleteNotif/{user}', 'FileNotificationController@destroy')->name('deleteNotif');
Route::get('/dashboard/destroyUser/{user}', 'ProfilesController@destroy')->name('deleteUser')->middleware('test');
Route::post('/dashboard/store/{user}', 'FileController@store')->name('upload')->middleware('auth');
Route::get('/dashboard/download/{file}', 'FileController@download')->name('download')->middleware('auth');
Route::get('/dashboard/destroy/{file}', 'FileController@destroy')->name('deleteFile')->middleware('auth');
Route::get('/dashboard/delete/{user}', 'ProfilesController@deleteDirectoryFiles')->name('deleteDir')->middleware('test');
Route::match(['get', 'post'], '/dashboard/{user}', 'ProfilesController@getShow', ['user' => Auth::user()])->name('showUser')->middleware('test');
Route::match(['get', 'post'], '/dashboard', 'ProfilesController@index', ['user' => Auth::user()])->middleware('auth');
Route::get('users', 'ProfilesController@users', ['user' => Auth::user()])->name('users')->middleware('test');


//Route::post('/dashboard/sendMessage', 'ChatkitController@sendMessage')->middleware('auth');


//Route::get('/testavimas', 'ChatkitController@index');
//Route::post('/testavimas', 'ChatkitController@join');


//Route::get('eventas', function(){
 //   event(new App\Events\NewMessageOrFile('message','sender', 'receiver'));
//});


//Route::view('/', 'landing');
//Route::match(['get', 'post'], '/dashboard', function(){
  //  return view('dashboard');
//});
//Route::view('/pages/slick', 'pages.slick');
//Route::view('/pages/datatables', 'pages.datatables');
//Route::view('/pages/blank', 'pages.blank');
