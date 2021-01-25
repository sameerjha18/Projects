<main>
   <div class="container-fluid">
      <div class="row">
         <div class="col-12">
            <h1>All Inquires</h1>
               <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                    <ol class="breadcrumb pt-0">
                        <li class="breadcrumb-item"><a href="<?php echo base_url().'admin/dashboard'; ?>">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page"><a href="<?php echo base_url() . 'inquiry'; ?>">All Inquires</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Customer List</li>
                    </ol>
                </nav>
            <div class="top-right-button-container">
               <a type="button" class="btn btn-outline-warning" href= "<?php echo base_url().'inquiry/add_inquiry'?>">Add Inquires</a>
               <div class="btn-group">
                  <button class="btn btn-outline-primary btn-lg dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">EXPORT</button>
                  <div class="dropdown-menu"><a class="dropdown-item" id="dataTablesCopy" href="#">Copy</a> <a class="dropdown-item" id="dataTablesExcel" href="#">Excel</a> <a class="dropdown-item" id="dataTablesCsv" href="#">Csv</a> <a class="dropdown-item" id="dataTablesPdf" href="#">Pdf</a></div>
               </div>
            </div>
            <div class="mb-2">
               <a class="btn pt-0 pl-0 d-inline-block d-md-none" data-toggle="collapse" href="#displayOptions" role="button" aria-expanded="true" aria-controls="displayOptions">Display Options <i class="simple-icon-arrow-down align-middle"></i></a>
               <div class="collapse dont-collapse-sm" id="displayOptions">
                  <div class="d-block d-md-inline-block">
                     <div class="search-sm d-inline-block float-md-left mr-1 mb-1 align-top"><input class="form-control" placeholder="Search Table" id="searchDatatable"></div>
                  </div>
                  <div class="float-md-right dropdown-as-select" id="pageCountDatatable">
                     <span class="text-muted text-small">Displaying 1-10 of 40 items </span><button class="btn btn-outline-dark btn-xs dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">10</button>
                     <div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item" href="#">5</a> <a class="dropdown-item active" href="#">10</a> <a class="dropdown-item" href="#">20</a></div>
                  </div>
               </div>
            </div>
            <div class="separator"></div>
         </div>
      </div>
      <div class="row">
         <div class="col-12 mb-4 data-table-rows data-tables-hide-filter">
              <?php
                 if($this->session->flashdata('Customermsg')){
                 ?>
                   <div class="alert alert-success mb-2" role="alert">
                     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                       <span aria-hidden="true">&times;</span>
                     </button>

                     <?php
                         echo $this->session->flashdata('Customermsg');
                     ?>
                   </div>
                 <?php
                  }
               ?>
            <table id="datatableRows" class="data-table responsive nowrap" data-order="[[ 0, &quot;asc&quot; ]]">
             <thead>
                <tr>
                  <th>Name</th>
                  <th>Mobile</th>
                  <th>Email</th>
                  <th>Update </th>
                </tr>
              </thead>
              <?php
                      if(is_array($cl) && !empty($cl))
                      {
                      ?>
                      <tbody>
                      <?php
                      $i = 1;
                      foreach($cl as $val)
                      { 
                      ?>
                        <tr>
                          <td><?php echo $val->c_name; ?></td>
                          <td><?php echo '+'.$val->c_code.' '.$val->c_mobile; ?></td>       
                          <td><?php echo $val->c_email; ?> </td>                  
                          <td>
                             <a href="<?php echo base_url().'inquiry/update_customer/'; ?><?php echo $val->c_id; ?>"><i class="simple-icon-pencil" title="Update member"></i> 
                            </a>
                          </td>
                        </tr>
                      <?php
                      $i++;
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
</main>
