<?php

namespace App\Http\Controllers;

use App\User;
use App\file;
use App\Events\EndPool;
use App\FileNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Events\FileCreatedEvent;
use App\Order;
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
    public function index()
    {
        $notif = Auth()->User()->notifications()->get();
        //$orders = Order::where('owner_id', Auth()->User()->id)->get();
        $orders=Order::all();
        return view('orders.index', ['user' => Auth()->User(), 'users' => User::all(), 'orders'=>$orders, 'notif' => $notif]);    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //$data=array(['data'=>'Naujas užsakymas nuo '.'Auth()->User()->name','link'=>'orders/'.'1/edit']);
        //Mail::to('deividassabaliauskas@gmail.com')->send(new Notification($data));
        //Mail::to('domantassabaliauskas@gmail.com')->send(new Notification());
        $notif = Auth()->User()->notifications()->get();
       // $orders = Order::where('owner_id', Auth()->User()->id)->get();
        $orders=Order::all();
        //dd($orders);
        return view('orders.create', ['user' => Auth()->User(), 'users' => User::all(), 'orders'=>$orders, 'notif' => $notif]);    
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {/*
        $validator=$request->validate([
            'name' => 'required',
                'requirements' => 'required',
                'comment' => 'required',
                'result' => 'required',
                'state' => 'required',
                'type' => 'required',
        ]);
*/


        if(Auth()->User()->remaining < 1)
            abort(404);
        $input=$request->files->all();
        //dd($input["files"]);
        $order=new Order;
        $order->requirements=$request->requirements;
        $order->comment=$request->comment;
        $order->name=$request->title;
        $order->result=$request->result;
        $order->feedback=$request->feedback;
        $order->owner_id=Auth()->user()->id;
        $order->state="Projektas kuriamas";
        $order->type=$request->type;
        
        $user=Auth()->user();
        $order->save();

        
        $expected=strtotime($order->created_at)+86400;
        $order->expected_at=date('Y-m-d H:i:s',$expected);
        $order->save();
        if($input != null)
        {
            foreach($input["files"] as $file)
            {
            $fileName = $file->getClientOriginalName();
                
            $naujasFile = new file;
            $naujasFile->name =  $file->getClientOriginalName();
            $naujasFile->path =  $user->name;
            //$naujasFile->owner_id = $user->id;
            $naujasFile->order_id = $order->id;
            $naujasFile->owner_id = $user->id;
            $naujasFile->save();
            
            // Save the file
            $file->move('storage/'.$user->name, $fileName);
            $order->file_id=$naujasFile->id;
           }
        }
            $order->save();


            if($user->id != 1)
            {
                
                FileNotification::create([
                    'user_id' => 1,                 //JEI BUS DAUGIAU NEI VIENAS ADMIN, PAKEISTI SIA EILUTE
                    'message' => 'Naujas užsakymas nuo '.Auth()->User()->name,
                    'link' => 'orders/'.$order->id.'/edit',
                ]);
                $admin=User::find(1);
                $headers = "Content-Type: text/html; charset=UTF-8\r\n";
               // mail($admin->email,'Naujas užsakymas',view('mail.notification',['data'=>'Naujas užsakymas nuo '.Auth()->User()->name,'link'=>'orders/'.$order->id.'/edit']),$headers);
                $data=array(['data'=>'Naujas užsakymas nuo '.Auth()->User()->name,'link'=>'orders/'.$order->id.'/edit']);
                //Mail::to($admin->email)->send(new Notification($data));
            }

            
            $user = Auth()->User();
            $remaining = $user->remaining;
            $remaining = $remaining - 1;
            $user->remaining = $remaining;
            $user->save();
        
            return view('responses.project-new',['user' => Auth()->User(), 'users' => User::all() , 'notif' => Auth()->User()->notifications()->get() ]);
           
        
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \Clients\file  $file
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        //return view('responses.project-finished',['user' => Auth()->User() , 'users' => User::all() , 'notif' => Auth()->User()->notifications()->get() ]);
        $order=Order::find($id);
        
        if($order->owner_id== Auth()->User()->id || Auth()->User()->position == 'admin')
        {
        return view('orders.show', ['user' => Auth()->User() , 'users' => User::all() , 'order'=>$order , 'notif' => Auth()->User()->notifications()->get() ]);
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
        //
        $order=Order::find($id);
        
        if($order->owner_id== Auth()->User()->id || Auth()->User()->position == 'admin')
        {
        return view('orders.edit', ['user' => Auth()->User() , 'users' => User::all() , 'order'=>$order , 'notif' => Auth()->User()->notifications()->get() ]);
        }
        else{
            abort(404);
        }
    }
    public function dashboard_orders(){
        $notif = Auth()->User()->notifications()->get();
        //$orders = Order::where('owner_id', Auth()->User()->id)->get();
        $orders=Order::all();
        return view('orders.pradzia', ['user' => Auth()->User(), 'users' => User::all(), 'orders'=>$orders, 'notif' => $notif]);   
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
        //
               
        $input=$request->files->all();
        //dd($request);
        $order=Order::find($id);
        $order->requirements=$request->requirements;
        $order->comment=$request->comment;
        $order->name=$request->title;
        $order->result=$request->result;
        $order->feedback=$request->feedback;
        $order->state=$request->state;
        $order->type=$request->type;
        $order->expected_at=$request->expected_at;
        $user=Auth()->user();
        $order->save();
        if($input != null)
        {
            foreach($input["files"] as $file)
            {
            // Generate a file name with extension
            $fileName = $file->getClientOriginalName();
                
            $naujasFile = new file;
            $naujasFile->name =  $file->getClientOriginalName();
            $naujasFile->path =  $user->name;
            //$naujasFile->owner_id = $user->id;
            $naujasFile->order_id = $order->id;
            $naujasFile->owner_id = $user->id;
            $naujasFile->save();
            $owner=User::find($order->owner_id);
            // Save the file
            $file->move('storage/'.$owner->name, $fileName);
            $order->file_id=$naujasFile->id;
           }
        }
            $order->save();


            if($user->id == 1)
            {
                FileNotification::create([
                    'user_id' => $order->owner_id,                 //JEI BUS DAUGIAU NEI VIENAS ADMIN, PAKEISTI SIA EILUTE
                    'message' => 'Pakeista užsakymo '.$order->name. ' būsena',
                    'link' => 'orders-dashboard',
                ]);
                $user1=User::find($order->owner_id);
                $headers = "Content-Type: text/html; charset=UTF-8\r\n";
                //mail($user1->email,'Pakeista užsakymo būsena',view('mail.notification',['data'=>'Pakeista užsakymo '.$order->name. ' būsena','link'=>'orders-dashboard']),$headers);
                $data=array(['data'=>'Pakeista užsakymo '.$order->name. ' būsena','link'=>'orders-dashboard']);
                //Mail::to($user1->email)->send(new Notification($data));
            }
            
        
            return view('responses.project-edited',['user' => Auth()->User(), 'users' => User::all() , 'notif' => Auth()->User()->notifications()->get() ]);
           
        
        
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
            return redirect('dashboard');
        }
        return back();
        
       
    }

    public function download($file)
    {
        $file = file::find($file);
       // $user = User::find($file->owner_id);
        $notif = Auth()->User()->notifications()->get();
        $files = file::where('owner_id', Auth()->User()->id)->get();
        if(Auth()->user()->id != $file->owner_id || Auth()->user()->position != 'admin')
        {
            return Storage::download('public/'.Auth()->user()->name.'/'.$file->name);
        }
        
        return back();
    }
    public function finished($id)
    {
        $order=Order::find($id);
        $order->state='Projektas uždarytas';
        $order->save();
        FileNotification::create([
            'user_id' => $order->owner_id,                 //JEI BUS DAUGIAU NEI VIENAS ADMIN, PAKEISTI SIA EILUTE
            'message' => 'Order "'.$order->name.'" finished',
            'link' => 'orders',
        ]);
        $admin=User::find(1);
        $headers = "Content-Type: text/html; charset=UTF-8\r\n";
        //mail($admin->email,'Užsakymo atsiliepimas',view('mail.notification',['data'=>'Order "'.$order->name.'" finished','link'=>'orders']),$headers);
        $data=array(['data'=>'Order "'.$order->name.'" finished','link'=>'orders']);
        //Mail::to($admin->email)->send(new Notification($data));
        return view('responses.project-finished',['user' => Auth()->User(),'order' => $order , 'users' => User::all() , 'notif' => Auth()->User()->notifications()->get() ]);
    }
    public function feedback_finished(Request $request,$id)
    {
        $order=Order::find($id);
        $order->feedback=$request->feedback;
        $order->save();
        FileNotification::create([
            'user_id' => 1,                 //JEI BUS DAUGIAU NEI VIENAS ADMIN, PAKEISTI SIA EILUTE
            'message' => 'Order "'.$order->name.'" finished',
            'link' => 'orders',
        ]);
        $admin=User::find(1);
        $headers = "Content-Type: text/html; charset=UTF-8\r\n";
        $data=array(['data'=>'Order "'.$order->name.'" finished','link'=>'orders']);
        //Mail::to($admin->email)->send(new Notification($data));
        //mail($admin->email,'Užsakymo atsiliepimas',view('mail.notification',['data'=>'Order "'.$order->name.'" finished','link'=>'orders']),$headers);
       
        return view('responses.project-finished-feedback',['user' => Auth()->User() , 'users' => User::all() , 'notif' => Auth()->User()->notifications()->get() ]);
    }
    public function feedback(Request $request,$id)
    {
        $order=Order::find($id);
        $order->feedback=$request->feedback;
        $order->state="Projektas kuriamas";
        $order->save();
        FileNotification::create([
            'user_id' => 1,                 //JEI BUS DAUGIAU NEI VIENAS ADMIN, PAKEISTI SIA EILUTE
            'message' => 'Naujas atsiliepimas užsakymui "'.$order->name.'"',
            'link' => 'orders/'.$id.'/edit',
        ]);
        $headers = "Content-Type: text/html; charset=UTF-8\r\n";
        $admin=User::find(1);
        //mail($admin->email,'Užsakymo atsiliepimas',view('mail.notification',['data'=>'Naujas atsiliepimas užsakymui "'.$order->name.'"','link'=>'orders/'.$id.'/edit']),$headers);
        $data=array(['data'=>'Naujas atsiliepimas užsakymui "'.$order->name.'"','link'=>'orders/'.$id.'/edit']);
        //Mail::to($admin->email)->send(new Notification($data));
        return view('responses.feedback',['user' => Auth()->User() , 'users' => User::all() , 'notif' => Auth()->User()->notifications()->get() ]);
    }
    public function preview($id)
    {
        $order=Order::find($id);
        
        if($order->owner_id== Auth()->User()->id || Auth()->User()->position == 'admin')
        {
        return view('orders.preview', ['user' => Auth()->User() , 'users' => User::all() , 'order'=>$order , 'notif' => Auth()->User()->notifications()->get() ]);
        }
        else{
            abort(404);
        }
    }
}
