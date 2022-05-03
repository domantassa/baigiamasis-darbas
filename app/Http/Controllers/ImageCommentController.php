<?php

namespace App\Http\Controllers;

use App\User;
use App\Order;
use App\ImageRevision;
use App\ImageComment;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageCommentController extends Controller
{


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $imageRevision = ImageRevision::find($id);
        $notif = Auth()->User()->notifications()->get();
        $imageComments=$imageRevision->imageComments()
                            ->get();
        return view(
            'imageRevisions.imageCommentsEdit')->with([
                'user'=>Auth::user(), 
                'image_revision'=>$imageRevision, 
                'users' =>User::all(),
                'notif'=>Auth()->User()->notifications()->get()
            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        
       
        $inputs= $request->input();
        $i=1;
        $t='text-'.$i;
        $imageRevision = ImageRevision::find($inputs['image_revision_id']);
        $imageRevision->comment_count = 0;

        $comments= ImageComment::where('image_revision_id',$inputs['image_revision_id'])
                        ->delete();
        while($request->$t && $inputs['text-'.$i] != null)
        {
        $imageRevision->comment_count = $imageRevision->comment_count + 1;
        
        $comment = New ImageComment;
        $comment->comment=$inputs['text-'.$i];
        $comment->x=$inputs['x-'.$i];
        $comment->y=$inputs['y-'.$i];
        $comment->image_revision_id=$inputs['image_revision_id'];
        $comment->user_id = Auth()->User()->id;
        $comment->user_name = Auth()->User()->name;
        $comment->save();
        $i++;
        $t='text-'.$i;
        }
        $imageRevision->save();

        return back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ImageComment  $imageComment
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $imageRevision = ImageRevision::find($id);
        $notif = Auth()->User()->notifications()
                    ->get();
        $imageComments=$imageRevision->imageComments()
                            ->get();

        return view(
            'imageRevisions.imageCommentsEdit')->with([
                'user'=>Auth::user(), 
                'image_revision'=>$imageRevision, 
                'users' =>User::all(),
                'notif'=>Auth()->User()->notifications()->get()
            ]);
    }


}
