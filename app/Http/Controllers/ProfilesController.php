<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\User;
use App\file;
use App\Setting;
use App\FileNotification;



class ProfilesController extends Controller
{

    public function __construct()
    {
        
        $expiresAt = now()->addMinutes(5);
        $now = now();
    }


    public function index(Request $request)
    {
            $notif = Auth()->User()->notifications()->get();

            $class='User';
            $objects='users';
            $Settings="App\\Setting";
            if($request->filter_by || $request->order_by){
                dd($request);
                $request->request
                            ->add(['class' => $class]);
                $$objects=$this
                            ->filter($request);
            }
            else{
                $Class="App\\".$class;
                $pagination_count=9;    
                if($Settings::where('attribute','pagination_count')->first())
                {  
                    $setting=$Settings::where('attribute','pagination_count')
                                ->first(); 
                    $pagination_count=$setting->value;
                }
                $$objects=$Class::paginate($pagination_count);
            }
            $user = Auth()->User();
            
            if($user->refresh_date != null)
            {
                $plan = $user->plan;
                $refresh_date = $user->refresh_date;
                
                $refresh_dateTime = strtotime($refresh_date);
                $nowTime = time();
                $remaining = 8;
                if($refresh_dateTime - $nowTime < 0)
                {
                    if($plan == 'Hidrosfera')
                    {
                        $remaining = 12;
                    }
                    else if ($plan == 'Ekosfera')
                    {
                        $remaining = 20;
                    }
                    else if ($plan== 'Atmosfera')
                    {
                        $remaining = 40;
                    }
                    $user->remaining = $remaining;
                    
                    $refresh_date=date('Y-m-d H:i:s',$refresh_dateTime+2592000);
                    $user->refresh_date = $refresh_date;
                
                    $user->save();
                }
            }
            $class='file';
            $objects='files';
            $Settings="App\\Setting";
            if($request->filter_by || $request->order_by){
                $request->request->add(['class' => $class]);
                $$objects=$this->filter($request);
            }
            else{
                $Class="App\\".$class;
                $pagination_count=9;    
                if($Settings::where('attribute','pagination_count')->first())
                {  
                    $setting=$Settings::where('attribute','pagination_count')
                                ->first(); 
                    $pagination_count=$setting->value;
                }
                $$objects=$Class::paginate($pagination_count);
            }
            
            return view(
                'dashboard', [
                    'user' => Auth()->User(), 
                    'users' =>$users, 
                    'files' =>$files,
                    'notif' => $notif,
            ]);
        

       
    }

    public function getShow($id,Request $request)
    {
        
        $user = User::findOrFail($id);

        $notif = Auth()
                    ->User()
                    ->notifications()
                    ->get();

        $class='file';
        $objects='files';
        $Settings="\App\Setting";
        if($request->filter_by || $request->order_by){
            $request->request
                        ->add(['class' => $class]);
            $$objects=$this
                        ->filter($request);
        }
        else{
            $Class="App\\".$class;
            $pagination_count=9;    
            if($Settings::where('attribute','pagination_count')->first())
            {  
                $setting=$Settings::where('attribute','pagination_count')
                            ->first(); 
                $pagination_count=$setting->value;
            }
            $$objects=$Class::paginate($pagination_count);
        }

        $files= $files->where('owner_id',$user->id);
        return view(
            'dashboard', [
                'user' => $user, 
                'users' => User::all(), 
                'files'=>$files, 
                'notif' => $notif
            ]);
    }


    public function deleteDirectoryFiles($user)
    {
        
        $user = User::findOrFail($user);
        Storage::deleteDirectory('public/'.$user->name);
        Storage::makeDirectory('public/'.$user->name);
        
        $file = file::where('owner_id', $user->id)
                    ->take(file::where('owner_id', $user->id)
                    ->count());
            $file->delete();

        return redirect('dashboard');
    }

    public function destroy($user)
    {
        $user = User::find($user);

        $files = $user->files()
                    ->get();

        $orders = $user->orders()
                    ->get();

        $brands = $user->brands()
                    ->get();

        $notifications = $user
                            ->notifications()
                            ->get();

        if(count($files) > 0) 
        {
            $user->files()
                    ->delete();
        }
        if(count($brands) > 0) 
        {
            $user->brands()
                    ->delete();
        }
        if(count($orders) > 0)
        {
            $user->orders()
                    ->delete();
        }
        if(count($notifications) > 0)
        {
            $user->notifications()
                    ->delete();
        }
        $user->delete();
        Storage::deleteDirectory($user->name);
        return redirect('dashboard/users');
    }

    public function update(Request $request)
    {
        $user=User::find($request->id);
        $user->name=$request->name;
        $user->email=$request->email;
        $user->plan=$request->plan;
        $user->remaining=$request->remaining;
        $user->refresh_date = $request->refresh_date;
        $user->save();
        $notif = Auth()
                    ->User()
                    ->notifications()
                    ->get();
        $files = file::where('owner_id', Auth()->User()->id)
                    ->get();
        
        return view(
            'users', [
                'user' => Auth()->User(), 
                'users' => User::all(), 
                'files'=>$files, 
                'notif' => $notif
            ]);
    }

