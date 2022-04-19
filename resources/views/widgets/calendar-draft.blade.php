<?php
//$events=[];
//$Y=2022;
//$M=4;
$holidays=[
    ['m'=>'01','d'=>'01'],
    ['m'=>'02','d'=>'16'],
    ['m'=>'03','d'=>'11'],
    ['m'=>'05','d'=>'01'],
    ['m'=>'06','d'=>'24'],
    ['m'=>'07','d'=>'06'],
    ['m'=>'08','d'=>'15'],
    ['m'=>'11','d'=>'01'],
    ['m'=>'11','d'=>'02'],
    ['m'=>'12','d'=>'24'],
    ['m'=>'12','d'=>'25']
];
foreach($events as $event)
{   
 $event->start_datetime=$event->created_at;
 $event->end_datetime=$event->expected_at;
}
//require_once('C:\Users\Deividas\Documents\Laravel\KABG\resources\views\events\classes.php');
/*
$holiday1= new Holiday(12,26,$Y);
$holiday2= new Holiday(date('m',easter_date($Y)),date('d',easter_date($Y))+1,$Y);
$holiday3= new Holiday(2,11,$Y);
$holiday4= new Holiday(2,16,$Y);
$holidayBreaks= [
    new HolidayBreak($holiday1,2,'Kalėdų'),
    new HolidayBreak($holiday2,1,'Pavasario'),
    new HolidayBreak($holiday3,1,'Rudens'),
    new HolidayBreak($holiday3,1,'Žiemos')
];
*/
/*
foreach( $holidayBreaks as $holidayBreak){
    $holidayBreak->data();
}
*/
$month=date('F', mktime(0, 0, 0, $M,1));
$calendar=CAL_GREGORIAN;
$W=gregoriantojd($M,1,$Y);
$W=jddayofweek($W,0);
$d=0;
$today_month=date('m');
$today_day=date('d');
$today_year=date('Y');
if($M>1) $cal_days_in_month_last=cal_days_in_month($calendar,$M-1,$Y);
else $cal_days_in_month_last=cal_days_in_month($calendar,12,$Y-1);
$cal_days_in_month=cal_days_in_month($calendar,$M,$Y);
$offset=$W-1;
function cal_day($d,$offset,$cal_days_in_month_last,$cal_days_in_month){
    $D=$d-$offset;
    if($D<1){
        return $cal_days_in_month_last+$D;
    }
    if($D>$cal_days_in_month)
    {
        return $D-$cal_days_in_month;
    } 
    return $D;
}
$M=strval($M);
if(strlen($M)<2) $M='0'.$M;  
?>

<div>


<div id='month' class="d-none">{{$M}}</div>
<div id='year' class="d-none">{{$Y}}</div>
<div class="event_description" style="display:none">



<div class="close" id="event_close"><i class="fas fa-times"></i></div>
@foreach($events as $event)
<div id="event-{{$event->id}}" class="event inactive-eve" >
    <div class="card-body">
        <h5 class="card-title">{{$event->name}}</h5>
        <p class="card-text">
        Tipas: {{$event->type}}<br>
        Pradžios data: {{$event->created_at}}<br>
        Pabaigos data: {{$event->expected_at}}<br>
        Likęs laikas : <span  class="expected" data-time="{{$event->expected_at}}">01:43:09</span>
        </p>
        <a class="btn spec-btn">Spauskite cia</a>
    </div>
</div>
@endforeach




</div>

<table class=" calendar">
    <thead>
    <tr>
        
    <th id="calendar-next-t" class="cal-buttons p-0" data_M="{{$M-1}}" data_Y="{{$Y}}" data_url="{{route('calendar.update')}}">
    <i class="fas fa-chevron-left"></i></th>      
    <th colspan="5" class="px-0 py-1">{{__($month)}} {{$Y}}</th>
    <th id="calendar-previous-t" class="cal-buttons p-0" data_M="{{$M+1}}" data_Y="{{$Y}}" data_url="{{route('calendar.update')}}">
    <i class="fas fa-chevron-right"></i></th>
    </tr>
        <tr>
            <td>{{__('P')}}</td>
            <td>{{__('A')}}</td>
            <td>{{__('T')}}</td>
            <td>{{__('K')}}</td>
            <td>{{__('P')}}</td>
            <td>{{__('Š')}}</td>
            <td>{{__('S')}}</td>
        </tr>
    </thead>
<?php
$maxd=5;
if($offset+$cal_days_in_month>5*7) $maxd++;
for($i=0;$i<$maxd;$i++)
{
    echo "<tr>";
for($y=1;$y<=7;$y++)
{
    $day=($y+7*$i)-$offset;
    $eve='<td class="';
    
    foreach($events as $event)
    {   
        $stime=strtotime($event->start_datetime);
        $etime=strtotime($event->end_datetime);

        
        if($day<10){
            $day='0'.$day;
        }
        if(date('Y-m-d',$stime)<=date($Y.'-'.$M.'-'.$day) && date('Y-m-d',$etime)>=date($Y.'-'.$M.'-'.$day))
        {
            $eve.="event-".$event->id." ";

        }
    }
    
    foreach($holidays as $holiday)
    { 
    if($M==$holiday['m'] && $day==$holiday['d']) $eve.=' holiday '; 
    }

    $dayy=$y+7*$i;
    if($dayy-$offset<1 || $dayy-$offset>$cal_days_in_month){
        $eve.="inactive-cal ";
    }
    if($dayy-$offset==$today_day && $M==$today_month && $Y==$today_year){
        $eve.="cal-today ";
    }
    $eve.='">'.cal_day($dayy,$offset,$cal_days_in_month_last,$cal_days_in_month).'</td>';
    echo $eve;

}
echo "</tr>";
}
?>
</table>






