<main>
    <div class="card mb-4">
        <div class="card-body">
        <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                <ol class="breadcrumb pt-0">
                    <li class="breadcrumb-item"><a href="<?php echo base_url() . 'admin/dashboard'; ?>">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page"><a href="<?php echo base_url() . 'purchase'; ?>">Purchase List</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><a href="<?php echo base_url() . 'purchase/purchasedetail/'.$purchase_id; ?>">Purchase Details List</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Add Purchase Details</li>
                </ol>
            </nav>
            <?php
            $attributes = array('class' => 'form', 'id' => 'add_purchasedetailform', 'enctype' => 'multipart/form-data');
            echo form_open('', $attributes);
            ?>
            <div class="form-row">
            <div class="form-group col-md-6">
                    <label>Product*</label><br>
                    <select class="form-control select2-single" name="product">
                        <option disabled="" selected>Select Product</option>
                        <?php if (is_array($product)) {
                            foreach ($product as $product) {
                        ?>
                                <option value="<?php echo $product->p_id; ?>"><?php echo $product->p_name; ?></option>
                        <?php }
                        } ?>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="inputEmail4">Quantity*</label>
                    <input type="text" class="form-control" name="qty" placeholder="Quantity">
                    <input type="hidden" id = "sp_id" value="<?php echo $purchase_id; ?>">
                    
                </div>
                <div class="form-group col-md-6">
                    <label for="inputEmail4">Unit Price*</label>
                    <input type="text" class="form-control" name="unit_price" placeholder="Unit Price">
                </div>
            
                <div class="form-group col-md-6">
                    <label for="companyinput5">Status*</label>
                    <select id="status" class="form-control" name="status">
                        <option value="1">Active</option>
                        <option value="0">De-active</option>
                    </select>
                </div>
            </div>
            <button type="submit" id="addpurchasedetail" class="btn btn-primary">
                <i class="la la-check-square-o"></i> Save
            </button>
            <a href="<?php echo base_url().'purchase/purchasedetail/'.$purchase_id; ?>" class="btn btn-danger mr-1">
                <i class="ft-x"></i> Back
            </a>
            <?php echo form_close(); ?>
        </div>
    </div>
</main>