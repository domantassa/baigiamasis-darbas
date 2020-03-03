<?php

namespace App\Http\Controllers;

use App\User;
use App\file;
use App\Events\EndPool;
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
            
            if($user->id != 1)
            {
                
                $fileNotification = FileNotification::create([
                'user_id' => $user->id,
                'message' => $file->getClientOriginalName(),
                'fileId' => $naujasFile->id,
                ]);
                event(new EndPool($fileNotification));
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
            return redirect('dashboard');
        }
        return back();
        
       
    }

    public function download($file)
    {
        $file = file::find($file);
        $user = User::find($file->owner_id);
        if(Auth()->user()->id != $file->owner_id || Auth()->user()->position != 'admin')
        {
            
            return Storage::download('public/'.$user->name.'/'.$file->name);
    
        }
        
        return back();
    }

}
