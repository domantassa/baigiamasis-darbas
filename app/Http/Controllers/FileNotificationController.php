<?php

namespace App\Http\Controllers;

use App\FileNotification;
use Illuminate\Http\Request;

class FileNotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \Clients\FileNotification  $fileNotification
     * @return \Illuminate\Http\Response
     */
    public function show(FileNotification $fileNotification)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Clients\FileNotification  $fileNotification
     * @return \Illuminate\Http\Response
     */
    public function edit(FileNotification $fileNotification)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Clients\FileNotification  $fileNotification
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FileNotification $fileNotification)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Clients\FileNotification  $fileNotification
     * @return \Illuminate\Http\Response
     */

    public function destroy(Request $request)
    {
        $fileNotification = FileNotification::where('id', $request->notification)->take(1);
        $fileNotification->delete();
        return (redirect('/dashboard/'.$request->link));
        
    }

    public function delete($user)
    {
        $fileNotification = FileNotification::where('user_id', $user)->take(FileNotification::where('user_id', $user)->count());
        $fileNotification->delete();
        return back();
        
    }
}
