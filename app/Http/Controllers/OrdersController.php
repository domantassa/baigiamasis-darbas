<?php

namespace App\Http\Controllers;

use App\User;
use App\file;
use App\ImageRevision;
use App\Order;
use App\Setting;

use App\FileNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Events\FileCreatedEvent;

use Illuminate\Support\Facades\Mail;
use App\Mail\Notification;
class OrdersController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user=Auth()->user();
        $notif = Auth()
                    ->User()
                    ->notifications()
                    ->get();
        $class='Order';
        $objects='orders';
        $Settings="App\\Setting";

        if(Auth()->User()->position=='admin'){
            $pagination_count=9;    
            if(Setting::where('attribute','pagination_count')->first()){  
                $setting=Setting::where('attribute','pagination_count')
                            ->first(); 
                $pagination_count=$setting->value;
            }
            $class='Order';
            $classes="orders";
            if($request->filter_by || $request->order_by){
                $request->request->add(['class' => $class]);
                $$classes=$this->filter($request);
            }
            else{
                $Class="App\\".$class;   
                $$classes=$Class::where('id','!=','0');
            }
                $orders = $orders->where('state','!=','Projektas kuriamas')
                    ->get();
            return view(
            'orders.admin.index', [
                'user' => Auth()->User(), 
                'users' => User::all(), 
                'orders'=>$orders, 
                'notif' => $notif
            ]);
        }
        
        if(Auth()->User()->position!='admin'){
            $pagination_count=9;    
            if(Setting::where('attribute','pagination_count')->first()){  
                $setting=Setting::where('attribute','pagination_count')
                            ->first(); 
                $pagination_count=$setting->value;
            }
            $class='Order';
            $classes="orders";
            if($request->filter_by || $request->order_by){
                $request->request->add(['class' => $class]);
                $$classes=$this->filter($request);
            }
            else{
                $Class="App\\".$class;   
                $$classes=$Class::where('id','!=','0');
            }
    
        
                $orders = $orders->where('state','!=','Projektas kuriamas')
                ->where('owner_id',Auth()->User()->id)
                    ->paginate($pagination_count);
            return view(
                'orders.user.index', [
                    'user' => Auth()->User(), 
                    'users' => User::all(), 
                    'orders'=>$orders, 
                    'notif' => $notif
                ]);
        }    
    }

    /**
     * Display admin page to upload results
     *
     * @return \Illuminate\Http\Response
     */
    public function uploadResult($id)
    {
        $notif = Auth()
                    ->User()
                    ->notifications()
                    ->get();

        $order=Order::find($id);

        return view(
            'orders.order-result-upload', [
                'user' => Auth()->User(), 
                'users' => User::all(), 
                'order'=>$order, 
                'notif' => $notif
            ]);    
    }

    /**
     * Display admin page to upload results
     *
     * @return \Illuminate\Http\Response
     */
    public function showResults($id)
    {
        $notif = Auth()
                    ->User()
                    ->notifications()
                    ->get();

        $order=Order::find($id);

        $imageRevisions = ImageRevision::where('order_id', $id)
                            ->get();

        $files=file::all();


        return view(
            'orders.order-result-page', [
                'user' => Auth()->User(), 
                'imageRevisions' => $imageRevisions, 
                'users' => User::all(), 
                'order'=>$order,
                'files'=>$files, 
                'notif' => $notif
            ]);    
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function uploadResultStore(Request $request, $id)
    {   



        if(Auth()->User()->position != 'admin')
            abort(404);

        $input=$request->files
                ->all();

        $order=Order::find($id);


        
        $order->comment=$request->comment;
        
        $owner = User::find($order->owner_id);


        $order->save();


        if($input != null)
        {
            foreach($input["files"] as $file)
            {
            $fileName = $file->getClientOriginalName();
            $number = $order->number_of_revisions + 1;
            $order->number_of_revisions = $order->number_of_revisions + 1;
            $order->save();
            $newImageRevision = new ImageRevision;
            $newImageRevision->name =  $file->getClientOriginalName();
            $newImageRevision->path =  $owner->name;
            $newImageRevision->order_id = $order->id;
            $newImageRevision->status = 'revision';
            $newImageRevision->number = $number;
            $newImageRevision->save();
            $newImageRevision->original_id = $newImageRevision->id;
            $newImageRevision->save();
            
            $file->move('storage/'.$owner->name, $fileName);
           }
        }
            $order->save();


            FileNotification::create([
                'user_id' => $order->owner_id,            
                'message' => 'Nauji rezultatai užsakymui '.$order->name.'.',
                'link' => 'orders/'.$order->id.'/edit',
            ]);

            

            $notif = Auth()
                        ->User()
                        ->notifications()
                        ->get();

            $imageRevisions = ImageRevision::where('order_id', $id)
                                ->get();

            return view(
                'orders.order-result-page', [
                    'user' => Auth()->User(), 
                    'imageRevisions' => $imageRevisions, 
                    'users' => User::all(), 
                    'order'=>$order, 
                    'notif' => $notif
                ]);
    }

    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        if(Auth()->User()->remaining < 1)
            abort(404);

        $notif = Auth()
                ->User()
                ->notifications()
                ->get();

        $orders=Order::all();

        return view(
            'orders.create', [
                'user' => Auth()->User(), 
                'users' => User::all(), 
                'orders'=>$orders, 
                'notif' => $notif
            ]);    
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        if(Auth()->User()->remaining < 1)
            abort(404);

        $input=$request->files
                ->all();

        $order=new Order;
        $order->requirements=$request->requirements;
        $order->comment=$request->comment;
        $order->name=$request->title;
        $order->brand=$request->brand;
        $order->result=$request->result;
        $order->feedback=$request->feedback;
        $order->owner_id=Auth()->user()->id;
        $order->state="Projektas kuriamas";
        $order->type=$request->type;
        
        $user=Auth()->user();

        $owner = User::find($order->owner_id);

        $order->save();

        $expected=strtotime($order->created_at)+86400;

        $order->expected_at=date('Y-m-d-H:i:s',$expected);

        $order->save();
        if($input != null)
        {
            foreach($input["files"] as $file)
            {
            $fileName = date('Y-m-d-H-i-s',time()) . '-'.$file->getClientOriginalName();
                
            $naujasFile = new file;
            $naujasFile->name =  $fileName;
            $naujasFile->path =  $owner->name;
            $naujasFile->order_id = $order->id;
            $naujasFile->owner_id = $owner->id;

            $naujasFile->save();
            
            $file->move('storage/'.$owner->name, $fileName);
            $order->file_id=$naujasFile->id;
           }
        }
            $order->save();

            function toLongString(string $str, int $ilg) {
                if(strlen($str) > $ilg) {
                    $strr = substr($str, 0, $ilg-4);
                    $strr .= "...";
                    return $strr;
                }
                else {
                    return $str;
                }
            }

            if($owner->id != 1)
            {
                
                FileNotification::create([
                    'user_id' => 1,
                    'message' => 'Naujas užsakymas nuo '.Auth()->User()->name,
                    'link' => 'orders/'.$order->id.'/edit',
                ]);
                $admin=User::find(1);
                $headers = "Content-Type: text/html; charset=UTF-8\r\n";
                $data=array([
                    'data'=>'Naujas užsakymas nuo '.Auth()->User()->name,
                    'link'=>'orders/'.$order->id.'/edit'
                ]);
            }

            

            $remaining = $owner->remaining;
            $remaining = $remaining - 1;
            $owner->remaining = $remaining;
            $owner->save();
        
            return view(
                'responses.project-new',[
                    'user' => Auth()->User(), 
                    'users' => User::all() , 
                    'notif' => Auth()->User()->notifications()->get() 
                ]);
           
        
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \Clients\file  $file
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order=Order::find($id);
        
        if($order->owner_id== Auth()->User()->id )
        {
            return view(
                'orders.show', [
                    'user' => Auth()->User() , 
                    'users' => User::all() , 
                    'order'=>$order , 
                    'notif' => Auth()->User()->notifications()->get() 
                ]);
        }
        else if(Auth()->User()->position == 'admin')
        {
            return view(
                'orders.show', [
                    'user' => Auth()->User() , 
                    'users' => User::all() , 
                    'order'=>$order , 
                    'notif' => Auth()->User()->notifications()->get() 
                ]);    
        }
        else{
            abort(404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Clients\file  $file
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $order=Order::find($id);
        
        if($order->owner_id== Auth()->User()->id)
        {
            return view(
                'orders.edit', [
                    'user' => Auth()->User() , 
                    'users' => User::all() , 
                    'order'=>$order , 
                    'notif' => Auth()->User()->notifications()->get() 
                ]);
        }
        else if(Auth()->User()->position == 'admin'){
            return view(
                'orders.edit', [
                    'user' => Auth()->User() , 
                    'users' => User::all() , 
                    'order'=>$order , 
                    'notif' => Auth()->User()->notifications()->get() 
                ]);
        }
        else{
            abort(404);
        }
    }
    
    public function dashboard_orders(Request $request){
        $notif = Auth()
                    ->User()
                    ->notifications()
                    ->get();
        
        
        
        if(Auth()->User()->position != 'admin'){
                $pagination_count=9;    
                if(Setting::where('attribute','pagination_count')->first()){  
                    $setting=Setting::where('attribute','pagination_count')
                                ->first(); 
                    $pagination_count=$setting->value;
                }
                $class='Order';
                $classes="orders";
                if($request->filter_by || $request->order_by){
                    $request->request->add(['class' => $class]);
                    $$classes=$this->filter($request);
                }
                else{
                    $Class="App\\".$class;   
                    $$classes=$Class::where('id','!=','0');
                }

            
            $orders = $orders->where('state','Projektas kuriamas')
            ->where('owner_id',Auth()->User()->id)
                ->paginate($pagination_count);
            return view('orders.user.pradzia', [
                    'user' => Auth()->User(), 
                    'users' => User::all(), 
                    'orders'=>$orders, 
                    'notif' => $notif
                ]);   
        }
        if(Auth()->User()->position == 'admin'){
            $pagination_count=9;    
                if(Setting::where('attribute','pagination_count')->first()){  
                    $setting=Setting::where('attribute','pagination_count')
                                ->first(); 
                    $pagination_count=$setting->value;
                }
                $class='Order';
                $classes="orders";
                if($request->filter_by || $request->order_by){
                    $request->request->add(['class' => $class]);
                    $$classes=$this->filter($request);
                }
                else{
                    $Class="App\\".$class;   
                    $$classes=$Class::where('id','!=','0');
                }
            $orders = $orders->where('state','Projektas kuriamas')
                ->get();
            return view('orders.admin.pradzia', [
                'user' => Auth()->User(), 
                'users' => User::all(), 
                'orders'=>$orders, 
                'notif' => $notif
            ]);   
        }
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Clients\file  $file
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
        $input=$request->files->all();
        $order=Order::find($id);
        $order->requirements=$request->requirements;
        $order->comment=$request->comment;
        $order->name=$request->title;
        $order->brand=$request->brand;
        $order->result=$request->result;
        $order->feedback=$request->feedback;
        if(Auth()->User()->position != 'admin') {
            $order->state='Projektas kuriamas';
        } else {
            $order->state=$request->state;
        }

        $order->type=$request->type;
        $order->expected_at= date('Y-m-d H:i:s',strtotime($request->expected_at));
        $owner = User::find($order->owner_id);
        $order->save();
        if($input != null)
        {
            foreach($input["files"] as $file)
            {
            $fileName = $file->getClientOriginalName();
                
            $naujasFile = new file;
            $naujasFile->name =  $file->getClientOriginalName();
            $naujasFile->path =  $owner->name;
            $naujasFile->order_id = $order->id;
            $naujasFile->owner_id = $owner->id;
            $naujasFile->save();
            $file->move('storage/'.$owner->name, $fileName);
            $order->file_id=$naujasFile->id;
           }
        }
            $order->save();

        $user = Auth()->User();

        if($user->id == 1)
            {
                FileNotification::create([
                    'user_id' => $order->owner_id,                 
                    'message' => 'Pakeista užsakymo '.$order->name. ' būsena',
                    'link' => 'orders-dashboard',
                ]);
                $user1=User::find($order->owner_id);
                $headers = "Content-Type: text/html; charset=UTF-8\r\n";
                $data=array(['data'=>'Pakeista užsakymo '.$order->name. ' būsena','link'=>'orders-dashboard']);
                $notif = Auth()->User()->notifications()->get();

                return redirect('dashboard');
                   
            }
            else{
                return view('responses.project-edited',[
                    'user' => Auth()->User(), 
                    'users' => User::all() , 
                    'notif' => Auth()->User()->notifications()->get() 
                ]);
            }
           
        
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Clients\file  $file
     * @return \Illuminate\Http\Response
     */
    public function destroy($file)
    {
        $file = file::find($file);
        $user = User::find($file->owner_id);
        if(Auth()->user()->id == $file->owner_id )
        {
            Storage::deleteDirectory($file->name);
            $file->delete();
            return redirect('dashboard');
        }
        else if( Auth()->user()->position == 'admin'){
            Storage::deleteDirectory($file->name);
            $file->delete();
            return redirect('dashboard');
        }
        return back();
        
       
    }

    public function download($file)
    {
        $file = file::find($file);
        $user = User::find($file->owner_id);
        $notif = Auth()
                    ->User()
                    ->notifications()
                    ->get();
        $files = file::where('owner_id', Auth()->User()->id)
                    ->get();
        if(Auth()->user()->id != $file->owner_id )
        {
            return Storage::download('public/'.$user->name.'/'.$file->name);
        }
        else if(Auth()->user()->position != 'admin'){
            return Storage::download('public/'.$user->name.'/'.$file->name);    
        }
        else{
            return back();
        }
    }
    public function finished($id)
    {
        $order=Order::find($id);
        $order->state='Projektas pabaigtas';
        $order->save();
        FileNotification::create([
            'user_id' => $order->owner_id,                
            'message' => 'Order "'.$order->name.'" finished',
            'link' => 'orders',
        ]);
        $admin=User::find(1);
        $headers = "Content-Type: text/html; charset=UTF-8\r\n";
        $data=array(['data'=>'Order "'.$order->name.'" finished','link'=>'orders']);
        return view('responses.project-finished',[
            'user' => Auth()->User(),
            'order' => $order , 
            'users' => User::all() , 
            'notif' => Auth()->User()->notifications()->get() 
        ]);
    }
    public function feedback_finished(Request $request,$id)
    {
        $order=Order::find($id);
        $order->feedback=$request->feedback;
        $order->save();
        FileNotification::create([
            'user_id' => 1,            
            'message' => 'Order "'.$order->name.'" finished',
            'link' => 'orders',
        ]);
        $admin=User::find(1);
        $headers = "Content-Type: text/html; charset=UTF-8\r\n";
        $data=array([
            'data'=>'Order "'.$order->name.'" finished',
            'link'=>'orders'
        ]);
        
        return view('responses.project-finished-feedback',[
            'user' => Auth()->User(), 
            'users' => User::all() , 
            'notif' => Auth()->User()->notifications()->get() 
        ]);
    }
    public function feedback(Request $request,$id)
    {
        $order=Order::find($id);
        $order->feedback=$request->feedback;
        $order->state="Projektas kuriamas";
        $order->save();
        FileNotification::create([
            'user_id' => 1,                 
            'message' => 'Naujas atsiliepimas užsakymui "'.$order->name.'"',
            'link' => 'orders/'.$id.'/edit',
        ]);
        $headers = "Content-Type: text/html; charset=UTF-8\r\n";
        $admin=User::find(1);
        $data=array([
            'data'=>'Naujas atsiliepimas užsakymui "'.$order->name.'"',
            'link'=>'orders/'.$id.'/edit'
        ]);
          return view('responses.feedback',['user' => Auth()->User() , 'users' => User::all() , 'notif' => Auth()->User()->notifications()->get() ]);
    }


    public function filter($request){
        $user=Auth()->user();

        if(Setting::where('attribute',$user->name.'_'.'order')->first() && !$request->order)
        {
            $setting=Setting::where('attribute',$user->name.'_'.'order')
                        ->first();
            $request->request->add(['order' => $setting->value]);
        
        }
        if(Setting::where('attribute',$user->name.'_'.'order_by')->first() && !$request->order_by)
        {
            $setting=Setting::where('attribute',$user->name.'_'.'order_by')
                        ->first();
            $request->request->add(['order_by' => $setting->value]);
        }
        if(Setting::where('attribute',$user->name.'_'.'filter_by')->first() && !$request->filter_by)
        {   
            $setting=Setting::where('attribute',$user->name.'_'.'filter_by')
                        ->first();
            $request->request->add(['filter_by' => $setting->value]);
        }
        if(Setting::where('attribute',$user->name.'_'.'filter_value')->first() && !$request->filter_value)
        {   
            $setting=Setting::where('attribute',$user->name.'_'.'filter_value')
                        ->first();
            $request->request->add(['filter_value' => $setting->value]);
        }
    if(Setting::where('attribute','pagination_count')->first())
    {  
            $setting=Setting::where('attribute','pagination_count')
                        ->first(); 
            $pagination_count=$setting->value;
    }
    if(Setting::where('attribute','order')->first() && !$request->order)
    {
        $setting=Setting::where('attribute','order')
                            ->first();
        $request->request
                    ->add(['order' => $setting->value]);
    
    }
    if(Setting::where('attribute','order_by')->first() && !$request->order_by)
    {
        $setting=Setting::where('attribute','order_by')->first();
        $request->request
                    ->add(['order_by' => $setting->value]);
    }
    if(Setting::where('attribute','filter_by')->first() && !$request->filter_by)
    {   
        $setting=Setting::where('attribute','filter_by')->first();
        $request->request
                    ->add(['filter_by' => $setting->value]);
    }
    if(Setting::where('attribute','filter_value')->first() && !$request->filter_value)
    {   
        $setting=Setting::where('attribute','filter_value')->first();
        $request->request
                    ->add(['filter_value' => $setting->value]);
    }
    if(!$request->pagination_count)
    {
            $request->request
                        ->add(['pagination_count' => 9]);
    }
    if(!$request->order)
    {
        $request->request
                    ->add(['order' => 'desc']);
    }
    if(!$request->order_by){
        $request->request
                    ->add(['order_by' => 'id']);
    }
    if(!$request->filter_by){
        $request->request
                    ->add(['filter_by' => 'attribute']);
    }
    if(!$request->filter_value){
        $request->request
                    ->add(['filter_value' => '!']);
    }
    if(!$request->filter_operator)
    {
         $request->request
                    ->add(['filter_operator' => '!=']);
    }
    if($request->filter_value=='!'){
        $request->request
                    ->remove('filter_check');
    }
    if($request->filter_value==''){
        $request->request
                    ->remove('filter_check');
    }
    $order=$request->order; 
    $filter_by=$request->filter_by; 
    $filter_value=$request->filter_value;
    $order_by=$request->order_by; 
    $filter_operator=$request->filter_operator;
    $Class="App\\".$request->class;
    $objects=$Class::where('id','!=','0');
   
    if($filter_by == 'user_id' ){
        if( $filter_operator == 'LIKE' && User::where('name',$filter_operator,"%".$filter_value."%")
                                            ->first()){
            $names = User::where('name',$filter_operator,"%".$filter_value."%")
                        ->get();
            $objects=$Class::where('user_id',0)->get();
            foreach($names as $name ){
            $temp=$Class::where('user_id',$name->id)
                    ->get();
            $objects = $objects
                        ->merge($temp);
            }
            
                if($order=='desc'){
                    $sorted = $objects
                        ->sortByDesc($order_by);
                }
                if($order=='asc'){
                    $sorted = $objects
                        ->sortBy($order_by);
                }
                $objects = $sorted->values()->collect();
            return $objects;
        }
        else if( User::where('name',$filter_value)
                    ->first()){
            $name = User::where('name',$filter_value)
                        ->first();
            $filter_value=$name->id;
        }
        
    }
    if($user->position=='admin' && $request->filter_check){
        if($filter_operator=='LIKE' ||$filter_operator=='NOT LIKE') {
            $objects = $Class::where($filter_by,$filter_operator,"%".$filter_value."%");
        }
        else $objects = $Class::where($filter_by,$filter_operator,$filter_value);
    }
    else if($request->filter_check)
    {
        if($filter_operator=='LIKE' || $filter_operator=='NOT LIKE') {
            $objects = $Class::where($filter_by,$filter_operator,"%".$filter_value."%");
        }
        else $objects = $Class::where($filter_by,$filter_operator,$filter_value);
        
        $objects = $objects
                    ->where('owner_id',$user->id);
    }
    if($request->order_check)
    {
        $objects = $objects->orderBy($order_by,$order);
    }
    return $objects;
}
}
