<main>
   <div class="container-fluid">
      <div class="row">
         <div class="col-12">
            <h1>Generate an Inquiry</h1>
            <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
               <ol class="breadcrumb pt-0">
                  <li class="breadcrumb-item"><a href="<?php echo base_url().'admin/dashboard';?>">Dashboard</a></li>
                  <li class="breadcrumb-item"><a href="<?php echo base_url().'inquiry';?>">All Inquires</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Add</li>
               </ol>
            </nav>
            <div class="separator mb-5"></div>
         </div>
      </div>
      <div class="row">
         <div class="col-12">
            <div class="card mb-4">
               <div class="card-body">
                  <?php
                     $attributes = array('class' => 'form', 'id' => 'inquiryform');
                      echo form_open('', $attributes);
                  ?>
                  <div class="form-body">
                     <div class="row">
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="companyinput1" id="cust_update">Inquiry Date</label>
                              <input type="date" name="idate" class="form-control" placeholder="Inquiry date"  value= "<?php echo $inq[0]['inq_date'];?>" readonly/>
                              <input type="hidden" id="redirect" class="form-control" value= "<?php echo 'inquiry/view/'.$inq[0]['inq_id'];?>"/>
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="companyinput1" id="cust_update">Customer Name</label>
                              <input type="text" name="cname" class="form-control" placeholder="Customer Name" id ="cname" value= "<?php echo $inq[0]['c_name'];?>" readonly/>
                           </div>
                        </div>
                      
                     </div>

                     <div class="row">
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="companyinput1" id="cust_update">Customer Mobile</label>
                              <div class="row">
                                 <div class="col-md-4">
                                 <select class="form-control select2-single"  name="usstate">
                                       <option disabled="" selected></option>
                                       <?php if (is_array($code)) {
                                          foreach ($code as $ct) {
                                       ?>
                                             <option  <?php if($ct->countries_isd_code == $inq[0]['c_code']):?>selected <?php endif;?> value="<?php echo $ct->countries_isd_code; ?>" ><?php echo $ct->countries_isd_code.'-'.$ct->countries_iso_code; ?>
                                             </option>
                                       <?php }
                                       } ?>
                                 </select>
                                 </div>
                                 <div class="col-md-8">
                                    <input type="text" name="cmobile" class="form-control" placeholder="Customer mobile" id ="cmobile" value= "<?php echo $inq[0]['c_mobile'];?>" readonly/>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="companyinput1" id="cust_update">Customer Email</label>
                              <input type="text" name="email" class="form-control" placeholder="Customer Email" id="email" value= "<?php echo $inq[0]['c_email'];?>" readonly/>
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="companyinput1" id="cust_update">Reference Type</label>
                                 <select class="select2-single form-control"  name="rtype" id ="rtype">
                                 <?php if(is_array($rt)) { 
                                          foreach ($rt as $rt) {
                                    ?>
                                    <option <?php if($rt->rt_id==$inq[0]['rt_id']):?>selected<?php endif;?> value="<?php echo $rt->rt_id; ?>"><?php echo $rt->rt_name; ?></option>
                                    <?php } } ?>
                              </select>
                           </div>
                        </div>

                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="companyinput1" id="cust_update">Reference Name</label>
                              <input type="text" name="rname" class="form-control" placeholder="Refernce name"  id="rname" value= "<?php echo $inq[0]['r_name'];?>" readonly/>
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="companyinput1" id="cust_update">Scope of work</label>
                              <textarea name="sow" class="form-control" placeholder="Scope Of Work" id ="sow"><?php echo $inq[0]['inq_sow'];?></textarea>
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="companyinput1" id="cust_update">Site address</label>
                              <input type="text" name="address" class="form-control" placeholder="Address" id ="address" value= "<?php echo $inq[0]['inq_address'];?>"/>
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="companyinput1" id="cust_update">Site Person</label>
                              <input type="text" name="sperson" class="form-control" placeholder="Site Person" id ="s_person" value= "<?php echo $inq[0]['inq_sitePerson'];?>" />
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="companyinput1" id="cust_update">Site Contact No</label>
                              <input type="text" name="scontact" class="form-control" placeholder="Site Contact No" id ="s_contact"value= "<?php echo $inq[0]['inq_siteContact'];?>" />
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="companyinput1" id="cust_update">Site Date</label>
                              <input type="date" name="sdate" class="form-control" value= "<?php echo $inq[0]['inq_sdate'];?>"/>
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="companyinput1" id="cust_update">Follow Up Date</label>
                              <input type="date" name="fdate" class="form-control" placeholder="Inquiry date"  value= "<?php echo $inq[0]['inq_fdate'];?>"/>
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="companyinput1" id="cust_update">Site Inspection By</label>
                              <select class="select2-single form-control" multiple="" name="sup[]" id ="sup[]">
                                 <?php if(is_array($sup)) { 
                                          foreach ($sup as $sup) {
                                    ?>
                                    <option <?php if(in_array($sup->sup_id,$sup_array)):?>selected <?php endif;?> value="<?php echo $sup->sup_id; ?>"><?php echo $sup->sup_name; ?></option>
                                    <?php } } ?>
                              </select>
                           </div>
                        </div>
                        <div class="form-group col-md-6">
                        <label for="companyinput5">Status*</label>
                        <select id="status" class="form-control" name="ustatus">
                           <option <?php if (@$inq[0]['inq_status'] == '1') {
                                 echo "selected";
                                 } ?> value="1">Active</option>
                           <option <?php if (@$inq[0]['inq_status'] == '0') {
                                 echo "selected";
                                 } ?> value="0">De-active</option>
                        </select>
                     </div>
                     </div>
                  </div>
                  
                  <div class="form-actions">
                  
                     <button type="submit" id="inquiry" class="btn btn-primary">
                        <i class="la la-check-square-o"></i> Save
                     </button>
                     <a href="<?php echo base_url().'inquiry'; ?>" class="btn btn-danger mr-1">
                        <i class="ft-x"></i> Back
                     </a>
                  </div>
                  <?php echo form_close(); ?>
               </div>
            </div>
         </div>
      </div>
   </div>
</main>

