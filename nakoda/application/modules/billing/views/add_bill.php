<main>
   <div class="card mb-4">
      <div class="card-body">
         <div class="mb-4">
            <div class="top-right-button-container">
               <button type="button" class="btn btn-default btn-primary" data-toggle="modal" data-backdrop="static" data-target="#add_customer">Add Customer Name</button>
            </div>
            <h3>Add Bill<h3>
         </div>

         <!-- <div class="top-right-button-container">
                  <button type="button" class="btn btn-default btn-primary" data-toggle="modal" data-backdrop="static" data-target="#add_customer">Add Customer Name</button><br><br>
               </div> -->
         <?php
         $attributes = array('class' => 'form', 'id' => 'add_billingform', 'enctype' => 'multipart/form-data');
         echo form_open('', $attributes);
         ?>
         <div class="form-row">
            <div id="addon-row-drop">
               <div class="row">
                  <div class="form-group col-md-4">
                     <label>Customer Name*</label><br>
                     <select class="form-control customer select2-single" name="customer">
                        <option disabled="" selected>Select Customer Name</option>
                        <?php if (is_array($customer)) {
                           foreach ($customer as $c) {
                        ?>
                              <option value="<?php echo $c->c_id; ?>" data-customername="<?php echo $c->c_name; ?>" data-adress1="<?php echo $c->c_address1; ?>" data-address2="<?php echo $c->c_address2; ?>" data-mobile="<?php echo $c->c_mobile; ?>" data-alt="<?php echo $c->c_alt; ?>" data-pincode="<?php echo $c->c_pincode; ?>">
                                 <?php echo $c->c_name; ?>
                              </option>
                        <?php }
                        } ?>
                     </select>
                  </div>
                  <div class="form-group col-md-4">
                     <label>Payment Mode*</label><br>
                     <select class="form-control select2-single" name="paymentmode">
                        <option disabled="" selected>Select Payment Mode</option>
                        <?php if (is_array($paymode)) {
                           foreach ($paymode as $pm) {
                        ?>
                              <option value="<?php echo $pm->pm_id; ?>"><?php echo $pm->pm_name; ?></option>
                        <?php }
                        } ?>
                     </select>
                  </div>
                  <div class="form-group col-md-4">
                     <label for="companyinput5">Status*</label>
                     <select id="status" class="form-control" name="status">
                        <option value="1">Active</option>
                        <option value="0">De-active</option>
                     </select>
                  </div>
                  <!-- <div class="form-group col-md-4">
                     <button type="button" class="btn btn-default btn-primary" data-toggle="modal" data-backdrop="static" data-target="#add_customer">Add Customer Name</button>
                  </div> -->
                  <div class="form-group col-md-4">
                     <label for="inputEmail4">Drop Contact Name</label>
                     <input type="text" class="form-control shipping_contactname" name="cname" placeholder=" Drop Contact Name">
                  </div>
                  <div class="form-group col-md-4">
                     <label for="inputEmail4">Drop shipping Address</label>
                     <input type="text" class="form-control shipping_address" name="saddress" placeholder="shipping Address">
                  </div>
                  <div class="form-group col-md-4">
                     <label for="inputEmail4">Drop Shipping Pincode</label>
                     <input type="text" class="form-control shipping_pincode" name="spincode" placeholder="Shipping Pincode">
                  </div>
                  <div class="form-group col-md-4">
                     <label for="inputEmail4">Drop Contact Number</label>
                     <input type="text" class="form-control shipping_contact" name="scontact" placeholder="Shipping contact number">
                  </div>
               </div>
            </div>
            <div class="col-md-12">
               <span>---------------------------------------------------------------</span>
            </div>
         </div>
         <div id="addon-row-container">
            <div class="row addon-row">
               <div class="form-group col-md-3">
                  <label>Product</label><br>
                  <select class="form-control products" name="product[]">
                     <option selected="">product</option>
                     <?php if (is_array($products)) {
                        foreach ($products as $p) {
                     ?>
                           <option value="<?php echo $p['p_id']; ?>" 
					                    	data-tax_per = "<?php echo $p['tax_price'];?>"
                                    data-tax_type = "<?php echo $p['p_tax']; ?>"
                                    data-total="<?php echo $p['p_total']; ?>" 
                                    data-avail="<?php echo $p['p_avail']; ?>"
                                    data-unitprice="<?php echo $p['pd_unitprice']; ?>"  
                                    data-sold="<?php echo $p['p_sold']; ?>">
                              <?php echo $p['p_name'] . '-' . $p['p_code']; ?>
                           </option>
                     <?php }
                     } ?>
                  </select>
               </div>
               <div class="form-group col-md-3">
                  <label for="inputEmail4">Available Qty</label>
                  <input type="number" class="form-control p_avail" name="p_avail[]" min="1" readonly="">
                  <input type="hidden" name="p_sold[]" class="form-control p_sold">
                  <input type="hidden" name="p_total[]" class="form-control p_total">
               </div>
               <div class="form-group col-md-3">
                  <label>Tax type*</label><br>
                  <select class="form-control taxtype" name="taxtype[]">
                     <option selected ="" >Select Tax Type</option>
                     <?php if (is_array($taxtype)) {
                        foreach ($taxtype as $t) {
                     ?>
                        <option value="<?php echo $t->t_id; ?>" data-per = "<?php echo $t->tax_price;?>">
                           <?php echo $t->tax_name; ?> 
                        </option>
                     <?php }
                     } ?>
                  </select>
               </div>
               <div class="form-group col-md-3">
                  <label for="inputEmail4"> Order Qty</label>
                  <input type="number" class="form-control qty" name="qty[]" placeholder="Qty" min="1">
               </div>
               <div class="form-group col-md-3">
                  <label for="inputEmail4"> Unit Price</label>
                  <input type="number" min="0" class="form-control unitprice" name="unitprice[]" placeholder="unitprice">
               </div>
               
               <div class="form-group col-md-3">
                  <label for="inputEmail4">Total Price</label>
                  <input type="number" class="form-control total_price">
               </div>
               <div class="form-group col-md-2">
                  <label for="inputEmail4">Tax %</label>
                  <input type="text" class="form-control tax_per" name="tax_per[]">
               </div>
               <div class="form-group col-md-3">
                  <label for="inputEmail4">Tax Price</label>
                  <input type="text" class="form-control tax-price" name="tax_price[]">
               </div>
               <div class="col-md-1">
                  <span class="btn btn-default remove-row btn-danger">X</span>
               </div>
               <div class="col-md-12">
                  <span>---------------------------------------------------------------</span>
               </div>
            </div>
         </div>
         <div class="form-row">
            <div class="form-group col-md-4">
               <span class="btn btn-default btn-primary" id="add-row">Add product</span>
               <br><br>
            </div>
         </div>
         <div class="form-row">
         <div class="form-group col-md-4">
                  <label for="inputEmail4">Grand total</label>
                  <input type="text" class="form-control " id="addon-total-price" name="grand_total" readonly="">
               </div>
         <div class="form-group col-md-4">
                  <label for="inputEmail4">Grand total tax</label>
                  <input type="text" class="form-control " id="final-taxtotal-price" name="grand_taxtotal" readonly="">
               </div>
         <div class="form-group col-md-4">
                  <label for="inputEmail4">Grand total with tax</label>
                  <input type="text" class="form-control " id="grand-taxtotal" readonly="">
               </div>
         </div>
         <button type="submit" id="billing" class="btn btn-primary">
            <i class="la la-check-square-o"></i> Save
         </button>
         <a href="<?php echo base_url() . 'inventory'; ?>" class="btn btn-danger mr-1">
            <i class="ft-x"></i> Back
         </a>
         <?php echo form_close(); ?>
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

   $(document).on('change', '#addon-row-container .addon-row .products', function() {
      
      
      if ($(this).find('option:selected').attr('data-avail') == 0) {
         $(this).closest('.addon-row').find('.qty').attr('max', (0));

         $(this).closest('.addon-row').find('.qty').val($(this).find('option:selected').attr('data-avail'));


         $(this).closest('.addon-row').find('.qty').attr('min', (0));

      } else {

         $(this).closest('.addon-row').find('.qty').attr('max', ($(this).find('option:selected').attr('data-avail')));
         $(this).closest('.addon-row').find('.qty').attr('min', (1));

         $(this).closest('.addon-row').find('.qty').val(1);
      }

      $(this).closest('.addon-row').find('.p_avail').val($(this).find('option:selected').attr('data-avail'));

      $(this).closest('.addon-row').find('.p_sold').val($(this).find('option:selected').attr('data-sold'));
      // $(this).closest('.addon-row').find('.p_total').val($(this).find('option:selected').attr('data-total'));

      $(this).closest('.addon-row').find('.tax_per').val($(this).find('option:selected').attr('data-tax_per'));
      $(this).closest('.addon-row').find('.taxtype').val($(this).find('option:selected').attr('data-tax_type'));
		$(this).closest('.addon-row').find('.unitprice').val($(this).find('option:selected').attr('data-unitprice'));

      calcTotal();
   });

   $(document).on('change', '#addon-row-drop .row .customer', function() {
      $(this).closest('.row').find('.shipping_contactname').val($(this).find('option:selected').attr('data-customername'));

      $(this).closest('.row').find('.shipping_address').val($(this).find('option:selected').attr('data-adress1'));

      $(this).closest('.row').find('.shipping_pincode').val($(this).find('option:selected').attr('data-pincode'));

      $(this).closest('.row').find('.shipping_contact').val($(this).find('option:selected').attr('data-mobile'));
   });
   $(document).on('change','#addon-row-container .addon-row .qty',function(){

		
calcTotal();
});
$(document).on('keyup','#addon-row-container .addon-row .qty',function(){
		max = $(this).closest('.addon-row').find('.qty').attr('max');
		if($(this).val()>max)
		{
			alert("Insufficient stock");
			$(this).val(max);
		}
		calcTotal();
   });

   $(document).on('change','#addon-row-container .addon-row .unitprice',function(){
		calcTotal();
   });
   
   $(document).on('change','#addon-row-container .addon-row .taxtype',function(){
      var percentage = $(this).find('option:selected').attr('data-per')
      $(this).closest('.addon-row').find('.tax_per').val(percentage);
		      
		calcTotal();
   });

	$(document).on('keyup','#addon-row-container .addon-row .unitprice',function(){
		calcTotal();
	});
   
   function calcTotal(){
		grandTotal = 0;

		grandtaxTotal = 0;

		$('#addon-row-container').find('.addon-row').each(function(){
			var qty = $(this).find('.qty').val();
			var price = $(this).find('.unitprice').val();
			var tax = $(this).find('.tax_per').val();
			totalPrice = parseFloat(qty)*parseFloat(price);
			taxtotal = (totalPrice *parseFloat(tax)/100);
			finalPrice = totalPrice - taxtotal;
			$(this).find('.total_price').val(totalPrice.toFixed(2));

			$(this).find('.tax-price').val(taxtotal.toFixed(2));
			grandTotal += totalPrice;
			grandtaxTotal += taxtotal;

      });
      
		$('#addon-total-price').val(grandTotal.toFixed(2));

			
		$('#final-taxtotal-price').val(grandtaxTotal.toFixed(2));


		$('#grand-taxtotal').val((grandTotal+grandtaxTotal).toFixed(2));

	}
