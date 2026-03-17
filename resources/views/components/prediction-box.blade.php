<?php
$p = isset($data) ? $data : [];
$tc = isset($topContent) ? $topContent : '';
$bc = isset($bottomContent) ? $bottomContent : '';

$isSecure = isset($secure) ? $secure : false;
$v = isset($p['id']) && isset($p['seller']) && isset($p['home_club']) && 
     isset($p['away_club']) && isset($p['status']) && isset($p['free']) && isset($p['prediction_category']);

if(count($p) > 0 && $v)
{
$pid = $p['id'];
$cc = [];
$seller = $p['seller'];
$home = $p['home_club']; $homeImg = $home['logo'];
$away = $p['away_club']; $awayImg = $away['logo'];
$prediction = $p['prediction_category'];
$predictionText = $isSecure ? '***********' : '<b>'.ucwords($prediction['title']).'</b>';

$status =  "expired";
if($p['status'] === "ok") $status = "active";
else if($p['status'] === "lost") $status = "lost";
else if($p['status'] === "won") $status = "won";



$freeText = $p['free'] === 'yes' ? "<span class='free-text text-white'>Free</span>" : "";

$statusText =  "";

if($status === 'won'){
  $statusText = "<i class='fa fa-check-circle' style='color: green;'></i>";
}
else if($status === 'lost'){
  $statusText = "<i class='fa fa-times-circle' style='color: red;'></i>";
}
?>

<div class="game-box">
  {!! $tc !!}
            <p><img src="images/clubs/{{$homeImg}}" style="width: 20px; height: 20px;"/> {{$home['club_name']}} <b style=" margin-left: 5px; margin-right: 5px;">vs</b> {{$away['club_name']}} <img src="images/clubs/{{$awayImg}}" style="width: 20px; height: 20px;"/></p>
            <p>
             {!! $statusText !!} {!! $predictionText !!} {!! $freeText !!} 
              
            </p>      
            <p>Date added: <b>{{$p['date']}}</b></p>   
            <p>Kickoff: <b>{{$p['kickoff']}}</b></p>
  {!! $bc !!}
           </div>

<?php
}
else
{
?>
<div class="game-box">
    <p style='color: red'>Invalid Prediction Data</p>
</div>
<?php
}
?>