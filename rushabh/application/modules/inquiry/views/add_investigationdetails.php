<main>
    <div class="card mb-4">
        <div class="card-body">
        <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                <ol class="breadcrumb pt-0">
                    <li class="breadcrumb-item"><a href="<?php echo base_url() . 'admin/dashboard'; ?>">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page"><a href="<?php echo base_url() . 'inquiry/allinquiries'; ?>">All Inquiry</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Add Investigation Details</li>
                </ol>
            </nav>
            <?php
            $attributes = array('class' => 'form', 'id' => 'add_inquirydetailform');
            echo form_open('', $attributes);
            ?>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label> Investigation Details</label> 
                    <a id ="undo" class="btn btn-danger mr-1">
                    <i class="ft-x"></i> Undo</a>
                            <br><br>
                 
                    <textarea id="id_details" cols="5" class="form-control" rows="8"></textarea>
            
                    
                </div>
                <div class="form-group col-md-6">
                    <label for="companyinput1" id="cust_update">Area</label>
                    <textarea name="area" id="area" cols="5" class="form-control" rows="8"></textarea>
                    <input type="hidden" id= "inq_id" class="form-control" value="<?php echo $inq_id; ?>">
                </div>

                <div class="form-group col-md-6">
                    <label for="companyinput1" id="cust_update">Jali Position</label>
                    <textarea name="jp" id="jp" cols="5" rows="8" class="form-control"></textarea>
                </div>
                <div class="form-group col-md-6">
                    <label for="companyinput1" id="cust_update">Openable Grill Distance</label>
                    <textarea name="ogd" id="ogd" cols="5" class="form-control" rows="2"></textarea>
                </div>

                <div class="form-group col-md-6">
                    <label for="companyinput1" id="cust_update">Exhausted Fan Size (Kitchen & Bathroom)</label>
                    <textarea name="efs" id="efs" class="form-control" cols="5" rows="2"></textarea>
                </div>
                <div class="form-group col-md-6">
                    <label for="companyinput1" id="cust_update">Marbel Size</label>
                    <textarea name="ms" id="ms" cols="5" class="form-control" rows="2"></textarea>
                </div>
                <div class="form-group col-md-6">
                    <label for="companyinput1" id="cust_update">Powder Coating / Anodibling</label>
                    <textarea name="pc" id="pc" cols="5" rows="2" class="form-control"></textarea>
                </div>
                <div class="form-group col-md-6">
                    <label for="companyinput1" id="cust_update">Glass</label>
                    <textarea name="glass" id="glass" cols="5" rows="2" class="form-control"></textarea>
                </div>
                <div class="form-group col-md-6">
                    <label for="companyinput1" id="cust_update">Aluminium Section</label>
                    <textarea name="aluminium" id="aluminium" cols="5" class="form-control" rows="2"></textarea>
                </div>
            </div>
            <button type="submit" id="add_inquirydetail" class="btn btn-primary">
                <i class="la la-check-square-o"></i> Save
            </button>
            <a href="<?php echo base_url() . 'inquiry/view/'.$inq_id; ?>" class="btn btn-danger mr-1">
                <i class="ft-x"></i> Back
            </a>
            <?php echo form_close(); ?>
        </div>
    </div>
</main>

<script type="text/javascript">
    
    $("#id_details").on("keypress",function(e){
       $("#area").val($("#id_details").val());
       $("#jp").val($("#id_details").val());
    });


    $("#id_details").on("change",function(e){ 
        $("#area").val($("#id_details").val());       
       $("#jp").val($("#id_details").val());
    });

    $("#area").on("focus",function(e)
    {
        document.getElementById("id_details").readOnly = true;
    });

    $("#undo").on("click",function(e){

        document.getElementById("id_details").readOnly = false;
    });
</script>