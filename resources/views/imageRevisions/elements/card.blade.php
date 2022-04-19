<div class="dotcont" id="dotcont-{{$number}}" style="top:{{$y}}px;left:{{$x}}px" >
    <div class="dot" data_id="{{$number}}" id="dot-{{$number}} " >
        {{$number}}
    </div>
    <input class="d-none y" name="y-{{$number}}" value="{{$y}}">
    <input class="d-none x" name="x-{{$number}}" value="{{$x}}">
    <div class="input-card d-none" data_id='{{$number}}'>
        <div class="c-head">
        @lang('Pridėkite komentarą')
            
            <span class="close"><i class="fa fa-times"></i></span>
            <span style="margin-right: 10px" class="delete"><i class="fa fa-trash"></i></span>

        </div>    
        <div class="c-body">
            <textarea class="text-input text" name="text-{{$number}}"   data_id="{{$number}}">{{$text}}</textarea>
        </div>
    </div>
</div>
