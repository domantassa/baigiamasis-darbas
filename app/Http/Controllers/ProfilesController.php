<?php

namespace App\Http\Controllers;
use App\Events\NewMessageOrFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\User;
use App\file;
use App\FileNotification;
use Chatkit\Laravel\Facades\Chatkit;

//use Illuminate\Support\Facades\Cache;
//use Illuminate\Support\Facades\Auth;


class ProfilesController extends Controller
{

    private $chatkit;
    private $roomId;
    public function __construct()
    {
        
        $this->chatkit = app('ChatKit');
        $expiresAt = now()->addMinutes(5);
        $now = now();
       
        //Cache::put('user-is-online-' . Auth::user()->id, true, $expiresAt);
        //$this->roomId = env('CHATKIT_GENERAL_ROOM_ID');
        
    }


    public function index()
    {
        
        //$user = User::findOrFail($user);
       // return view('dashboard', [
        //    'user' => $user,
       // ]);
       
            
       
            $notif = Auth()->User()->notifications()->get();
            //event(new NewMessageOrFile('hello world'));
            
            $files = file::where('owner_id', Auth()->User()->id)->get();
            
            return view('dashboard', ['user' => Auth()->User(), 'users' => User::all(), 'files'=>$files, 'notif' => $notif]);
        

       
    }

    public function getShow($id)
    {
        
        $user = User::findOrFail($id);
        //event(new NewMessageOrFile('hello world'));
        $notif = Auth()->User()->notifications()->get();
        //$files = Storage::allFiles('public/'.$user->name);
        $files = file::where('owner_id', $id)->get();
        
        return view('dashboard', ['user' => $user, 'users' => User::all(), 'files'=>$files, 'notif' => $notif]);
    }

    public function store(Request $request, $user)
    {
        
        
        
    }

    public function deleteDirectoryFiles($user)
    {
        
        $user = User::findOrFail($user);
        Storage::deleteDirectory('public/'.$user->name);
        Storage::makeDirectory('public/'.$user->name);

        //while(file::where('owner_id', $user->id)->get() != null)
        //{
            
        //}
        
        $file = file::where('owner_id', $user->id)->take(file::where('owner_id', $user->id)->count());
            $file->delete();
        
        //

        return redirect('dashboard');
    }

    public function destroy($user)
    {
        $user = User::find($user);
        $user->delete();
        Storage::deleteDirectory($user->name);
        return redirect('users');
    }

    public function getAdminProfile()
    {
        //
    }

    public function postProfile()
    {
        //
    }

    public function users()
    {
        $notif = Auth()->User()->notifications()->get();
            
            
        $files = file::where('owner_id', Auth()->User()->id)->get();
            
        return view('/users', ['user' => Auth()->User(), 'users' => User::all(), 'files'=>$files, 'notif' => $notif]);
    }

    
}

