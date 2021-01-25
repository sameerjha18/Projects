<main>
   <div class="container-fluid">
      <div class="row">
         <div class="col-12 mb-4 data-table-rows data-tables-hide-filter">
            <?php
            if (is_array($s_list) && !empty($s_list)) {
               foreach ($s_list as $val) {
            ?>
                  <div class="row">
                     <!-- <div class="col-lg-4"> -->
                        <div class="card mb-4 progress-banner">
                           <div class="card-body justify-content-between d-flex flex-row align-items-center">
                              <div>
                                 <div>
                                    <p class="lead text-white"><?php echo $val->site_name; ?></p>
                                    <p class="text-small text-white"><?php echo $val->site_address; ?></p>
                                 </div>
                              </div>
                           </div>
                        </div>
                     <!-- </div> -->
                  </div>
            <?php
               }
            }
            ?>
         </div>
      </div>
   </div>
</main>