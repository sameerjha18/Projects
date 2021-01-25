<main>
    <div class="card mb-4">
        <div class="card-body">
        <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                <ol class="breadcrumb pt-0">
                    <li class="breadcrumb-item"><a href="<?php echo base_url() . 'admin/dashboard'; ?>">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page"><a href="<?php echo base_url() . 'inquiry/allinquiries'; ?>">All Inquiry</a></li>
                    <li class="breadcrumb-item active" aria-current="page">updated Inquiry Details</li>
                </ol>
            </nav>
            <?php
            $attributes = array('class' => 'form', 'id' => 'update_inquirydetailform');
            echo form_open('', $attributes);
            ?>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="companyinput1" id="cust_update">Area</label>
                    <textarea name="area" id="area" cols="5" class="form-control" rows="8"><?php echo $inquirydetail[0]->inqd_area; ?></textarea>
                    <input type="hidden" class="form-control" id="inqd_id" name="inqd_id" value="<?php echo $inquirydetail[0]->inqd_id; ?>" />
                    <input type="hidden" class="form-control" id="inq_id" name="inq_id" value="<?php echo $inquirydetail[0]->inq_id; ?>" />
                </div>

                <div class="form-group col-md-6">
                    <label for="companyinput1" id="cust_update">Jali Position</label>
                    <textarea name="jp" id="jp" cols="5" rows="8" class="form-control"><?php echo $inquirydetail[0]->inqd_jp; ?></textarea>
                </div>
                <div class="form-group col-md-6">
                    <label for="companyinput1" id="cust_update">Openable Grill Distance</label>
                    <textarea name="ogd" id="ogd" class="form-control" cols="5" rows="3" ><?php echo $inquirydetail[0]->inqd_ogd; ?></textarea>
                </div>
                <div class="form-group col-md-6">
                    <label for="companyinput1" id="cust_update">Exhausted Fan Size</label>
                    <textarea name="efs" id="efs" cols="5" rows="3" class="form-control"><?php echo $inquirydetail[0]->inqd_efs; ?></textarea>
                </div>
                <div class="form-group col-md-6">
                    <label for="companyinput1" id="cust_update">Marbel Size</label>
                    <textarea name="ms" id="ms" cols="5" rows="3" class="form-control"><?php echo $inquirydetail[0]->inqd_mSize; ?></textarea>
                </div>
                <div class="form-group col-md-6">
                    <label for="companyinput1" id="cust_update">Powder Coating / Anodibling</label>
                    <textarea name="pc" id="pc" cols="5" rows="3" class="form-control"><?php echo $inquirydetail[0]->inqd_pCoating; ?></textarea>
                </div>
                <div class="form-group col-md-6">
                    <label for="companyinput1" id="cust_update">Glass</label>
                    <textarea name="glass" id="glass" cols="5" rows="3" class="form-control"><?php echo $inquirydetail[0]->inqd_glass; ?></textarea>
                </div>
                <div class="form-group col-md-6">
                    <label for="companyinput1" id="cust_update">Aluminium Section</label>
                    <textarea name="aluminium" id="aluminium" cols="5" rows="3" class="form-control"><?php echo $inquirydetail[0]->inqd_aSection; ?></textarea>
                </div>
            </div>
            <button type="submit" id="update_inquirydetail" class="btn btn-primary">
                <i class="la la-check-square-o"></i> Save
            </button>
            <a href="<?php echo base_url() . 'inquiry/views/'.$inquirydetail[0]->inq_id; ?>" class="btn btn-danger mr-1">
                <i class="ft-x"></i> Back
            </a>
            <?php echo form_close(); ?>
        </div>
    </div>
</main>