<?php

    if(!isset($attributes)){
    $Class="App\\".$class;
    $object= $Class::first();
    $attributes=$object->getAttributes();
    $attributes=array_keys($attributes);
    }

    if(!isset($_REQUEST['filter_check']) ){ 
        $_REQUEST['filter_check']="";
    }
    if(!isset($_REQUEST['order_check']) ){ 
        $_REQUEST['order_check']="";
    }
    if(!isset($_REQUEST['filter_by']) ){ 
        $_REQUEST['filter_by']="";
    }
    if(!isset($_REQUEST['filter_operator']) ){ 
        $_REQUEST['filter_operator']="";
    }
    if(!isset($_REQUEST['filter_value']) ){ 
        $_REQUEST['filter_value']="";
    }
    if(!isset($_REQUEST['order_by']) ){ 
        $_REQUEST['order_by']="";
    }    if(!isset($_REQUEST['order']) ){ 
        $_REQUEST['order']="";
    }
?>
<div class="d-flex justify-content-between align-items-center" style="max-width:1400px;">
<form id="filter-sort-form" method="GET" action="" style="">
<div class="filter-main-group">
    <label for="filter-check" class="ml-2 filter-check-group btn btn-primary <?php if($_REQUEST['filter_check']) echo "active"?>" >
        <i class="fas fa-filter"></i>
    </label>
    <input class="d-none" name="filter_check" id="filter-check" type="checkbox" <?php if($_REQUEST['filter_check']) echo 'checked'?>>
    
    <div class="filter-group <?php if($_REQUEST['filter_check']) echo "active"?>">
    <select name="filter_by" class="filter-input m-2">
    @foreach($attributes as $key=>$value)
                    <option  value="{{$value}}" 
                    <?php if($_REQUEST['filter_by']==$value) echo 'selected'?>>{{__($value)}}</option>
        @endforeach
    </select>
    <select name="filter_operator" class="filter-input m-2" >
        <option <?php if($_REQUEST['filter_operator']=='=') echo 'selected'?>>=</option>
        <option <?php if($_REQUEST['filter_operator']=='!=') echo 'selected'?>>!=</option>
        <option  <?php if($_REQUEST['filter_operator']=='LIKE') echo 'selected'?> value="LIKE">{{__('LIKE')}}</option>
    </select>

    <input type="text" name="filter_value" placeholder="{{__('Filter value')}}" style="width:200px" class="filter-input m-2" value="{{ $_REQUEST['filter_value'] }}" <?php //disabled?>>
    </div>
</div>
        <div class="order-main-group">
        <label for="order-check" type="button" class="btn btn-primary order-check-group  <?php if($_REQUEST['order_check']) echo 'active'?>">
            <i class="fas fa-arrows-alt-v"></i>
        </label>
        <input id="order-check" class="d-none" name="order_check" type="checkbox" <?php if($_REQUEST['order_check']) echo 'checked'?>>
        <div class="order-group ">
            <select name="order_by" class="order-input m-2" >
                @foreach($attributes as $key=>$value)
                    <option  value="{{$value}}" 
                    <?php if($_REQUEST['order_by']==$value) echo 'selected'?>>{{__($value)}}</option>
                @endforeach
            </select>
            <select name="order" class="order-input m-2" >
                <option  <?php if($_REQUEST['order']=='desc') echo 'selected'?>>{{__('desc')}}</option>
                <option  <?php if($_REQUEST['order']=='asc') echo 'selected'?>>{{__('asc')}}</option>
            </select>
        </div>
         <label for="filter-order-submit" class=" d-none filter-order-submit btn btn-primary "><i class="fas fa-check"></i></label>        
            <input type="submit" id="filter-order-submit" class="d-none">
        </div>
    </form>
<a class="refresh-btn btn btn-primary mr-2" href="{{ URL::current() }}"><i class="fas fa-redo"></i></a>
</div>


