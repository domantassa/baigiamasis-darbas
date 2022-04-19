<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use App\Order;
use App\Setting;
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    public function calendar_update(Request $request){
        $month=(int)$request->M;
        $year=(int)$request->Y;
        $user=Auth()->user();
        if($user->position == 'admin'){
            $orders=Order::all();  
        }
        else
        {
            $orders=Order::where('owner_id',$user->id)->get();
        }

        return  view('widgets.calendar',['M'=>$month,'Y'=>$year,'events'=>$orders]);
    }
    public function sort($request){
                $user=Auth()->user();
        if(Setting::where('attribute','order_by')->first() && !$request->order_by)
        {
            $setting=Setting::where('attribute','order_by')->first();
            $request->order_by=$setting->value;
        
        }
        if(!$request->order_by){
            $request->order_by='id';
        }


        if(Setting::where('attribute','order')->first() && !$request->order)
        {
            $setting=Setting::where('attribute','order')->first();
            $request->order=$setting->value;
        
        }
        if(!$request->order){
            $request->order='desc';
        }

        $order=$request->order;
        $filter_by=$request->filter_by;
        $filter_value=$request->filter_value;
        $order_by=$request->order_by;
        //
        $Class='App\\'.$request->class;
        //
        $user=Auth()->user();
        if($user->position=='admin'){
        $objects = $Class::orderBy($order_by,$order)->get();
        }
        else
        {
        $objects = $Class::orderBy($order_by,$order)->get();
        }

        return $objects;
        
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
/*
        if(Setting::where('attribute','filter_operator')->first() && !$request->filter_operator)
        {   
            $setting=Setting::where('attribute','filter_operator')->first();
            $request->request->add(['filter_operator' => $setting->value]);
        
        }
*/















        if(!$request->filter_operator)
        {
             $request->request->add(['filter_operator' => '!=']);
        }








        $order=$request->order; //
        $filter_by=$request->filter_by; // 
        $filter_value=$request->filter_value; //
        $order_by=$request->order_by; // 
        $filter_operator=$request->filter_operator;
        $Class="App\\".$request->class;

        if($user->position=='admin'){

            $objects = $Class::where($filter_by,$filter_operator,$filter_value);
        }
        else
        {
            $objects = $Class::where($filter_by,$filter_operator,$filter_value);
            $objects = $objects->where('owner_id',$user->id);
        }
        $objects->orderBy($order_by,$order);
        $objects = $objects->paginate($pagination_count)->appends(['order_by'=>$order_by,'order'=>$order,'filter_by'=>$filter_by,'filter_value'=>$filter_value,'filter_operator'=>$filter_operator]);
        return $objects;
    }














}
