<div class="card " data_id="{{$number}}">
        <div class="c-head">
            <span class="dot-style d-inline-block" data_id="{{$number}}">
                {{$number}}
            </span>
             <img class="img-avatar img-avatar48 img-avatar-thumb c-user "  src="http://127.0.0.1:8000/media/avatars/avatar10.jpg" alt=""> 
            <span class="card-name">
                {{$user->name}}
            </span>
        </div>
        <div class="c-body card-input">
            {{$text}}
        </div>
    </div>