<main>
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="mb-4">Add Purchase Form</h5>
            <?php
            $attributes = array('class' => 'form', 'id' => 'add_purchaseform', 'enctype' => 'multipart/form-data');
            echo form_open('', $attributes);
            ?>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputEmail4">Purchase Date</label>
                    <input type="date" class="form-control" name="date" placeholder="Purchase Date">
                </div>
                <div class="form-group col-md-6">
                    <label>Supplier*</label><br>
                    <select class="form-control select2-single" name="supplier">
                        <option disabled="" selected>Select Supplier</option>
                        <?php if (is_array($sp)) {
                            foreach ($sp as $sp) {
                        ?>
                                <option value="<?php echo $sp->sp_id; ?>"><?php echo $sp->sp_name; ?></option>
                        <?php }
                        } ?>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="inputAddress">Remarks</label>
					<textarea class="form-control" row ="5" name="remark"></textarea>
                </div>
                <div class="form-group col-md-6">
                    <label for="companyinput5">Status*</label>
                    <select id="status" class="form-control" name="status">
                        <option value="1">Active</option>
                        <option value="0">De-active</option>
                    </select>
                </div>
            </div>
            <button type="submit" id="addpurchase" class="btn btn-primary">
                <i class="la la-check-square-o"></i> Save
            </button>
            <a href="<?php echo base_url() . 'purchase'; ?>" class="btn btn-danger mr-1">
                <i class="ft-x"></i> Back
            </a>
            <?php echo form_close(); ?>
        </div>
    </div>
</main>