<main>
    <div class="card mb-4">
        <div class="card-body">
        <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                <ol class="breadcrumb pt-0">
                    <li class="breadcrumb-item"><a href="<?php echo base_url() . 'admin/dashboard'; ?>">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page"><a href="<?php echo base_url() . 'vendor'; ?>">fabricator List</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Update fabricator</li>
                </ol>
            </nav>
            <?php
            $attributes = array('class' => 'form', 'id' => 'update_vendorform');
            echo form_open('', $attributes);
            ?>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputEmail4">fabricator Name*</label>
                    <input type="text" class="form-control" id="" name="uname" placeholder="fabricator Name" value = "<?php echo $category[0]->v_name;?>"/>
                    <input type="hidden" class="form-control" id="v_id" name="uv_id" placeholder="fabricator Name" value = "<?php echo $category[0]->v_id;?>"/>
                </div>
                <div class="form-group col-md-6">
                    <label for="inputAddress">Address1*</label>
                    <input type="text" class="form-control" id="" name="uaddress1" placeholder="fabricator address 1" value = "<?php echo $category[0]->v_address1;?>"/>
                </div>
                <div class="form-group col-md-6">
                    <label for="inputAddress">Address2</label>
                    <input type="text" class="form-control" id=""  name="uaddress2" placeholder="fabricator address 2" value = "<?php echo $category[0]->v_address2;?>"/>
                </div>
                <div class="form-group col-md-6">
                    <label for="inputAddress2">Address 3</label>
                    <input type="text" class="form-control" id="" name="uaddress3" placeholder="fabricator address 3" value = "<?php echo $category[0]->v_address3;?>"/>
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
                    <label for="inputCity">City</label>
                    <input type="text" class="form-control" id="" name="ucity" placeholder="fabricator City" value = "<?php echo $category[0]->v_city;?>" />
                </div>
                <div class="form-group col-md-6">
                    <label for="inputZip">Pincode</label>
                    <input type="text" class="form-control" id="" name="upincode" placeholder="fabricator Pincode" value = "<?php echo $category[0]->v_pincode;?>" />
                </div>
                <div class="form-group col-md-6">
                    <label for="inputcountry">Country</label>
                    <input type="text" class="form-control" id="" name="ucountry" placeholder="fabricator Country" value = "<?php echo $category[0]->v_country;?>" />
                </div>
                <div class="form-group col-md-6">
                    <label for="inputmob">Mobile*</label>
                    <input type="text" class="form-control" id="" name="umobile" placeholder="fabricator mobile" value = "<?php echo $category[0]->v_mobile;?>" />
                </div>
                <div class="form-group col-md-6">
                    <label for="inputalt">Alt Mobile</label>
                    <input type="text" class="form-control" id="" name="ualtmobile" placeholder="fabricator alt mobile" value = "<?php echo $category[0]->v_alt;?>" />
                </div>
                <div class="form-group col-md-6">
                    <label for="inputmob">Gst Number</label>
                    <input type="text" class="form-control" id="" name="ugstno" placeholder="fabricator gst no" value = "<?php echo $category[0]->v_gst;?>" />
                </div>
                <div class="form-group col-md-6">
                    <label for="inputalt">Pan No.</label>
                    <input type="text" class="form-control" id="" name="upanno" placeholder="fabricator pan no." value = "<?php echo $category[0]->v_pan;?>" />
                </div>
                <div class="form-group col-md-6">
                    <label for="inputemail">Email</label>
                    <input type="email" class="form-control" id="" name="uemail" placeholder="fabricator email" value = "<?php echo $category[0]->v_email;?>" />
                </div>
                <div class="form-group col-md-6">
                    <label for="companyinput5">Status</label>
                    <select id="status" class="form-control"  name="ustatus">
                        <option <?php if(@$category[0]->v_status == '1') { echo "selected"; } ?> value="1">Active</option>
                        <option <?php if(@$category[0]->v_status == '0') { echo "selected"; } ?> value="0">De-active</option>
                    </select>
                </div>
            </div>
            <button type="submit" id="update_vendor" class="btn btn-primary">
                <i class="la la-check-square-o"></i> Save
            </button>
            <a href="<?php echo base_url().'vendor'; ?>" class="btn btn-danger mr-1">
                <i class="ft-x"></i> Back
            </a>
            <?php echo form_close(); ?>
        </div>
    </div>

</main>