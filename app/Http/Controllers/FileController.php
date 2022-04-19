<?php

namespace App\Http\Controllers;

use App\User;
use App\Order;
use App\file;
use App\Events\MyEvent;
use App\FileNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Events\FileCreatedEvent;

class FileController extends Controller
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
    public function index()
    {
        //

                    
       
        $notif = Auth()->User()->notifications()->get();
        
        $files = file::where('owner_id', Auth()->User()->id)->get();
        
        return view('dashboard', ['user' => Auth()->User(), 'users' => User::all(), 'files'=>$files, 'notif' => $notif]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $user)
    {


        if(Auth()->user()->id == $user || Auth()->user()->position == 'admin')
        {
            $user = User::findOrFail($user);  
            $validation = $request->validate([
                'file'  =>  'required|file|max:20000'
            ]);
            
            $file = $request->file;  
            $fileName = date('Y-m-d-H-i-s',time()) . '-'.$file->getClientOriginalName();
                
            $naujasFile = file::create([
                'name' => $fileName,
                'path' => $user->name,
                'owner_id' => $user->id,
                
                
            ]);
            
            
            $file->storeAs('public/'.$user->name, $fileName);

            function toLongString(string $str) {
                if(strlen($str) > 27) {
                    $strr = substr($str, 0, 23);
                    $strr .= "...";
                    return $strr;
                }
                else {
                    return $str;
                }
            }
            

            if($user->id != 1)
            {
                
                $fileNotification = FileNotification::create([
                'user_id' => $user->id,
                'message' => 'Naujas failas: '.toLongString($file->getClientOriginalName()),
                'link' => 'files',
                'fileId' => $naujasFile->id,
                ]);
            }
            
            return redirect('dashboard/'.$user->id);
            
        }
        return back();
           
        
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeFinalResult(Request $request, $orderId)
    {


        if( Auth()->user()->position == 'admin')
        {
            $order = Order::find($orderId);
            $user = User::findOrFail($order->owner_id);  
            $validation = $request->validate([
                'file'  =>  'required|file|max:50000'
            ]);
            
            $file = $request->file;  
            $fileName = date('Y-m-d-H-i-s',time()) . '-'.$file->getClientOriginalName();
                
            $naujasFile = file::create([
                'name' => $fileName,
                'path' => $user->name,
                'owner_id' => $user->id,
                'order_id' => $order->id,
                'isResult' => 'orderResult'
            ]);
            
            
            $file->storeAs('public/'.$user->name, $fileName);

            function toLongString(string $str) {
                if(strlen($str) > 27) {
                    $strr = substr($str, 0, 23);
                    $strr .= "...";
                    return $strr;
                }
                else {
                    return $str;
                }
            }
            

            if($user->id != 1)
            {
                
                $fileNotification = FileNotification::create([
                'user_id' => $user->id,
                'message' => 'Įkelti rezultatai: '.toLongString($file->getClientOriginalName()),
                'link' => 'orders/results/'.$orderId,
                'fileId' => $naujasFile->id,
                ]);
            }
            
            return redirect('dashboard/orders/results/'.$order->id);
            
        }
        return back();
           
        
        
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
        if(Auth()->user()->id == $file->owner_id || Auth()->user()->position == 'admin')
        {
            
            Storage::deleteDirectory($file->name);
            
            $file->delete();
            return back();
        }
        return back();
        
       
    }

    public function download($id)
    {
        $file = file::find($id);


        if($file)
        {
        $user = User::find($file->owner_id);
        if($file->order_id)
        {
        $order = Order::find($file->order_id);
        $user = User::find($order->owner_id);

            if(  Auth()->user()->id == $order->owner_id || Auth()->user()->position == 'admin' ){
                return Storage::download('public/'.$file->path.'/'.$file->name);
            }
        }
        else{
        if(Auth()->user()->id == $file->owner_id  || Auth()->user()->position == 'admin' )
        {
            
            return Storage::download('public/'.$file->path.'/'.$file->name);
        }
     }
    }
        return back();
    }
    public function form()
    {

        $notif = Auth()->User()->notifications()->get();
        $files = file::where('owner_id', Auth()->User()->id)->get();
        return view('forma')->with(['user' => Auth()->User(), 'users' => User::all(), 'files'=>$files, 'notif' => $notif]);
    }
}
