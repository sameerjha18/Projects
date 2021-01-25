<main>
        <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="mb-4">Add Vendor Form</h5>
                        <?php
                            $attributes = array('class' => 'form', 'id' => 'add_vendorform');
                            echo form_open('', $attributes);
                        ?>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4">Vendor Name</label>
                                    <input type="text" class="form-control" id="" name="name" placeholder="Vendor Name">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputAddress">Address1*</label> 
                                    <input type="text" class="form-control" id="" name="address1" placeholder="">
                                </div>
                            
                                <div class="form-group col-md-6">
                                    <label for="inputAddress">Address2*</label> 
                                    <input type="text" class="form-control" id=""  name="address2" placeholder="">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputAddress2">Address 3*</label> 
                                    <input type="text" class="form-control" id="" name="address3" placeholder="">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputCity">State</label> 
                                    <input type="text" class="form-control" id="inputCity" name="state" >
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputCity">City</label> 
                                    <input type="text" class="form-control" id="inputCity" name="city">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputZip">Pincode</label> 
                                    <input type="text" class="form-control" id="inputZip" name="pincode">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputcountry">Country</label>
                                    <input type="text" class="form-control" id="" name="country">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputmob">Mobile</label>
                                    <input type="text" class="form-control" id="" name="mobile">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputalt">Alt Mobile</label>
                                    <input type="text" class="form-control" id="" name="altmobile">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputmob">Gst Number</label>
                                    <input type="text" class="form-control" id="" name="gstno">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputalt">Pan No.</label>
                                    <input type="text" class="form-control" id="" name="panno">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputemail">Email</label>
                                    <input type="email" class="form-control" id="" name="email">
                                </div>
                                <div class="form-group col-md-6">
                                <label for="companyinput5">Status*</label>
                                    <select id="status" class="form-control"  name="status">
                                        <option value="1">Active</option>
                                        <option value="0">De-active</option>
                                    </select>
                                </div>
                            </div>
                            <button type="submit" id="add_vendor" class="btn btn-primary">
                                <i class="la la-check-square-o"></i> Save
                            </button>
                            <a href="<?php echo base_url().'vendor'; ?>" class="btn btn-danger mr-1">
                                <i class="ft-x"></i> Back
                            </a>
                        <?php echo form_close(); ?>
                    </div>
                </div>
</main>