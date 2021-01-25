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
                    <label for="inputEmail4">HSN code</label>
                    <input type="text" class="form-control" name="hsncode" placeholder="HSN code">
                </div>
                 <div class="form-group col-md-6">
                    <label for="inputEmail4">Description</label>
                    <textarea class="form-control" name="pdesc"></textarea>
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