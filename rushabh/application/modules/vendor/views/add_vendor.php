<main>
    <div class="card mb-4">
        <div class="card-body">
            <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                <ol class="breadcrumb pt-0">
                    <li class="breadcrumb-item"><a href="<?php echo base_url() . 'admin/dashboard'; ?>">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page"><a href="<?php echo base_url() . 'vendor'; ?>">fabricator List</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Add fabricator</li>
                </ol>
            </nav>
            <?php
            $attributes = array('class' => 'form', 'id' => 'add_vendorform');
            echo form_open('', $attributes);
            ?>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputEmail4">fabricator Name*</label>
                    <input type="text" class="form-control" id="" name="name" placeholder="fabricator Name">
                </div>
                <div class="form-group col-md-6">
                    <label for="inputAddress">Address1*</label>
                    <input type="text" class="form-control" id="" name="address1" placeholder="fabricator Address 1">
                </div>

                <div class="form-group col-md-6">
                    <label for="inputAddress">Address2</label>
                    <input type="text" class="form-control" id="" name="address2" placeholder="fabricator Address 2 ">
                </div>
                <div class="form-group col-md-6">
                    <label for="inputAddress2">Address 3</label>
                    <input type="text" class="form-control" id="" name="address3" placeholder="fabricator Address 3">
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
                    <label for="inputCity">City</label>
                    <input type="text" class="form-control" id="inputCity" name="city" placeholder="fabricator City">
                </div>
                <div class="form-group col-md-6">
                    <label for="inputZip">Pincode</label>
                    <input type="text" class="form-control" id="inputZip" name="pincode" placeholder="fabricator Pincode">
                </div>
                <div class="form-group col-md-6">
                    <label for="inputcountry">Country</label>
                    <input type="text" class="form-control" id="" name="country" value="India">
                </div>
                <div class="form-group col-md-6">
                    <label for="inputmob">Mobile*</label>
                    <input type="text" class="form-control" id="" name="mobile" placeholder="fabricator Contact No:">
                </div>
                <div class="form-group col-md-6">
                    <label for="inputalt">Alt Mobile</label>
                    <input type="text" class="form-control" id="" name="altmobile" placeholder="fabricator Alt. Mobile ">
                </div>
                <div class="form-group col-md-6">
                    <label for="inputmob">Gst Number</label>
                    <input type="text" class="form-control" id="" name="gstno" placeholder="fabricator Gst No:">
                </div>
                <div class="form-group col-md-6">
                    <label for="inputalt">Pan No.</label>
                    <input type="text" class="form-control" id="" name="panno" placeholder="fabricator Pan No:">
                </div>
                <div class="form-group col-md-6">
                    <label for="inputemail">Email</label>
                    <input type="email" class="form-control" id="" name="email" placeholder="fabricator Email Id.">
                </div>
                <div class="form-group col-md-6">
                    <label for="companyinput5">Status</label>
                    <select id="status" class="form-control" name="status">
                        <option value="1">Active</option>
                        <option value="0">De-active</option>
                    </select>
                </div>
            </div>
            <button type="submit" id="add_vendor" class="btn btn-primary">
                <i class="la la-check-square-o"></i> Save
            </button>
            <a href="<?php echo base_url() . 'vendor'; ?>" class="btn btn-danger mr-1">
                <i class="ft-x"></i> Back
            </a>
            <?php echo form_close(); ?>
        </div>
    </div>
</main>