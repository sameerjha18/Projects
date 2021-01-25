<main>
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Add New Client</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <?php
            $attributes = array('class' => 'form', 'id' => 'update_clientform');
            echo form_open('', $attributes);
            ?>
            <div class="form-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="companyinput1" id="cust_update">Company Name*</label>
                            <input type="text" name="uname" class="form-control" placeholder=" Company Name" value = "<?php echo $category[0]->c_name;?>" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="companyinput1" id="cust_update">Address 1*</label>
                            <input type="text" name="uaddress1" class="form-control" placeholder="Address 1" value = "<?php echo $category[0]->c_address1;?>" />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="companyinput1" id="cust_update">Address 2*</label>
                            <input type="text" name="uaddress2" class="form-control" placeholder="Address 2" value = "<?php echo $category[0]->c_address2;?>"/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="companyinput1" id="cust_update">Address 3*</label>
                            <input type="text" name="uaddress3" class="form-control" placeholder="Address 3" value = "<?php echo $category[0]->c_address3;?>"/>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="companyinput1" id="cust_update">State*</label>
                            <input type="text" name="ustate" class="form-control" placeholder="State" value = "<?php echo $category[0]->c_state;?>"/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="companyinput1" id="cust_update">City*</label>
                            <input type="text" name="ucity" class="form-control" placeholder="City" value = "<?php echo $category[0]->c_city;?>"/>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="companyinput1" id="cust_update">Pincode*</label>
                            <input type="text" name="upincode" class="form-control" placeholder="Pincode" value = "<?php echo $category[0]->c_pincode;?>"/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="companyinput1" id="cust_update">Country*</label>
                            <input type="text" name="ucountry" class="form-control" placeholder="Country" value = "<?php echo $category[0]->c_country;?>"/>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="companyinput1" id="cust_update">Mobile*</label>
                            <input type="text" name="umobile" class="form-control" placeholder="Mobile" value = "<?php echo $category[0]->c_mobile;?>"/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="companyinput1" id="cust_update">Alt Mobile*</label>
                            <input type="text" name="ualtmobile" class="form-control" placeholder="Alt Mobile" value = "<?php echo $category[0]->c_alt;?>"/>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="companyinput1" id="cust_update">Email*</label>
                            <input type="text" name="uemail" class="form-control" placeholder="Email"value = "<?php echo $category[0]->c_email;?>"/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="companyinput5">Status*</label>
                            <select id="status" class="form-control"  name="ustatus">
                                <option <?php if(@$category[0]->c_status == '1') { echo "selected"; } ?> value="1">Active</option>
                                <option <?php if(@$category[0]->c_status == '0') { echo "selected"; } ?> value="0">De-active</option>
                            </select>
                        </div>
                    </div>
                </div>

                <?php echo form_close(); ?>
            </div>
            <div class="modal-footer">
                <button type="submit" id="update_client" class="btn btn-primary">
                    <i class="la la-check-square-o"></i> Save
                </button>
                <a href="<?php echo base_url().'clientmanagement'; ?>" class="btn btn-danger mr-1">
                    <i class="ft-x"></i> Back
                </a>
            </div>
        </div>
        <!-- </div>
    </div> -->
</main>