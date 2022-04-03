<div class="card " data_id="{{$number}}">
        <div class="c-head">
            <span class="dot-style d-inline-block c-user-dot" data_id="{{$number}}">
                {{$number}}
            </span> 

             <img id="small-profile-avatar" class=" img-avatar img-avatar-thumb c-user" src="http://127.0.0.1:8000/media/avatars/avatar0.png" alt="Header Avatar">

        </div>
        <div class="c-body">
            <span class="c-body-top-row">
                <span class="c-body-bottom-row-name">{{substr($user->name,0,7)}}...</span>
                <span class="c-body-bottom-row-date">{{date('M d, Y')}}</span>
            </span>
            <span class="c-body-bottom-row card-input"> {{$text}}</span>
        </div>
    </div>