    public function show($user)
    {
        $user = User::find($user);
        return view(
            'auth.edit', [
                'user' => $user
            ]);
    }

    public function users(Request $request)
    {
        
        $class='User';
            $objects='users';
            $Settings="App\\Setting";
            if($request->filter_by || $request->order_by){
                $request->request
                            ->add(['class' => $class]);
                $$objects=$this
                            ->filter($request);
            }
            else{
                $Class="App\\".$class;
                $pagination_count=9;    
                if($Settings::where('attribute','pagination_count')->first())
                {  
                    $setting=$Settings::where('attribute','pagination_count')
                                ->first(); 
                    $pagination_count=$setting->value;
                }
                $$objects=$Class::paginate($pagination_count);
            }

        $notif = Auth()
                    ->User()
                    ->notifications()
                    ->get();
            
            
        $files = file::where(
            'owner_id', 
            Auth()->User()->id
            )->get();
            
        return view('users', [
                'user' => Auth()->User(), 
                'users' => $users, 
                'files'=>$files, 
                'notif' => $notif
            ]);
    }

    public function filter($request){
        $user=Auth()->user();
        $pagination_count=9;
        if(Setting::where('attribute',$user->name.'_'.'pagination_count')->first())
        {  
                $setting=Setting::where('attribute',$user->name.'_'.'pagination_count')
                            ->first(); 
                $pagination_count=$setting->value;
        }
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
        $request->request->add(['order' => $setting->value]);
    
    }
    if(Setting::where('attribute','order_by')->first() && !$request->order_by)
    {
        $setting=Setting::where('attribute','order_by')->first();
        $request->request->add(['order_by' => $setting->value]);
    }
    if(Setting::where('attribute','filter_by')->first() && !$request->filter_by)
    {   
        $setting=Setting::where('attribute','filter_by')
                    ->first();
        $request->request->add(['filter_by' => $setting->value]);
    }
    if(Setting::where('attribute','filter_value')->first() && !$request->filter_value)
    {   
        $setting=Setting::where('attribute','filter_value')
                    ->first();
        $request
            ->request
            ->add(['filter_value' => $setting->value]);
    }
    if(!$request->pagination_count)
    {
            $request
                ->request
                ->add(['pagination_count' => 9]);
    }
    if(!$request->order)
    {
        $request
            ->request
            ->add(['order' => 'desc']);
    }
    if(!$request->order_by){
        $request
            ->request
            ->add(['order_by' => 'id']);
    }
    if(!$request->filter_by){
        $request
            ->request
            ->add(['filter_by' => 'attribute']);
    }
    if(!$request->filter_value){
        $request
            ->request
            ->add(['filter_value' => '!']);
    }
    if(!$request->filter_operator)
    {
         $request
            ->request
            ->add(['filter_operator' => '!=']);
    }
    if($request->filter_value=='!'){
        $request
            ->request
            ->remove('filter_check');
    }
    if($request->filter_value==''){
        $request
            ->request
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
        if( $filter_operator == 'LIKE' && User::where('name',$filter_operator,"%".$filter_value."%")->first()){
            $names = User::where('name',$filter_operator,"%".$filter_value."%")
                        ->get();
            $objects=$Class::where('user_id',0)
                ->get();
            foreach($names as $name )
            {
                $temp=$Class::where('user_id',$name->id)
                        ->get();
                $objects = $objects->merge($temp);
            }
            
                if($order=='desc'){
                    $sorted = $objects->sortByDesc($order_by);
                }
                if($order=='asc'){
                    $sorted = $objects->sortBy($order_by);
                }
                $objects = $sorted->values()
                            ->collect();
            $objects = $objects->paginate($pagination_count)
                        ->appends([
                            'order_by'=>$order_by,
                            'order'=>$order,
                            'filter_by'=>$filter_by,
                            'filter_value'=>$filter_value,
                            'filter_operator'=>$filter_operator
                        ]);        
            return $objects;
        }
        else if( User::where('name',$filter_value)->first()){
            $name = User::where('name',$filter_value)
                        ->first();
            $filter_value=$name->id;
        }
        
    }


    if($user->position=='admin' && $request->filter_check){
        if($filter_operator=='LIKE' ) {
            $objects = $Class::where($filter_by,$filter_operator,"%".$filter_value."%");
        }
        else $objects = $Class::where($filter_by,$filter_operator,$filter_value);
    }
    else if($request->filter_check)
    {
        if($filter_operator=='LIKE' ) {
            $objects = $Class::where($filter_by,$filter_operator,"%".$filter_value."%");
        }
        else $objects = $Class::where($filter_by,$filter_operator,$filter_value);
        
        $objects = $objects->where('owner_id',$user->id);
    }
    $objects
        ->orderBy($order_by,$order);
    $objects = $objects
                ->paginate($pagination_count)
                ->appends([
                    'order_by'=>$order_by,
                    'order'=>$order,
                    'filter_by'=>$filter_by,
                    'filter_value'=>$filter_value,
                    'filter_operator'=>$filter_operator
                ]);
    return $objects;
}
}

