<?php
$void = 'javascript:void(0)';
$title = "Send Mail";
?>
@extends('layout')

@section('title',$title)


@section('content')
<div class="container-fluid">
   <div class="row">
      <div class="col-12">
         <h3 class="text-center">Send a batch of emails</h3>
         <form>
            <div class="row">
               <div class="col-6 mb-4">
                  <label for="s" class="form-label">Select sender</label>
                  <select class="form-control" id="s">
                     <option value="none">Select an option</option>
                     @foreach($senders as $sender)
                     <option value="{{$sender['id']}}">{{$sender['su']}}</option>
                     @endforeach
                  </select>
                  @include('components.form-validation',['id' => 's'])
               </div>
               <div class="col-6 mb-4">
                  <label for="n" class="form-label">Sender name</label>
                  <input type="text" class="form-control" id="n" placeholder="john doe" required="">
                  @include('components.form-validation',['id' => 'n'])
               </div>
               <div class="col-6 mb-4">
                  <label for="sub" class="form-label">Subject</label>
                  <input type="text" class="form-control" id="sub" placeholder="email subject" required="">
                  @include('components.form-validation',['id' => 'sub'])
               </div>
               <div class="col-6 mb-4">
                  <label for="d" class="form-label">Delay between email send (seconds)</label>
                  <input type="number" class="form-control" id="d" placeholder="Delay between email send" required="">
                  @include('components.form-validation',['id' => 'd'])
               </div>
               <div class="col-6 mb-4">
                  <label for="l" class="form-label">Leads (1 per line)</label>
                  <textarea class="form-control" id="l" placeholder="Patse leads here, 1 per line" rows="8" required=""></textarea>
                  @include('components.form-validation',['id' => 'l'])
               </div>
               <div class="col-6 mb-4">
               <label for="b" class="form-label">Message</label>
               <div  id="b"></div>
               @include('components.form-validation',['id' => 'b'])
               </div>
               <div class="col-12 p-2">
                                         <div class="contact-form-btn">
                                         @include('components.button',['id' => 'bomb'])
                                         </div>
                                         @include('components.form-loading',['id' => 'bomb'])
                                     </div>

            </div>
            <div class="col-12 m-4" id="bomb-results"></div>
         </form>
      </div>
   </div>
</div>
@stop

@section('scripts')
<script src="lib/ckeditor/ckeditor.js"></script>
<script>  

const confirmBomb = (payload={s:'',n:'',sub:'',b:'',d:1,i:0}) => {
   
          confirmAction(payload, 
              (p) => {
           bomb(payload,
            () => {
               alert('All emails sent!');
               //window.location.reload();
            },
            (err) => {
              alert('error occured');
              console.log('Failed to bomb: ',err);
            }
           );
         });
      
      }

$(() => {
   hideFormValidations();
   initHTMLEditor('b');

   

   $('#bomb-btn').click(e => {
            e.preventDefault();
            hideFormValidations();
            $('#bomb-results').html('');

           
            const s = $('#s').val(), n = $('#n').val(), b = CKEDITOR.instances.b.getData(),
            sub = $('#sub').val(), d = $('#d').val(), l = $('#l').val();
           
            const v = /*n.length < 1 || */sub.length < 1 || b.length < 1 ||
                  s === 'none' ||  (parseInt(d) < 1 || d.length < 1) || l.length < 1;
           console.log('s: ',s);
            if(v){
              //if(n.length < 1) $('#n-validation').fadeIn();
              if(sub.length < 1) $('#sub-validation').fadeIn();
              if(b.length < 1) $('#b-validation').fadeIn();
              if(l.length < 1) $('#l-validation').fadeIn();
              if(s === 'none') $('#s-validation').fadeIn();
              if(parseInt(d) < 1 || d.length < 1) $('#d-validation').fadeIn();
            }
            else{
              ll = l.split('\n');
              console.log('ll: ',ll);

              if(Array.isArray(ll) && ll.length > 0){
                 toggleFormButton({id: 'bomb',mode: 'hide'});
                 let payload = {s,n,sub,b,d,i:0};
                 confirmBomb(payload);
              }
              else{
               alert('Invalid leads');
              }
             
            }
            
        });
});
</script>
@stop


