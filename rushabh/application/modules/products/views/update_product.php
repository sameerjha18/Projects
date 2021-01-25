<main>
<div class="row">
                <div class="col-12">
                    <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                        <ol class="breadcrumb pt-0">
                            <li class="breadcrumb-item"><a href="<?php echo base_url() . 'admin/dashboard'; ?>">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page"><a href="<?php echo base_url() . 'products'; ?>">Product List</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Update Product</li>
                        </ol>
                    </nav>
                </div>
            </div>
    <div class="card mb-4">
        <div class="card-body">
            <?php
            $attributes = array('class' => 'form', 'id' => 'update_productsform', 'enctype' => 'multipart/form-data');
            echo form_open('', $attributes);
            ?>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputEmail4">Products Name*</label>
                    <input type="text" class="form-control" id="" name="upname" placeholder="Products Name" value="<?php echo $category[0]->p_name; ?>" />
                    <input type="hidden" class="form-control" id="p_id" name="p_id" value="<?php echo $category[0]->p_id; ?>" />

                    <input type="hidden" name="isAjax" value="1" class="form-control">
                </div>
                <div class="form-group col-md-6">
                    <label for="inputEmail4">HSN code</label>
                    <input type="text" class="form-control" name="uhsncode" placeholder="HSN code" value="<?php echo $category[0]->p_hsn; ?>">
                </div>
                 <div class="form-group col-md-6">
                    <label for="inputEmail4">Description</label>
                    <textarea class="form-control" name="updesc"><?php echo $category[0]->p_desc; ?></textarea>
                </div>
                <div class="form-group col-md-6">
                    <label for="companyinput5">Status*</label>
                    <select id="status" class="form-control" name="ustatus">
                        <option <?php if (@$category[0]->p_status == '1') {
                                    echo "selected";
                                } ?> value="1">Active</option>
                        <option <?php if (@$category[0]->p_status == '0') {
                                    echo "selected";
                                } ?> value="0">De-active</option>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="inputupload">Upload</label>
                    <div class="controls">
                        <input type="file" id="image" name="image" class="form-control" /><br />
                        <img src="<?php echo base_url() . 'uploads/product/' . $category[0]->p_image; ?>" style="width: 25%; height:25% " />
                    </div>
                </div>
            </div>
            <button type="submit" id="updateproduct" class="btn btn-primary">
                <i class="la la-check-square-o"></i> Save
            </button>
            <a href="<?php echo base_url() . 'products'; ?>" class="btn btn-danger mr-1">
                <i class="ft-x"></i> Back
            </a>
            <?php echo form_close(); ?>
        </div>
    </div>

</main>