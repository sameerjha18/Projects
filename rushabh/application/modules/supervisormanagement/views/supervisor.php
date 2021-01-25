
 <main>
         <div class="container-fluid">
            <div class="row">
               <div class="col-12">
                  <h1>Supervisor List</h1>
                  <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                    <ol class="breadcrumb pt-0">
                        <li class="breadcrumb-item"><a href="<?php echo base_url().'admin/dashboard'; ?>">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Supervisor List</li>
                    </ol>
                </nav>
                  <div class="top-right-button-container">

                     <button type="button" class="btn btn-outline-warning" data-toggle="modal" data-backdrop="static" data-target="#add_supervisor">Add Supervisor</button>
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
                       if($this->session->flashdata('Supervisormsg')){
                       ?>
                         <div class="alert alert-success mb-2" role="alert">
                           <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                             <span aria-hidden="true">&times;</span>
                           </button>

                           <?php
                               echo $this->session->flashdata('Supervisormsg');
                           ?>
                         </div>
                       <?php
                        }
                     ?>
                  <table id="datatableRows" class="data-table responsive nowrap" data-order="[[ 0, &quot;asc&quot; ]]">
                     <thead>
                        <tr>                           
                           <th>Supervisor Name</th>
                           <th>Mobile number</th>
                           <th>Mail ID</th>
                           <th>Status</th>
                           <th>Action</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php
                           if(is_array($s_list) && !empty($s_list))
                           {
                              foreach($s_list as $val)
                               {
                        ?>
                           <tr>
                              <td><?php echo $val->sup_name; ?></td>
                              <td><?php echo $val->sup_mobile; ?></td>
                              <td><?php echo $val->sup_email; ?></td>
                              <td>
                                 <?php 
                                 if($val->sup_status=='1'){
                                    echo "Active";
                                 }
                                 else{ 
                                    echo "De-active"; } 
                                 ?>
                              </td>
                              <td>
                                 <a for ="<?php echo $val->sup_id; ?>" class="search_supervisor"  data-csrf_token_name ="<?php echo $this->security->get_csrf_token_name(); ?>" data-csrf_token_hash = "<?php echo $this->security->get_csrf_hash(); ?>">
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

<div class="modal fade modal-right" id="add_supervisor" tabindex="-1" role="dialog" aria-labelledby="add_supervisor" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Add Supervisor</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<?php
					$attributes = array('class' => 'form', 'id' => 'add_supervisorform');
					echo form_open('', $attributes);
				?>
					<div class="form-group">
						<label>Name*</label>
						<input type="text" class="form-control" name = "supname">
					</div>
               <div class="form-group">
                  <label>Address*</label>
                  <input type="text" class="form-control" name = "supaddress">
               </div>

               <div class="form-group">
                  <label>Mobile*</label>
                  <input type="text" class="form-control" name = "supmobile">
               </div>
               <div class="form-group">
                  <label>Alternate Mobile</label>
                  <input type="text" class="form-control" name = "supalt">
               </div>

               <div class="form-group">
                  <label>Email*</label>
                  <input type="text" class="form-control" name = "supemail">
               </div>
					<div class="form-group">
						<label>Status</label>
						<select class="form-control" name="supstatus">
							<option label="&nbsp;">&nbsp;</option>
							<option value="1" selected="">Active</option>
							<option value="0" >Delete</option>
						</select>
					</div>
				
				<?php echo form_close(); ?>
			</div>
			<div class="modal-footer">
            <button type="submit" class="btn btn-primary" id ="add_supervisors">Submit</button>
				<button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cancel</button>
			</div>
		</div>
	</div>
</div>	


<div class="modal fade modal-right" id="update_supervisor" tabindex="-1" role="dialog" aria-labelledby="update_supervisor" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title">Update Supervisor </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <?php
               $attributes = array('class' => 'form', 'id' => 'update_supervisorform');
               echo form_open('', $attributes);
            ?>
               <div class="form-group">
                  <label>Name*</label>
                  <input type="text" class="form-control" name = "supname"  id ="supname">

                  <input type="hidden" class="form-control" name = "sup_id"  id ="sup_id">
               </div>
               
               <div class="form-group">
                  <label>Address*</label>
                  <input type="text" class="form-control" name = "supaddress" id = "supaddress">
               </div>

               <div class="form-group">
                  <label>Mobile*</label>
                  <input type="text" class="form-control" name = "supmobile" id = "supmobile">
               </div>
               <div class="form-group">
                  <label>Alternate Mobile</label>
                  <input type="text" class="form-control" name = "supalt" id = "supalt">
               </div>

               <div class="form-group">
                  <label>Email*</label>
                  <input type="text" class="form-control" name = "supemail" id ="supemail">
               </div>
               <div class="form-group">
                  <label>Status</label>
                  <select class="form-control" name="supstatus" id ="supstatus">
                     <option label="&nbsp;">&nbsp;</option>
                     <option value="1" selected="">Active</option>
                     <option value="0" >Delete</option>
                  </select>
               </div>
            
            <?php echo form_close(); ?>
         </div>
         <div class="modal-footer">

            <button type="submit" class="btn btn-primary" id ="update_supervisors">Submit</button>
            <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cancel</button>
         </div>
      </div>
   </div>
</div>   

<script type="text/javascript">
   document.addEventListener("keydown", function(event) {
  
      if(event.keyCode=='113')
      {

         $('#add_staffmodal').modal('show'); 
      }
   });


</script>