<main>
   <div class="container-fluid">
      <div class="row">
         <div class="col-12">
            <h1>Investigation Details</h1>
            <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                <ol class="breadcrumb pt-0">
                    <li class="breadcrumb-item"><a href="<?php echo base_url().'admin/dashboard'; ?>">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">All Inquires</li>
                </ol>
            </nav>
            <div class="top-right-button-container">

               <a type="button" class="btn btn-outline-warning" href= "<?php echo base_url().'supervisor/upload_photographs/'.$inq_id?>">Upload Photographs</a>
              <a type="button" class="btn btn-outline-warning" href= "<?php echo base_url().'supervisor/add_inquirydetails/'.$inq_id?>">Add Inspection Details</a>
               <div class="btn-group">
                  <button class="btn btn-outline-primary btn-lg dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">EXPORT</button>
                  <div class="dropdown-menu"><a class="dropdown-item" id="dataTablesCopy" href="#">Copy</a> <a class="dropdown-item" id="dataTablesExcel" href="#">Excel</a> <a class="dropdown-item" id="dataTablesCsv" href="#">Csv</a> <a class="dropdown-item" id="dataTablesPdf" href="#">Pdf</a></div>
               </div>
            </div>
         </div>
      </div>
      <div class="row">
         <div class="col-lg-6 col-md-6 mb-4">
            <div class="card">
               <div class="card-body">
                  <h5 class="card-title">
                     Investigation Details
                  </h5>
                  <table class="table table-borderless">
                     <thead>
                      <?php
                      if(is_array($id) && !empty($id))
                      {
                      ?>
                      <?php
                      foreach($id as $val)
                      {
                      ?>
                        <tr>
                           <th scope="col">#</th>
                           <th scope="col">Details</th>
                           <th scope="col">
                              <a href="<?php echo base_url().'supervisor/update_inquirydetails/'.$val->inq_id.'/'.$val->inqd_id; ?>">
                                 <i class="simple-icon-pencil" title="Update member"></i>
                              </a>
                           </th>
                        </tr>
                     </thead>
                     <tbody>
                        <tr>
                           <th scope="row">1</th>
                           <th>Area</th>
                           <td><?php echo $val->inqd_area;?></td>
                        </tr>
                        <tr>
                           <th scope="row">2</th>
                           <th>Openable Grill Distance</th>
                           <td><?php echo $val->inqd_ogd;?></td>
                        </tr>
                        <tr>
                           <th scope="row">3</th>
                           <th>Exhaust Fan Size</th>
                          <td><?php echo $val->inqd_efs;?></td>
                        </tr>
                        <tr>
                           <th scope="row">4</th>
                           <th>Jaali Position</th>
                           <td><?php echo $val->inqd_jp;?></td>
                        </tr>
                        <?php
                          }
                        ?>
                     </tbody>
                     <?php
                      }
                      ?>
                  </table>
               </div>
            </div>
         </div>
         <div class="col-lg-6 col-md-6 mb-4">
            <div class="card">
               <div class="card-body">
                  <h5 class="card-title">
                     Investigation Details
                  </h5>
                  <table class="table table-borderless">
                     <thead>
                      <?php
                      if(is_array($id) && !empty($id))
                      {
                      ?>
                      <?php
                      foreach($id as $val)
                      {
                      ?>
                        <tr>
                           <th scope="col">#</th>
                           <th scope="col">Details</th>
                        </tr>
                     </thead>
                     <tbody>
                        <tr>
                           <th scope="row">5</th>
                           <th>Marbel Size</th>
                          <td><?php echo $val->inqd_mSize;?></td>
                        </tr>
                        <tr>
                           <th scope="row">6</th>
                           <th>P Coating</th>
                          <td><?php echo $val->inqd_pCoating;?></td>
                        </tr>
                        <tr>
                           <th scope="row">7</th>
                           <th>Glass</th>
                          <td><?php echo $val->inqd_glass;?></td>
                        </tr>
                        <tr>
                           <th scope="row">8</th>
                           <th>Aluminium Section</th>
                          <td><?php echo $val->inqd_aSection;?></td>
                        </tr>
                        <?php
                          }
                        ?>
                     </tbody>
                     <?php
                      }
                      ?>
                  </table>
               </div>
            </div>
      </div>
    </div>
      <div class="row">
               <div class="col-12 mb-4 data-table-rows data-tables-hide-filter">
                    <?php
                       if($this->session->flashdata('Productmsg')){
                       ?>
                         <div class="alert alert-success mb-2" role="alert">
                           <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                             <span aria-hidden="true">&times;</span>
                           </button>

                           <?php
                               echo $this->session->flashdata('Productmsg');
                           ?>
                         </div>
                       <?php
                        }
                     ?>
                  <table id="datatableRows" class="data-table responsive nowrap" data-order="[[ 0, &quot;asc&quot; ]]">
                     <thead>
                        <tr>                          
                           <th>Sr. No</th>
                           <th>Description</th>
                           <th>Image</th>
                        </tr>
                     </thead>
                     <tbody>
                           <?php
                              if(is_array($id_img) && !empty($id_img))
                              {
                                 $i = 1;
                              foreach($id_img as $val)
                              {
                           ?>
                           <tr>
                              <td><?php echo $i; ?></td>
                              <td><?php echo $val->img_descriptions;?></td>
                              <td><a href="<?php echo base_url().'uploads/inspectionimages/'.$val->img_name; ?>" target="_blank"><?php echo $val->img_name; ?></a></td>
                             
                           </tr>
                        <?php
                        /*$i++;*/
                              }
                           }
                        ?>
                     </tbody>
                  </table>
               </div>
      </div>
   </div>
</main>