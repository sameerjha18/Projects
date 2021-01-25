<main>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h1>Dashboard Content</h1>
                <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                    <ol class="breadcrumb pt-0">
                        <li class="breadcrumb-item"><a href="#">Home</a>
                        </li>
                        <li class="breadcrumb-item"><a href="#">Library</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Data</li>
                    </ol>
                </nav>
                <div class="separator mb-5"></div>
            </div>
            <div class="row">
                    <div class="col-lg-4">
                        <div class="card mb-4 progress-banner">
                            <div class="card-body justify-content-between d-flex flex-row align-items-center">

                                <div><a href="<?php echo base_url(); ?>products"><i class="iconsminds-male mr-2 text-white align-text-bottom d-inline-block"></i>
                                        <div>
                                            <p class="lead text-white">Product list</p>
                                        </div>
                                </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card mb-4 progress-banner">
                            <div class="card-body justify-content-between d-flex flex-row align-items-center">
                                <div><a href="<?php echo base_url().'products/product_supplier'; ?>"><i class="iconsminds-male mr-2 text-white align-text-bottom d-inline-block"></i>
                                        <div>
                                            <p class="lead text-white">Product suppliers</p>
                                        </div>
                                </div>
                            </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card mb-4 progress-banner">
                            <div class="card-body justify-content-between d-flex flex-row align-items-center">
                                <div><a href="<?php echo base_url().'products/product_specialized'; ?>"><i class="iconsminds-male mr-2 text-white align-text-bottom d-inline-block"></i>
                                        <div>
                                             <p class="lead text-white">Product Fabrication</p>
                                        </div>
                                </div>
                            </div>
                            </a>
                        </div>
                    </div>
            </div>
        </div>
</main>