<main>
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="mb-4">Update Purchase Form</h5>
            <?php
            $attributes = array('class' => 'form', 'id' => 'update_purchasedetailform');
            echo form_open('', $attributes);
            ?>
            <div class="form-row">
                <div class="form-group col-md-6">
                   <label>Product*</label><br>
                    <select class="form-control select2-single" name="uproduct">
                        <option disabled="" selected>Select Product</option>
                        <?php if (is_array($products)) {
                            foreach ($products as $products) {
                        ?>
                                <option <?php if (@$pd[0]->p_id == $products->p_id) {
                                            echo "selected";
                                        } ?> value="<?php echo $products->p_id; ?>"><?php echo $products->p_name; ?>
                                </option>
                        <?php }
                        } ?>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="inputAddress">Quantity*</label>
                    <input type="text" class="form-control" id="" name="qty" placeholder="Purchase Date" value="<?php echo $pd[0]->pd_qty; ?>" />
                    <input type="hidden" class="form-control" id="pd_id" name="pd_id" value="<?php echo $pd[0]->pd_id; ?>" />
                    <input type="hidden" class="form-control" id="purchase_id" name="purchase_id" value="<?php echo $pd[0]->purchase_id; ?>" />
                </div>
                <div class="form-group col-md-6">
                    <label for="inputAddress">Unit Price*</label>
                    <input type="text" class="form-control" id="" name="unit_price" placeholder="Purchase Date" value="<?php echo $pd[0]->pd_unitprice; ?>" />
                </div>
                <div class="form-group col-md-6">
                    <label for="companyinput5">Status*</label>
                    <select id="status" class="form-control" name="ustatus">
                        <option <?php if (@$pd[0]->pd_status == '1') {
                                    echo "selected";
                                } ?> value="1">Active</option>
                        <option <?php if (@$pd[0]->pd_status == '0') {
                                    echo "selected";
                                } ?> value="0">De-active</option>
                    </select>
                </div>
            </div>
            <button type="submit" id="updatepurchasedetail" class="btn btn-primary">
                <i class="la la-check-square-o"></i> Save
            </button>
            <a href="<?php echo base_url().'purchase/purchasedetail/'.$purchase_id; ?>" class="btn btn-danger mr-1">
                <i class="ft-x"></i> Back
            </a>
            <?php echo form_close(); ?>
        </div>
    </div>

</main>