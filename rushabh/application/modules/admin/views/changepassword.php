<main>
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="mb-4">Change password</h5>
          
    <?php
        $attributes = array('class' => 'form', 'id' => 'passwordform');
        echo form_open('', $attributes);
    ?>
        <div class="form-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="companyinput1" id="cust_update">Old Password*</label>
                        <input type="password" name="opass" class="form-control" placeholder="Old Password" />
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="companyinput5">New Password*</label>                       
                        <input type="password" name="npass" class="form-control" placeholder="New Password" />
                    </div>
                </div>
                  <div class="col-md-6">
                    <div class="form-group">
                        <label for="companyinput5">Confirm Password*</label>                       
                        <input type="password" name="cpass" class="form-control" placeholder="Confirm Password" />
                    </div>
                </div>
            </div>
        </div>
        <div class="form-actions">
            <button type="submit" id="changepassword" class="btn btn-primary">
                <i class="la la-check-square-o"></i> Save
            </button>

            <a href="<?php echo base_url(); ?>admin/dashboard" class="btn btn-danger mr-1">
                <i class="ft-x"></i> Back
            </a>
                  </div>
    <?php echo form_close(); ?>
        </div>
    </div>
</main>