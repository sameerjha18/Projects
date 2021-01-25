<main>
<!-- <div class="modal fade modal-right" id="add_clientmodal" tabindex="-1" role="dialog" aria-labelledby="add_clientmodal" aria-hidden="true"> -->
	<!-- <div class="modal-dialog" role="document"> -->
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Add New Client</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<?php
					$attributes = array('class' => 'form', 'id' => 'add_clientform');
					echo form_open('', $attributes);
				?>
                <div class="form-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="companyinput1" id="cust_update">Company Name*</label>
                                <input type="text" name="cname" class="form-control" placeholder=" Company Name" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="companyinput1" id="cust_update">Address 1*</label>
                                <input type="text" name="caddress1" class="form-control" placeholder="Address 1" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="companyinput1" id="cust_update">Address 2*</label>
                            <input type="text" name="caddress2" class="form-control" placeholder="Address 2" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="companyinput1" id="cust_update">Address 3*</label>
                            <input type="text" name="caddress3" class="form-control" placeholder="Address 3" />
                        </div>
                    </div>
                    </div>
                    <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="companyinput1" id="cust_update">State*</label>
                            <input type="text" name="cstate" class="form-control" placeholder="State" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="companyinput1" id="cust_update">City*</label>
                            <input type="text" name="ccity" class="form-control" placeholder="City" />
                        </div>
                    </div>
                </div>
                    <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="companyinput1" id="cust_update">Pincode*</label>
                            <input type="text" name="cpincode" class="form-control" placeholder="Pincode" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="companyinput1" id="cust_update">Country*</label>
                            <input type="text" name="ccountry" class="form-control" placeholder="Country" />
                        </div>
                    </div>
                </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="companyinput1" id="cust_update">Mobile*</label>
                                <input type="text" name="cmobile" class="form-control" placeholder="Mobile" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="companyinput1" id="cust_update">Alt Mobile*</label>
                                <input type="text" name="caltmobile" class="form-control" placeholder="Alt Mobile" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="companyinput1" id="cust_update">Email*</label>
                                <input type="text" name="cemail" class="form-control" placeholder="Email" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="companyinput5">Status*</label>
                                <select id="status" class="form-control"  name="status">
                                    <option value="1">Active</option>
                                    <option value="0">De-active</option>
                                </select>
                            </div>
                        </div>
                    </div>
				
				<?php echo form_close(); ?>
			</div>
			<div class="modal-footer">
                <button type="submit" id="add_client" class="btn btn-primary">
                    <i class="la la-check-square-o"></i> Save
                </button>
                <a href="<?php echo base_url().'clientmanagement'; ?>" class="btn btn-danger mr-1">
                    <i class="ft-x"></i> Back
                </a>
			</div>
		</div>
	<!-- </div>
</div> -->
</main>