</script>

<div class="modal fade modal-right" id="add_customer" tabindex="-1" role="dialog" aria-labelledby="add_customer" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title">Add Customer</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <?php
            $attributes = array('class' => 'form', 'id' => 'add_customerform');
            echo form_open('', $attributes);
            ?>
            <div class="form-group">
               <label>Customer Name</label>
               <input type="text" class="form-control" name="cname" placeholder="Customer Name"/>
            </div>
            <div class="form-group">
               <label>Address 1</label>
               <input type="text" class="form-control" name="address1" placeholder="Customer Address" />
            </div>
            <div class="form-group">
               <label>Address 2</label>
               <input type="text" class="form-control" name="address2" placeholder="Customer Address" />
            </div>
            <div class="form-group">
               <label>Customer Mobile No.</label>
               <input type="text" class="form-control" name="mobile" placeholder="Customer Mobile Number" />
            </div>
            <div class="form-group">
               <label>Customer Alt No.</label>
               <input type="text" class="form-control" name="alt" placeholder="Customer Alt Number" />
            </div>
            <div class="form-group">
               <label>Customer Pincode</label>
               <input type="text" class="form-control" name="pincode" placeholder="Customer Pincode" />
            </div>
            
            <?php echo form_close(); ?>
         </div>
         <div class="modal-footer">
            <button type="submit" class="btn btn-primary" id="customer">Submit</button>
            <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cancel</button>
         </div>
      </div>
   </div>
</div>