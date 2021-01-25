<main>
    <div class="card mb-4">
        <div class="card-body">
        <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                <ol class="breadcrumb pt-0">
                    <li class="breadcrumb-item"><a href="<?php echo base_url() . 'supervisor/dashboard'; ?>">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page"><a href="<?php echo base_url() . 'supervisor/allinquiry'; ?>">All Inquiry</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Add Inquiry Details</li>
                </ol>
            </nav>
            <?php
            $attributes = array('class' => 'form', 'id' => 'add_inquirydetailform');
            echo form_open('', $attributes);
            ?>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="companyinput1" id="cust_update">Area</label>
                    <textarea name="area" id="area" cols="5" class="form-control" rows="3"></textarea>
                    <input type="hidden" id= "inq_id" class="form-control" value="<?php echo $inq_id; ?>">
                </div>
                <div class="form-group col-md-6">
                    <label for="companyinput1" id="cust_update">Openable Grill Distance</label>
                    <textarea name="ogd" id="ogd" cols="5" class="form-control" rows="3"></textarea>
                </div>

                <div class="form-group col-md-6">
                    <label for="companyinput1" id="cust_update">Exhausted Fan Size</label>
                    <textarea name="efs" id="efs" class="form-control" cols="5" rows="3"></textarea>
                </div>
                <div class="form-group col-md-6">
                    <label for="companyinput1" id="cust_update">Jali Position</label>
                    <textarea name="jp" id="jp" cols="5" rows="3" class="form-control"></textarea>
                </div>
                <div class="form-group col-md-6">
                    <label for="companyinput1" id="cust_update">Marbel Size</label>
                    <textarea name="ms" id="ms" cols="5" class="form-control" rows="3"></textarea>
                </div>
                <div class="form-group col-md-6">
                    <label for="companyinput1" id="cust_update">Powder Coating / Anodibling</label>
                    <textarea name="pc" id="pc" cols="5" rows="3" class="form-control"></textarea>
                </div>
                <div class="form-group col-md-6">
                    <label for="companyinput1" id="cust_update">Glass</label>
                    <textarea name="glass" id="glass" cols="5" rows="3" class="form-control"></textarea>
                </div>
                <div class="form-group col-md-6">
                    <label for="companyinput1" id="cust_update">Aluminium Section</label>
                    <textarea name="aluminium" id="aluminium" cols="5" class="form-control" rows="3"></textarea>
                </div>
            </div>
            <button type="submit" id="add_inquirydetail" class="btn btn-primary">
                <i class="la la-check-square-o"></i> Save
            </button>
            <a href="<?php echo base_url() . 'supervisor/inspectiondetails/'.$inq_id; ?>" class="btn btn-danger mr-1">
                <i class="ft-x"></i> Back
            </a>
            <?php echo form_close(); ?>
        </div>
    </div>
</main>