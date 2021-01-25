 <main>
   <div class="container-fluid">
      <div class="row">
         <div class="col-12">
            <h1>View Inquires</h1>
            <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
               <ol class="breadcrumb pt-0">
                  <li class="breadcrumb-item"><a href="<?php echo base_url() . 'admin/dashboard'; ?>">Dashboard</a>
                  </li>
                  <li class="breadcrumb-item"><a href="<?php echo base_url() . 'inquiry'; ?>">Inquiry List</a>
                  </li>
                  <li class="breadcrumb-item active" aria-current="page">View Inquiry</li>
               </ol>
            </nav>
            <div class="top-right-button-container">

               <a type="button" class="btn btn-outline-warning" href= "<?php echo base_url().'inquiry/add_inquirydetails/'.$inq['inq_id'];?>">Add Inspection Details</a>

               <a type="button" class="btn btn-outline-danger" href= "<?php echo base_url().'inquiry/upload_photographs/'.$inq['inq_id']?>">Upload Photographs</a>
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
                     Customer Details
                  </h5>
                  <table class="table table-borderless">
                     <thead>
                        <tr>
                           <th scope="col">#</th>
                           <th scope="col">Details</th>
                           <th scope="col">
                              <a href="<?php echo base_url() . 'inquiry/update_customer/' . $customer['c_id']; ?>">
                                 <i class="simple-icon-pencil" title="Update member"></i>
                              </a>
                           </th>
                        </tr>
                     </thead>
                     <tbody>
                        <tr>
                           <th scope="row">1</th>
                           <td>Customer name</td>
                           <td><?php echo $customer['c_name']; ?></td>
                        </tr>
                        <tr>
                           <th scope="row">3</th>
                           <td>Mobile number</td>
                           <td><?php echo '+' . $customer['c_code'] . ' ' . $customer['c_mobile']; ?></td>
                        </tr>
                        <tr>
                           <th scope="row">5</th>
                           <td>Email</td>
                           <td><?php echo $customer['c_email']; ?></td>
                        </tr>
                        <tr>
                           <th scope="row">8</th>
                           <td>Reference type</td>
                           <td><?php echo $customer['rt_name']; ?></td>
                        </tr>
                        <tr>
                           <th scope="row">9</th>
                           <td>Reference type name</td>
                           <td><?php echo $customer['r_name']; ?></td>
                        </tr>
                     </tbody>
                  </table>
               </div>
            </div>
         </div>
         <div class="col-lg-6 col-md-6 mb-4">
            <div class="card">
               <div class="card-body">
                  <h5 class="card-title">Miscellaneous Details</h5>
                  <table class="table table-borderless">
                     <thead>
                        <tr>
                           <th scope="col">#</th>
                           <th scope="col">Details</th>
                           <th scope="col">
                              <a href="<?php echo base_url(); ?>inquiry/update_inquiry/<?php echo $inq['inq_id'];?>">
                                 <i class="simple-icon-pencil" title="Update"></i></a>
                              </a>
                           </th>
                        </tr>
                     </thead>
                     <tbody>
                        <tr>
                           <th scope="row">1</th>
                           <td>Site Person</td>
                           <td><?php echo $inq['inq_sitePerson']; ?></td>
                        </tr>
                        <tr>
                           <th scope="row">2</th>
                           <td>Address</td>
                           <td><?php echo $inq['inq_address']; ?></td>
                        </tr>
                        <tr>
                           <th scope="row">3</th>
                           <td>Site Contact No.</td>
                           <td><?php echo $inq['inq_siteContact']; ?></td>
                        </tr>
                        <tr>
                           <th scope="row">4</th>
                           <td>Scope Of Work</td>
                           <td><?php echo $inq['inq_sow']; ?></td>
                        </tr>
                        <tr>
                           <th scope="row">5</th>
                           <td>Site Date</td>
                           <td><a for ="<?php echo $inq['inq_id']; ?>" class="update_site" data-csrf_token_name ="<?php echo $this->security->get_csrf_token_name(); ?>" data-csrf_token_hash = "<?php echo $this->security->get_csrf_hash(); ?>">
                              <?php echo date('d-M-Y',strtotime($inq['inq_sdate']));  ?>&nbsp;&nbsp;<i class="simple-icon-pencil"></i>
                           </a>
                           </td>
                        </tr>
                        <tr>
                           <th scope="row">6</th>
                           <td>Site Supervisor</td>
                           <td><?php echo $supervisor;?></td>
                        </tr>
                        <tr>
                           <th scope="row">7</th>
                           <td>Follow Up Date</td>
                           <td><?php echo date('d-M-Y',strtotime($inq['inq_fdate'])); ?></td>
                        </tr>
                        <tr>
                           <th scope="row">7</th>
                           <td>Leads Status</td>
                           <td><?php echo $lead['ls_name']; ?>
                             <a for ="<?php echo $inq['inq_id']; ?>" class="leadstatus"  data-csrf_token_name ="<?php echo $this->security->get_csrf_token_name(); ?>" data-csrf_token_hash = "<?php echo $this->security->get_csrf_hash(); ?>">
                                        <i class="simple-icon-pencil"></i>
                                    </a>
                           </td>
                        </tr>
                        </tr>
                     </tbody>
                  </table>
               </div>
            </div>
         </div>
         <div class="col-lg-6 col-md-6 mb-4">
            <div class="card">
               <div class="card-body">
                  <h5 class="card-title">Followp Details</h5>
                  <table class="table table-borderless">
                     <thead>
                        <tr>
                           <th scope="col">#</th>
                           <th scope="col">Details</th>
                           <th scope="col">
                              <a for ="<?php echo $inq['inq_id'];?>" class="add_followup" data-csrf_token_name ="<?php echo $this->security->get_csrf_token_name(); ?>" data-csrf_token_hash = "<?php echo $this->security->get_csrf_hash(); ?>">
                              <i class="simple-icon-pencil"></i>
                              </a>
                           </th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php
                        if (is_array($inqfr) && !empty($inqfr)) {
                           foreach ($inqfr as $inqfr) {
                        ?>
                              <tr>
                                 <th scope="row">1</th>
                                 <td>Follow Up Date</td>
                                 <td><?php echo $inqfr->ifr_date; ?></td>
                              </tr>
                              <tr>
                                 <th scope="row">2</th>
                                 <td>Follow Up Remark</td>
                                 <td><?php echo $inqfr->ifr_remark; ?></td>
                              </tr>
                              <tr>
                                 <th scope="col">2</th>
                                 <td>Leads Remark</td>
                                 <td><?php echo $inqfr->lead_remarks; ?></td>
                              </tr>
                        <?php
                           }
                        }
                        ?>
                     </tbody>
                  </table>
               </div>
            </div>
         </div>
         <div class="col-lg-6 col-md-6 mb-4">
            <div class="card">
               <div class="card-body">
                  <h5 class="card-title">Investigation Details</h5>
                  <table class="table table-borderless">
                     <thead>
                        <tr>
                           <th scope="col">#</th>
                           <th scope="col">Details</th>
                           <th scope="col">
                              
                           </th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php
                        if (is_array($inspect) && !empty($inspect)) {
                           foreach ($inspect as $inspect) {
                        ?>
                              <tr>
                                 <th scope="row">1</th>
                                 <td>Inspected By</td>
                                 <td> <a href="<?php echo base_url(); ?>inquiry/inspectiondetails/<?php echo $inq['inq_id'];?>"><?php echo $inspect->inqd_addedBy; ?>&nbsp;&nbsp;<i class="simple-icon-eye">
                                 </a></td>
                              </tr>
                        <?php
                           }
                        }
                        ?>
                     </tbody>
                  </table>
               </div>
            </div>
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
                    <input type="hidden" id="redirect" class="form-control" value= "<?php echo 'inquiry/view/'.$inq['inq_id'];?>"/>
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
                    <input type="hidden" id="redirect" class="form-control" value= "<?php echo 'inquiry/view/'.$inq['inq_id'];?>"/>
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

