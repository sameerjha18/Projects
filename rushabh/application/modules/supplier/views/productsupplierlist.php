<main>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
            <?php
                    if(is_array($s_name) && !empty($s_name))
                    {
                        foreach($s_name as $val)
                        {
                            ?>
                    <h1><?php echo $val->s_name; ?></h1>
                <?php
                        }
                    }
                    ?>
                <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                    <ol class="breadcrumb pt-0">
                        <li class="breadcrumb-item"><a href="<?php echo base_url().'admin/dashboard'; ?>">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item"><a href="<?php echo base_url().'supplier'; ?>">Supplier List</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Product Supplier</li>
                    </ol>
                </nav>
                <div class="top-right-button-container">

                    <button type="button" class="btn btn-outline-warning" data-toggle="modal" data-backdrop="static" data-target="#add_productsupply">Add Product Supplier</button>
                    <div class="btn-group">
                        <button class="btn btn-outline-primary btn-lg dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">EXPORT</button>
                        <div class="dropdown-menu"><a class="dropdown-item" id="dataTablesCopy" href="#">Copy</a> <a class="dropdown-item" id="dataTablesExcel" href="#">Excel</a> <a class="dropdown-item" id="dataTablesCsv" href="#">Csv</a> <a class="dropdown-item" id="dataTablesPdf" href="#">Pdf</a></div>
                    </div>
                </div>
                <div class="mb-2">
                    <a class="btn pt-0 pl-0 d-inline-block d-md-none" data-toggle="collapse" href="#displayOptions" role="button" aria-expanded="true" aria-controls="displayOptions">Display Options <i class="simple-icon-arrow-down align-middle"></i></a>
                    <div class="collapse dont-collapse-sm" id="displayOptions">
                        <div class="d-block d-md-inline-block">
                            <div class="search-sm d-inline-block float-md-left mr-1 mb-1 align-top"><input class="form-control" placeholder="Search Table" id="searchDatatable"></div>
                        </div>
                        <div class="float-md-right dropdown-as-select" id="pageCountDatatable">
                            <span class="text-muted text-small">Displaying 1-10 of 40 items </span><button class="btn btn-outline-dark btn-xs dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">10</button>
                            <div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item" href="#">5</a> <a class="dropdown-item active" href="#">10</a> <a class="dropdown-item" href="#">20</a></div>
                        </div>
                    </div>
                </div>
                <div class="separator"></div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 mb-4 data-table-rows data-tables-hide-filter">
                <?php
                if($this->session->flashdata('productsuppliermsg')){
                    ?>
                    <div class="alert alert-success mb-2" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>

                        <?php
                        echo $this->session->flashdata('productsuppliermsg');
                        ?>
                    </div>
                    <?php
                }
                ?>
                <table id="datatableRows" class="data-table responsive nowrap" data-order="[[ 0, &quot;asc&quot; ]]">
                    <thead>
                    <tr>
                        <th>Products</th>
                        <th>Status</th>
                        <th>Edit</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if(is_array($ps_list) && !empty($ps_list))
                    {
                        foreach($ps_list as $val)
                        {
                            ?>
                            <tr>
                                <td><?php echo $val['p_name']; ?></td>
                                <td>
                                    <?php
                                    if($val['ps_status']=='1'){
                                        echo "Supplying";
                                    }
                                    else{
                                        echo "Not-Supplying"; }
                                    ?>
                                </td>
                                <td>
                                    <a for ="<?php echo $val['ps_id']; ?>" class="search_productsuppliers"  data-csrf_token_name ="<?php echo $this->security->get_csrf_token_name(); ?>" data-csrf_token_hash = "<?php echo $this->security->get_csrf_hash(); ?>">
                                        <i class="simple-icon-pencil"></i>
                                    </a>
                                </td>
                            </tr>
                            <?php
                        }
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>

<div class="modal fade modal-right" id="add_productsupply" tabindex="-1" role="dialog" aria-labelledby="add_productsupply" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Product Supplier</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php
                $attributes = array('class' => 'form', 'id' => 'add_productsupplyform');
                echo form_open('', $attributes);
                ?>  
                <div class="form-group">
                    <label>Product*</label><br>
                    <input type="hidden" name="s_id" class="form-control" id="s_id" value ="<?php echo $id;?>"/>
                    <select class="form-control select2-single" name="product">
                        <option disabled="" selected>Select Product</option>
                        <?php if (is_array($product)) {
                            foreach ($product as $p) {
                        ?>
                                <option value="<?php echo $p->p_id; ?>"><?php echo $p->p_name; ?></option>
                        <?php }
                        } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Status</label>
                    <select class="form-control" name="status">
                        <option label="&nbsp;">&nbsp;</option>
                        <option value="1" selected="">Active</option>
                        <option value="0" >Delete</option>
                    </select>
                </div>

                <?php echo form_close(); ?>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" id ="productsupply">Submit</button>
                <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade modal-right" id="update_productsupplier" tabindex="-1" role="dialog" aria-labelledby="update_productsupplier" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update Supplier Contact</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php
                $attributes = array('class' => 'form', 'id' => 'update_productsupplierform');
                echo form_open('', $attributes);
                ?>
                <div class="form-group">
                    <label>Product*</label><br>
                   <input type="hidden" name="s_id" class="form-control" id="us_id" value ="<?php echo $id;?>"/>
                    <input type="hidden" name="ps_id" class="form-control" id="ps_id" value ="<?php echo $id;?>"/>
                    <select class="form-control" name="product" id="product">
                        <option disabled="" selected>Select Product</option>
                        <?php if (is_array($product)) {
                            foreach ($product as $p) {
                        ?>
                                <option value="<?php echo $p->p_id; ?>"><?php echo $p->p_name; ?>
                                </option>
                        <?php }
                        } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Status</label>
                    <select class="form-control" name="ustatus" id="ustatus">
                        <option label="&nbsp;">&nbsp;</option>
                        <option value="1" selected="">Active</option>
                        <option value="0" >Delete</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary" id ="updateproductsupplier">Submit</button>
                <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cancel</button>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>
