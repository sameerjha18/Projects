<main>
    <div class="card mb-4">
        <div class="card-body">
        <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                <ol class="breadcrumb pt-0">
                    <li class="breadcrumb-item"><a href="<?php echo base_url() . 'admin/dashboard'; ?>">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page"><a href="<?php echo base_url() . 'purchase'; ?>">Purchase List</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Update Purchase</li>
                </ol>
            </nav>
            <?php
            $attributes = array('class' => 'form', 'id' => 'update_purchaseform');
            echo form_open('', $attributes);
            ?>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputEmail4">Purchase Date*</label>
                    <input type="date" class="form-control" id="" name="update" placeholder="Purchase Date" value="<?php echo $category[0]->purchase_date; ?>" />
                    <input type="hidden" class="form-control" id="purchase_id" name="purchase_id" value="<?php echo $category[0]->purchase_id; ?>" />
                </div>
                <div class="form-group col-md-6">
                    <label>Supplier*</label><br>
                    <select class="form-control select2-single" name="upsupplier">
                        <option disabled="" selected>Select Supplier</option>
                        <?php if (is_array($supplier)) {
                            foreach ($supplier as $supplier) {
                        ?>
                                <option <?php if (@$category[0]->s_id == $supplier->s_id) {
                                            echo "selected";
                                        } ?> value="<?php echo $supplier->s_id; ?>"><?php echo $supplier->s_name; ?>
                                </option>
                        <?php }
                        } ?>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="inputAddress">Remarks*</label>
					<textarea class="form-control" row ="5" name="remark" ><?php echo $category[0]->purchase_remarks; ?></textarea>
                </div>
                <div class="form-group col-md-6">
                    <label for="companyinput5">Status*</label>
                    <select id="status" class="form-control" name="ustatus">
                        <option <?php if (@$category[0]->purchase_status == '1') {
                                    echo "selected";
                                } ?> value="1">Active</option>
                        <option <?php if (@$category[0]->purchase_status == '0') {
                                    echo "selected";
                                } ?> value="0">De-active</option>
                    </select>
                </div>
            </div>
            <button type="submit" id="updatepurchase" class="btn btn-primary">
                <i class="la la-check-square-o"></i> Save
            </button>
            <a href="<?php echo base_url() . 'purchase'; ?>" class="btn btn-danger mr-1">
                <i class="ft-x"></i> Back
            </a>
            <?php echo form_close(); ?>
        </div>
    </div>

</main>