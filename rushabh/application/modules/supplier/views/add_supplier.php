<main>
    <div class="card mb-4">
        <div class="card-body">
        <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                <ol class="breadcrumb pt-0">
                    <li class="breadcrumb-item"><a href="<?php echo base_url() . 'admin/dashboard'; ?>">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page"><a href="<?php echo base_url() . 'supplier'; ?>">Supplier List</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Add Supplier</li>
                </ol>
            </nav>
            <?php
            $attributes = array('class' => 'form', 'id' => 'add_supplierform');
            echo form_open('', $attributes);
            ?>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="companyinput1" id="cust_update">Supplier Name*</label>
                    <input type="text" name="sname" class="form-control" placeholder=" Supplier Name" />
                </div>
                <div class="form-group col-md-6">
                    <label for="companyinput1" id="cust_update">Address 1*</label>
                    <input type="text" name="saddress1" class="form-control" placeholder="Address 1" />
                </div>

                <div class="form-group col-md-6">
                    <label for="companyinput1" id="cust_update">Address 2</label>
                    <input type="text" name="saddress2" class="form-control" placeholder="Address 2" />
                </div>
                <div class="form-group col-md-6">
                    <label for="companyinput1" id="cust_update">Address 3</label>
                    <input type="text" name="saddress3" class="form-control" placeholder="Address 3" />
                </div>
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
                <div class="form-group col-md-6">
                    <label for="companyinput1" id="cust_update">City</label>
                    <input type="text" name="scity" class="form-control" placeholder="City" />
                </div>
                <div class="form-group col-md-6">
                    <label for="companyinput1" id="cust_update">Pincode</label>
                    <input type="text" name="spincode" class="form-control" placeholder="Pincode" />
                </div>
                <div class="form-group col-md-6">
                    <label for="companyinput1" id="cust_update">Country</label>
                    <input type="text" name="scountry" class="form-control" placeholder="Country" value="India" />
                </div>
                <div class="form-group col-md-6">
                    <label for="companyinput1" id="cust_update">Mobile*</label>
                    <input type="text" name="smobile" class="form-control" placeholder="Mobile" />
                </div>
                <div class="form-group col-md-6">
                    <label for="companyinput1" id="cust_update">Alt Mobile</label>
                    <input type="text" name="saltmobile" class="form-control" placeholder="Alt Mobile" />
                </div>
                <div class="form-group col-md-6">
                    <label for="companyinput1" id="cust_update">Email</label>
                    <input type="text" name="semail" class="form-control" placeholder="Email" />
                </div>
                <div class="form-group col-md-6">
                    <label for="companyinput5">Status</label>
                    <select id="status" class="form-control" name="status">
                        <option value="1">Active</option>
                        <option value="0">De-active</option>
                    </select>
                </div>
            </div>
            <button type="submit" id="add_supplier" class="btn btn-primary">
                <i class="la la-check-square-o"></i> Save
            </button>
            <a href="<?php echo base_url() . 'supplier'; ?>" class="btn btn-danger mr-1">
                <i class="ft-x"></i> Back
            </a>
            <?php echo form_close(); ?>
        </div>
    </div>
</main>