<div class="modal fade modal-right" id="lead_status" tabindex="-1" role="dialog" aria-labelledby="lead_status" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Change Lead Status</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php
                $attributes = array('class' => 'form', 'id' => 'update_leadstatus');
                echo form_open('', $attributes);
                ?>
                <div class="form-group">
                    <label>Lead Status</label>
                    <input type="hidden" name="inqu_id" class="form-control" id="inq" value= "<?php echo $inq['inq_id'];?>"/>
                    <input type="hidden" id="redirect" class="form-control" value= "<?php echo 'inquiry/view/'.$inq['inq_id'];?>"/>
                    <select class="form-control" name="lead" id="leads">
                        <option disabled="" selected>Select Lead Status</option>
                        <?php if (is_array($leads)) {
                            foreach ($leads as $leads) {
                        ?>
                                <option value="<?php echo $leads->ls_id; ?>"><?php echo $leads->ls_name; ?>
                                </option>
                        <?php }
                        } ?>
                    </select>
                </div>

               <div class="form-group">
                  <label for="companyinput1" id="cust_update">Remarks</label>
                  <textarea name="remark" id="remarks" class="form-control" cols="5" rows="4"></textarea>
               </div>
                <?php echo form_close(); ?>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" id ="leadstatus">Submit</button>
                <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>