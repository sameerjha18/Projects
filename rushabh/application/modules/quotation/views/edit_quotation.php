	<main> 
		<div class="card mb-4"> 
			<div class="card-body"> 
				<nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb"> 
					<ol class="breadcrumb pt-0"> 
						<li class="breadcrumb-item"><a href="<?php echo base_url() . 'admin/dashboard'; ?>">Dashboard</a> </li> 
						<li class="breadcrumb-item active" aria-current="page"><a href="<?php echo base_url() . 'purchase'; ?>">Quotation List</a></li> 
						<li class="breadcrumb-item active" aria-current="page">Add Quotataion</li> 
					</ol> 
				</nav> 
				<?php $attributes = array('class' => 'form', 'id' => 'edit_quotationform'); 
				echo form_open('', $attributes); ?>  
					<div class="row addon-rows">  
						<div class="form-group col-md-6"> 
							<label>Customer Name</label><br> 
							<input type="text" name="customer" class="form-control" value="<?php echo $iq[0]['c_name'];?>">
							<input type="hidden" name="inq_id" id="inq_id" class="form-control" value="<?php echo $iq[0]['inq_id'];?>">
							<input type="hidden" name="q_id" id="q_id" class="form-control" value="<?php echo $quote_id;?>">
						</div>

						<div class="form-group col-md-6"> 
							<label>Customer Mobile</label><br> 
							<input type="text" name="mobile" class="form-control" value="<?php echo $iq[0]['c_mobile'];?>">
						</div>

						<div class="form-group col-md-6"> 
							<label>Customer Email</label><br> 
							<input type="text" name="email" class="form-control" value="<?php echo $iq[0]['c_email'];?>">
						</div>
						<div class="form-group col-md-6"> 
							<label>Scope Of Work</label><br>
							<textarea name="sow" class="form-control" cols="5" rows="3"><?php echo $iq[0]['inq_sow'];?></textarea>
						</div>
					</div> 

					<div id="addon-row-container"> 
						<?php if(is_array($qd)):
							foreach ($qd as $value) 
							{
							
						?>
								<div class="row addon-row"> 
									<div class="form-group col-md-6"> 
										<label>Work Name</label><br> 
										<select class="form-control temp" name="wname[]"> 
											<option selected>Select Work Name</option> 
											<?php if (is_array($temp)) {foreach ($temp as $t) {?> 
												<option <?php if($value->temp_name == $t->temp_name){
													echo "selected";
												}?> value="<?php echo $t->temp_name; ?>"
													data-name="<?php echo $t->temp_name; ?>"
													data-desc="<?php echo $t->temp_desc; ?>"> 
													<?php echo $t->temp_name ?> 
												</option> 
											<?php } } ?> 
										</select> 
									</div>
									<div class="form-group col-md-6"> 
										<label for="inputEmail4">Work Description</label>
										<textarea class="form-control desc" rows="5" cols="4" name="wdesc[]" placeholder="Work Description"><?php echo $value->temp_description;?></textarea> 
									</div> 
									<div class="form-group col-md-4"> 
										<label for="inputEmail4"> Total Area</label> 
										<input type="number" class="form-control area" name="area[]" value="<?php echo $value->qd_totalArea;?>" placeholder="Area" min="1"> 
									</div> 
									<div class="form-group col-md-4"> 
										<label for="inputEmail4"> Unit</label> 
										<input type="text"class="form-control unit" name="unit[]" value="<?php echo $value->qd_unit;?>" placeholder="unit"> 
									</div> 
									<div class="form-group col-md-4"> 
										<label for="inputEmail4">Price</label> 
										<input type="number" class="form-control price" name="price[]" value="<?php echo $value->qd_price;?>" placeholder="Price"> 
									</div>

									<div class="form-group col-md-4"> 
										<label for="inputEmail4">Amount</label> 
										<input type="number" class="form-control amount" name="amount[]" value="<?php echo $value->qd_amount;?>" placeholder="Amount"> 
									</div> 
									<div class="col-md-1"> 
										<span class="btn btn-default remove-row btn-danger">X</span> 
									</div> 
									<div class="col-md-12"> 
										<span>---------------------------------------------------------------</span> 
									</div> 
								</div> 

							<?php 
							}
						else:?>
							<div class="row addon-row"> 
								<div class="form-group col-md-6"> 
									<label>Work Name</label><br> 
									<select class="form-control temp" name="wname[]"> 
										<option selected>Select Work Name</option> 
										<?php if (is_array($temp)) {foreach ($temp as $t) {?> 
											<option value="<?php echo $t->temp_name; ?>"
												data-name="<?php echo $t->temp_name; ?>"
												data-desc="<?php echo $t->temp_desc; ?>"> 
												<?php echo $t->temp_name ?> 
											</option> 
										<?php } } ?> 
									</select> 
								</div>
								<div class="form-group col-md-6"> 
									<label for="inputEmail4">Work Description</label>
									<textarea class="form-control desc" rows="5" cols="4" name="wdesc[]" placeholder="Work Description"></textarea> 
								</div> 
								<div class="form-group col-md-4"> 
									<label for="inputEmail4"> Total Area</label> 
									<input type="number" class="form-control area" name="area[]" placeholder="Area" min="1"> 
								</div> 
								<div class="form-group col-md-4"> 
									<label for="inputEmail4"> Unit</label> 
									<input type="text"class="form-control unit" name="unit[]" placeholder="unit"> 
								</div> 
								<div class="form-group col-md-4"> 
									<label for="inputEmail4">Price</label> 
									<input type="number" class="form-control price" name="price[]" placeholder="Price"> 
								</div>

								<div class="form-group col-md-4"> 
									<label for="inputEmail4">Amount</label> 
									<input type="number" class="form-control amount" name="amount[]" placeholder="Amount"> 
								</div> 
								<div class="col-md-1"> 
									<span class="btn btn-default remove-row btn-danger">X</span> 
								</div> 
								<div class="col-md-12"> 
									<span>---------------------------------------------------------------</span> 
								</div> 
							</div> 
						<?php endif;?>

					</div>
					<div class="form-row"> 
						<div class="form-group col-md-4"> 
							<span class="btn btn-default btn-primary" id="add-row">Add Quotation</span> 
							<br><br> 
						</div> 
					</div>
					<div class="form-actions"> 
						<button type="submit" id="edit_quotation" class="btn btn-primary"> <i class="la la-check-square-o"></i> Save </button> 
						<a href="<?php echo base_url(); ?>quotation" class="btn btn-danger mr-1"> <i class="ft-x"></i> Back </a> 
					</div> 
				<?php echo form_open(); ?> 
			</div> 
		</div> 
	</main>

