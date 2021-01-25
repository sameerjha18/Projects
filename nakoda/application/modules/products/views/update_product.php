<main>
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="mb-4">Update Products Form</h5>
            <?php
            $attributes = array('class' => 'form', 'id' => 'update_productsform');
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
                    <label for="inputAddress">Products Code*</label>
                    <input type="text" class="form-control" id="" name="upcode" placeholder="" value="<?php echo $category[0]->p_code; ?>" />
                </div>
                <div class="form-group col-md-6">
                    <label>Products Type</label><br>
                    <select class="form-control select2-single" name="uptype">
                        <option disabled="" selected>Type</option>
                        <?php if (is_array($type)) {
                            foreach ($type as $type) {
                        ?>
                                <option <?php if (@$category[0]->t_id == $type->t_id) {
                                            echo "selected";
                                        } ?> value="<?php echo $type->t_id; ?>"><?php echo $type->t_name; ?>
                                </option>
                        <?php }
                        } ?>
                    </select>
                </div>
                <div class="form-group col-md-6">
                        <label>Brand*</label><br>
                        <select class="form-control select2-single" name="ubrand">
                            >
                            <?php if (is_array($brand)) {
                                foreach ($brand as $brand) {
                            ?>
                                    <option <?php if (@$category[0]->b_id == $brand->b_id) {
                                            echo "selected";
                                        } ?> value="<?php echo $brand->b_id; ?>"><?php echo $brand->b_name; ?>
                                </option>
                            <?php }
                            } ?>
                        </select>
                </div>
                <div class="form-group col-md-6">
                    <label>Products Colour</label><br>
                    <select class="form-control select2-single" name="upcolour">
                        <option disabled="" selected>Colour</option>
                        <?php if (is_array($colour)) {
                            foreach ($colour as $colour) {
                        ?>
                                <option <?php if (@$category[0]->cl_id == $colour->cl_id) {
                                            echo "selected";
                                        } ?> value="<?php echo $colour->cl_id; ?>"><?php echo $colour->cl_name; ?>
                                </option>
                        <?php }
                        } ?>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label>Products Dimension</label><br>
                    <select class="form-control select2-single" name="updimension">
                        <option disabled="" selected>Dimension</option>
                        <?php if (is_array($dimension)) {
                            foreach ($dimension as $dimension) {
                        ?>
                                <option <?php if (@$category[0]->d_id == $dimension->d_id) {
                                            echo "selected";
                                        } ?> value="<?php echo $dimension->d_id; ?>"><?php echo $dimension->d_size; ?>
                                </option>
                        <?php }
                        } ?>
                    </select>
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
                        <input type="file" id="image" name="uimage" class="form-control" /><br />
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