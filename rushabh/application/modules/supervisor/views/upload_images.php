<main>
    <div class="row">
        <div class="col-12">
            <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                <ol class="breadcrumb pt-0">
                    <li class="breadcrumb-item"><a href="<?php echo base_url() . 'admin/dashboard'; ?>">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page"><a href="<?php echo base_url() . 'allinquiry'; ?>">All Inquiry</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><a href="<?php echo base_url() . 'inspectiondetails'.$inq_id; ?>">Inspection Details</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Upload Images</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="card mb-4">
        <div class="card-body">
            <?php
            $attributes = array('class' => 'form', 'id' => 'imageuploadform', 'enctype' => 'multipart/form-data');
            echo form_open('', $attributes);
            ?>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputupload">Upload</label>
                    <div class="controls">
                        <input type="file" name="image" id="image" class="form-control" />
                        <input type="hidden" name="isAjax" value="1" class="form-control">
                    </div>
                </div>

                <div class="form-group col-md-6">
                    <label for="inputEmail4">Description</label>
                    <textarea class="form-control" name="imgdesc"></textarea>
                    <input type="hidden" id= "inq_id" class="form-control" value="<?php echo $inq_id; ?>">
                </div>
            </div>
            <button type="submit" id="uploadimage" class="btn btn-primary">
                <i class="la la-check-square-o"></i> Save
            </button>
            <a href="<?php echo base_url() . 'supervisor/inspectiondetails/'.$inq_id; ?>" class="btn btn-danger mr-1">
                <i class="ft-x"></i> Back
            </a>
            <?php echo form_close(); ?>
        </div>
    </div>
</main>