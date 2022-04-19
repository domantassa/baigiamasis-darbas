<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\User;
use App\file;
use App\FileNotification;

//use Illuminate\Support\Facades\Cache;
//use Illuminate\Support\Facades\Auth;


class ProfilesController extends Controller
{

    public function __construct()
    {
        
        $expiresAt = now()->addMinutes(5);
        $now = now();
    }


    public function index(Request $request)
    {
        
            $notif = Auth()->User()->notifications()->get();

            if($request->filter_by){
                $request->request->add(['class' => 'file']);
                $files=$this->filter($request);
            }
            else{
                $files=file::all();
            }
            $files = file::where('owner_id', Auth()->User()->id);//->get();
            
            $user = Auth()->User();
            
            if($user->refresh_date != null)
            {
                $plan = $user->plan;
                $refresh_date = $user->refresh_date;
                
                $refresh_dateTime = strtotime($refresh_date);
                //$refresh_dateTime =date('U',$refresh_date)
                //dd($refresh_dateTime);
                $nowTime = time();
                $remaining = 8;
                if($refresh_dateTime - $nowTime < 0)
                {
                    if($plan == 'Hidrosfera')
                        $remaining = 12;
                    else if ($plan == 'Ekosfera')
                        $remaining = 20;
                    else if ($plan== 'Atmosfera')
                        $remaining = 40;
                    $user->remaining = $remaining;
                    
                    $refresh_date=date('Y-m-d H:i:s',$refresh_dateTime+2592000);
                    //prideti prie refreshdate + 1 men
                    $user->refresh_date = $refresh_date;
                
                    $user->save();
                }
            }
            
            
            return view('dashboard', ['user' => Auth()->User(), 'users' => User::all(), 'files'=>$files, 'notif' => $notif,
        ]);
        

       
    }

    public function getShow($id)
    {
        
        $user = User::findOrFail($id);

        $notif = Auth()->User()->notifications()->get();
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
        
        $file = file::where('owner_id', $user->id)->take(file::where('owner_id', $user->id)->count());
            $file->delete();

        return redirect('dashboard');
    }

    public function destroy($user)
    {
        $user = User::find($user);
        $files = $user->files()->get();
        $orders = $user->orders()->get();
        $brands = $user->brands()->get();
        $notifications = $user->notifications()->get();
        if(count($files) > 0)
            $user->files()->delete();
        if(count($brands) > 0)
            $user->brands()->delete();
        if(count($orders) > 0)
            $user->orders()->delete();
        if(count($notifications) > 0)
            $user->notifications()->delete();
        $user->delete();
        Storage::deleteDirectory($user->name);
        return redirect('dashboard/users');
    }

    public function update(Request $request)
    {
        $user=User::find($request->id);
        $user->name=$request->name;
        $user->email=$request->email;
        $user->plan=$request->plan;
        $user->remaining=$request->remaining;
        $user->refresh_date = $request->refresh_date;
        $user->save();
        $notif = Auth()->User()->notifications()->get();
        $files = file::where('owner_id', Auth()->User()->id)->get();
        
        return view('users', ['user' => Auth()->User(), 'users' => User::all(), 'files'=>$files, 'notif' => $notif]);
    }

    public function getAdminProfile()
    {
        //
    }

    public function postProfile()
    {
        //
    }

    public function show($user)
    {
        $user = User::find($user);
        return view('auth.edit', ['user' => $user]);
    }

    public function users()
    {
        
        $notif = Auth()->User()->notifications()->get();
            
            
        $files = file::where('owner_id', Auth()->User()->id)->get();
            
        return view('users', ['user' => Auth()->User(), 'users' => User::all(), 'files'=>$files, 'notif' => $notif]);
    }
}

