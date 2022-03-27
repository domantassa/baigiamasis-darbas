<?php

namespace App\Http\Controllers;

use App\ImageRevision;
use App\Order;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Events\FileCreatedEvent;

class ImageRevisionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $notif = Auth()->User()->notifications()->get();
        $order=Order::find($id);
        $imageRevisions = ImageRevision::where('order_id', $id)->get();

        return view('orders.order-result-page', ['user' => Auth()->User(), 'imageRevisions' => $imageRevisions, 'users' => User::all(), 'order'=>$order, 'notif' => $notif]);    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $notif = Auth()->User()->notifications()->get();

        $order=Order::find($id);

        return view('orders.order-result-upload', ['user' => Auth()->User(), 'users' => User::all(), 'order'=>$order, 'notif' => $notif]);  
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $input=$request->files->all();

        $order=Order::find($id);



        $order->comment=$request->comment;
        
        $owner = User::find($order->owner_id);


        $order->save();


        if($input != null)
        {
            foreach($input["files"] as $file)
            {
            //dd($file);
                $fileName = date('Y-m-d-H-i-s',time()) . '-'.$file->getClientOriginalName();
            
            $number = $order->number_of_revisions + 1;
            $order->number_of_revisions = $order->number_of_revisions + 1;
            $order->save();
            $newImageRevision = new ImageRevision;
            $newImageRevision->name =  $fileName;
            $newImageRevision->path =  $owner->name;
            $newImageRevision->order_id = $order->id;
            $newImageRevision->status = 'revision';
            $newImageRevision->number = $number;
            $newImageRevision->save();
            $newImageRevision->original_id = $newImageRevision->id;
            $newImageRevision->save();
            
            // Save the file
            //$file->storeAs('public/'.$user->name, $fileName);
            $file->move('storage/'.$owner->name, $fileName);
           }
        }
            $order->save();

            $notif = Auth()->User()->notifications()->get();
            $imageRevisions = ImageRevision::where('order_id', $id)->get();

            return redirect("dashboard/orders/results/".$order->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ImageRevision  $imageRevision
     * @return \Illuminate\Http\Response
     */
    public function show(ImageRevision $imageRevision)
    {
        //
    }

    public function download($orderId, $imageRevisionId)
    {
        $imageRevision = ImageRevision::find($imageRevisionId);
        $order = Order::find($orderId);
        $user = User::find($order->owner_id);
        
        if(Auth()->user()->id != $order->owner_id || Auth()->user()->position != 'admin')
        {
            return Storage::download('public/'.$imageRevision->path.'/'.$imageRevision->name);
        }
        
        return back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ImageRevision  $imageRevision
     * @return \Illuminate\Http\Response
     */
    public function edit($orderId, $imageRevisionId)
    {
        $imageRevision = ImageRevision::find($file);
        $order = Order::find($orderId);
        
        $notif = Auth()->User()->notifications()->get();
        $imageComments=$imageRevision->imageComments()->get();

        return view('imageRevisions.imageCommentsCreate',['user' => Auth()->User(), 'users' => User::all(), 'notif' => $notif,'imageRevision'=>$imageRevision, 'imageComments'=>$imageComments,'order'=>$order ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ImageRevision  $imageRevision
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ImageRevision $imageRevision)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ImageRevision  $imageRevision
     * @return \Illuminate\Http\Response
     */
    public function destroy($orderId, $imageRevisionId)
    {   
        $order = Order::find($orderId);
        $imageRevision = ImageRevision::find($imageRevisionId);
        if(Auth()->user()->id == $order->owner_id || Auth()->user()->position == 'admin')
        {
            //TODO CHECK THIS
            Storage::deleteDirectory($imageRevision->name);
            
            $imageRevision->delete();
        }
        return back();
    }
}
