<main>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                    <ol class="breadcrumb pt-0">
                        <li class="breadcrumb-item"><a href="<?php echo base_url().'admin/dashboard'; ?>">Dashboard</a>
                        </li>
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
                        <th>Supplier</th>
                        <th>Product Image</th>
                        <th>Purchase Price</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if(is_array($sp_list) && !empty($sp_list))
                    {
                        foreach($sp_list as $val)
                        {
                            ?>
                            <tr>
                                <td><?php echo $val['p_name']; ?></td>
                                <td><?php echo $val['s_name']; ?></td>
                                <td><a href="<?php echo base_url().'uploads/product/'.$val['p_image']; ?>" target="_blank"><?php echo $val['p_image']; ?></a></td>
                                <td><i class="simple-icon-eye"></i></td>
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