<script type="text/javascript">
   /* ADDON & RELATED CALCULATIONS */
   $('#add-row').click(function() {
      var addonRow = $('#addon-row-container .addon-row').html();
      $('#addon-row-container').append('<div class="row addon-row" >' + addonRow + '</div>');

   });
   $(document).on('click', '#addon-row-container .addon-row .remove-row', function() {
      if ($('#addon-row-container .addon-row').length > 1) {
         $(this).closest('.addon-row').remove();
         calcTotal();

      }
   });

   $(document).on('change', '#addon-row-container .addon-row .temp', function() {
    

      $(this).closest('.addon-row').find('.desc').val($(this).find('option:selected').attr('data-desc'));

       calcTotal();

   });

   $(document).on('change','#addon-row-container .addon-row .area',function(){
      
      calcTotal();
      });


   
   $(document).on('change','#addon-row-container .addon-row .price',function(){
        calcTotal();
   });

      $(document).on('keyup','#addon-row-container .addon-row .area',function(){
      
      calcTotal();
      });

   
   
   $(document).on('keyup','#addon-row-container .addon-row .price',function(){
        calcTotal();
   });

   $(document).on('keyup','#addon-row-container .addon-row .price',function(){
        calcTotal();
   });
   
   function calcTotal(){


        $('#addon-row-container').find('.addon-row').each(function(){
            var area = $(this).find('.area').val();
            var price = $(this).find('.price').val();
            amount = parseFloat(area)*parseFloat(price);
            $(this).find('.amount').val(amount.toFixed(2));

      });

    }
</script>