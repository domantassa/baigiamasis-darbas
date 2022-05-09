<?php
use App\User;
use App\Events\Message;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\App;

//PA26
Auth::routes();

Route::prefix('dashboard')->middleware('auth')->group(function(){ 
  Route::get('calendar', function(){
    return view('widgets.calendarPage')->with(['user'=>Auth::user(),'users' =>User::all(),'notif'=>Auth()->User()->notifications()->get()]);
  })->name('calendar');
  Route::post('calendar', 'Controller@calendar_update')->name('calendar.update');
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

  //PA21
  Route::get('chatting/{user}', 'ChattingController@index')->name('chattingadmin');

  Route::post('/send-message', function() {
    event(new Message(
      $request->input['username'], 
      $request->input['message']));
  });
  //end PA21

  Route::get('/deletenotification/{notification}', 'FileNotificationController@destroy')->name('notifications.destroy');
  Route::get('visit/notification/{notification}', 'FileNotificationController@visit')->name('notifications.visit');
  //PA11
  Route::get('/deleteNotifications/{user}', 'FileNotificationController@delete')->name('notifications.delete');
  Route::get('files', 'FileController@index')->name('files');
  Route::post('store/{user}', 'FileController@store')->name('upload');
  Route::get('file/{file}', 'FileController@download')->name('download');
  Route::get('brandfile/{file}', 'FileController@brandDownload')->name('brands.download');
  Route::post('orders/feedback-finished/{id}', 'OrdersController@feedback_finished')->name('orders.feedback.finished');
  Route::post('orders/finished/{id}', 'OrdersController@finished')->name('orders.finished');
  Route::post('orders/feedback/{id}', 'OrdersController@feedback')->name('orders.feedback');
  
  Route::post('orders/store', 'OrdersController@store')->name('orders.store');
  Route::get('orders/show/{id}', 'OrdersController@show')->name('orders.show');
  Route::get('orders/results/{id}', 'OrdersController@showResults')->name('orders.show-results');   

  //PA12
  Route::get('orders','OrdersController@index')->name('orders.index');
  Route::get('orders/{order}/edit','OrdersController@edit')->name('orders.edit');
  Route::get('orders/create','OrdersController@create')->name('orders.create');
  Route::get('orders/{id}','OrdersController@show')->name('orders.show');
  Route::put('orders/update/{id}', 'OrdersController@update')->name('orders.update');

  Route::delete('orders/{order}','OrdersController@destroy')->name('orders.destroy');

  Route::get('/delete/image-revision/{orderId}/{imageRevisionId}', 'ImageRevisionController@destroy')->name('imageRevision.destroy');
  Route::get('/download/image-revision/{orderId}/{imageRevisionId}', 'ImageRevisionController@download')->name('imageRevision.download');
  Route::get('/edit/image-revision/{imageRevisionId}', 'ImageCommentController@edit')->name('imageComment.edit');
  Route::post('/store/image-revision/{imageRevisionId}', 'ImageCommentController@store')->name('imageComment.store');
  Route::get('/create/image-revision/new-upload/{imageRevisionId}', 'ImageRevisionController@createNewUpload')->name('imageRevision.createNewUpload');
  Route::post('/store/image-revision/new-upload/{imageRevisionId}', 'ImageRevisionController@storeNewUpload')->name('imageRevision.storeNewUpload');
  Route::get('/select/image-revision/{id}', 'ImageRevisionController@select')->name('imageRevision.select');

  Route::get('orders-dashboard','OrdersController@dashboard_orders')->name('orders.dashboard');
  Route::get('destroy/{file}', 'FileController@destroy')->name('deleteFile');
  Route::match(['get', 'post'], '/', 'ProfilesController@index', ['user' => Auth::user()]);
  Route::post('postmsg','AjaxController@index')->name('postmsg');
  //PA12
  Route::post('postavatar','AjaxController@changeAvatar')->name('postavatar');
  Route::get('notifications','FileNotificationController@index')->name('notifications.index');
  Route::get('brands/create','BrandController@create')->name('brands.create');

  Route::middleware('admin')->group(function(){ 
    Route::get('users', 'ProfilesController@users')->name('users');
    Route::get('/user/{user}', 'ProfilesController@show')->name('user.show');
    Route::post('/userupdate', 'ProfilesController@update')->name('user.update');
    Route::get('/destroyUser/{user}', 'ProfilesController@destroy')->name('deleteUser');
    Route::get('/delete/{user}', 'ProfilesController@deleteDirectoryFiles')->name('deleteDir');
    Route::get('orders/upload-result/{id}', 'OrdersController@uploadResult')->name('upload-orders-result');
    Route::post('orders/upload-result/{id}', 'ImageRevisionController@store')->name('upload-order-result-store');
    Route::get('settings/create','SiteSettingsController@create')->name('settings.create');
    Route::get('settings/{id}/edit','SiteSettingsController@edit')->name('settings.edit');
    Route::post('settings/store','SiteSettingsController@store')->name('settings.store');
    Route::get('/settings','SiteSettingsController@index')->name('settings.index');
    Route::put('settings/{id}/update','SiteSettingsController@update')->name('settings.update');
    Route::delete('settings/{id}/delete','SiteSettingsController@destroy')->name('settings.destroy');
  

    Route::post('store/finalResult/{order}', 'FileController@storeFinalResult')->name('uploadFinalResult');
    Route::get('brands','BrandController@index')->name('brands.index');
    
    
  
  
    Route::match(['get', 'post'], '/{user}', 'ProfilesController@getShow')->name('showUser');
   
  
  
  
  });
});
Route::get('/', 'ProfilesController@index')->middleware('auth');

//PA13
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
 //end PA13