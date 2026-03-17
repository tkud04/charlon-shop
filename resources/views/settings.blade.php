<?php
$void = 'javascript:void(0)';
$title = "Site Settings";
$activeClass = "settings";
$sidebar = 'components.admin-sidebar';
?>
@extends('dashboard_layout')

@section('title',$title)


@section('content')
  <!-- Fund history -->
  <section class="transaction-history mt-5 pt-5">
  <div class="container-fluid">
  @include('components.dashboard-title',['title' => $title])

  <div class="row">
        <div class="col-lg-12" style="padding-bottom: 10px;">
            <a class="btn btn-primary" href="{{url('add-setting')}}">Add setting</a>
        </div>
       </div>
       <div class="row">
          <div class="col">
             <div class="table-parent table-responsive">
                <table class="table table-striped mb-5">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Value</th>
                            <th scope="col">Status</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        /*

                        */
                         foreach($settings as $s)
                         {
                            $sid = $s['id'];
                           $vu = url('view-setting').'?xf='.$sid;
                           $ru = url('remove-setting').'?xf='.$sid;
                           $cu =  "confirmDelete('{$sid}')";
                        ?>
                          <tr>
                                <td>{{$sid}}</td>
                               <td>{{$s['name']}}</td>
                                <td>{{$s['value']}}</td>
                                <td>{{$s['status']}}</td>
                                <td>
                                   <a href="#" class="btn btn-primary" onclick="{{$cu}}"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                        <?php
                         }
                        ?>

                    </tbody>
                </table>

                <nav id="pagination">
    </nav>


             </div>
          </div>
       </div>
  
    </section>
  <!-- Fund history END -->

@stop

@section('scripts')
 <script>
     const confirmDelete = (pid) => {
            confirmAction(pid, 
			    (xf) => {
            removeSetting(xf,
				      () => {
			       		alert('Site setting removed');
					      window.location = 'settings';
				      },
				      (err) => {
				       	alert('Failed to remove setting: ',err);
				      }
			       )
           })
        
        }
 </script>
@stop

