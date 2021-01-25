<main>
   <div class="container-fluid">
      <div class="row">
         <div class="col-12">
            <h1>All Inquires</h1>
            <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                    <ol class="breadcrumb pt-0">
                        <li class="breadcrumb-item"><a href="<?php echo base_url().'admin/dashboard'; ?>">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">All Inquires</li>
                    </ol>
                </nav>
            <div class="top-right-button-container">

               <a type="button" class="btn btn-outline-warning" href= "<?php echo base_url().'inquiry/add_inquiry'?>">Add an Inquiry</a>
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
                 if($this->session->flashdata('Inquirymsg')){
                 ?>
                   <div class="alert alert-success mb-2" role="alert">
                     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                       <span aria-hidden="true">&times;</span>
                     </button>

                     <?php
                         echo $this->session->flashdata('Inquirymsg');
                     ?>
                   </div>
                 <?php
                  }
               ?>
            <table id="datatableRows" class="data-table responsive nowrap" data-order="[[ 0, &quot;asc&quot; ]]">
             <thead>
                <tr>

                  <th>Sr.no</th>
                  <th>Date</th>
                  <th>Inquiry Id</th>
                  <th>Customer</th>
                  <th>Lead Status</th>
                  <th>Follow Up</th>
                  <th>Site Visit</th>
                  <th>Edit</th>
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

                          <td><?php echo $val['inq_id']; ?></td>
                          <td><?php echo date('d-m-Y',strtotime($val['inq_date'])); ?></td>                       
                          <td>
                            <a href="<?php echo base_url().'inquiry/view/'; ?><?php echo $val['inq_id']; ?>"> <?php echo $val['inq_id']; ?>
                               &nbsp;|&nbsp;&nbsp;<i class="simple-icon-eye"></i>
                            </a>
                          </td>
                          <td title="<?php echo $val['c_mobile']; ?>"><?php echo $val['c_name']; ?>
                            
                          </td>
                          <td><?php echo $val['ls_name']; ?></td>
                          
                          <td>
                              <a for ="<?php echo $val['inq_id']; ?>" class="add_followup" data-csrf_token_name ="<?php echo $this->security->get_csrf_token_name(); ?>" data-csrf_token_hash = "<?php echo $this->security->get_csrf_hash(); ?>">
                              <?php echo date('d-M-Y',strtotime($val['inq_fdate']));  ?>&nbsp;&nbsp;<i class="simple-icon-pencil"></i>
                              </a>
                          </td>
                          <td>
                              <a for ="<?php echo $val['inq_id']; ?>" class="update_site" data-csrf_token_name ="<?php echo $this->security->get_csrf_token_name(); ?>" data-csrf_token_hash = "<?php echo $this->security->get_csrf_hash(); ?>">
                              <?php echo date('d-M-Y',strtotime($val['inq_sdate']));  ?>&nbsp;&nbsp;<i class="simple-icon-pencil"></i>
                              </a>
                          </td>
                          <td>
                              <a href="<?php echo base_url(); ?>inquiry/update_inquiry/<?php echo $val['inq_id'];?>"><i class="simple-icon-pencil" title="Update"></i></a>
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

<div class="modal fade modal-right" id="add_followups" tabindex="-1" role="dialog" aria-labelledby="add_followups" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Follow Up</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php
                $attributes = array('class' => 'form', 'id' => 'add_followform');
                echo form_open('', $attributes);
                ?>
                <div class="form-group">
                    <label>Follow Up Old Date</label>
                    <input type="date" class="form-control" name = "inquirydate" id="inqdate">
                    <input type="hidden" name="inqu_id" class="form-control" id="inq_id"/>
                    <input type="hidden" id="redirect" class="form-control" value= "inquiry/allinquiries"/>
                </div>
               <div class="form-group">
                  <label for="companyinput1" id="cust_update">Follow Up New Date</label>
                  <input type="date" name="fndate" class="form-control" value= "<?php echo date('Y-m-d');?>"/>
               </div>
                <div class="form-group">
                    <label>Follow Up Remarks</label>
                    <textarea name="fremark" id="follow_r" class="form-control" cols="40" rows="10"></textarea>
                </div>
                

                <?php echo form_close(); ?>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" id ="addfollowup">Submit</button>
                <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade modal-right" id="update_sitevisit" tabindex="-1" role="dialog" aria-labelledby="update_sitevisit" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Site Date</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php
                $attributes = array('class' => 'form', 'id' => 'add_sitedateform');
                echo form_open('', $attributes);
                ?>
                <div class="form-group">
                    <label>Site Visit Old Date</label>
                    <input type="date" class="form-control" name = "sitedate" id="sitedate">
                    <input type="hidden" name="inqu_id" class="form-control" id="inquiry_id"/>
                    <input type="hidden" id="redirect" class="form-control" value= "inquiry/allinquiries"/>
                </div>
               <div class="form-group">
                  <label for="companyinput1" id="cust_update">Site Visit New Date</label>
                  <input type="date" name="sitenewdate" class="form-control" value= "<?php echo date('Y-m-d');?>"/>
               </div>
                <?php echo form_close(); ?>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" id ="sitevisitdate">Submit</button>
                <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>