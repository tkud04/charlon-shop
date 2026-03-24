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
                    console.log('data: ',"firstPage: <?php echo e($firstPage); ?>, tp: <?php echo e($tp); ?>, lastPage: <?php echo e($lastPage); ?>, p: <?php echo e($p); ?>");
                  </script>
                  <?php
                    for($i = $firstPage; $i < $lastPage; $i++)
                    {
                      $p2 = $pu."&page=".($i + 1);
                      $ss = ($i + 1) === $p ? "active" : "";
                  ?>
                 
                  <li class="<?php echo e($ss); ?>">
                    <a href="<?php echo e($p2); ?>"><?php echo e($i + 1); ?></a>
                  </li>
                  <?php
                    }
                  ?>
                  <li>
                    <a href="<?php echo e($nu); ?>">
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
            </div><?php /**PATH /Users/tobikudayisi/repos/charlon-shop/resources/views/components/pagination2.blade.php ENDPATH**/ ?>