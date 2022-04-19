<?php
    $class="Setting";
    $Class="App\\".$class;
    $object= $Class::first();
    $atrributes=$object->getAttributes();

    if(!isset($filters) ){ 
        $filters = [
        'filter_check'=>'',
        'filter_by'=>'',
        'filter_operator'=>'',
        'filter_value'=>'',
        'order_check'=>'',
        'order_by'=>'',
        'order'=>''
        ];
    }
    
?>
<form method="GET" action="">

filter
<input name="filter_check" id="filter-check" type="checkbox" <?php if($filters['filter_check']) echo 'checked'?>>
<select name="filter_by" class="filter-input m-2" disabled >
@if($filters['filter_by'] )<option >{{ $filters['filter_by'] }}</option> @endif
@foreach($atrributes as $key=>$value)
<option>{{$key}}</option>
@endforeach
</select>
<select name="filter_operator" class="filter-input m-2" disabled >
@if($filters['filter_operator'] )<option >{{ $filters['filter_operator'] }}</option> @endif
    <option>=</option>
    <option>!=</option>
    <option>LIKE</option>
    <option>NOT LIKE</option>
</select>
<input type="text" name="filter_value" placeholder="filter_value" style="width:200px" class="filter-input m-2" value="{{ $filters['filter_value'] }}" disabled>

sort
        <input id="order-check"  name="order_check" type="checkbox" <?php if($filters['order_check']) echo 'checked'?>>
            <select name="order_by" class="order-input m-2" disabled >

            @if($filters['order_by'] )   <option >{{ $filters['order_by'] }}</option>@endif
            @foreach($atrributes as $key=>$value)
            <option>{{$key}}</option>
            @endforeach
            </select>


            <select name="order" class="order-input m-2" disabled>
            @if($filters['order'] )  <option >{{ $filters['order'] }}</option>@endif
                <option>desc</option>
                <option>asc</option>
            </select>




<button class="btn-primary btn m-2"> submit</button>

</form>

<script>
if($('#filter-check').is(':checked')){
    $('.filter-input').each(function(){
        $(this).prop('disabled',false);
    });
}

if($('#order-check').is(':checked')){
    $('.order-input').each(function(){
        $(this).prop('disabled',false);
    });
}
$('#filter-check').on('change',function(){
    $('.filter-input').each(function(){
        if($(this).prop('disabled')) $(this).prop('disabled',false);
        else $(this).prop('disabled',true);
    
    })
});
$('#order-check').on('change',function(){
    $('.order-input').each(function(){
        if($(this).prop('disabled')) $(this).prop('disabled',false);
        else $(this).prop('disabled',true);
    
    })

});
</script>