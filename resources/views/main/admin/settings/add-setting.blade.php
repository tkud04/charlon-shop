<?php
$void = 'javascript:void(0)';
$title = "Add Setting";
$activeClass = "settings";
$sidebar = 'components.admin-sidebar';
?>
@extends('dashboard_layout')

@section('title',$title)


@section('content')
  <!-- Balance Transfer -->
  <section class="transaction-history profile-setting mt-5 pt-5">
  <div class="container-fluid">
  <div class="row">
  @include('components.dashboard-title',['title' => $title])

  <div class="edit-area">
            <form class="form-row" action="" method="post">
                 <div class="row">
                    <div class="col-md-6 mb-4">
                        <label for="name" class="golden-text">Name</label>
                        <input
                            type="text"
                            class="form-control"
                            id="name"
                            value="" placeholder="Name"
                        />
                        @include('components.form-validation', ['id' => "name-validation"])
                                            </div>

                    <div class="col-md-6 mb-4">
                        <label for="value" class="golden-text">Value</label>
                        <input
                            type="text"
                            id="value"
                            class="form-control"
                            value="" placeholder="Enter value"
                        />
                        @include('components.form-validation', ['id' => "value-validation"])
                    </div>

                    <div class="col-md-12 mb-4">
                        <label for="amount" class="golden-text">Status</label>
                        <select
                            id="status"
                            class="form-control"
                        >
                         <option value="none">Select value</option>
                         <option value="active">Active</option>
                         <option value="pending">Pending</option>
                        </select>
                        @include('components.form-validation', ['id' => "status-validation"])
                    </div>

                   
                </div>
                <button id="add-plan-btn" class="gold-btn">Submit</button>
                @include('components.form-loading', ['message' => 'Loading', 'id' => "add-plan-loading"])
                @include('components.form-validation', ['id' => "add-plan-error",'message' => "Email not found!"])
            </form>
        </div>

    </div>
    </div>
  </section>
@stop


@section('scripts')

<script>
   let pc = '';

 $(() => {
   $('.form-validation, .form-loading').hide();

    $('#add-plan-btn').click(async (e) => {
    e.preventDefault();
     const name = $('#name').val(), value = $('#value').val(), status = $('#status').val();
    
    const v = name.length < 1 || value.length < 1 || status.length < 1;

     if(v){
      if(name.length < 1) $('#name-validation').fadeIn();
      if(value.length < 1) $('#value-validation').fadeIn();
      if(status.length < 1) $('#status-validation').fadeIn();
     }
     else{
        toggleFormButton({id: 'add-plan',mode: 'hide'});

       
        addSetting(
            {name,value,status},
                (data) => {
                   toggleFormButton({id: 'add-plan',mode: 'show'});

                   if(data.status === 'ok'){
                    
                      window.location = 'settings';
                   }
                   else if(data.status === 'error'){
                     handleResponseError(data);
                   }
                },
                (err) => {
                    toggleFormButton({id: 'add-plan',mode: 'show'});
                    alert(`Failed to add setting: ${err}`)
                }
        );
        
     }
   });
 });     
</script>

@stop


