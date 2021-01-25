<main>
    <div class="card mb-4">
        <div class="card-body">
        <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                <ol class="breadcrumb pt-0">
                    <li class="breadcrumb-item"><a href="<?php echo base_url() . 'admin/dashboard'; ?>">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page"><a href="<?php echo base_url() . 'clientmanagement'; ?>">Client List</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><a href="<?php echo base_url() . 'clientmanagement/site/'.$id; ?>">Client site List</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Update site</li>
                </ol>
            </nav>
            <?php
					$attributes = array('class' => 'form', 'id' => 'update_siteform');
					echo form_open('', $attributes);
				?>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputEmail4">Name*</label>
                    <input type="text" class="form-control" name="usname" placeholder="Site Name" value = "<?php echo $site[0]->site_name;?>">
                    <input type="hidden" name="id" class="form-control" id="c_id" value ="<?php echo $id;?>"/>
                    <input type="hidden" name="ucs_id" class="form-control" id="ucs_id" value ="<?php echo $sid;?>"/>
                </div>
                <div class="form-group col-md-6">
                    <label for="inputAddress">Site Address*</label>
                    <input type="text" class="form-control" name="usaddress" placeholder="Site Address" value = "<?php echo $site[0]->site_address;?>">
                </div>
                <div class="form-group col-md-6">
                <label>State</label><br>
                    <select class="form-control select2-single" name="usstate">
                        <option disabled="" selected>States</option>
                        <?php if (is_array($state)) {
                            foreach ($state as $state) {
                        ?>
                                <option <?php if (@$site[0]->state_id == $state->state_id) {
                                            echo "selected";
                                        } ?> value="<?php echo $state->state_id; ?>"><?php echo $state->state_name; ?>
                                </option>
                        <?php }
                        } ?>
                    </select>
                </div>
                <div class="form-group col-md-6">
                        <label>Supervisor*</label><br>
						<select class="form-control select2-single"  name="sup[]" multiple="true">
>
							<?php if(is_array($supervisor)) { 
				                  foreach ($supervisor as $sup) {
				            ?>
                			<option value="<?php echo $sup->sup_id; ?>" 
                            <?php if(in_array($sup->sup_id,$sup_array)):?>selected <?php endif;?>><?php echo $sup->sup_name; ?></option>
              				<?php } } ?>
						</select>
                </div>
                <div class="form-group col-md-6">
                    <label for="inputAddress">City</label>
                    <input type="text" class="form-control" name="uscity" placeholder="Site City" value = "<?php echo $site[0]->site_city;?>">
                </div>
                <div class="form-group col-md-6">
                <label for="companyinput5">Working*</label>
                            <select id="working" class="form-control"  name="usworking">
                                <option <?php if(@$site[0]->site_working == '1') { echo "selected"; } ?> value="1">Working</option>
                                <option <?php if(@$site[0]->site_working == '0') { echo "selected"; } ?> value="0">Completed</option>
                            </select>
                </div>
                <div class="form-group col-md-6">
                <label for="companyinput5">Status</label>
                            <select id="status" class="form-control"  name="usstatus">
                                <option <?php if(@$site[0]->site_status == '1') { echo "selected"; } ?> value="1">Active</option>
                                <option <?php if(@$site[0]->site_status == '0') { echo "selected"; } ?> value="0">De-active</option>
                            </select>
                </div>
            </div>
            <button type="submit" id="updatesite" class="btn btn-primary">
                <i class="la la-check-square-o"></i> Save
            </button>
            <a href="<?php echo base_url(); ?>clientmanagement/site/<?php echo $id;?>" class="btn btn-danger mr-1">
                <i class="ft-x"></i> Back
            </a>
            <?php echo form_close(); ?>
        </div>
    </div>
</main>