<main>
   <div class="container-fluid">
      <div class="row">
         <div class="col-12">
            <h1>Update Customer Details</h1>
            <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
               <ol class="breadcrumb pt-0">
                  <li class="breadcrumb-item"><a href="<?php echo base_url().'admin/dashboard';?>">Dashboard</a></li>
                  <li class="breadcrumb-item"><a href="<?php echo base_url().'inquiry';?>">All Inquires</a></li>
                  <li class="breadcrumb-item"><a href="<?php echo base_url().'inquiry/customers';?>">All Customers</a></li>

                  <li class="breadcrumb-item active" aria-current="page">Update Customer</li>

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
                     $attributes = array('class' => 'form', 'id' => 'update_customerform');
                     echo form_open('', $attributes);
                  ?>
                  <div class="form-body">
                     <div class="row">
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="companyinput1" id="cust_update">Customer Name</label>
                              <input type="text" name="cname" class="form-control" placeholder="Customer Name" id ="cname" value="<?php echo $c_details[0]->c_name; ?>" />
                              <input type="text" name="c_id" id="c_id" class="form-control" value="<?php echo $c_details[0]->c_id; ?>" />
                           </div>
                        </div>                          
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="companyinput5">Status*</label>
                              <select id="status" class="form-control"  name="status">
                                 <option value="1">Active</option>
                                 <option value="0">De-active</option>
                              </select>
                           </div>
                        </div>                      
                     </div>

                     <div class="row">
                      
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="companyinput1" id="cust_update">Customer Mobile</label>
                              <div class="row">
                                 <div class="col-md-4">
                                    <select id="c_code" class="form-control select2-single"  name="cm_code" id ="cm_code" >
                                       <option selected disabled="">Isd Code</option>
                                       <?php if(is_array($code)) { 
                                                foreach ($code as $ct) {
                                              ?>
                                             <option value="<?php echo $ct->countries_isd_code; ?>" <?php if($ct->countries_isd_code == $c_details[0]->c_code):?>selected <?php endif;?> ><?php echo $ct->countries_isd_code.'-'.$ct->countries_iso_code; ?></option>
                                          <?php } } ?>
                                    </select>
                                 </div>
                                 <div class="col-md-8">
                                    <input type="text" name="cmobile" class="form-control" placeholder="Customer mobile" value="<?php echo $c_details[0]->c_mobile; ?>" />
                                 </div>
                              </div>
                           </div>
                        </div>

                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="companyinput1" id="cust_update">Customer Email</label>
                              <input type="text" name="email" class="form-control" placeholder="Customer Email" value="<?php echo $c_details[0]->c_email;?>" />
                           </div>
                        </div>
                        
                        
                     </div>

                     <div class="row">
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="companyinput1" id="cust_update">Reference Type</label>
                                 <select class="select2-single form-control"  name="rtype">
                                 <option disabled="" selected="">Reference type</option>
                                 <?php if(is_array($rt)) { 
                                          foreach ($rt as $rt) {
                                    ?>
                                    <option value="<?php echo $rt->rt_id; ?>"  <?php if($rt->rt_id==$c_details[0]->rt_id):?>selected=""<?php endif;?>><?php echo $rt->rt_name; ?></option>
                                    <?php } } ?>
                              </select>
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="companyinput1" id="cust_update">Reference Name</label>
                              <input type="text" name="rname" class="form-control" placeholder="Refernce name" value="<?php echo $c_details[0]->r_name; ?>" />
                           </div>
                        </div>
                     </div>
                  </div>
                  
                  <div class="form-actions">
                  
                     <button type="submit" id="update_customer" class="btn btn-primary">
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

