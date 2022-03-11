<?php

namespace App\Http\Controllers;

use App\User;
use App\brand;
use App\BrandColor;
use App\BrandFile;
use App\file;
use Illuminate\Http\Request;

class BrandController extends Controller
{
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
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $brand=new brand;
        $brand->user_id = Auth()->user()->id;
        $brand->name=$request->title;
        $brand->website=$request->website;
        $brand->industry=$request->industry;
        $brand->style=$request->description;
        $brand->save();
        


        $inputs=$request->all();
        foreach($inputs as $key=>$value){
            if(str_contains($key,'hex-select'))
            {             
            $brandColor=new BrandColor;
            $brandColor->brand_id = $brand->id;
            $brandColor->color_code = $value;
            $brandColor->save();
            }
        }
        
        
        
     

        if($request->files->all())
        {
        $input=$request->files->all();
        foreach($input['files'] as $file)
            {


            $brandFile = new BrandFile;
            $brandFile->name = $file->getClientOriginalName();
            $brandFile->brand_id = $brand->id;
            $brandFile->path = 'brand';
            $brandFile->save();
            
            $file->move('storage/'.Auth()->user()->name.'/brands', $file->getClientOriginalName());
           }
        }
        return back();
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function show(brand $brand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $brand=brand::find($id);
        
        $colors=BrandFile::where('brand_id', $id)->get();
        $files=BrandColor::where('brand_id', $id)->get();
        $colors=$brand->colors()->get();
        $files=$brand->files()->get();
        //dd($colors);
        if($brand->user_id== Auth()->User()->id || Auth()->User()->position == 'admin')
        {
            return view('brands.brand-edit', ['user' => Auth()->User() , 'users' => User::all(), 'brand'=>$brand, 'colors'=>$colors, 'files'=>$files, 'notif' => Auth()->User()->notifications()->get()]);
        }
        else {
            abort(404);
        }
    
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $brand= brand::find($id);
        //
        $colors=$brand->colors()->delete();
       // foreach($request->color){

       //
               
       $brand->name=$request->title;
       $brand->website=$request->website;
       $brand->industry=$request->industry;
       $brand->style=$request->description;
       $brand->save();
       


       $inputs=$request->all();
       foreach($inputs as $key=>$value){
           if(str_contains($key,'hex-select'))
           {             
           $brandColor=new BrandColor;
           $brandColor->brand_id = $brand->id;
           $brandColor->color_code = $value;
           $brandColor->save();
           }
       }
       
       
       
    

       if($request->files->all())
       {
       $input=$request->files->all();
       foreach($input['files'] as $file)
           {
        

           $brandFile = new BrandFile;
           $brandFile->name = $file->getClientOriginalName();
           $brandFile->brand_id = $brand->id;
           $brandFile->path = 'brand';
           $brandFile->save();
           
           $file->move('storage/'.Auth()->user()->name.'/brands', $fileName);
          }
       }

           
       
           if($brand->user_id== Auth()->User()->id || Auth()->User()->position == 'admin')
        {
            return back();
        }
        else {
            abort(404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function destroy(brand $brand)
    {
        //
    }
}