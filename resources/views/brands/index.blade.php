@include('widgets.filter')
@foreach($brands as $brand)
{{$brand->id}} {{$brand->name}}
<br>
@endforeac)