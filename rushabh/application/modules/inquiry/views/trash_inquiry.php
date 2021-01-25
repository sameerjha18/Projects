<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-wrapper-before"></div>
        <div class="content-header row">
         
          <div class="content-header-right col-md-12 col-12">
            <div class="breadcrumbs-top float-md-right">
              <div class="breadcrumb-wrapper mr-1">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>admin/dashboard">Home</a>
                  </li>
                  <li class="breadcrumb-item"><a href="<?php echo base_url().'inquiry/allinquiries'; ?>">Inquiry list</a>
                  </li>
                  <li class="breadcrumb-item active">Trash Inquiry
                  </li>
                </ol>
              </div>
            </div>
          </div>
        </div>
        <div class="content-body">
        	<!-- DOM - jQuery events table -->
				<section id="dom">
				    <div class="row">
				        <div class="col-12">
				            <div class="card">
								<div class="card-header">
				                </div>
								<input type="hidden" id="csrf_token_name" value="<?php echo $this->security->get_csrf_token_name(); ?>" />
								<input type="hidden" id="csrf_token_hash" value="<?php echo $this->security->get_csrf_hash(); ?>" />
				                <div class="card-content collapse show">
				                    <div class="card-body card-dashboard">
				                        <div class="table-responsive">
											<table class="table table-striped table-bordered dom-jQuery-events">
				                            <thead>
				                                <tr>
				                                    <th>Date</th>
				                                    <th>Customer</th>
				                                    <th>Lead status</th>
				                                    <th>Products</th>
				                                    <th>Update</th>
				                                </tr>
				                            </thead>
				                            <?php
											if(is_array($cl) && !empty($cl))
											{
											?>
											<tbody>
											<?php
											$i = 1;
											foreach($cl as $val)
											{
											?>
												<tr>
													<td><?php echo date('d-m-Y',strtotime($val['inq_date'])); ?></td>												
													<td><?php echo $val['c_name']; ?></td>
													<td><?php echo $val['ls_name']; ?></td>
												
													<td><?php echo $val['products']; ?></td>
													<td>
														<a href="<?php echo base_url().'inquiry/update_inquiry/'; ?><?php echo $val['inq_id']; ?>"><i class="ft-edit" title="Update"></i></a>
													</td>
													
												</tr>
											<?php
											$i++;
											}
											?>
											</tbody>
											<?php
											}
											?>
				                        </table>
				                    </div>
				                </div>
				            </div>
				        </div>
				    	</div>
					</div>
				</section>
			<!-- DOM - jQuery events table -->
		</div>
	</div>
</div>