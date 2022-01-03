<?php

namespace App\Http\Controllers;

use App\User;
use App\Order;
use App\file;
use App\Events\EndPool;
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
        //event(new NewMessageOrFile('hello world'));
        
        $files = file::where('owner_id', Auth()->User()->id)->get();
        
        return view('dashboard', ['user' => Auth()->User(), 'users' => User::all(), 'files'=>$files, 'notif' => $notif]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, $user)
    {
        
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $user)
    {
        if($user !=  Auth()->User()->id || Auth()->user()->position != 'admin') {
            event(new MyEvent('Įkeltas failas'));
        }
        if(Auth()->user()->id == $user || Auth()->user()->position == 'admin')
        {
            $user = User::findOrFail($user);  
            $validation = $request->validate([
                'file'  =>  'required|file|max:20000'
            ]);
            
            $file = $request->file;  
            // Generate a file name with extension
            $fileName = $file->getClientOriginalName();
                
            $naujasFile = file::create([
                'name' => $file->getClientOriginalName(),
                'path' => $user->name,
                'owner_id' => $user->id,
                
            ]);
            
            
            // Save the file
            $file->storeAs('public/'.$user->name, $fileName);
        // $files = file::where('name', $fileName)->get();
            //foreach($files as $file)
            //{
        //     $result = $file;
            //}
            
            
            //$file = file::findOrFail($fileId);  

            //27

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

            
            //event(new FileCreatedEvent($user->id, $result->name));
            
            
            return redirect('dashboard/'.$user->id);
            
        }
        return back();
           
        
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \Clients\file  $file
     * @return \Illuminate\Http\Response
     */
    public function show(file $file)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Clients\file  $file
     * @return \Illuminate\Http\Response
     */
    public function edit(file $file)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Clients\file  $file
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, file $file)
    {
        //
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

        //dd($file,$id);
        if($file)
        {
        $user = User::find($file->owner_id);
        if($file->order_id)
        {
        $order = Order::find($file->order_id);
        $user = User::find($order->owner_id);
        //$order_user = User::find($order->owner_id);
            if(  Auth()->user()->id == $order->owner_id || Auth()->user()->position == 'admin' ){
                return Storage::download('public/'.$user->name.'/'.$file->name);
            }
        }
        else{
        if(Auth()->user()->id == $file->owner_id  || Auth()->user()->position == 'admin' )
        {
            
            return Storage::download('public/'.$user->name.'/'.$file->name);
            //return 1;
        }
     }
    }
        return back();
    }
    public function form()
    {
        //$files=file::all();
       // $user=User::find(1);
        $notif = Auth()->User()->notifications()->get();
        $files = file::where('owner_id', Auth()->User()->id)->get();
        return view('forma')->with(['user' => Auth()->User(), 'users' => User::all(), 'files'=>$files, 'notif' => $notif]);
    }
}
