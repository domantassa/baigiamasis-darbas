<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use App\Order;
use App\User;
use DB;
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
        public function calendar_update(Request $request){
            $month=(int)$request->M;
            $year=(int)$request->Y;
            $user=Auth()->user();
            if($user->position == 'admin')
            {
                $orders=Order::all();  
            }
            else
            {
                $orders=Order::where('owner_id',$user->id)
                            ->get();
            }
            return  view(
                'widgets.calendar',[
                    'M'=>$month,
                    'Y'=>$year,
                    'events'=>$orders
                ]);
        }
        public function calendarOrders_update(Request $request){
            $month=(int)$request->M;
            $year=(int)$request->Y;
            $user=Auth()->user();
            if($user->position == 'admin')
            {
                $orders=Order::all();  
            }
            else
            {
                $orders=Order::where('owner_id',$user->id)
                            ->get();
            }
            return  view(
                'widgets.calendarOrders',[
                    'M'=>$month,
                    'Y'=>$year,
                    'events'=>$orders
                ]);
        }

       
}
