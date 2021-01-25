<main>
    <div class="card mb-4">
        <div class="card-body">
        <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                <ol class="breadcrumb pt-0">
                    <li class="breadcrumb-item"><a href="<?php echo base_url() . 'admin/dashboard'; ?>">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page"><a href="<?php echo base_url() . 'clientmanagement'; ?>">Client List</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><a href="<?php echo base_url() . 'clientmanagement/site/'.$id; ?>">Client site List</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Add site</li>
                </ol>
            </nav>
            <?php
					$attributes = array('class' => 'form', 'id' => 'add_siteform','enctype' => 'multipart/form-data');
					echo form_open('', $attributes);
				?>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputEmail4">Name*</label>
                    <input type="text" class="form-control" name="sname" placeholder="Site Name">
                    <input type="hidden" name="id" class="form-control" id="c_id" value ="<?php echo $id;?>"/>
                </div>
                <div class="form-group col-md-6">
                    <label for="inputAddress">Site Address*</label>
                    <input type="text" class="form-control" name="saddress" placeholder="Site Address">
                </div>
                <div class="form-group col-md-6">
                  <label>States</label><br>
						<select class="form-control select2-single"  name="state" >
                     <option disabled="" selected>States</option>
							<?php if(is_array($state)) { 
				                  foreach ($state as $state) {
				            ?>
                			<option value="<?php echo $state->state_id; ?>"><?php echo $state->state_name; ?></option>
              				<?php } } ?>
						</select>
                </div>
                <div class="form-group col-md-6">
                        <label>Supervisor*</label><br>
						<select class="form-control select2-single"  name="sup[]" multiple="true">

							<?php if(is_array($supervisor)) { 
				                  foreach ($supervisor as $sup) {
				            ?>
                			<option value="<?php echo $sup->sup_id; ?>"><?php echo $sup->sup_name; ?></option>
              				<?php } } ?>
						</select>
                </div>
                <div class="form-group col-md-6">
                    <label for="inputAddress">City</label>
                    <input type="text" class="form-control" name="scity" placeholder="Site City">
                </div>
                <div class="form-group col-md-6">
                    <label for="companyinput5">Working*</label>
                    <select id="working" class="form-control" name="working">
                        <option value="1">Working</option>
                        <option value="0">Completed</option>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="companyinput5">Status</label>
                    <select id="status" class="form-control" name="status">
                        <option value="1">Active</option>
                        <option value="0">De-active</option>
                    </select>
                </div>
            </div>
            <button type="submit" id="addsite" class="btn btn-primary">
                <i class="la la-check-square-o"></i> Save
            </button>
            <a href="<?php echo base_url(); ?>clientmanagement/site/<?php echo $id;?>" class="btn btn-danger mr-1">
                <i class="ft-x"></i> Back
            </a>
            <?php echo form_close(); ?>
        </div>
    </div>
</main>