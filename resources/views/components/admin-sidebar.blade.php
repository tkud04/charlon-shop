<?php
$data = [
  ['url' => url('admin'), 'icon' => "fa-light fa-dashboard",'label' => "Dashboard"],
  ['url' => url('site-messages'), 'icon' => "fa-light fa-envelope",'label' => "Site Messages"],
  ['url' => url('members2'), 'icon' => "fa-light fa-users",'label' => "Members"],
  ['url' => url('events'), 'icon' => "fa-light fa-calendar",'label' => "Events"],
  ['url' => url('donations'), 'icon' => "fa-light fa-wallet",'label' => "Donations"],
  ['url' => url('admin-forum'), 'icon' => "fa-light fa-rss",'label' => "Forum"],
  ['url' => url('gallery-items'), 'icon' => "fa-light fa-image",'label' => "Gallery Items"],
  ['url' => url('settings'), 'icon' => "fa-light fa-wrench",'label' => "Site Settings"],
  ['url' => url('senders'), 'icon' => "fa-light fa-send",'label' => "SMTP settings"],
  ['url' => url('plugins'), 'icon' => "fa-light fa-gears",'label' => "Site Plugins"],
];
?>

<div class="list-group">
   <?php
     foreach($data as $d)
     {
   ?>
       <a href="{{$d['url']}}" class="list-group-item list-group-item-action"> <i class="fa-light {{$d['icon']}}" style="margin-right: 5px;"></i> {{$d['label']}}</a> 
    <?php
     }
    ?>
</div>