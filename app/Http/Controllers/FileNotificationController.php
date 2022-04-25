<?php

namespace App\Http\Controllers;

use App\FileNotification;
use Illuminate\Http\Request;
use App\User;

class FileNotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $class='FileNotification';
        $objects='notifications';
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
                $setting=$Settings::where('attribute','pagination_count')->first(); 
                $pagination_count=$setting->value;
            }
            $$objects=$Class::paginate($pagination_count);
        }
        $notif = Auth()->User()->notifications()->get();
        return view('notifications.index',[
                'notifications'=>$notif,
                'user' => Auth()->User(), 
                'users' => User::all(), 
                'notif' => $notif
        ]);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \Clients\FileNotification  $fileNotification
     * @return \Illuminate\Http\Response
     */

    public function destroy(Request $request)
    {
        $fileNotification = FileNotification::where('id', $request->notification)->take(1);
        $fileNotification->delete();
        return (redirect('/dashboard/'.$request->link));
        
    }

    public function delete($user)
    {
        $fileNotification = FileNotification::where('user_id', $user)->take(FileNotification::where('user_id', $user)->count());
        $fileNotification->delete();
        return back();
        
    }
    public function filter($request){
        $user=Auth()->user();
        $pagination_count=9;
        if(Setting::where('attribute',$user->name.'_'.'pagination_count')->first())
        {  
                $setting=Setting::where('attribute',$user->name.'_'.'pagination_count')->first(); 
                $pagination_count=$setting->value;
        }
        if(Setting::where('attribute',$user->name.'_'.'order')->first() && !$request->order)
        {
            $setting=Setting::where('attribute',$user->name.'_'.'order')->first();
            $request->request->add(['order' => $setting->value]);
        
        }
        if(Setting::where('attribute',$user->name.'_'.'order_by')->first() && !$request->order_by)
        {
            $setting=Setting::where('attribute',$user->name.'_'.'order_by')->first();
            $request->request->add(['order_by' => $setting->value]);
        }
        if(Setting::where('attribute',$user->name.'_'.'filter_by')->first() && !$request->filter_by)
        {   
            $setting=Setting::where('attribute',$user->name.'_'.'filter_by')->first();
            $request->request->add(['filter_by' => $setting->value]);
        }
        if(Setting::where('attribute',$user->name.'_'.'filter_value')->first() && !$request->filter_value)
        {   
            $setting=Setting::where('attribute',$user->name.'_'.'filter_value')->first();
            $request->request->add(['filter_value' => $setting->value]);
        }
    if(Setting::where('attribute','pagination_count')->first())
    {  
            $setting=Setting::where('attribute','pagination_count')->first(); 
            $pagination_count=$setting->value;
    }
    if(Setting::where('attribute','order')->first() && !$request->order)
    {
        $setting=Setting::where('attribute','order')->first();
        $request->request->add(['order' => $setting->value]);
    
    }
    if(Setting::where('attribute','order_by')->first() && !$request->order_by)
    {
        $setting=Setting::where('attribute','order_by')->first();
        $request->request->add(['order_by' => $setting->value]);
    }
    if(Setting::where('attribute','filter_by')->first() && !$request->filter_by)
    {   
        $setting=Setting::where('attribute','filter_by')->first();
        $request->request->add(['filter_by' => $setting->value]);
    }
    if(Setting::where('attribute','filter_value')->first() && !$request->filter_value)
    {   
        $setting=Setting::where('attribute','filter_value')->first();
        $request->request->add(['filter_value' => $setting->value]);
    }
    if(!$request->pagination_count)
    {
            $request->request->add(['pagination_count' => 9]);
    }
    if(!$request->order)
    {
        $request->request->add(['order' => 'desc']);
    }
    if(!$request->order_by){
        $request->request->add(['order_by' => 'id']);
    }
    if(!$request->filter_by){
        $request->request->add(['filter_by' => 'attribute']);
    }
    if(!$request->filter_value){
        $request->request->add(['filter_value' => '!']);
    }
    if(!$request->filter_operator)
    {
         $request->request->add(['filter_operator' => '!=']);
    }
    if($request->filter_value=='!'){
        $request->request->remove('filter_check');
    }
    if($request->filter_value==''){
        $request->request->remove('filter_check');
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
            $names = User::where('name',$filter_operator,"%".$filter_value."%")->get();
            $objects=$Class::where('user_id',0)->get();
            foreach($names as $name ){
            $temp=$Class::where('user_id',$name->id)->get();
            $objects = $objects->merge($temp);
            }
            
                if($order=='desc'){
                    $sorted = $objects->sortByDesc($order_by);
                }
                if($order=='asc'){
                    $sorted = $objects->sortBy($order_by);
                }
                $objects = $sorted->values()->collect();
            $objects = $objects->paginate($pagination_count)->appends([
                'order_by'=>$order_by,
                'order'=>$order,
                'filter_by'=>$filter_by,
                'filter_value'=>$filter_value,
                'filter_operator'=>$filter_operator
            ]);        
            return $objects;
        }
        else if( User::where('name',$filter_value)->first()){
            $name = User::where('name',$filter_value)->first();
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
        
        $objects = $objects->where('owner_id',$user->id);
    }
    $objects->orderBy($order_by,$order);
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
