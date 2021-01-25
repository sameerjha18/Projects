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
                  <div class="row">
                     <div class="col-md-2">
                        <div class="form-group">
                           <select  class="form-control select2-single"  name="c_code" id ="s_code">
                              <option selected disabled="">Isd Code</option>
                              <?php if(is_array($code)) { 
                                       foreach ($code as $ct) {
                                     ?>
                                    <option value="<?php echo $ct->countries_isd_code; ?>"  <?php if($ct->countries_isd_code =='91' ):?>selected <?php endif;?>><?php echo $ct->countries_isd_code.'-'.$ct->countries_iso_code; ?></option>
                                 <?php } } ?>
                           </select>
                        </div>
                     </div>
                     <div class="col-md-4">
                        <div class="form-group">
                           <input type="text" id  = "s_mobile" class="form-control" placeholder="Search customer primary mobile"  />
                        </div>
                     </div>
                     <div class="col-md-3">
                           
                        <button type="click" id="c_mobile" class="btn btn-danger" data-csrf_token_name ="<?php echo $this->security->get_csrf_token_name(); ?>" data-csrf_token_hash = "<?php echo $this->security->get_csrf_hash(); ?>">
                           <i class="ft-search"></i> Check now
                        </button>
                     </div>
                     <div class="col-md-2">
                           
                        <a href="<?php echo base_url().'inquiry/add_inquiry'?>" class = "btn btn-warning">
                           <i class="ft-search"></i> Refresh
                        </a>
                     </div>
                  </div>
                  <?php
                     $attributes = array('class' => 'form', 'id' => 'inquiryform');
                      echo form_open('', $attributes);
                  ?>
                  <div class="form-body">
                     <div class="row">
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="companyinput1" id="cust_update">Inquiry Date</label>
                              <input type="date" name="idate" class="form-control" placeholder="Inquiry date"  value= "<?php echo date('Y-m-d');?>"/>
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="companyinput1" id="cust_update">Customer Name</label>
                              <input type="text" name="cname" class="form-control" placeholder="Customer Name" id ="cname"/>
                           </div>
                        </div>
                      
                     </div>

                     <div class="row">
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="companyinput1" id="cust_update">Customer Mobile</label>
                              <div class="row">
                                 <div class="col-md-4">
                                    <select id="cm_code" class="form-control select2-single"  name="cm_code">
                                       <option selected disabled="">Isd Code</option>
                                       <?php if(is_array($code)) { 
                                                foreach ($code as $ct) {
                                              ?>
                                             <option value="<?php echo $ct->countries_isd_code; ?>" ><?php echo $ct->countries_isd_code.'-'.$ct->countries_iso_code; ?></option>
                                          <?php } } ?>
                                    </select>
                                 </div>
                                 <div class="col-md-8">
                                    <input type="text" name="cmobile" class="form-control" placeholder="Customer mobile" id ="cmobile" />
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="companyinput1" id="cust_update">Customer Email</label>
                              <input type="hidden" value="inquiry/allinquiries" id = "redirect">
                              <input type="text" name="email" class="form-control" placeholder="Customer Email" id="email" />
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
                                    <option value="<?php echo $rt->rt_id; ?>"><?php echo $rt->rt_name; ?></option>
                                    <?php } } ?>
                              </select>
                           </div>
                        </div>

                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="companyinput1" id="cust_update">Reference Name</label>
                              <input type="text" name="rname" class="form-control" placeholder="Refernce name"  id="rname" value="none" />
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="companyinput1" id="cust_update">Scope of work</label>
                              <textarea name="sow" class="form-control" placeholder="Scope Of Work" id ="sow"></textarea>
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="companyinput1" id="cust_update">Address</label>
                              <textarea name="address" class="form-control" placeholder="Address"></textarea>
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="companyinput1" id="cust_update">Site Person</label>
                              <input type="text" name="sperson" class="form-control" placeholder="Site Person" id ="s_person" />
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="companyinput1" id="cust_update">Site Contact No</label>
                              <input type="text" name="scontact" class="form-control" placeholder="Site Contact No" id ="s_contact" />
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="companyinput1" id="cust_update">Site Date</label>
                              <input type="date" name="sdate" class="form-control" />
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="companyinput1" id="cust_update">Follow Up Date</label>
                              <input type="date" name="fdate" class="form-control" placeholder="Inquiry date"  value= "<?php echo date('Y-m-d');?>"/>
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="companyinput1" id="cust_update">Site Inspection By</label>
                              <select class="select2-single form-control" multiple="" name="sup[]" id ="sup[]">
                                 <?php if(is_array($sp)) { 
                                          foreach ($sp as $sp) {
                                    ?>
                                    <option value="<?php echo $sp->sup_id; ?>"><?php echo $sp->sup_name; ?></option>
                                    <?php } } ?>
                              </select>
                           </div>
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



<script type="text/javascript">
   $(document).ready(function(){
      $("#c_mobile").on("click",function(){

      var id = $("#s_mobile").val();
      var code = $("#s_code").val();

      var csrfName =  $('#c_mobile').attr('data-csrf_token_name');
      var csrfHash =  $('#c_mobile').attr('data-csrf_token_hash');

      
      $.ajax({
         url:base_url+'inquiry/search_member',
         type:'POST',
         data:csrfName+'='+csrfHash+'&id='+id+'&code='+code,
         dataType:"JSON",
         beforeSend:function()
         {
            ajaxindicatorstart("Please wait.",base_url);
         },
         success:function(response)
         {
            ajaxindicatorstop();
            if(response.result=='success')
            {
               $("#cname").val(response.c_name);
               $("#cmobile").val(response.c_mobile);
               $("#cm_code").val(response.c_code);
               $('#cm_code').select2().trigger('change');
               $("#camobile").val(response.ca_mobile);
               $("#ca_code").val(response.ca_code);
               $('#ca_code').select2().trigger('change');
               $("#email").val(response.c_email);
               $("#itype").val(response.it_id);
               $('#itype').select2().trigger('change');
               $("#rtype").val(response.rt_id);
               $('#rtype').select2().trigger('change');
               
               $("#rname").val(response.c_email);
               $("#bname").val(response.b_name);
            }
            else if(response.result=='fail'){

               ajaxindicatorstop();
               alert("No records Found !!!");
            }
         },
         error:function(){
            ajaxindicatorstop();
         }
      });
});
   });
</script>

