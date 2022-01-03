<?php
use App\User;
use App\Events\Message;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
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

/*if(count($users)>0)
{
  Route::get('register','Auth\RegisterController@showRegistrationForm')->name('register')->middleware('admin');
  Route::post('register','Auth\RegisterController@showRegistrationForm')->middleware('admin');;
}*/
Auth::routes();

Route::prefix('dashboard')->middleware('auth')->group(function(){ 
  Route::get('duk', function(){
    
    return view('duk')->with(['user'=>Auth::user(),'users' =>User::all(),'notif'=>Auth()->User()->notifications()->get()]);
  })->name('duk');
  Route::get('chat', function(){
    return view('chat/chat')->with(['user'=>Auth::user(),'users' =>User::all(),'notif'=>Auth()->User()->notifications()->get()]);
  })->name('chat');

  Route::get('chatting', function(){
    return view('chat/chatting')->with(['user'=>Auth::user(),'users' =>User::all(),'notif'=>Auth()->User()->notifications()->get()]);
  })->name('chatting');

  Route::post('/send-message', function() {
    event(new Message(
      $request->input['username'], 
      $request->input['message']));
  });

  Route::post('/deletenotification', 'FileNotificationController@destroy')->name('notifications.destroy');
  Route::get('/deleteNotifications/{user}', 'FileNotificationController@delete')->name('notifications.delete');
  Route::get('files', 'FileController@index')->name('files');
  Route::post('store/{user}', 'FileController@store')->name('upload');
  Route::get('file/{file}', 'FileController@download')->name('download');
  //Route::get('/dashboard/form','OrdersController@index');
  Route::get('orders/preview/{id}', 'OrdersController@preview')->name('orders.preview');
  Route::post('orders/feedback-finished/{id}', 'OrdersController@feedback_finished')->name('orders.feedback.finished');
  Route::post('orders/finished/{id}', 'OrdersController@finished')->name('orders.finished');
  Route::post('orders/feedback/{id}', 'OrdersController@feedback')->name('orders.feedback');
  Route::resource('orders','OrdersController');
  Route::get('orders-dashboard','OrdersController@dashboard_orders')->name('orders.dashboard');
  Route::get('destroy/{file}', 'FileController@destroy')->name('deleteFile');
  Route::match(['get', 'post'], '/', 'ProfilesController@index', ['user' => Auth::user()]);

  
  Route::middleware('admin')->group(function(){ 
    Route::get('users', 'ProfilesController@users')->name('users');
    Route::get('/user/{user}', 'ProfilesController@show')->name('user.show');
    Route::post('/userupdate', 'ProfilesController@update')->name('user.update');
    Route::get('/destroyUser/{user}', 'ProfilesController@destroy')->name('deleteUser');
    Route::get('/delete/{user}', 'ProfilesController@deleteDirectoryFiles')->name('deleteDir');
    Route::match(['get', 'post'], '/{user}', 'ProfilesController@getShow')->name('showUser');

  });
});
Route::get('/', 'ProfilesController@index')->middleware('auth');


