<?php
use App\User;
use App\Events\Message;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\App;


Auth::routes();

Route::prefix('dashboard')->middleware('auth')->group(function(){ 
  Route::get('duk', function(){
    
    return view('duk')->with(['user'=>Auth::user(),'users' =>User::all(),'notif'=>Auth()->User()->notifications()->get()]);
  })->name('duk');

  
  Route::get('chatting', 'ChattingController@chattingWithAdmin')->name('chatting');;

  Route::get('brand', 'BrandController@create')->name('brand');
  Route::get('image-feedback', function() {
    return view('orders/image-feedback')->with(['user'=>Auth::user(),'users' =>User::all(),'notif'=>Auth()->User()->notifications()->get()]);
  });
  Route::get('image-comparer', function() {
    return view('orders/image-comparer')->with(['user'=>Auth::user(),'users' =>User::all(),'notif'=>Auth()->User()->notifications()->get()]);
  });
  Route::post('brands/store', 'BrandController@store')->name('brand.store');
  Route::post('brands/update/{id}', 'BrandController@update')->name('brand.update');
  Route::get('brand/edit/{id}', 'BrandController@edit')->name('brand.edit');
  Route::get('brand/delete/{id}', 'BrandController@destroy')->name('brand.delete');

  Route::get('chatting/{user}', 'ChattingController@index')->name('chattingadmin');

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
  Route::post('orders/feedback-finished/{id}', 'OrdersController@feedback_finished')->name('orders.feedback.finished');
  Route::post('orders/finished/{id}', 'OrdersController@finished')->name('orders.finished');
  Route::post('orders/feedback/{id}', 'OrdersController@feedback')->name('orders.feedback');
  Route::put('orders/feedback/{id}', 'OrdersController@feedback')->name('orders.update');
  Route::post('orders/feedback', 'OrdersController@feedback')->name('orders.store');
  Route::get('orders/show/{id}', 'OrdersController@show')->name('orders.show');   
  Route::resource('orders','OrdersController');

  //Route::get('orders')

  Route::get('orders-dashboard','OrdersController@dashboard_orders')->name('orders.dashboard');
  Route::get('destroy/{file}', 'FileController@destroy')->name('deleteFile');
  Route::match(['get', 'post'], '/', 'ProfilesController@index', ['user' => Auth::user()]);
  Route::post('postmsg','AjaxController@index')->name('postmsg');
  Route::post('postavatar','AjaxController@changeAvatar')->name('postavatar');

 
  
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

Route::get('/lang/{locale}', function($locale){

 Session::put('locale',$locale);
  return back();
})->name('lang');
Route::get('/lang-toggle',function(){
  if(Session::get('locale')!='en'){
  $locale='en';
  }
  if(Session::get('locale')!='lt'){
    $locale='lt';
  }
  Session::put('locale',$locale);
   return back();
 })->name('lang.toggle');
 