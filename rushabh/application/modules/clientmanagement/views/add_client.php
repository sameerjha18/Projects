<main>
    <div class="card mb-4">
        <div class="card-body">
            <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                <ol class="breadcrumb pt-0">
                    <li class="breadcrumb-item"><a href="<?php echo base_url() . 'admin/dashboard'; ?>">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page"><a href="<?php echo base_url() . 'clientmanagement'; ?>">Client List</a></li>
                </ol>
            </nav>
            <?php
            $attributes = array('class' => 'form', 'id' => 'add_clientform');
            echo form_open('', $attributes);
            ?>
            <div class="form-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="companyinput1" id="cust_update">Company Name*</label>
                            <input type="text" name="cname" class="form-control" placeholder=" Company Name" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="companyinput1" id="cust_update">Address 1*</label>
                            <input type="text" name="caddress1" class="form-control" placeholder="Address 1" />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="companyinput1" id="cust_update">Address 2</label>
                            <input type="text" name="caddress2" class="form-control" placeholder="Address 2" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="companyinput1" id="cust_update">Address 3</label>
                            <input type="text" name="caddress3" class="form-control" placeholder="Address 3" />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label>State</label><br>
                        <select class="form-control select2-single" name="state">
                            <option disabled="" selected>Select State</option>
                            <?php if (is_array($state)) {
                                foreach ($state as $state) {
                            ?>
                                    <option value="<?php echo $state->state_id; ?>"><?php echo $state->state_name; ?></option>
                            <?php }
                            } ?>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="companyinput1" id="cust_update">City</label>
                            <input type="text" name="ccity" class="form-control" placeholder="City" />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="companyinput1" id="cust_update">Pincode</label>
                            <input type="text" name="cpincode" class="form-control" placeholder="Pincode" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="companyinput1" id="cust_update">Country</label>
                            <input type="text" name="ccountry" class="form-control" placeholder="Country" value="India" />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="companyinput1" id="cust_update">Mobile*</label>
                            <input type="text" name="cmobile" class="form-control" placeholder="Mobile" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="companyinput1" id="cust_update">Alt Mobile</label>
                            <input type="text" name="caltmobile" class="form-control" placeholder="Alt Mobile" />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="companyinput1" id="cust_update">Email</label>
                            <input type="text" name="cemail" class="form-control" placeholder="Email" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="companyinput5">Status</label>
                            <select id="status" class="form-control" name="status">
                                <option value="1">Active</option>
                                <option value="0">De-active</option>
                            </select>
                        </div>
                    </div>
                </div>
                <button type="submit" id="add_client" class="btn btn-primary">
                    <i class="la la-check-square-o"></i> Save
                </button>
                <a href="<?php echo base_url() . 'clientmanagement'; ?>" class="btn btn-danger mr-1">
                    <i class="ft-x"></i> Back
                </a>
                <?php echo form_close(); ?>
            </div>
        </div>
</main>