<?php
 $p = (isset($page) && intval($page) > 0) ? $page : '1';
 $tp = (isset($totalPages) && intval($totalPages) > 0) ? $totalPages : '1';
 $pu = isset($url) ? $url : '#';
 $nu = $pu."&op=next";
?>

<div class="category-toolbar clearfix">
               
              <div class="toolbox-pagination clearfix">
                <ul class="pagination">
                  <?php
                    $firstPage = ($p - 5) < 1 ? 0 : ($p - 5);
                    $lastPage = ($tp > ($firstPage + 5)) ? ($firstPage + 5) : $tp;
                  ?>
                     <script>
                    console.log('data: ',"firstPage: {{$firstPage}}, tp: {{$tp}}, lastPage: {{$lastPage}}, p: {{$p}}");
                  </script>
                  <?php
                    for($i = $firstPage; $i < $lastPage; $i++)
                    {
                      $p2 = $pu."&page=".($i + 1);
                      $ss = ($i + 1) === $p ? "active" : "";
                  ?>
                 
                  <li class="{{$ss}}">
                    <a href="{{$p2}}">{{$i + 1}}</a>
                  </li>
                  <?php
                    }
                  ?>
                  <li>
                    <a href="{{$nu}}">
                      <i class="fa fa-angle-right"></i>
                    </a>
                  </li>
                </ul>
                <div class="view-count-box">
                  <span class="separator">view:</span>
                  <div class="btn-group select-dropdown">
                    <button type="button" class="btn select-btn">9</button>
                    <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                      <i class="fa fa-angle-down"></i>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                      <li>
                        <a href="#">9</a>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>