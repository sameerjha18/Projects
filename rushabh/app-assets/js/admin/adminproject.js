$(document).ready(function(){
	$('#mySelect1').select2({
         dropdownParent: $('#add_industrytype')
      });

	$("#adminuser").on("click",function(e){
		e.preventDefault();
		formdata = $("#adminform").serializeArray();
		formdata.push({name:'isAjax',value:1});
		$.ajax({
			url:$('#adminform').attr('action'),
			type:'POST',
			data:formdata,
			dataType:"JSON",
			beforeSend:function(){
				ajaxindicatorstart("Please wait.",base_url);
			},
			success:function(response)
			{
				ajaxindicatorstop();
				if(response == 1)
				{
					$('input[name=admin_role]').attr('checked', false);
					$("#adminform")[0].reset();
					
					$("#form_error").css("display","none");
					$("#form_success").css("display","block");
					$(".success_msg").html("Admin user added successfully.");
				}
				else if(response == 2)
				{
					$('input[name=admin_role]').attr('checked', false);
					$("#adminform")[0].reset();
					$("#form_success").css("display","none");
					$("#form_error").css("display","block");
					$(".error_msg").html("Something wrong, please check again.");
				}
				else if(response == 3)
				{
					$('input[name=admin_role]').attr('checked', false);
					$("#adminform")[0].reset();
					$("#form_error").css("display","block");
					$(".error_msg").html("User already exist.");
				}
				else
				{
					appendMsgs("#adminform",response);
				}
			},
			error:function(){
				ajaxindicatorstop();
			}
		});
	});

	$("#changepassword").on("click",function(e){

		e.preventDefault();
		formdata = $("#passwordform").serializeArray();

		formdata.push({name:'isAjax',value:1});
		$.ajax({
			url:$('#passwordform').attr('action'),
			type:'POST',
			data:formdata,
			dataType:"JSON",
			beforeSend:function(){
				ajaxindicatorstart("Please wait.",base_url);
			},
			success:function(response)
			{
				ajaxindicatorstop();
				if(response.result == 'success')
				{
					alert("password change");
					window.location.href = base_url+'admin/dashboard';

				}
				else if(response.result =='fail')
				{
					alert("old password does not match")
					$("#passwordform")[0].reset();
				}
				else if(response == 3)
				{
					window.location.href = base_url+'admin/dashboard';
				}
				else
				{
					appendMsgs("#passwordform",response);
				}
			},
			error:function(){
				ajaxindicatorstop();
			}
		});
	});

	$("#add_inquirydetail").on("click",function(e){
		e.preventDefault();
		id = $('#inq_id').val();
		formdata = $("#add_inquirydetailform").serializeArray();
		formdata.push({name:'isAjax',value:1});
		$.ajax({
			url:base_url+'inquiry/add_inquirydetails/'+id,
			type:'POST',
			data:formdata,
			dataType:"JSON",
			beforeSend:function(){
				ajaxindicatorstart("Please wait.",base_url);
			},
			success:function(response)
			{
				ajaxindicatorstop();
				if(response == 1)
				{
					$("#add_inquirydetailform")[0].reset();
					window.location.href = base_url+'inquiry/view/'+id;
				}
				else if(response == 2)
				{
					$("#add_inquirydetailform")[0].reset();
					$("#form_success").css("display","none");
					$("#form_error").css("display","block");
					$(".error_msg").html("Something wrong, please check again.");
				}
				else if(response == 3)
				{
					window.location.href = base_url+'admin/dashboard';
				}
				else
				{
					appendMsgs("#add_inquirydetailform",response);
				}
			},
			error:function(){
				ajaxindicatorstop();
			}
		});
    });

    $("#update_inquirydetail").on("click",function(e){
		e.preventDefault();
		id = $("#inqd_id").val();
		inqid = $("#inq_id").val();
		formdata = $("#update_inquirydetailform").serializeArray();
		formdata.push({name:'isAjax',value:1});
		$.ajax({
			url:base_url+'/inquiry/update_inquirydetails/'+id+'/'+inqid,
			type:'POST',
			data:formdata,
			dataType:"JSON",
			beforeSend:function(){
				ajaxindicatorstart("Please wait.",base_url);
			},
			success:function(response)
			{
				ajaxindicatorstop();
				if(response == 1)
				{
					$("#update_inquirydetailform")[0].reset();
					window.location.href = base_url+'inquiry/inspectiondetails/'+inqid;
				}
				else if(response == 2)
				{
					$("#update_inquirydetailform")[0].reset();
					$("#form_success").css("display","none");
					$("#form_error").css("display","block");
					$(".error_msg").html("Something wrong, please check again.");
				}
				else if(response == 3)
				{
					window.location.href = base_url+'inquiry/allinquiry';
				}
				else
				{
					appendMsgs("#update_inquirydetailform",response);
				}
			},
			error:function(){
				ajaxindicatorstop();
			}
		});
	});

	$("#uploadimage").on("click",function(e){
		e.preventDefault();
		id = $('#inq_id').val();
		var form = $('#imageuploadform')[0];
		var data = new FormData(form);
		$.ajax({
			url:base_url+'inquiry/upload_photographs/'+id,
			type:'POST',
			data:data,
			processData:false,
			cache:false,
			contentType:false,
			dataType:"JSON",
			beforeSend:function(){
				ajaxindicatorstart("Please wait.",base_url);
			},
			success:function(response)
			{
				ajaxindicatorstop();
				if(response == 1)
				{
					$("#imageuploadform")[0].reset();
					window.location.href = base_url+'inquiry/inspectiondetails/'+id;;
				}
				else if(response == 2)
				{
					$("#imageuploadform")[0].reset();
					$("#form_success").css("display","none");
					$("#form_error").css("display","block");
					$(".error_msg").html("Something wrong, please check again.");
				}
				else if(response == 3)
				{
					window.location.href = base_url+'admin/dashboard';
				}
				else
				{
					appendMsgs("#imageuploadform",response);
				}
			},
			error:function(){
				ajaxindicatorstop();
			}
		});
	});

	$("#ptype").on("click",function(e){
		e.preventDefault();
		formdata = $("#add_producttypeform").serializeArray();
		formdata.push({name:'isAjax',value:1});
		$.ajax({
			url:$('#add_producttypeform').attr('action')+'/add_producttype',
			type:'POST',
			data:formdata,
			dataType:"JSON",
			beforeSend:function(){
				ajaxindicatorstart("Please wait.",base_url);
			},
			success:function(response)
			{
				ajaxindicatorstop();
				if(response == 1)
				{
					$("#add_producttypeform")[0].reset();
					window.location.href = base_url+'producttype';
				}
				else if(response == 2)
				{
					$("#add_producttypeform")[0].reset();
					$("#form_success").css("display","none");
					$("#form_error").css("display","block");
					$(".error_msg").html("Something wrong, please check again.");
				}
				else if(response == 3)
				{
					window.location.href = base_url+'producttype';
				}
				else
				{
					appendMsgs("#add_producttypeform",response);
				}
			},
			error:function(){
				ajaxindicatorstop();
			}
		});
	});

	$(".search_type").on("click",function($this){

		var id =  $(this).closest('tr').find('.search_type').attr("for");

		var csrfName =  $(this).closest('tr').find('.search_type').attr('data-csrf_token_name');
		var csrfHash =  $(this).closest('tr').find('.search_type').attr('data-csrf_token_hash');
		
		$.ajax({
			url:base_url+'producttype/update_producttype/'+id,
			type:'POST',
			data:csrfName+'='+csrfHash,
			dataType:"JSON",
			beforeSend:function()
			{
				ajaxindicatorstart("Please wait.",base_url);
			},
			success:function(response)
			{
				ajaxindicatorstop();
				if(response.result=='success')
				{
					$('#update_type').modal('show'); 
					$("#p_id").val(response.t_id);
					$("#p_type").val(response.t_name);
					$("#p_desc").val(response.t_desc);
					$("#p_status").val(response.t_status);

				}
				else if(response.result=='fail'){

					ajaxindicatorstop();
					alert("No records Found !!!");
				}
			},
			error:function(){
				ajaxindicatorstop();
			}
		});        
	});

	$(".add_followup").on("click",function($this){

		var id =  $(this).closest('tr').find('.add_followup').attr("for");

		var csrfName =  $(this).closest('tr').find('.add_followup').attr('data-csrf_token_name');
		var csrfHash =  $(this).closest('tr').find('.add_followup').attr('data-csrf_token_hash');
		
		$.ajax({
			url:base_url+'inquiry/update_followup/'+id,
			type:'POST',
			data:csrfName+'='+csrfHash,
			dataType:"JSON",
			beforeSend:function()
			{
				ajaxindicatorstart("Please wait.",base_url);
			},
			success:function(response)
			{
				ajaxindicatorstop();
				if(response.result=='success')
				{
					$('#add_followups').modal('show'); 
					$("#inq_id").val(response.inq_id);
					$("#inqdate").val(response.inq_fdate);

				}
				else if(response.result=='fail'){

					ajaxindicatorstop();
					alert("No records Found !!!");
				}
			},
			error:function(){
				ajaxindicatorstop();
			}
		});        
	});

	$("#addfollowup").on("click",function(e){
		e.preventDefault();
		id = $("#inq_id").val();
		formdata = $("#add_followform").serializeArray();
		formdata.push({name:'isAjax',value:1});
		$.ajax({
			url:base_url+'inquiry/update_followup/'+id,
			type:'POST',
			data:formdata,
			dataType:"JSON",
			beforeSend:function(){
				ajaxindicatorstart("Please wait.",base_url);
			},
			success:function(response)
			{
				ajaxindicatorstop();
				if(response == 1)
				{
					$("#add_followform")[0].reset();
					window.location.href = base_url+$("#redirect").val();
				}
				else if(response == 2)
				{
					$("#add_followform")[0].reset();
					$("#form_success").css("display","none");
					$("#form_error").css("display","block");
					$(".error_msg").html("Something wrong, please check again.");
				}
				else if(response == 3)
				{
					window.location.href = base_url+'expensetype';
				}
				else
				{
					appendMsgs("#add_followform",response);
				}
			},
			error:function(){
				ajaxindicatorstop();
			}
		});
	});

	$(".update_site").on("click",function($this){

		var id =  $(this).closest('tr').find('.update_site').attr("for");

		var csrfName =  $(this).closest('tr').find('.update_site').attr('data-csrf_token_name');
		var csrfHash =  $(this).closest('tr').find('.update_site').attr('data-csrf_token_hash');
		
		$.ajax({
			url:base_url+'inquiry/update_sitedate/'+id,
			type:'POST',
			data:csrfName+'='+csrfHash,
			dataType:"JSON",
			beforeSend:function()
			{
				ajaxindicatorstart("Please wait.",base_url);
			},
			success:function(response)
			{
				ajaxindicatorstop();
				if(response.result=='success')
				{
					$('#update_sitevisit').modal('show'); 
					$("#inquiry_id").val(response.inq_id);
					$("#sitedate").val(response.inq_sdate);

				}
				else if(response.result=='fail'){

					ajaxindicatorstop();
					alert("No records Found !!!");
				}
			},
			error:function(){
				ajaxindicatorstop();
			}
		});        
	});

	$(".leadstatus").on("click",function($this){

		var id =  $(this).closest('tr').find('.leadstatus').attr("for");

		var csrfName =  $(this).closest('tr').find('.leadstatus').attr('data-csrf_token_name');
		var csrfHash =  $(this).closest('tr').find('.leadstatus').attr('data-csrf_token_hash');
		
		$.ajax({
			url:base_url+'inquiry/update_leadstatus/'+id,
			type:'POST',
			data:csrfName+'='+csrfHash,
			dataType:"JSON",
			beforeSend:function()
			{
				ajaxindicatorstart("Please wait.",base_url);
			},
			success:function(response)
			{
				ajaxindicatorstop();
				if(response.result=='success')
				{
					$('#lead_status').modal('show');
					$("#leads").val(response.lead_status);

				}
				else if(response.result=='fail'){

					ajaxindicatorstop();
					alert("No records Found !!!");
				}
			},
			error:function(){
				ajaxindicatorstop();
			}
		});        
	});

	$("#leadstatus").on("click",function(e){
		e.preventDefault();
		id = $("#inq").val();
		formdata = $("#update_leadstatus").serializeArray();
		formdata.push({name:'isAjax',value:1});
		$.ajax({
			url:base_url+'inquiry/update_leadstatus/'+id,
			type:'POST',
			data:formdata,
			dataType:"JSON",
			beforeSend:function(){
				ajaxindicatorstart("Please wait.",base_url);
			},
			success:function(response)
			{
				ajaxindicatorstop();
				if(response == 1)
				{
					$("#update_leadstatus")[0].reset();
					window.location.href = base_url+$("#redirect").val();
				}
				else if(response == 2)
				{
					$("#update_leadstatus")[0].reset();
					$("#form_success").css("display","none");
					$("#form_error").css("display","block");
					$(".error_msg").html("Something wrong, please check again.");
				}
				else if(response == 3)
				{
					window.location.href = base_url+'admin/dashboard';
				}
				else
				{
					appendMsgs("#update_leadstatus",response);
				}
			},
			error:function(){
				ajaxindicatorstop();
			}
		});
	});


	$("#sitevisitdate").on("click",function(e){
		e.preventDefault();
		id = $("#inquiry_id").val();
		formdata = $("#add_sitedateform").serializeArray();
		formdata.push({name:'isAjax',value:1});
		$.ajax({
			url:base_url+'inquiry/update_sitedate/'+id,
			type:'POST',
			data:formdata,
			dataType:"JSON",
			beforeSend:function(){
				ajaxindicatorstart("Please wait.",base_url);
			},
			success:function(response)
			{
				ajaxindicatorstop();
				if(response == 1)
				{
					$("#add_sitedateform")[0].reset();
					window.location.href = base_url+$("#redirect").val();
				}
				else if(response == 2)
				{
					$("#add_sitedateform")[0].reset();
					$("#form_success").css("display","none");
					$("#form_error").css("display","block");
					$(".error_msg").html("Something wrong, please check again.");
				}
				else if(response == 3)
				{
					window.location.href = base_url+'admin/dashboard';
				}
				else
				{
					appendMsgs("#add_sitedateform",response);
				}
			},
			error:function(){
				ajaxindicatorstop();
			}
		});
	});

	$("#updateproducttype").on("click",function(e){
		e.preventDefault();
		id = $("#p_id").val();
		formdata = $("#update_producttypeform").serializeArray();
		formdata.push({name:'isAjax',value:1});
		$.ajax({
			url:$('#update_producttypeform').attr('action')+'/update_producttype/'+id,
			type:'POST',
			data:formdata,
			dataType:"JSON",
			beforeSend:function(){
				ajaxindicatorstart("Please wait.",base_url);
			},
			success:function(response)
			{
				ajaxindicatorstop();
				if(response == 1)
				{
					$("#update_producttypeform")[0].reset();
					window.location.href = base_url+'producttype';
				}
				else if(response == 2)
				{
					$("#update_producttypeform")[0].reset();
					$("#form_success").css("display","none");
					$("#form_error").css("display","block");
					$(".error_msg").html("Something wrong, please check again.");
				}
				else if(response == 3)
				{
					window.location.href = base_url+'producttype';
				}
				else
				{
					appendMsgs("#update_producttypeform",response);
				}
			},
			error:function(){
				ajaxindicatorstop();
			}
		});
	});

	$("#billing").on("click",function(e){
		e.preventDefault();
		formdata = $("#add_billingform").serializeArray();
		formdata.push({name:'isAjax',value:1});

		$.ajax({
			url:$('#add_billingform').attr('action'),
			type:'POST',
			data:formdata,
			dataType:"JSON",
			beforeSend:function(){
				ajaxindicatorstart("Please wait.",base_url);
			},
			success:function(response)
			{
				ajaxindicatorstop();
				if(response == 1)
				{
					$("#add_billingform")[0].reset();
					window.location.href = base_url+'inventory/';
				}
				else if(response == 2)
				{
					$("#add_billingform")[0].reset();
					$("#form_success").css("display","none");
					$("#form_error").css("display","block");
					$(".error_msg").html("Something wrong, please check again.");
				}
				else if(response == 3)
				{
					window.location.href = base_url+'billing';
				}
				else
				{
					appendMsgs("#add_billingform",response);
				}
			},
			error:function(){
				ajaxindicatorstop();
			}
		});
	});

	$("#customer").on("click",function(e){
		e.preventDefault();
		formdata = $("#add_customerform").serializeArray();
		formdata.push({name:'isAjax',value:1});
		$.ajax({
			url:base_url+'billing/add_customer',
			type:'POST',
			data:formdata,
			dataType:"JSON",
			beforeSend:function(){
				ajaxindicatorstart("Please wait.",base_url);
			},
			success:function(response)
			{
				ajaxindicatorstop();
				if(response == 1)
				{
					$("#add_customerform")[0].reset();
					window.location.href = base_url+'billing/add_bill';
				}
				else if(response == 2)
				{
					$("#add_customerform")[0].reset();
					$("#form_success").css("display","none");
					$("#form_error").css("display","block");
					$(".error_msg").html("Something wrong, please check again.");
				}
				else if(response == 3)
				{
					window.location.href = base_url+'billing';
				}
				else
				{
					alert(response);
					appendMsgs("#add_customerform",response);
				}
			},
			error:function(){
				ajaxindicatorstop();
			}
		});
	});

	//Expense Type
	
	$("#expensetype").on("click",function(e){
		e.preventDefault();
		formdata = $("#add_expenseform").serializeArray();
		formdata.push({name:'isAjax',value:1});
		$.ajax({
			url:$('#add_expenseform').attr('action')+'/add_expensetype',
			type:'POST',
			data:formdata,
			dataType:"JSON",
			beforeSend:function(){
				ajaxindicatorstart("Please wait.",base_url);
			},
			success:function(response)
			{
				ajaxindicatorstop();
				if(response == 1)
				{
					$("#add_expenseform")[0].reset();
					window.location.href = base_url+'expensetype';
				}
				else if(response == 2)
				{
					$("#add_expenseform")[0].reset();
					$("#form_success").css("display","none");
					$("#form_error").css("display","block");
					$(".error_msg").html("Something wrong, please check again.");
				}
				else if(response == 3)
				{
					window.location.href = base_url+'expensetype';
				}
				else
				{
					appendMsgs("#add_expenseform",response);
				}
			},
			error:function(){
				ajaxindicatorstop();
			}
		});
	});

	$(".search_expensetype").on("click",function($this){

		var id =  $(this).closest('tr').find('.search_expensetype').attr("for");

		var csrfName =  $(this).closest('tr').find('.search_expensetype').attr('data-csrf_token_name');
		var csrfHash =  $(this).closest('tr').find('.search_expensetype').attr('data-csrf_token_hash');
		
		$.ajax({
			url:base_url+'expensetype/update_expensetype/'+id,
			type:'POST',
			data:csrfName+'='+csrfHash,
			dataType:"JSON",
			beforeSend:function()
			{
				ajaxindicatorstart("Please wait.",base_url);
			},
			success:function(response)
			{
				ajaxindicatorstop();
				if(response.result=='success')
				{
					$('#update_expensetype').modal('show'); 
					$("#ex_id").val(response.ex_id);
					$("#u_expense").val(response.ex_type);
					$("#u_desc").val(response.ex_desc);
					$("#u_status").val(response.ex_status);

				}
				else if(response.result=='fail'){

					ajaxindicatorstop();
					alert("No records Found !!!");
				}
			},
			error:function(){
				ajaxindicatorstop();
			}
		});        
 	});

	$("#update_expense").on("click",function(e){
		e.preventDefault();
		id = $("#ex_id").val();
		formdata = $("#update_expenseform").serializeArray();
		formdata.push({name:'isAjax',value:1});
		$.ajax({
			url:$('#update_expenseform').attr('action')+'/update_expensetype/'+id,
			type:'POST',
			data:formdata,
			dataType:"JSON",
			beforeSend:function(){
				ajaxindicatorstart("Please wait.",base_url);
			},
			success:function(response)
			{
				ajaxindicatorstop();
				if(response == 1)
				{
					$("#update_expenseform")[0].reset();
					window.location.href = base_url+'expensetype';
				}
				else if(response == 2)
				{
					$("#update_expenseform")[0].reset();
					$("#form_success").css("display","none");
					$("#form_error").css("display","block");
					$(".error_msg").html("Something wrong, please check again.");
				}
				else if(response == 3)
				{
					window.location.href = base_url+'expensetype';
				}
				else
				{
					appendMsgs("#update_expenseform",response);
				}
			},
			error:function(){
				ajaxindicatorstop();
			}
		});
	});
	//supervisor

	$("#add_supervisors").on("click",function(e){
		e.preventDefault();
		formdata = $("#add_supervisorform").serializeArray();
		formdata.push({name:'isAjax',value:1});
		$.ajax({
			url:$('#add_supervisorform').attr('action')+'/add_supervisor',
			type:'POST',
			data:formdata,
			dataType:"JSON",
			beforeSend:function(){
				ajaxindicatorstart("Please wait.",base_url);
			},
			success:function(response)
			{
				ajaxindicatorstop();
				if(response == 1)
				{
					$("#add_supervisorform")[0].reset();
					window.location.href = base_url+'supervisormanagement';
				}
				else if(response == 2)
				{
					$("#add_supervisorform")[0].reset();
					$("#form_success").css("display","none");
					$("#form_error").css("display","block");
					$(".error_msg").html("Something wrong, please check again.");
				}
				else if(response == 3)
				{
					window.location.href = base_url+'supervisormanagement';
				}
				else
				{
					appendMsgs("#add_supervisorform",response);
				}
			},
			error:function(){
				ajaxindicatorstop();
			}
		});
	});

	$(".search_supervisor").on("click",function($this){

		var id =  $(this).closest('tr').find('.search_supervisor').attr("for");

		var csrfName =  $(this).closest('tr').find('.search_supervisor').attr('data-csrf_token_name');
		var csrfHash =  $(this).closest('tr').find('.search_supervisor').attr('data-csrf_token_hash');
		
		$.ajax({
			url:base_url+'supervisormanagement/update_supervisor/'+id,
			type:'POST',
			data:csrfName+'='+csrfHash,
			dataType:"JSON",
			beforeSend:function()
			{
			  ajaxindicatorstart("Please wait.",base_url);
			},
			success:function(response)
			{
			  ajaxindicatorstop();
			  if(response.result=='success')
			  {
				 $('#update_supervisor').modal('show'); 
				 $("#sup_id").val(response.sup_id);
				 $("#supname").val(response.sup_name);
				 $("#supaddress").val(response.sup_address);
				 $("#supmobile").val(response.sup_mobile);
				 $("#supalt").val(response.sup_alt);
				 $("#supemail").val(response.sup_email);
				 $("#supstatus").val(response.sup_status);
			  }
			  else if(response.result=='fail'){

				 ajaxindicatorstop();
				 alert("No records Found !!!");
			  }
			},
			error:function(){
			  ajaxindicatorstop();
			}
		});        
	});

	$("#update_supervisors").on("click",function(e){
		e.preventDefault();
		id = $("#sup_id").val();
		formdata = $("#update_supervisorform").serializeArray();
		formdata.push({name:'isAjax',value:1});
		$.ajax({
			url:$('#update_supervisorform').attr('action')+'/update_supervisor/'+id,
			type:'POST',
			data:formdata,
			dataType:"JSON",
			beforeSend:function(){
				ajaxindicatorstart("Please wait.",base_url);
			},
			success:function(response)
			{
				ajaxindicatorstop();
				if(response == 1)
				{
					$("#update_supervisorform")[0].reset();
					window.location.href = base_url+'supervisormanagement';
				}
				else if(response == 2)
				{
					$("#update_supervisorform")[0].reset();
					$("#form_success").css("display","none");
					$("#form_error").css("display","block");
					$(".error_msg").html("Something wrong, please check again.");
				}
				else if(response == 3)
				{
					window.location.href = base_url+'supervisormanagement';
				}
				else
				{
					appendMsgs("#update_supervisorform",response);
				}
			},
			error:function(){
				ajaxindicatorstop();
			}
		});
	});

	$("#add_staff").on("click",function(e){
		e.preventDefault();
		formdata = $("#add_staffform").serializeArray();
		formdata.push({name:'isAjax',value:1});
		$.ajax({
			url:$('#add_staffform').attr('action')+'/add_staff',
			type:'POST',
			data:formdata,
			dataType:"JSON",
			beforeSend:function(){
				ajaxindicatorstart("Please wait.",base_url);
			},
			success:function(response)
			{
				ajaxindicatorstop();
				if(response == 1)
				{
					$("#add_staffform")[0].reset();
					window.location.href = base_url+'staffmanagement';
				}
				else if(response == 2)
				{
					$("#add_staffform")[0].reset();
					$("#form_success").css("display","none");
					$("#form_error").css("display","block");
					$(".error_msg").html("Something wrong, please check again.");
				}
				else if(response == 3)
				{
					window.location.href = base_url+'staffmanagement';
				}
				else
				{
					appendMsgs("#add_staffform",response);
				}
			},
			error:function(){
				ajaxindicatorstop();
			}
		});
	});

	$(".search_staff").on("click",function($this){

		var id =  $(this).closest('tr').find('.search_staff').attr("for");

		var csrfName =  $(this).closest('tr').find('.search_staff').attr('data-csrf_token_name');
		var csrfHash =  $(this).closest('tr').find('.search_staff').attr('data-csrf_token_hash');
		
		$.ajax({
		   url:base_url+'staffmanagement/update_staff/'+id,
		   type:'POST',
		   data:csrfName+'='+csrfHash,
		   dataType:"JSON",
		   beforeSend:function()
		   {
			  ajaxindicatorstart("Please wait.",base_url);
		   },
		   success:function(response)
		   {
			  ajaxindicatorstop();
			  if(response.result=='success')
			  {
				 $('#update_staffmodal').modal('show'); 
				 $("#s_id").val(response.s_id);
				 $("#sname").val(response.s_name);
				 $("#saddress").val(response.s_address);
				 $("#smobile").val(response.s_mobile);
				 $("#salt").val(response.s_alt);
				 $("#email").val(response.s_email);
				 $("#status").val(response.s_status);
			  }
			  else if(response.result=='fail'){

				 ajaxindicatorstop();
				 alert("No records Found !!!");
			  }
		   },
		   error:function(){
			  ajaxindicatorstop();
		   }
		});        
   });

   	$("#update_staffManagement").on("click",function(e){
		e.preventDefault();
		id = $("#s_id").val();
		formdata = $("#update_staffform").serializeArray();
		formdata.push({name:'isAjax',value:1});
		$.ajax({
			url:$('#update_staffform').attr('action')+'/update_staff/'+id,
			type:'POST',
			data:formdata,
			dataType:"JSON",
			beforeSend:function(){
				ajaxindicatorstart("Please wait.",base_url);
			},
			success:function(response)
			{
				ajaxindicatorstop();
				if(response == 1)
				{
					$("#update_staffform")[0].reset();
					window.location.href = base_url+'staffmanagement';
				}
				else if(response == 2)
				{
					$("#update_staffform")[0].reset();
					$("#form_success").css("display","none");
					$("#form_error").css("display","block");
					$(".error_msg").html("Something wrong, please check again.");
				}
				else if(response == 3)
				{
					window.location.href = base_url+'staffmanagement';
				}
				else
				{
					appendMsgs("#update_staffform",response);
				}
			},
			error:function(){
				ajaxindicatorstop();
			}
		});
	});


	$("#addpurchase").on("click",function(e){
		e.preventDefault();
		formdata = $("#add_purchaseform").serializeArray();
		formdata.push({name:'isAjax',value:1});

		$.ajax({
			url:$('#add_purchaseform').attr('action'),
			type:'POST',
			data:formdata,
			dataType:"JSON",
			beforeSend:function(){
				ajaxindicatorstart("Please wait.",base_url);
			},
			success:function(response)
			{
				ajaxindicatorstop();
				if(response.res == true)
				{
					$("#add_purchaseform")[0].reset();
					window.location.href = base_url+'purchase/purchasedetail/'+response.id;
				}
				else if(response == 2)
				{
					$("#add_purchaseform")[0].reset();
					$("#form_success").css("display","none");
					$("#form_error").css("display","block");
					$(".error_msg").html("Something wrong, please check again.");
				}
				else if(response == 3)
				{
					window.location.href = base_url+'purchase';
				}
				else
				{
					appendMsgs("#add_purchaseform",response);
				}
			},
			error:function(){
				ajaxindicatorstop();
			}
		});
	});

	$("#updatepurchase").on("click",function(e){
		e.preventDefault();
		id = $("#purchase_id").val();
		formdata = $("#update_purchaseform").serializeArray();
		formdata.push({name:'isAjax',value:1});
		$.ajax({
			url:$('#update_purchaseform').attr('action')+'/update_purchase/'+id,
			type:'POST',
			data:formdata,
			dataType:"JSON",
			beforeSend:function(){
				ajaxindicatorstart("Please wait.",base_url);
			},
			success:function(response)
			{
				ajaxindicatorstop();
				if(response == 1)
				{
					$("#update_purchaseform")[0].reset();
					window.location.href = base_url+'purchase';
				}
				else if(response == 2)
				{
					$("#update_purchaseform")[0].reset();
					$("#form_success").css("display","none");
					$("#form_error").css("display","block");
					$(".error_msg").html("Something wrong, please check again.");
				}
				else if(response == 3)
				{
					window.location.href = base_url+'purchase';
				}
				else
				{
					appendMsgs("#update_purchaseform",response);
				}
			},
			error:function(){
				ajaxindicatorstop();
			}
		});
	});

	$("#addpurchasedetail").on("click",function(e){
		e.preventDefault();
		id = $("#sp_id").val();
		formdata = $("#add_purchasedetailform	").serializeArray();

		formdata.push({name:'isAjax',value:1});
		$.ajax({
			url:$('#add_purchasedetailform').attr('action'),
			type:'POST',
			data:formdata,
			dataType:"JSON",
			beforeSend:function(){
				ajaxindicatorstart("Please wait.",base_url);
			},
			success:function(response)
			{
				ajaxindicatorstop();
				if(response == 1)
				{
					$("#add_purchasedetailform	")[0].reset();
					window.location.href = base_url+'purchase/purchasedetail/'+id;
				}
				else if(response == 2)
				{
					$("#add_purchasedetailform")[0].reset();
					$("#form_success").css("display","none");
					$("#form_error").css("display","block");
					$(".error_msg").html("Something wrong, please check again.");
				}
				else if(response == 3)
				{
					window.location.href = base_url+'purchase';
				}
				else
				{
					appendMsgs("#spcontactform",response);
				}
			},
			error:function(){
				ajaxindicatorstop();
			}
		});
	});

	$("#updatepurchasedetail").on("click",function(e){
		e.preventDefault();
		id = $("#purchase_id").val();
		formdata = $("#update_purchasedetailform	").serializeArray();

		formdata.push({name:'isAjax',value:1});
		$.ajax({
			url:$('#update_purchasedetailform	').attr('action'),
			type:'POST',
			data:formdata,
			dataType:"JSON",
			beforeSend:function(){
				ajaxindicatorstart("Please wait.",base_url);
			},
			success:function(response)
			{
				ajaxindicatorstop();
				if(response == 1)
				{
					$("#update_purchasedetailform	")[0].reset();
					window.location.href = base_url+'purchase/purchasedetail/'+id;
				}
				else if(response == 2)
				{
					$("#update_purchasedetailform")[0].reset();
					$("#form_success").css("display","none");
					$("#form_error").css("display","block");
					$(".error_msg").html("Something wrong, please check again.");
				}
				else if(response == 3)
				{
					alert(123);
					window.location.href = base_url+'purchase';
				}
				else
				{
					appendMsgs("#spcontactform",response);
				}
			},
			error:function(){
				ajaxindicatorstop();
			}
		});
	});

	$("#add_supplier").on("click",function(e){
		e.preventDefault();
		formdata = $("#add_supplierform").serializeArray();
		formdata.push({name:'isAjax',value:1});

		$.ajax({
			url:$('#add_supplierform').attr('action')+'/add_supplier',
			type:'POST',
			data:formdata,
			dataType:"JSON",
			beforeSend:function(){
				ajaxindicatorstart("Please wait.",base_url);
			},
			success:function(response)
			{
				ajaxindicatorstop();
				if(response == 1)
				{
					$("#add_supplierform")[0].reset();
					window.location.href = base_url+'supplier';
				}
				else if(response == 2)
				{
					$("#add_supplierform")[0].reset();
					$("#form_success").css("display","none");
					$("#form_error").css("display","block");
					$(".error_msg").html("Something wrong, please check again.");
				}
				else if(response == 3)
				{
					window.location.href = base_url+'supplier';
				}
				else
				{
					appendMsgs("#add_supplierform",response);
				}
			},
			error:function(){
				ajaxindicatorstop();
			}
		});
	});

	$("#update_supplier").on("click",function(e){
		e.preventDefault();
		id = $("#sp_id").val();
		formdata = $("#update_supplierform").serializeArray();
		formdata.push({name:'isAjax',value:1});
		$.ajax({
			url:$('#update_supplierform').attr('action')+'/update_supplier/'+id,
			type:'POST',
			data:formdata,
			dataType:"JSON",
			beforeSend:function(){
				ajaxindicatorstart("Please wait.",base_url);
			},
			success:function(response)
			{
				ajaxindicatorstop();
				if(response == 1)
				{
					$("#update_supplierform")[0].reset();
					window.location.href = base_url+'supplier';
				}
				else if(response == 2)
				{
					$("#update_supplierform")[0].reset();
					$("#form_success").css("display","none");
					$("#form_error").css("display","block");
					$(".error_msg").html("Something wrong, please check again.");
				}
				else if(response == 3)
				{
					window.location.href = base_url+'supplier';
				}
				else
				{
					appendMsgs("#update_supplierform",response);
				}
			},
			error:function(){
				ajaxindicatorstop();
			}
		});
	});


	$(".search_productsuppliers").on("click",function($this){

		var id =  $(this).closest('tr').find('.search_productsuppliers').attr("for");
		var csrfName =  $(this).closest('tr').find('.search_productsuppliers').attr('data-csrf_token_name');
		var csrfHash =  $(this).closest('tr').find('.search_productsuppliers').attr('data-csrf_token_hash');

		$.ajax({
			url:base_url+'supplier/update_productSupply/'+id,
			type:'POST',
			data:csrfName+'='+csrfHash,
			dataType:"JSON",
			beforeSend:function()
			{
				ajaxindicatorstart("Please wait.",base_url);
			},
			success:function(response)
			{
				ajaxindicatorstop();
				if(response.result=='success')
				{
					$('#update_productsupplier').modal('show');
					$("#us_id").val(response.s_id);
					$("#ps_id").val(response.ps_id);
					$("#product").val(response.p_id);
					$("#ustatus").val(response.ps_status);

				}
				else if(response.result=='fail'){

					ajaxindicatorstop();
					alert("No records Found !!!");
				}
			},
			error:function(){
				ajaxindicatorstop();
			}
		});
	});
	
	$("#suppliercontacts").on("click",function(e){
		e.preventDefault();
		var id = $("#s_id").val();
		// alert(id);
		formdata = $("#add_suppliercontactform").serializeArray();
		formdata.push({name:'isAjax',value:1});
		$.ajax({
			url:base_url+'supplier/add_suppliercontact/'+ id,
			type:'POST',
			data:formdata,
			dataType:"JSON",
			beforeSend:function(){
				ajaxindicatorstart("Please wait.",base_url);
			},
			success:function(response)
			{
				ajaxindicatorstop();
				if(response == 1)
				{
					$("#add_suppliercontactform")[0].reset();
					window.location.href = base_url+'supplier/suppliercontact/'+id;
				}
				else if(response == 2)
				{
					$("#add_suppliercontactform")[0].reset();
					$("#form_success").css("display","none");
					$("#form_error").css("display","block");
					$(".error_msg").html("Something wrong, please check again.");
				}
				else if(response == 3)
				{
					window.location.href = base_url+'supplier';
				}
				else
				{
					appendMsgs("#add_suppliercontactform",response);
				}
			},
			error:function(){
				ajaxindicatorstop();
			}
		});
	});

	$(".search_supliercontact").on("click",function($this){

		var id =  $(this).closest('tr').find('.search_supliercontact').attr("for");
		var csrfName =  $(this).closest('tr').find('.search_supliercontact').attr('data-csrf_token_name');
		var csrfHash =  $(this).closest('tr').find('.search_supliercontact').attr('data-csrf_token_hash');

		$.ajax({
			url:base_url+'supplier/update_suppliercontact/'+id,
			type:'POST',
			data:csrfName+'='+csrfHash,
			dataType:"JSON",
			beforeSend:function()
			{
				ajaxindicatorstart("Please wait.",base_url);
			},
			success:function(response)
			{
				ajaxindicatorstop();
				if(response.result=='success')
				{
					$('#update_suppliercontact').modal('show');
					$("#us_id").val(response.s_id);
					$("#sc_id").val(response.sc_id);
					$("#uname").val(response.sc_name);
					$("#umobile").val(response.sc_mobile);
					$("#udesignation").val(response.sc_designation);
					$("#uemail").val(response.sc_email);
					$("#ustatus").val(response.sc_status);

				}
				else if(response.result=='fail'){

					ajaxindicatorstop();
					alert("No records Found !!!");
				}
			},
			error:function(){
				ajaxindicatorstop();
			}
		});
	});

	$("#updatesuppliercontact").on("click",function(e){
		e.preventDefault();
		id = $("#sc_id").val();
		s_id = $("#us_id").val();
		formdata = $("#update_suppliercontactform").serializeArray();
		formdata.push({name:'isAjax',value:1});
		$.ajax({
			url:base_url+'supplier/update_suppliercontact/'+id,
			type:'POST',
			data:formdata,
			dataType:"JSON",
			beforeSend:function(){
				ajaxindicatorstart("Please wait.",base_url);
			},
			success:function(response)
			{
				ajaxindicatorstop();
				if(response == 1)
				{
					$("#update_suppliercontactform")[0].reset();
					window.location.href = base_url+'supplier/suppliercontact/'+s_id;
				}
				else if(response == 2)
				{
					$("#update_suppliercontactform")[0].reset();
					$("#form_success").css("display","none");
					$("#form_error").css("display","block");
					$(".error_msg").html("Something wrong, please check again.");
				}
				else if(response == 3)
				{
					window.location.href = base_url+'vendor';
				}
				else
				{
					appendMsgs("#update_suppliercontactform",response);
				}
			},
			error:function(){
				ajaxindicatorstop();
			}
		});
	});

	$("#productsupply").on("click",function(e){
		e.preventDefault();
		var id = $("#s_id").val();
		// alert(id);
		formdata = $("#add_productsupplyform").serializeArray();
		formdata.push({name:'isAjax',value:1});
		$.ajax({
			url:base_url+'supplier/add_productSupply/'+ id,
			type:'POST',
			data:formdata,
			dataType:"JSON",
			beforeSend:function(){
				ajaxindicatorstart("Please wait.",base_url);
			},
			success:function(response)
			{
				ajaxindicatorstop();
				if(response == 1)
				{
					$("#add_productsupplyform")[0].reset();
					window.location.href = base_url+'supplier/productsupplierlist/'+id;
				}
				else if(response == 2)
				{
					$("#add_productsupplyform")[0].reset();
					$("#form_success").css("display","none");
					$("#form_error").css("display","block");
					$(".error_msg").html("Something wrong, please check again.");
				}
				else if(response == 3)
				{
					window.location.href = base_url+'supplier';
				}
				else
				{
					appendMsgs("#add_productsupplyform",response);
				}
			},
			error:function(){
				ajaxindicatorstop();
			}
		});
	});

	$("#updateproductsupplier").on("click",function(e){
		e.preventDefault();
		id = $("#ps_id").val();
		s_id = $("#us_id").val();
		formdata = $("#update_productsupplierform").serializeArray();
		formdata.push({name:'isAjax',value:1});
		$.ajax({
			url:base_url+'supplier/update_productSupply/'+id,
			type:'POST',
			data:formdata,
			dataType:"JSON",
			beforeSend:function(){
				ajaxindicatorstart("Please wait.",base_url);
			},
			success:function(response)
			{
				ajaxindicatorstop();
				if(response == 1)
				{
					$("#update_productsupplierform")[0].reset();
					window.location.href = base_url+'supplier/productsupplierlist/'+s_id;
				}
				else if(response == 2)
				{
					$("#update_productsupplierform")[0].reset();
					$("#form_success").css("display","none");
					$("#form_error").css("display","block");
					$(".error_msg").html("Something wrong, please check again.");
				}
				else if(response == 3)
				{
					window.location.href = base_url+'vendor';
				}
				else
				{
					appendMsgs("#update_productsupplierform",response);
				}
			},
			error:function(){
				ajaxindicatorstop();
			}
		});
	});



	//client section
	//<--------------------------------------------------------------------------------------------------------------->//
	$("#add_client").on("click",function(e){
		e.preventDefault();
		formdata = $("#add_clientform").serializeArray();
		formdata.push({name:'isAjax',value:1});

		$.ajax({
			url:$('#add_clientform').attr('action')+'/add_client',
			type:'POST',
			data:formdata,
			dataType:"JSON",
			beforeSend:function(){
				ajaxindicatorstart("Please wait.",base_url);
			},
			success:function(response)
			{
				ajaxindicatorstop();
				if(response == 1)
				{
					$("#add_clientform")[0].reset();
					window.location.href = base_url+'clientmanagement';
				}
				else if(response == 2)
				{
					$("#add_clientform")[0].reset();
					$("#form_success").css("display","none");
					$("#form_error").css("display","block");
					$(".error_msg").html("Something wrong, please check again.");
				}
				else if(response == 3)
				{
					window.location.href = base_url+'clientmanagement';
				}
				else
				{
					appendMsgs("#add_clientform",response);
				}
			},
			error:function(){
				ajaxindicatorstop();
			}
		});
	});

	$("#update_client").on("click",function(e){
		e.preventDefault();
		id = $("#client_id").val();
		formdata = $("#update_clientform").serializeArray();
		formdata.push({name:'isAjax',value:1});
		$.ajax({
			url:$('#update_clientform').attr('action')+'/update_client/'+id,
			type:'POST',
			data:formdata,
			dataType:"JSON",
			beforeSend:function(){
				ajaxindicatorstart("Please wait.",base_url);
			},
			success:function(response)
			{
				ajaxindicatorstop();
				if(response == 1)
				{
					$("#update_clientform")[0].reset();
					window.location.href = base_url+'clientmanagement';
				}
				else if(response == 2)
				{
					$("#update_clientform")[0].reset();
					$("#form_success").css("display","none");
					$("#form_error").css("display","block");
					$(".error_msg").html("Something wrong, please check again.");
				}
				else if(response == 3)
				{
					window.location.href = base_url+'clientmanagement';
				}
				else
				{
					appendMsgs("#update_clientform",response);
				}
			},
			error:function(){
				ajaxindicatorstop();
			}
		});
	});

	//site

	$("#addsite").on("click",function(e){
		e.preventDefault();
		var id = $("#c_id").val();
		formdata = $("#add_siteform").serializeArray();
		formdata.push({name:'isAjax',value:1});
		$.ajax({
			url:base_url+'clientmanagement/add_site/'+ id,
			type:'POST',
			data:formdata,
			dataType:"JSON",
			beforeSend:function(){
				ajaxindicatorstart("Please wait.",base_url);
			},
			success:function(response)
			{
				ajaxindicatorstop();
				if(response == 1)
				{
					$("#add_siteform")[0].reset();
					window.location.href = base_url+'clientmanagement/site/'+id;
				}
				else if(response == 2)
				{
					$("#add_siteform")[0].reset();
					$("#form_success").css("display","none");
					$("#form_error").css("display","block");
					$(".error_msg").html("Something wrong, please check again.");
				}
				else if(response == 3)
				{
					window.location.href = base_url+'clientmanagement';
				}
				else
				{
					appendMsgs("#add_siteform",response);
				}
			},
			error:function(){
				ajaxindicatorstop();
			}
		});
	});

	$("#updatesite").on("click",function(e){
		e.preventDefault();
		id = $("#c_id").val();
		sid = $("#ucs_id").val();
		formdata = $("#update_siteform").serializeArray();
		formdata.push({name:'isAjax',value:1});
		$.ajax({
			url:$('#update_siteform').attr('action')+'/update_site/'+id+sid,
			type:'POST',
			data:formdata,
			dataType:"JSON",
			beforeSend:function(){
				ajaxindicatorstart("Please wait.",base_url);
			},
			success:function(response)
			{
				ajaxindicatorstop();
				if(response == 1)
				{
					$("#update_siteform")[0].reset();
					window.location.href = base_url+'clientmanagement/site/'+id;
				}
				else if(response == 2)
				{
					$("#update_siteform")[0].reset();
					$("#form_success").css("display","none");
					$("#form_error").css("display","block");
					$(".error_msg").html("Something wrong, please check again.");
				}
				else if(response == 3)
				{
					window.location.href = base_url+'clientmanagement';
				}
				else
				{
					appendMsgs("#update_siteform",response);
				}
			},
			error:function(){
				ajaxindicatorstop();
			}
		});
	});

	/*clientcontact*/
	$("#clientcontact").on("click",function(e){
		e.preventDefault();
		var id = $("#c_id").val();
		formdata = $("#add_clientcontactform").serializeArray();
		formdata.push({name:'isAjax',value:1});
		$.ajax({
			url:base_url+'clientmanagement/add_clientcontact/'+ id,
			type:'POST',
			data:formdata,
			dataType:"JSON",
			beforeSend:function(){
				ajaxindicatorstart("Please wait.",base_url);
			},
			success:function(response)
			{
				ajaxindicatorstop();
				if(response == 1)
				{
					$("#add_clientcontactform")[0].reset();
					window.location.href = base_url+'clientmanagement/clientcontact/'+id;
				}
				else if(response == 2)
				{
					$("#add_clientcontactform")[0].reset();
					$("#form_success").css("display","none");
					$("#form_error").css("display","block");
					$(".error_msg").html("Something wrong, please check again.");
				}
				else if(response == 3)
				{
					window.location.href = base_url+'clientmanagement';
				}
				else
				{
					appendMsgs("#add_clientcontactform",response);
				}
			},
			error:function(){
				ajaxindicatorstop();
			}
		});
	});

	$(".search_clientcontact").on("click",function($this){
		
        var id =  $(this).closest('tr').find('.search_clientcontact').attr("for");
        var csrfName =  $(this).closest('tr').find('.search_clientcontact').attr('data-csrf_token_name');
        var csrfHash =  $(this).closest('tr').find('.search_clientcontact').attr('data-csrf_token_hash');
         
         $.ajax({
            url:base_url+'clientmanagement/update_clientcontact/'+id,
            type:'POST',
            data:csrfName+'='+csrfHash,
            dataType:"JSON",
            beforeSend:function()
            {
               ajaxindicatorstart("Please wait.",base_url);
            },
            success:function(response)
            {
               ajaxindicatorstop();
               if(response.result=='success')
               {
                  $('#update_clientcontact').modal('show'); 
						$("#ucc_id").val(response.cc_id);
                  $("#c_id").val(response.client_id);
                  $("#uccname").val(response.cc_name);
                  $("#uccmobile").val(response.cc_mobile);
                  $("#uccdesignation").val(response.cc_designation);
                  $("#uccemail").val(response.cc_email);
                  $("#uccstatus").val(response.cc_status);
 
               }
               else if(response.result=='fail'){

                  ajaxindicatorstop();
                  alert("No records Found !!!");
               }
            },
            error:function(){
               ajaxindicatorstop();
            }
         });        
    });

    $("#updateclientcontact").on("click",function(e){
		e.preventDefault();
		id = $("#c_id").val();
		formdata = $("#update_clientcontactform").serializeArray();
		formdata.push({name:'isAjax',value:1});
		$.ajax({
			url:base_url+'clientmanagement/update_clientcontact/'+id,
			type:'POST',
			data:formdata,
			dataType:"JSON",
			beforeSend:function(){
				ajaxindicatorstart("Please wait.",base_url);
			},
			success:function(response)
			{
				ajaxindicatorstop();
				if(response == 1)
				{
					$("#update_clientcontactform")[0].reset();
					window.location.href = base_url+'clientmanagement/clientcontact/'+id;
				}
				else if(response == 2)
				{
					$("#update_clientcontactform")[0].reset();
					$("#form_success").css("display","none");
					$("#form_error").css("display","block");
					$(".error_msg").html("Something wrong, please check again.");
				}
				else if(response == 3)
				{
					window.location.href = base_url+'clientmanagement';
				}
				else
				{
					appendMsgs("#update_clientcontactform",response);
				}
			},
			error:function(){
				ajaxindicatorstop();
			}
		});
	});
	/*client contact*/

	$("#addproduct").on("click",function(e){
		e.preventDefault();
		var form = $('#add_productform')[0];
		var data = new FormData(form);
		$.ajax({
			url:base_url+'products/add_products/',
			type:'POST',
			data:data,
			processData:false,
			cache:false,
			contentType:false,
			dataType:"JSON",
			beforeSend:function(){
				ajaxindicatorstart("Please wait.",base_url);
			},
			success:function(response)
			{
				ajaxindicatorstop();
				if(response == 1)
				{
					$("#add_productform")[0].reset();
					window.location.href = base_url+'products';
				}
				else if(response == 2)
				{
					$("#add_productform")[0].reset();
					$("#form_success").css("display","none");
					$("#form_error").css("display","block");
					$(".error_msg").html("Something wrong, please check again.");
				}
				else if(response == 3)
				{
					window.location.href = base_url+'products';
				}
				else
				{
					appendMsgs("#add_productform",response);
				}
			},
			error:function(){
				ajaxindicatorstop();
			}
		});
	});

	$("#updateproduct").on("click",function(e){
		e.preventDefault();
		var id = $("#p_id").val();
		var form = $('#update_productsform')[0];
		var data = new FormData(form);
		$.ajax({
			url:base_url+'products/update_products/'+ id,
			type:'POST',
			data:data,
			processData:false,
			cache:false,
			contentType:false,
			dataType:"JSON",
			beforeSend:function(){
				ajaxindicatorstart("Please wait.",base_url);
			},
			success:function(response)
			{
				ajaxindicatorstop();
				if(response == 1)
				{
					$("#update_productsform")[0].reset();
					window.location.href = base_url+'products';
				}
				else if(response == 2)
				{
					$("#update_productsform")[0].reset();
					$("#form_success").css("display","none");
					$("#form_error").css("display","block");
					$(".error_msg").html("Something wrong, please check again.");
				}
				else if(response == 3)
				{
					window.location.href = base_url+'products';
				}
				else
				{
					appendMsgs("#update_productsform",response);
				}
			},
			error:function(){
				ajaxindicatorstop();
			}
		});
	});

	$("#add_educationDetail").on("click",function(e){
		e.preventDefault();
		var id = $("#e_id").val();
		// alert(id);
		var form = $('#add_educationform')[0];
		var data = new FormData(form);
		$.ajax({
			url:base_url+'employee/add_educationdetail/'+ id,
			type:'POST',
			data:data,
			processData:false,
			cache:false,
			contentType:false,
			dataType:"JSON",
			beforeSend:function(){
				ajaxindicatorstart("Please wait.",base_url);
			},
			success:function(response)
			{
				ajaxindicatorstop();
				if(response == 1)
				{
					$("#add_educationform")[0].reset();
					window.location.href = base_url+'employee/educationdetail/'+id;
				}
				else if(response == 2)
				{
					$("#add_educationform")[0].reset();
					$("#form_success").css("display","none");
					$("#form_error").css("display","block");
					$(".error_msg").html("Something wrong, please check again.");
				}
				else if(response == 3)
				{
					window.location.href = base_url+'employee';
				}
				else
				{
					appendMsgs("#add_educationform",response);
				}
			},
			error:function(){
				ajaxindicatorstop();
			}
		});
	});

	$("#updateeducation").on("click",function(e){
		e.preventDefault();
		var id = $("#e_id").val();
		var id = $("#ed_id").val();
		// alert(id);
		var form = $('#update_educationform')[0];
		var data = new FormData(form);
		$.ajax({
			url:base_url+'employee/update_educationdetail/'+ id,
			type:'POST',
			data:data,
			processData:false,
			cache:false,
			contentType:false,
			dataType:"JSON",
			beforeSend:function(){
				ajaxindicatorstart("Please wait.",base_url);
			},
			success:function(response)
			{
				ajaxindicatorstop();
				if(response == 1)
				{
					$("#update_educationform")[0].reset();
					window.location.href = base_url+'employee/educationdetail/'+id;
				}
				else if(response == 2)
				{
					$("#update_educationform")[0].reset();
					$("#form_success").css("display","none");
					$("#form_error").css("display","block");
					$(".error_msg").html("Something wrong, please check again.");
				}
				else if(response == 3)
				{
					window.location.href = base_url+'employee';
				}
				else
				{
					appendMsgs("#update_educationform",response);
				}
			},
			error:function(){
				ajaxindicatorstop();
			}
		});
	});

	$("#add_documentDetail").on("click",function(e){
		e.preventDefault();
		var id = $("#e_id").val();
		// alert(id);
		var form = $('#add_documentsform')[0];
		var data = new FormData(form);
		$.ajax({
			url:base_url+'employee/add_documentdetail/'+ id,
			type:'POST',
			data:data,
			processData:false,
			cache:false,
			contentType:false,
			dataType:"JSON",
			beforeSend:function(){
				ajaxindicatorstart("Please wait.",base_url);
			},
			success:function(response)
			{
				ajaxindicatorstop();
				if(response == 1)
				{
					$("#add_documentsform")[0].reset();
					window.location.href = base_url+'employee/documentdetail/'+id;
				}
				else if(response == 2)
				{
					$("#add_documentsform")[0].reset();
					$("#form_success").css("display","none");
					$("#form_error").css("display","block");
					$(".error_msg").html("Something wrong, please check again.");
				}
				else if(response == 3)
				{
					window.location.href = base_url+'employee';
				}
				else
				{
					appendMsgs("#add_documentsform",response);
				}
			},
			error:function(){
				ajaxindicatorstop();
			}
		});
	});

	$("#updatedocument").on("click",function(e){
		e.preventDefault();
		var id = $("#e_id").val();
		var id = $("#dd_id").val();
		// alert(id);
		var form = $('#update_documentform')[0];
		var data = new FormData(form);
		$.ajax({
			url:base_url+'employee/update_documentdetail/'+ id,
			type:'POST',
			data:data,
			processData:false,
			cache:false,
			contentType:false,
			dataType:"JSON",
			beforeSend:function(){
				ajaxindicatorstart("Please wait.",base_url);
			},
			success:function(response)
			{
				ajaxindicatorstop();
				if(response == 1)
				{
					$("#update_documentform")[0].reset();
					window.location.href = base_url+'employee/documentdetail/'+id;
				}
				else if(response == 2)
				{
					$("#update_documentform")[0].reset();
					$("#form_success").css("display","none");
					$("#form_error").css("display","block");
					$(".error_msg").html("Something wrong, please check again.");
				}
				else if(response == 3)
				{
					window.location.href = base_url+'employee';
				}
				else
				{
					appendMsgs("#update_documentform",response);
				}
			},
			error:function(){
				ajaxindicatorstop();
			}
		});
	});

    //vendor section
	//<--------------------------------------------------------------------------------------------------------------->//

	$("#add_vendor").on("click",function(e){
		e.preventDefault();
		formdata = $("#add_vendorform").serializeArray();
		formdata.push({name:'isAjax',value:1});

		$.ajax({
			url:$('#add_vendorform').attr('action')+'/add_vendor',
			type:'POST',
			data:formdata,
			dataType:"JSON",
			beforeSend:function(){
				ajaxindicatorstart("Please wait.",base_url);
			},
			success:function(response)
			{
				ajaxindicatorstop();
				if(response == 1)
				{
					$("#add_vendorform")[0].reset();
					window.location.href = base_url+'vendor';
				}
				else if(response == 2)
				{
					$("#add_vendorform")[0].reset();
					$("#form_success").css("display","none");
					$("#form_error").css("display","block");
					$(".error_msg").html("Something wrong, please check again.");
				}
				else if(response == 3)
				{
					window.location.href = base_url+'vendor';
				}
				else
				{
					appendMsgs("#add_vendorform",response);
				}
			},
			error:function(){
				ajaxindicatorstop();
			}
		});
	});

	$("#update_vendor").on("click",function(e){
		e.preventDefault();
		id = $("#v_id").val();
		formdata = $("#update_vendorform").serializeArray();
		formdata.push({name:'isAjax',value:1});
		$.ajax({
			url:$('#update_vendorform').attr('action')+'/update_vendor/'+id,
			type:'POST',
			data:formdata,
			dataType:"JSON",
			beforeSend:function(){
				ajaxindicatorstart("Please wait.",base_url);
			},
			success:function(response)
			{
				ajaxindicatorstop();
				if(response == 1)
				{
					$("#update_vendorform")[0].reset();
					window.location.href = base_url+'vendor';
				}
				else if(response == 2)
				{
					$("#update_vendorform")[0].reset();
					$("#form_success").css("display","none");
					$("#form_error").css("display","block");
					$(".error_msg").html("Something wrong, please check again.");
				}
				else if(response == 3)
				{
					window.location.href = base_url+'vendor';
				}
				else
				{
					appendMsgs("#update_vendorform",response);
				}
			},
			error:function(){
				ajaxindicatorstop();
			}
		});
	});

	//vendor contact
	//<--------------------------------------------------------------------------------------------------------------->//

	$("#vendorcontact").on("click",function(e){
		e.preventDefault();
		var id = $("#v_id").val();
		// alert(id);
		formdata = $("#add_vendorcontactform").serializeArray();
		formdata.push({name:'isAjax',value:1});
		$.ajax({
			url:base_url+'vendor/add_vendorcontact/'+ id,
			type:'POST',
			data:formdata,
			dataType:"JSON",
			beforeSend:function(){
				ajaxindicatorstart("Please wait.",base_url);
			},
			success:function(response)
			{
				ajaxindicatorstop();
				if(response == 1)
				{
					$("#add_vendorcontactform")[0].reset();
					window.location.href = base_url+'vendor/vendorcontact/'+id;
				}
				else if(response == 2)
				{
					$("#add_vendorcontactform")[0].reset();
					$("#form_success").css("display","none");
					$("#form_error").css("display","block");
					$(".error_msg").html("Something wrong, please check again.");
				}
				else if(response == 3)
				{
					window.location.href = base_url+'vendor';
				}
				else
				{
					appendMsgs("#add_vendorcontactform",response);
				}
			},
			error:function(){
				ajaxindicatorstop();
			}
		});
	});

	$(".search_vendorcontact").on("click",function($this){

		var id =  $(this).closest('tr').find('.search_vendorcontact').attr("for");
		var csrfName =  $(this).closest('tr').find('.search_vendorcontact').attr('data-csrf_token_name');
		var csrfHash =  $(this).closest('tr').find('.search_vendorcontact').attr('data-csrf_token_hash');

		$.ajax({
			url:base_url+'vendor/update_vencontact/'+id,
			type:'POST',
			data:csrfName+'='+csrfHash,
			dataType:"JSON",
			beforeSend:function()
			{
				ajaxindicatorstart("Please wait.",base_url);
			},
			success:function(response)
			{
				ajaxindicatorstop();
				if(response.result=='success')
				{
					$('#update_vendorcontact').modal('show');
					$("#uv_id").val(response.v_id);
					$("#vc_id").val(response.vc_id);
					$("#uname").val(response.vc_name);
					$("#umobile").val(response.vc_mobile);
					$("#udesignation").val(response.vc_designation);
					$("#uemail").val(response.vc_email);
					$("#ustatus").val(response.vc_status);

				}
				else if(response.result=='fail'){

					ajaxindicatorstop();
					alert("No records Found !!!");
				}
			},
			error:function(){
				ajaxindicatorstop();
			}
		});
	});

	$("#updatevendorcontact").on("click",function(e){
		e.preventDefault();
		id = $("#vc_id").val();
		v_id = $("#uv_id").val();
		formdata = $("#update_vendorcontactform").serializeArray();
		formdata.push({name:'isAjax',value:1});
		$.ajax({
			url:base_url+'vendor/update_vencontact/'+id,
			type:'POST',
			data:formdata,
			dataType:"JSON",
			beforeSend:function(){
				ajaxindicatorstart("Please wait.",base_url);
			},
			success:function(response)
			{
				ajaxindicatorstop();
				if(response == 1)
				{
					$("#update_vendorcontactform")[0].reset();
					window.location.href = base_url+'vendor/vendorcontact/'+v_id;
				}
				else if(response == 2)
				{
					$("#update_vendorcontactform")[0].reset();
					$("#form_success").css("display","none");
					$("#form_error").css("display","block");
					$(".error_msg").html("Something wrong, please check again.");
				}
				else if(response == 3)
				{
					window.location.href = base_url+'vendor';
				}
				else
				{
					appendMsgs("#update_vendorcontactform",response);
				}
			},
			error:function(){
				ajaxindicatorstop();
			}
		});
	});


	$("#addproducts").on("click",function(e){
		e.preventDefault();
		var id = $("#v_id").val();
		// alert(id);
		formdata = $("#add_productform").serializeArray();
		formdata.push({name:'isAjax',value:1});
		$.ajax({
			url:base_url+'vendor/add_productspecialized/'+ id,
			type:'POST',
			data:formdata,
			dataType:"JSON",
			beforeSend:function(){
				ajaxindicatorstart("Please wait.",base_url);
			},
			success:function(response)
			{
				ajaxindicatorstop();
				if(response == 1)
				{
					$("#add_productform")[0].reset();
					window.location.href = base_url+'vendor/productspecialized/'+id;
				}
				else if(response == 2)
				{
					$("#add_productform")[0].reset();
					$("#form_success").css("display","none");
					$("#form_error").css("display","block");
					$(".error_msg").html("Something wrong, please check again.");
				}
				else if(response == 3)
				{
					window.location.href = base_url+'vendor';
				}
				else
				{
					appendMsgs("#add_productform",response);
				}
			},
			error:function(){
				ajaxindicatorstop();
			}
		});
	});
	
	$("#add_quotation").on("click",function(e){
		e.preventDefault();	
		var id = $("#inq_id").val();
		formdata = $("#add_quotationform").serializeArray();
		formdata.push({name:'isAjax',value:1});
		$.ajax({
			url:base_url+'quotation/add_quotation/'+id,
			type:'POST',
			data:formdata,
			dataType:"JSON",
			beforeSend:function(){
				ajaxindicatorstart("Please wait.",base_url);
			},
			success:function(response)
			{
				ajaxindicatorstop();
				if(response == 1)
				{
					$("#add_quotationform")[0].reset();
					window.location.href = base_url+'quotation';
				}
				else if(response == 2)
				{
					$("#add_quotationform")[0].reset();
					$("#form_success").css("display","none");
					$("#form_error").css("display","block");
					$(".error_msg").html("Something wrong, please check again.");
				}
				else if(response == 3)
				{
					window.location.href = base_url+'vendor';
				}
				else
				{
					appendMsgs("#add_quotationform",response);
				}
			},
			error:function(){
				ajaxindicatorstop();
			}
		});
	});

	$("#edit_quotation").on("click",function(e){
		e.preventDefault();	
		var id = $("#inq_id").val();
		var q_id = $("#q_id").val();
		formdata = $("#edit_quotationform").serializeArray();
		formdata.push({name:'isAjax',value:1});
		$.ajax({
			url:base_url+'quotation/edit_quotation/'+id+'/'+q_id,
			type:'POST',
			data:formdata,
			dataType:"JSON",
			beforeSend:function(){
				ajaxindicatorstart("Please wait.",base_url);
			},
			success:function(response)
			{
				ajaxindicatorstop();
				if(response == 1)
				{
					$("#edit_quotationform")[0].reset();
					window.location.href = base_url+'quotation';
				}
				else if(response == 2)
				{
					$("#edit_quotationform")[0].reset();
					$("#form_success").css("display","none");
					$("#form_error").css("display","block");
					$(".error_msg").html("Something wrong, please check again.");
				}
				else if(response == 3)
				{
					window.location.href = base_url+'vendor';
				}
				else
				{
					appendMsgs("#edit_quotationform",response);
				}
			},
			error:function(){
				ajaxindicatorstop();
			}
		});
	});


	$(".productspecilized").on("click",function($this){

		var id =  $(this).closest('tr').find('.productspecilized').attr("for");
		var csrfName =  $(this).closest('tr').find('.productspecilized').attr('data-csrf_token_name');
		var csrfHash =  $(this).closest('tr').find('.productspecilized').attr('data-csrf_token_hash');

		$.ajax({
			url:base_url+'vendor/update_productspecialized/'+id,
			type:'POST',
			data:csrfName+'='+csrfHash,
			dataType:"JSON",
			beforeSend:function()
			{
				ajaxindicatorstart("Please wait.",base_url);
			},
			success:function(response)
			{
				ajaxindicatorstop();
				if(response.result=='success')
				{
					$('#update_productspecilized').modal('show');
					$("#uv_id").val(response.v_id);
					$("#psp_id").val(response.psp_id);
					$("#product").val(response.p_id);
					$("#ustatus").val(response.psp_status);

				}
				else if(response.result=='fail'){

					ajaxindicatorstop();
					alert("No records Found !!!");
				}
			},
			error:function(){
				ajaxindicatorstop();
			}
		});
	});

	$("#updateproductspecialized").on("click",function(e){
		e.preventDefault();
		id = $("#psp_id").val();
		v_id = $("#uv_id").val();
		formdata = $("#update_productspecilizedform").serializeArray();
		formdata.push({name:'isAjax',value:1});
		$.ajax({
			url:base_url+'vendor/update_productspecialized/'+id,
			type:'POST',
			data:formdata,
			dataType:"JSON",
			beforeSend:function(){
				ajaxindicatorstart("Please wait.",base_url);
			},
			success:function(response)
			{
				ajaxindicatorstop();
				if(response == 1)
				{
					$("#update_productspecilizedform")[0].reset();
					window.location.href = base_url+'vendor/productspecialized/'+v_id;
				}
				else if(response == 2)
				{
					$("#update_productspecilizedform")[0].reset();
					$("#form_success").css("display","none");
					$("#form_error").css("display","block");
					$(".error_msg").html("Something wrong, please check again.");
				}
				else if(response == 3)
				{
					window.location.href = base_url+'vendor';
				}
				else
				{
					appendMsgs("#update_productspecilizedform",response);
				}
			},
			error:function(){
				ajaxindicatorstop();
			}
		});
	});

	$("#quotetemp").on("click",function(e){
		e.preventDefault();
		formdata = $("#add_quotetempform").serializeArray();
		formdata.push({name:'isAjax',value:1});
		$.ajax({
			url:base_url+'quotationtemplate/add_template/',
			type:'POST',
			data:formdata,
			dataType:"JSON",
			beforeSend:function(){
				ajaxindicatorstart("Please wait.",base_url);
			},
			success:function(response)
			{
				ajaxindicatorstop();
				if(response == 1)
				{
					$("#add_quotetempform")[0].reset();
					window.location.href = base_url+'quotationtemplate/template';
				}
				else if(response == 2)
				{
					$("#add_quotetempform")[0].reset();
					$("#form_success").css("display","none");
					$("#form_error").css("display","block");
					$(".error_msg").html("Something wrong, please check again.");
				}
				else if(response == 3)
				{
					window.location.href = base_url+'quotationtemplate/template';
				}
				else
				{
					appendMsgs("#add_quotetempform",response);
				}
			},
			error:function(){
				ajaxindicatorstop();
			}
		});
	});

	$(".search_template").on("click",function($this){

		var id =  $(this).closest('tr').find('.search_template').attr("for");
		var csrfName =  $(this).closest('tr').find('.search_template').attr('data-csrf_token_name');
		var csrfHash =  $(this).closest('tr').find('.search_template').attr('data-csrf_token_hash');

		$.ajax({
			url:base_url+'quotationtemplate/update_quotetemplate/'+id,
			type:'POST',
			data:csrfName+'='+csrfHash,
			dataType:"JSON",
			beforeSend:function()
			{
				ajaxindicatorstart("Please wait.",base_url);
			},
			success:function(response)
			{
				ajaxindicatorstop();
				if(response.result=='success')
				{
					$('#edit_template').modal('show');
					$("#t_id").val(response.temp_id);
					$("#t_name").val(response.temp_name);
					$("#t_desc").val(response.temp_desc);
				}
				else if(response.result=='fail'){

					ajaxindicatorstop();
					alert("No records Found !!!");
				}
			},
			error:function(){
				ajaxindicatorstop();
			}
		});
	});

	$("#editquotetemps").on("click",function(e){
		e.preventDefault();
		id = $("#t_id").val();
		formdata = $("#edit_quotetempform").serializeArray();
		formdata.push({name:'isAjax',value:1});
		$.ajax({
			url:base_url+'quotationtemplate/update_quotetemplate/'+id,
			type:'POST',
			data:formdata,
			dataType:"JSON",
			beforeSend:function(){
				ajaxindicatorstart("Please wait.",base_url);
			},
			success:function(response)
			{
				ajaxindicatorstop();
				if(response == 1)
				{
					$("#edit_quotetempform")[0].reset();
					window.location.href = base_url+'quotationtemplate/template';
				}
				else if(response == 2)
				{
					$("#edit_quotetempform")[0].reset();
					$("#form_success").css("display","none");
					$("#form_error").css("display","block");
					$(".error_msg").html("Something wrong, please check again.");
				}
				else if(response == 3)
				{
					window.location.href = base_url+'quotationtemplate';
				}
				else
				{
					appendMsgs("#edit_quotetempform",response);
				}
			},
			error:function(){
				ajaxindicatorstop();
			}
		});
	});

	$("#inquiry").on("click",function(e){
		e.preventDefault();
		formdata = $("#inquiryform").serializeArray();
		formdata.push({name:'isAjax',value:1});
		$.ajax({
			url:$('#inquiryform').attr('action'),
			type:'POST',
			data:formdata,
			dataType:"JSON",
			beforeSend:function(){
				ajaxindicatorstart("Please wait.",base_url);
			},
			success:function(response)
			{
				ajaxindicatorstop();
				if(response == 1)
				{
					$("#inquiryform")[0].reset();
					window.location.href = base_url+$("#redirect").val();
				}
				else if(response == 2)
				{
					$("#inquiryform")[0].reset();
					$("#form_success").css("display","none");
					$("#form_error").css("display","block");
					$(".error_msg").html("Something wrong, please check again.");
				}
				else if(response == 3)
				{
					window.location.href = base_url+'inquiry/allinquiries';
				}
				else
				{
					appendMsgs("#inquiryform",response);
				}
			},
			error:function(){
				ajaxindicatorstop();
			}
		});
	});

	$("#update_customer").on("click",function(e){
		e.preventDefault();
		id = $("#c_id").val();
		formdata = $("#update_customerform").serializeArray();
		formdata.push({name:'isAjax',value:1});
		$.ajax({
			url:$('#update_customerform').attr('action'),
			type:'POST',
			data:formdata,
			dataType:"JSON",
			beforeSend:function(){
				ajaxindicatorstart("Please wait.",base_url);
			},
			success:function(response)
			{
				ajaxindicatorstop();
				if(response == 1)
				{
					$("#update_customerform")[0].reset();
					window.location.href = base_url+'inquiry/customers/'+id;
				}
				else if(response == 2)
				{
					$("#update_customerform")[0].reset();
					$("#form_success").css("display","none");
					$("#form_error").css("display","block");
					$(".error_msg").html("Something wrong, please check again.");
				}
				else if(response == 3)
				{
					window.location.href = base_url+'inquiry/customers';
				}
				else
				{
					appendMsgs("#update_customerform",response);
				}
			},
			error:function(){
				ajaxindicatorstop();
			}
		});
	});


});






