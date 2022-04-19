<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Setting;
use App\User;

class SiteSettingsController extends Controller
{
    public function index(Request $request)
    {


        







        if($request->filter_by || $request->order_by){
            $request->request->add(['class' => 'Setting']);
            $settings=$this->filter($request);
        }
        else{

            $pagination_count=9;    
            if(Setting::where('attribute','pagination_count')->first())
            {  
                $setting=Setting::where('attribute','pagination_count')->first(); 
                
                $pagination_count=$setting->value;
            }
            $settings=Setting::paginate($pagination_count);
        }
        $notif = Auth()->User()->notifications()->get();
        return view('settings.index',[
            'settings'=>$settings,
            'filters'=>[
                'filter_by'=>$request->filter_by,
                'order_by'=>$request->order_by,
                'filter_value'=>$request->filter_value,
                'filter_operator'=>$request->filter_operator,
                'order'=>$request->order,
                'order_check'=>$request->order_check,
                'filter_check'=>$request->filter_check
            ],
            'user' => Auth()->User(), 
            'users' => User::all(), 
            'notif' => $notif
        ]);
    }

    public function create()
    {
        $notif = Auth()->User()->notifications()->get();
        return view('settings.create',[ 
            'user' => Auth()->User(), 
            'users' => User::all(), 
            'notif' => $notif
        ]);
    }

    public function store(Request $request)
    {   
        $setting = new Setting;
        $setting->attribute= $request->attribute;
        $setting->value= $request->value;
        $setting->save();
        return redirect(route('settings.index'));
    }

  
    public function show($id)
    {
        $setting=Setting::find($id);
        if(!$setting) abort(404);
        $notif = Auth()->User()->notifications()->get();
        return view('settings.show',['setting'=>$setting,
        'user' => Auth()->User(), 'users' => User::all(), 'notif' => $notif]);
    }

   
    public function edit($id)
    {
        $setting=Setting::find($id);
        $notif = Auth()->User()->notifications()->get();
        if(!$setting) abort(404);
        return view('settings.edit',['setting'=>$setting,
        'user' => Auth()->User(), 'users' => User::all(), 'notif' => $notif]);
    }

    public function update(Request $request, $id)
    {
        $setting=Setting::find($id);
        if(!$setting) abort(404);
        $setting->attribute=$request->attribute;
        $setting->value=$request->value;
        $setting->save();
        return redirect(route('settings.index'));
    }

    public function destroy($id)
    {
        $setting=Setting::find($id);
        if(!$setting) abort(404);
        $setting->delete();
        return redirect(route('settings.index'));
    }
}
