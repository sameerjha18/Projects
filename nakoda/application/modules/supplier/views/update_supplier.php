<main>
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="mb-4">Update Supplier</h5>
            <?php
            $attributes = array('class' => 'form', 'id' => 'update_supplierform');
            echo form_open('', $attributes);
            ?>
            <div class="form-row">
                <div class="form-group col-md-6">
                <label for="companyinput1" id="cust_update">Supplier Name*</label>
                            <input type="text" name="uname" class="form-control" placeholder=" Supplier Name" value="<?php echo $category[0]->sp_name; ?>" />

                            <input type="hidden" class="form-control" id="sp_id" name="sp_id" value="<?php echo $category[0]->sp_id; ?>" />
                </div>
                <div class="form-group col-md-6">
                <label for="companyinput1" id="cust_update">Address 1*</label>
                            <input type="text" name="uaddress1" class="form-control" placeholder="Address 1" value="<?php echo $category[0]->sp_address1; ?>" />
                </div>

                <div class="form-group col-md-6">
                <label for="companyinput1" id="cust_update">Address 2*</label>
                            <input type="text" name="uaddress2" class="form-control" placeholder="Address 2" value="<?php echo $category[0]->sp_address2; ?>" />
                </div>
                <div class="form-group col-md-6">
                <label for="companyinput1" id="cust_update">Address 3*</label>
                            <input type="text" name="uaddress3" class="form-control" placeholder="Address 3" value="<?php echo $category[0]->sp_address3; ?>" />
                </div>
                <div class="form-group col-md-6">
                <label>State*</label><br>
                            <select class="form-control select2-single" name="ustate">
                                >
                                <?php if (is_array($state)) {
                                    foreach ($state as $state) {
                                ?>
                                        <option <?php if (@$category[0]->state_id == $state->state_id) {
                                                    echo "selected";
                                                } ?> value="<?php echo $state->state_id; ?>"><?php echo $state->state_name; ?>
                                        </option>
                                <?php }
                                } ?>
                            </select>
                </div>
                <div class="form-group col-md-6">
                <label for="companyinput1" id="cust_update">City*</label>
                            <input type="text" name="ucity" class="form-control" placeholder="City" value="<?php echo $category[0]->sp_city; ?>" />
                </div>
                <div class="form-group col-md-6">
                <label for="companyinput1" id="cust_update">Pincode*</label>
                            <input type="text" name="upincode" class="form-control" placeholder="Pincode" value="<?php echo $category[0]->sp_pincode; ?>" />
                </div>
                <div class="form-group col-md-6">
                <label for="companyinput1" id="cust_update">Country*</label>
                            <input type="text" name="ucountry" class="form-control" placeholder="Country" value="<?php echo $category[0]->sp_country; ?>" />
                </div>
                <div class="form-group col-md-6">
                <label for="companyinput1" id="cust_update">Mobile*</label>
                            <input type="text" name="umobile" class="form-control" placeholder="Mobile" value="<?php echo $category[0]->sp_mobile; ?>" />
                </div>
                <div class="form-group col-md-6">
                <label for="companyinput1" id="cust_update">Alt Mobile*</label>
                            <input type="text" name="ualtmobile" class="form-control" placeholder="Alt Mobile" value="<?php echo $category[0]->sp_alt; ?>" />
                </div>
                <div class="form-group col-md-6">
                <label for="companyinput1" id="cust_update">Email*</label>
                            <input type="text" name="uemail" class="form-control" placeholder="Email" value="<?php echo $category[0]->sp_email; ?>" />
                </div>
                <div class="form-group col-md-6">
                <label for="companyinput5">Status*</label>
                            <select id="status" class="form-control" name="ustatus">
                                <option <?php if (@$category[0]->sp_status == '1') {
                                            echo "selected";
                                        } ?> value="1">Active</option>
                                <option <?php if (@$category[0]->sp_status == '0') {
                                            echo "selected";
                                        } ?> value="0">De-active</option>
                            </select>
                </div>
            </div>
            <button type="submit" id="update_supplier" class="btn btn-primary">
                    <i class="la la-check-square-o"></i> Save
                </button>
                <a href="<?php echo base_url() . 'supplier'; ?>" class="btn btn-danger mr-1">
                    <i class="ft-x"></i> Back
                </a>
            <?php echo form_close(); ?>
        </div>
    </div>
</main>