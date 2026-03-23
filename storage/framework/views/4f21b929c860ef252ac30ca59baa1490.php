<?php
 $cats = isset($categories) ? $categories : [];
?>
<div class="widget">
              <div class="panel-group custom-accordion sm-accordion" id="category-filter">
                <div class="panel">
                  <div class="accordion-header">
                    <div class="accordion-title">
                      <span>Category</span>
                    </div>
                    <a class="accordion-btn opened" data-toggle="collapse" data-target="#category-list-1"></a>
                  </div>
                  <div id="category-list-1" class="collapse in">
                    <div class="panel-body">
                      <ul class="category-filter-list jscrollpane jspScrollable" style="height: 300px; overflow: hidden; padding: 0px; width: 178px;" tabindex="0">
                        <div class="jspContainer" style="width: 178px; height: 300px;">
                          <div class="jspPane" style="padding: 0px; top: 0px; width: 171px;">
                            <?php
                             foreach($cats as $cc)
                             {
                                $vu = url('category')."?xf=".$cc['slug'];
                            ?>
                            <li>
                              <a href="<?php echo e($vu); ?>"><?php echo e($cc['title']); ?> (<?php echo e($cc['product_count']); ?>)</a>
                            </li>
                            <?php
                             }
                            ?>
                            
                          </div>
                          <div class="jspVerticalBar">
                            <div class="jspCap jspCapTop"></div>
                            <div class="jspTrack" style="height: 300px;">
                              <div class="jspDrag" style="height: 129px;">
                                <div class="jspDragTop"></div>
                                <div class="jspDragBottom"></div>
                              </div>
                            </div>
                            <div class="jspCap jspCapBottom"></div>
                          </div>
                        </div>
                      </ul>
                    </div>
                  </div>
                </div>
                <div class="panel">
                  <div class="accordion-header">
                    <div class="accordion-title">
                      <span>Brand</span>
                    </div>
                    <a class="accordion-btn opened" data-toggle="collapse" data-target="#category-list-2"></a>
                  </div>
                  <div id="category-list-2" class="collapse in">
                    <div class="panel-body">
                      <ul class="category-filter-list jscrollpane">
                        <?php
                          foreach($brands as $brand)
                          {
                            $bu = url('brand')."?xf=".$brand['slug'];
                        ?>
                        <li>
                          <a href="<?php echo e($bu); ?>"><?php echo e($brand['title']); ?>(<?php echo e($brand['product_count']); ?>)</a>
                        </li>
                        <?php
                          }
                        ?>
                      </ul>
                    </div>
                  </div>
                </div>
                <div class="panel">
                  <div class="accordion-header">
                    <div class="accordion-title">
                      <span>Price</span>
                    </div>
                    <a class="accordion-btn opened" data-toggle="collapse" data-target="#category-list-3"></a>
                  </div>
                  <div id="category-list-3" class="collapse in">
                    <div class="panel-body">
                      <div id="price-range" class="noUi-target noUi-ltr noUi-horizontal noUi-background">
                        <div class="noUi-base">
                          <div class="noUi-origin noUi-connect" data-style="left" style="left: 0%;">
                            <div class="noUi-handle noUi-handle-lower"></div>
                          </div>
                          <div class="noUi-origin noUi-background" data-style="left" style="left: 100%;">
                            <div class="noUi-handle noUi-handle-upper"></div>
                          </div>
                        </div>
                      </div>
                      <div id="price-range-details">
                        <span class="sm-separator">from</span>
                        <input type="text" id="price-range-low" class="separator">
                        <span class="sm-separator">to</span>
                        <input type="text" id="price-range-high">
                      </div>
                      <div id="price-range-btns">
                        <a href="#" class="btn btn-custom-2 btn-sm">Ok</a>
                        <a href="#" class="btn btn-custom-2 btn-sm">Clear</a>
                      </div>
                    </div>
                  </div>
                </div>
                <!--
                <div class="panel">
                  <div class="accordion-header">
                    <div class="accordion-title">
                      <span>Color</span>
                    </div>
                    <a class="accordion-btn opened" data-toggle="collapse" data-target="#category-list-4"></a>
                  </div>
                  <div id="category-list-4" class="collapse in">
                    <div class="panel-body">
                      <ul class="filter-color-list clearfix">
                        <li>
                          <a href="#" data-bgcolor="#fff" class="filter-color-box" style="background-color: rgb(255, 255, 255);"></a>
                        </li>
                        <li>
                          <a href="#" data-bgcolor="#ffff33" class="filter-color-box" style="background-color: rgb(255, 255, 51);"></a>
                        </li>
                        <li>
                          <a href="#" data-bgcolor="#ff9900" class="filter-color-box" style="background-color: rgb(255, 153, 0);"></a>
                        </li>
                        <li class="last-md">
                          <a href="#" data-bgcolor="#ff9999" class="filter-color-box" style="background-color: rgb(255, 153, 153);"></a>
                        </li>
                        <li class="last-lg">
                          <a href="#" data-bgcolor="#99cc33" class="filter-color-box" style="background-color: rgb(153, 204, 51);"></a>
                        </li>
                        <li>
                          <a href="#" data-bgcolor="#339933" class="filter-color-box" style="background-color: rgb(51, 153, 51);"></a>
                        </li>
                        <li>
                          <a href="#" data-bgcolor="#ff0000" class="filter-color-box" style="background-color: rgb(255, 0, 0);"></a>
                        </li>
                        <li class="last-md">
                          <a href="#" data-bgcolor="#ff3366" class="filter-color-box" style="background-color: rgb(255, 51, 102);"></a>
                        </li>
                        <li>
                          <a href="#" data-bgcolor="#cc33ff" class="filter-color-box" style="background-color: rgb(204, 51, 255);"></a>
                        </li>
                        <li class="last-lg">
                          <a href="#" data-bgcolor="#9966cc" class="filter-color-box" style="background-color: rgb(153, 102, 204);"></a>
                        </li>
                        <li>
                          <a href="#" data-bgcolor="#99ccff" class="filter-color-box" style="background-color: rgb(153, 204, 255);"></a>
                        </li>
                        <li class="last-md">
                          <a href="#" data-bgcolor="#3333cc" class="filter-color-box" style="background-color: rgb(51, 51, 204);"></a>
                        </li>
                        <li>
                          <a href="#" data-bgcolor="#999999" class="filter-color-box" style="background-color: rgb(153, 153, 153);"></a>
                        </li>
                        <li>
                          <a href="#" data-bgcolor="#663300" class="filter-color-box" style="background-color: rgb(102, 51, 0);"></a>
                        </li>
                        <li class="last-lg">
                          <a href="#" data-bgcolor="#000" class="filter-color-box" style="background-color: rgb(0, 0, 0);"></a>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
                  -->
              </div>
            </div>

            <div class="widget banner-slider-container">
              <div class="banner-slider flexslider">
                <ul class="banner-slider-list clearfix">
                  <li class="flex-active-slide" style="width: 100%; float: left; margin-right: -100%; position: relative; opacity: 1; display: block; z-index: 2;">
                    <a href="#">
                      <img src="images/banner1.jpg" alt="Banner 1" draggable="false">
                    </a>
                  </li>
                  <li class="" style="width: 100%; float: left; margin-right: -100%; position: relative; opacity: 0; display: block; z-index: 1;">
                    <a href="#">
                      <img src="images/banner2.jpg" alt="Banner 2" draggable="false">
                    </a>
                  </li>
                  <li class="" style="width: 100%; float: left; margin-right: -100%; position: relative; opacity: 0; display: block; z-index: 1;">
                    <a href="#">
                      <img src="images/banner3.jpg" alt="Banner 3" draggable="false">
                    </a>
                  </li>
                </ul>
                <ol class="flex-control-nav flex-control-paging">
                  <li>
                    <a class="flex-active">1</a>
                  </li>
                  <li>
                    <a class="">2</a>
                  </li>
                  <li>
                    <a class="">3</a>
                  </li>
                </ol>
              </div>
            </div><?php /**PATH /Users/tobikudayisi/repos/charlon-shop/resources/views/components/category-sidebar.blade.php ENDPATH**/ ?>