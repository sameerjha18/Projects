<main>
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="mb-4">Add Products Form</h5>
            <?php
            $attributes = array('class' => 'form', 'id' => 'add_productform', 'enctype' => 'multipart/form-data');
            echo form_open('', $attributes);
            ?>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputEmail4">Products Name</label>
                    <input type="text" class="form-control" name="pname" placeholder="Products Name">
                    <input type="hidden" name="isAjax" value="1" class="form-control">
                </div>
                <div class="form-group col-md-6">
                    <label for="inputAddress">Products Code</label>
                    <input type="text" class="form-control" name="pcode" placeholder="Products Code">
                </div>
                <div class="form-group col-md-6">
                    <label>Product Type*</label><br>
                    <select class="form-control select2-single" name="type">
                        <option disabled="" selected>Select Product Type</option>
                        <?php if (is_array($type)) {
                            foreach ($type as $type) {
                        ?>
                                <option value="<?php echo $type->t_id; ?>"><?php echo $type->t_name; ?></option>
                        <?php }
                        } ?>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label>Brand*</label><br>
                    <select class="form-control select2-single" name="brand">
                        <option disabled="" selected>Brands</option>
                        <?php if (is_array($brand)) {
                            foreach ($brand as $brand) {
                        ?>
                                <option value="<?php echo $brand->b_id; ?>"><?php echo $brand->b_name; ?></option>
                        <?php }
                        } ?>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label>Products Colour*</label><br>
                    <select class="form-control select2-single" name="colour">
                        <option disabled="" selected>Colour</option>
                        <?php if (is_array($colour)) {
                            foreach ($colour as $colour) {
                        ?>
                                <option value="<?php echo $colour->cl_id; ?>"><?php echo $colour->cl_name; ?></option>
                        <?php }
                        } ?>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label>Products Dimension*</label><br>
                    <select class="form-control select2-single" name="dimension">
                        <option disabled="" selected>Dimension</option>
                        <?php if (is_array($dimension)) {
                            foreach ($dimension as $dimension) {
                        ?>
                                <option value="<?php echo $dimension->d_id; ?>"><?php echo $dimension->d_size; ?></option>
                        <?php }
                        } ?>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label>Tax*</label><br>
                    <select class="form-control select2-single" name="tax">
                        <option disabled="" selected>Select Tax</option>
                        <?php if (is_array($tax)) {
                            foreach ($tax as $tax) {
                        ?>
                                <option value="<?php echo $tax->t_id; ?>"><?php echo $tax->tax_name; ?></option>
                        <?php }
                        } ?>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="inputupload">Upload</label>
                    <div class="controls">
                        <input type="file" name="product" id="product" class="form-control" />
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <label for="companyinput5">Status*</label>
                    <select id="status" class="form-control" name="status">
                        <option value="1">Active</option>
                        <option value="0">De-active</option>
                    </select>
                </div>
            </div>
            <button type="submit" id="addproduct" class="btn btn-primary">
                <i class="la la-check-square-o"></i> Save
            </button>
            <a href="<?php echo base_url() . 'products'; ?>" class="btn btn-danger mr-1">
                <i class="ft-x"></i> Back
            </a>
            <?php echo form_close(); ?>
        </div>
    </div>
</main>