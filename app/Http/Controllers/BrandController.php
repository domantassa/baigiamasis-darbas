<?php

namespace App\Http\Controllers;

use App\User;
use App\brand;
use App\BrandColor;
use App\BrandFile;
use App\file;
use App\Setting;
use Illuminate\Http\Request;

class BrandController extends Controller
{

    public function index(Request $request){

        $class='brand';
        $objects='brands';
        $Settings="App\\Setting";
        if($request->filter_by || $request->order_by){
            $request->request
                        ->add(['class' => $class]);
            $$objects=$this
                        ->filter($request);
        }
        else{
            $Class="App\\".$class;
            $pagination_count=9;    
            if($Settings::where('attribute','pagination_count')->first())
            {  
                $setting=$Settings::where('attribute','pagination_count')
                            ->first(); 
                $pagination_count=$setting->value;
            }
            $$objects=$Class::paginate($pagination_count);
        }

       
        
        
        return view('brands.index')
            ->with([
                'user'=>Auth()->User(),
                'users' =>User::all(),
                'notif'=>Auth()->User()->notifications()->get(),
                'brands'=>$brands
        ]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view(
            'brands/brand-page'
            )->with([
                'user'=>Auth()->User(),
                'users' =>User::all(),
                'notif'=>Auth()
                            ->User()
                            ->notifications()
                            ->get()
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
        $brand=new brand;
        $brand->user_id = Auth()
                            ->user()
                            ->id;
        $brand->name=$request->title;
        $brand->website=$request->website;
        $brand->industry=$request->industry;
        $brand->style=$request->description;
               
        $brand->save();
        $inputs=$request
                    ->all();
        foreach($inputs as $key=>$value)
        {
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
        $input=$request->files
                            ->all();
        foreach($input['files'] as $file)
            {


            $brandFile = new BrandFile;
            $brandFile->name = $file
                                ->getClientOriginalName();
            $brandFile->brand_id = $brand->id;
            $brandFile->path = 'brand';
            $brandFile->save();
            
            $file->move(
                'storage/'.Auth()->user()->name.'/brand', 
                $file->getClientOriginalName()
            );
           }
        }

        
        
        $colors=BrandFile::where('brand_id', $brand->id)
                    ->get();
        $files=BrandColor::where('brand_id', $brand->id)
                    ->get();
        $colors=$brand->colors()->get();
        $files=$brand->files()->get();


        if(!$request->isMockTest) 
        {
            return redirect("dashboard/brand/edit/".$brand->id);
        }
        else {
            return 0;
        }
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
        
        $colors=BrandFile::where('brand_id', $id)
                ->get();
        $files=BrandColor::where('brand_id', $id)
                ->get();
        $colors=$brand->colors()
                        ->get();
        $files=$brand->files()
                        ->get();
        
        if($brand->user_id== Auth()->User()->id )
        {
            return view(
                'brands.brand-edit', [
                    'user' => Auth()->User() , 
                    'users' => User::all(), 
                    'brand'=>$brand, 
                    'colors'=>$colors, 
                    'files'=>$files, 
                    'notif' => Auth()
                                ->User()
                                ->notifications()
                                ->get()
            ]);
        }
        else if(Auth()->User()->position == 'admin')
        {
            return view(
                'brands.brand-edit', [
                    'user' => Auth()->User() , 
                    'users' => User::all(), 
                    'brand'=>$brand, 
                    'colors'=>$colors, 
                    'files'=>$files, 
                    'notif' => Auth()
                                ->User()
                                ->notifications()
                                ->get()
            ]);
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
        if($brand->user_id== Auth()->User()->id )
        {
            $colors=$brand->colors();
            $colors->delete();
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
                $fileName=$brandFile->name;
                $file->move('storage/'.Auth()->user()->name.'/brands', $fileName);
                }
            }
            return back();
        }
        else if(Auth()->User()->position == 'admin')
        {
            $colors=$brand->colors();
            $colors->delete();
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
                $fileName=$brandFile->name;
                $file->move('storage/'.Auth()->user()->name.'/brands', $fileName);
                }
            }
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
    public function destroy($id)
    {
        $brand=brand::find($id);
        if($brand->user_id== Auth()->User()->id )
        {
            if($brand->name == 'routeTesting') 
            {
                $brand->delete();
                return 1;
            } else {
                $brand->delete();
                return redirect('/dashboard');
            }
            
        }
        else if(Auth()->User()->position == 'admin'){
            if($brand->name == 'routeTesting') 
            {
                $brand->delete();
                return 1;
            } else 
            {
                $brand->delete();
                return redirect('/dashboard');
            }
        }
        else {
            abort(404);
        }
        
    }

    public function filter($request){
            $user=Auth()->user();
            $pagination_count=9;
            if(Setting::where('attribute',$user->name.'_'.'pagination_count')->first())
            {  
                    $setting=Setting::where('attribute',$user->name.'_'.'pagination_count')->first(); 
                    $pagination_count=$setting->value;
            }
            if(Setting::where('attribute',$user->name.'_'.'order')->first() && !$request->order)
            {
                $setting=Setting::where('attribute',$user->name.'_'.'order')->first();
                $request->request->add(['order' => $setting->value]);
            
            }
            if(Setting::where('attribute',$user->name.'_'.'order_by')->first() && !$request->order_by)
            {
                $setting=Setting::where('attribute',$user->name.'_'.'order_by')->first();
                $request->request->add(['order_by' => $setting->value]);
            }
            if(Setting::where('attribute',$user->name.'_'.'filter_by')->first() && !$request->filter_by)
            {   
                $setting=Setting::where('attribute',$user->name.'_'.'filter_by')->first();
                $request->request->add(['filter_by' => $setting->value]);
            }
            if(Setting::where('attribute',$user->name.'_'.'filter_value')->first() && !$request->filter_value)
            {   
                $setting=Setting::where('attribute',$user->name.'_'.'filter_value')->first();
                $request->request->add(['filter_value' => $setting->value]);
            }
        if(Setting::where('attribute','pagination_count')->first())
        {  
                $setting=Setting::where('attribute','pagination_count')->first(); 
                $pagination_count=$setting->value;
        }
        if(Setting::where('attribute','order')->first() && !$request->order)
        {
            $setting=Setting::where('attribute','order')->first();
            $request->request->add(['order' => $setting->value]);
        
        }
        if(Setting::where('attribute','order_by')->first() && !$request->order_by)
        {
            $setting=Setting::where('attribute','order_by')->first();
            $request->request->add(['order_by' => $setting->value]);
        }
        if(Setting::where('attribute','filter_by')->first() && !$request->filter_by)
        {   
            $setting=Setting::where('attribute','filter_by')->first();
            $request->request->add(['filter_by' => $setting->value]);
        }
        if(Setting::where('attribute','filter_value')->first() && !$request->filter_value)
        {   
            $setting=Setting::where('attribute','filter_value')->first();
            $request->request->add(['filter_value' => $setting->value]);
        }
        if(!$request->pagination_count)
        {
                $request->request->add(['pagination_count' => 9]);
        }
        if(!$request->order)
        {
            $request->request->add(['order' => 'desc']);
        }
        if(!$request->order_by){
            $request->request->add(['order_by' => 'id']);
        }
        if(!$request->filter_by){
            $request->request->add(['filter_by' => 'attribute']);
        }
        if(!$request->filter_value){
            $request->request->add(['filter_value' => '!']);
        }
        if(!$request->filter_operator)
        {
             $request->request->add(['filter_operator' => '!=']);
        }
        if($request->filter_value=='!')
        {
            $request->request->remove('filter_check');
        }
        if($request->filter_value=='')
        {
            $request->request->remove('filter_check');
        }
        $order=$request->order; 
        $filter_by=$request->filter_by; 
        $filter_value=$request->filter_value;
        $order_by=$request->order_by; 
        $filter_operator=$request->filter_operator;
        $Class="App\\".$request->class;
        $objects=$Class::where('id','!=','0');

        if($filter_by == 'user_id' )
        {
            if( $filter_operator == 'LIKE' && User::where('name',$filter_operator,"%".$filter_value."%")->first())
            {
                $names = User::where('name',$filter_operator,"%".$filter_value."%")->get();
                $objects=$Class::where('user_id',0)->get();
                foreach($names as $name )
                {
                $temp=$Class::where('user_id',$name->id)->get();
                $objects = $objects->merge($temp);
                }
                
                    if($order=='desc'){
                        $sorted = $objects->sortByDesc($order_by);
                    }
                    if($order=='asc'){
                        $sorted = $objects->sortBy($order_by);
                    }
                    $objects = $sorted->values()->collect();
                $objects = $objects->paginate($pagination_count)->appends([
                    'order_by'=>$order_by,
                    'order'=>$order,
                    'filter_by'=>$filter_by,
                    'filter_value'=>$filter_value,
                    'filter_operator'=>$filter_operator
                ]);        
                return $objects;
            }
            else if( User::where('name',$filter_value)->first())
            {
                $name = User::where('name',$filter_value)->first();
                $filter_value=$name->id;
            }
            
        }
  

        if($user->position=='admin' && $request->filter_check)
        {
            if($filter_operator=='LIKE') {
                $objects = $Class::where($filter_by,$filter_operator,"%".$filter_value."%");
            }
            else $objects = $Class::where($filter_by,$filter_operator,$filter_value);
        }
        else if($request->filter_check)
        {
            if($filter_operator=='LIKE' ) 
            {
                $objects = $Class::where($filter_by,$filter_operator,"%".$filter_value."%");
            }
            else 
            {
                $objects = $Class::where($filter_by,$filter_operator,$filter_value);
            }
            $objects = $objects->where('owner_id',$user->id);
        }
        $objects->orderBy($order_by,$order);
        $objects = $objects
                    ->paginate($pagination_count)
                    ->appends([
                        'order_by'=>$order_by,
                        'order'=>$order,
                        'filter_by'=>$filter_by,
                        'filter_value'=>$filter_value,
                        'filter_operator'=>$filter_operator
                    ]);
        return $objects;
    }
}
