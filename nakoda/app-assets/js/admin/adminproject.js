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

	//brand section

	$("#brand").on("click",function(e){
		e.preventDefault();
		formdata = $("#add_brandform").serializeArray();
		formdata.push({name:'isAjax',value:1});
		$.ajax({
			url:$('#add_brandform').attr('action')+'/add_brand',
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
					$("#add_brandform")[0].reset();
					window.location.href = base_url+'brand';
				}
				else if(response == 2)
				{
					$("#add_brandform")[0].reset();
					$("#form_success").css("display","none");
					$("#form_error").css("display","block");
					$(".error_msg").html("Something wrong, please check again.");
				}
				else if(response == 3)
				{
					window.location.href = base_url+'brand';
				}
				else
				{
					appendMsgs("#add_brandform",response);
				}
			},
			error:function(){
				ajaxindicatorstop();
			}
		});
	});

	$(".search_brand").on("click",function($this){

		var id =  $(this).closest('tr').find('.search_brand').attr("for");

		var csrfName =  $(this).closest('tr').find('.search_brand').attr('data-csrf_token_name');
		var csrfHash =  $(this).closest('tr').find('.search_brand').attr('data-csrf_token_hash');
		
		$.ajax({
			url:base_url+'brand/update_brand/'+id,
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
					$('#update_brand').modal('show'); 
					$("#b_id").val(response.b_id);
					$("#b_name").val(response.b_name);
					$("#b_status").val(response.b_status);

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


$("#updatebrand").on("click",function(e){
	e.preventDefault();
	id = $("#b_id").val();
	formdata = $("#update_brandform").serializeArray();
	formdata.push({name:'isAjax',value:1});
	$.ajax({
		url:$('#update_brandform').attr('action')+'/update_brand/'+id,
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
				$("#update_brandform")[0].reset();
				window.location.href = base_url+'brand';
			}
			else if(response == 2)
			{
				$("#update_brandform")[0].reset();
				$("#form_success").css("display","none");
				$("#form_error").css("display","block");
				$(".error_msg").html("Something wrong, please check again.");
			}
			else if(response == 3)
			{
				window.location.href = base_url+'brand';
			}
			else
			{
				appendMsgs("#update_brandform",response);
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
	//Colour Section

	$("#colour").on("click",function(e){
		e.preventDefault();
		formdata = $("#add_colourform").serializeArray();
		formdata.push({name:'isAjax',value:1});
		$.ajax({
			url:$('#add_colourform').attr('action')+'/add_colour',
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
					$("#add_colourform")[0].reset();
					window.location.href = base_url+'colour';
				}
				else if(response == 2)
				{
					$("#add_colourform")[0].reset();
					$("#form_success").css("display","none");
					$("#form_error").css("display","block");
					$(".error_msg").html("Something wrong, please check again.");
				}
				else if(response == 3)
				{
					window.location.href = base_url+'colour';
				}
				else
				{
					appendMsgs("#add_colourform",response);
				}
			},
			error:function(){
				ajaxindicatorstop();
			}
		});
	});

	$(".search_colour").on("click",function($this){

         var id =  $(this).closest('tr').find('.search_colour').attr("for");

         var csrfName =  $(this).closest('tr').find('.search_colour').attr('data-csrf_token_name');
         var csrfHash =  $(this).closest('tr').find('.search_colour').attr('data-csrf_token_hash');
         
         $.ajax({
            url:base_url+'colour/update_colour/'+id,
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
                  $('#update_colour').modal('show'); 
                  $("#cl_id").val(response.cl_id);
                  $("#cl_colour").val(response.cl_name);
                  $("#cl_status").val(response.cl_status);
 
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


	$("#updatecolour").on("click",function(e){
		e.preventDefault();
		id = $("#cl_id").val();
		formdata = $("#update_colourform").serializeArray();
		formdata.push({name:'isAjax',value:1});
		$.ajax({
			url:$('#update_colourform').attr('action')+'/update_colour/'+id,
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
					$("#update_colourform")[0].reset();
					window.location.href = base_url+'colour';
				}
				else if(response == 2)
				{
					$("#update_colourform")[0].reset();
					$("#form_success").css("display","none");
					$("#form_error").css("display","block");
					$(".error_msg").html("Something wrong, please check again.");
				}
				else if(response == 3)
				{
					window.location.href = base_url+'colour';
				}
				else
				{
					appendMsgs("#update_colourform",response);
				}
			},
			error:function(){
				ajaxindicatorstop();
			}
		});
	});

	//Dimension Section

	$("#dimension").on("click",function(e){
		e.preventDefault();
		formdata = $("#add_dimensionform").serializeArray();
		formdata.push({name:'isAjax',value:1});
		$.ajax({
			url:$('#add_dimensionform').attr('action')+'/add_dimension',
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
					$("#add_dimensionform")[0].reset();
					window.location.href = base_url+'dimension';
				}
				else if(response == 2)
				{
					$("#add_dimensionform")[0].reset();
					$("#form_success").css("display","none");
					$("#form_error").css("display","block");
					$(".error_msg").html("Something wrong, please check again.");
				}
				else if(response == 3)
				{
					window.location.href = base_url+'dimension';
				}
				else
				{
					appendMsgs("#add_dimensionform",response);
				}
			},
			error:function(){
				ajaxindicatorstop();
			}
		});
	});

	$(".search_dimension").on("click",function($this){

         var id =  $(this).closest('tr').find('.search_dimension').attr("for");

         var csrfName =  $(this).closest('tr').find('.search_dimension').attr('data-csrf_token_name');
         var csrfHash =  $(this).closest('tr').find('.search_dimension').attr('data-csrf_token_hash');
         
         $.ajax({
            url:base_url+'dimension/update_dimension/'+id,
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
                  $('#update_dimension').modal('show'); 
                  $("#d_id").val(response.d_id);
                  $("#d_size").val(response.d_size);
                  $("#d_status").val(response.d_status);
 
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


	$("#updatedimension").on("click",function(e){
		e.preventDefault();
		id = $("#d_id").val();
		formdata = $("#update_dimensionform").serializeArray();
		formdata.push({name:'isAjax',value:1});
		$.ajax({
			url:$('#update_dimensionform').attr('action')+'/update_dimension/'+id,
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
					$("#update_dimensionform")[0].reset();
					window.location.href = base_url+'dimension';
				}
				else if(response == 2)
				{
					$("#update_dimensionform")[0].reset();
					$("#form_success").css("display","none");
					$("#form_error").css("display","block");
					$(".error_msg").html("Something wrong, please check again.");
				}
				else if(response == 3)
				{
					window.location.href = base_url+'dimension';
				}
				else
				{
					appendMsgs("#update_dimensionform",response);
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
					window.location.href = base_url+'staff';
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
					window.location.href = base_url+'staff';
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
		   url:base_url+'staff/update_staff/'+id,
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
				window.location.href = base_url+'staff';
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
				window.location.href = base_url+'staff';
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

$("#stafftype").on("click",function(e){
	e.preventDefault();
	formdata = $("#add_stafftypeform").serializeArray();
	formdata.push({name:'isAjax',value:1});
	$.ajax({
		url:$('#add_stafftypeform').attr('action')+'/add_stafftype',
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
				$("#add_stafftypeform")[0].reset();
				window.location.href = base_url+'stafftype';
			}
			else if(response == 2)
			{
				$("#add_stafftypeform")[0].reset();
				$("#form_success").css("display","none");
				$("#form_error").css("display","block");
				$(".error_msg").html("Something wrong, please check again.");
			}
			else if(response == 3)
			{
				window.location.href = base_url+'stafftype';
			}
			else
			{
				appendMsgs("#add_stafftypeform",response);
			}
		},
		error:function(){
			ajaxindicatorstop();
		}
	});
});

	$("#add_leadtype").on("click",function(e){
		e.preventDefault();
		formdata = $("#add_leadtypeform").serializeArray();
		formdata.push({name:'isAjax',value:1});
		$.ajax({
			url:$('#add_leadtypeform').attr('action')+'/add_leadtype',
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
					$("#add_leadtypeform")[0].reset();
					window.location.href = base_url+'leadtype';
				}
				else if(response == 2)
				{
					$("#leadtypeform")[0].reset();
					$("#form_success").css("display","none");
					$("#form_error").css("display","block");
					$(".error_msg").html("Something wrong, please check again.");
				}
				else if(response == 3)
				{
					window.location.href = base_url+'leadtype';
				}
				else
				{
					appendMsgs("#add_leadtypeform",response);
				}
			},
			error:function(){
				ajaxindicatorstop();
			}
		});
	});

	$(".update_lead").on("click",function($this){

         var id =  $(this).closest('tr').find('.update_lead').attr("for");

         var csrfName =  $(this).closest('tr').find('.update_industry').attr('data-csrf_token_name');
         var csrfHash =  $(this).closest('tr').find('.update_industry').attr('data-csrf_token_hash');
         
         $.ajax({
            url:base_url+'leadtype/update_leadtype/'+id,
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
                  $('#update_leadtypemodal').modal('show'); 
                  $("#lname").val(response.l_name);
                  $("#lstatus").val(response.l_status);
                  $("#l_id").val(response.l_id);

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

	$("#update_leadtype").on("click",function(e){
		e.preventDefault();
		id = $("#l_id").val();
		formdata = $("#update_leadtypeform").serializeArray();
		formdata.push({name:'isAjax',value:1});
		$.ajax({
			url:$('#update_leadtypeform').attr('action')+'/update_leadtype/'+id,
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
					$("#update_leadtypeform")[0].reset();
					window.location.href = base_url+'leadtype';
				}
				else if(response == 2)
				{
					$("#update_leadtypeform")[0].reset();
					$("#form_success").css("display","none");
					$("#form_error").css("display","block");
					$(".error_msg").html("Something wrong, please check again.");
				}
				else if(response == 3)
				{
					window.location.href = base_url+'leadtype';
				}
				else
				{
					appendMsgs("#update_leadtypeform",response);
				}
			},
			error:function(){
				ajaxindicatorstop();
			}
		});
	});

	$("#industrytype").on("click",function(e){
		e.preventDefault();
		formdata = $("#industrytypeform").serializeArray();
		formdata.push({name:'isAjax',value:1});
		$.ajax({
			url:$('#industrytypeform').attr('action')+'/add_industrytype',
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
					$("#industrytypeform")[0].reset();
					window.location.href = base_url+'industrytype';
				}
				else if(response == 2)
				{
					$("#industrytypeform")[0].reset();
					$("#form_success").css("display","none");
					$("#form_error").css("display","block");
					$(".error_msg").html("Something wrong, please check again.");
				}
				else if(response == 3)
				{
					window.location.href = base_url+'industrytype';
				}
				else
				{
					appendMsgs("#industrytypeform",response);
				}
			},
			error:function(){
				ajaxindicatorstop();
			}
		});
	});

	$(".update_industry").on("click",function($this){

         var id =  $(this).closest('tr').find('.update_industry').attr("for");

         var csrfName =  $(this).closest('tr').find('.update_industry').attr('data-csrf_token_name');
         var csrfHash =  $(this).closest('tr').find('.update_industry').attr('data-csrf_token_hash');
         
         $.ajax({
            url:base_url+'industrytype/update_industrytype/'+id,
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
                  $('#update_industrymodal').modal('show'); 
                  $("#iname").val(response.i_name);
                  $("#istatus").val(response.i_status);
                  $("#i_id").val(response.i_id);

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


	$("#update_industrytype").on("click",function(e){
		e.preventDefault();
		id = $("#i_id").val();
		formdata = $("#update_industrytypeform").serializeArray();
		formdata.push({name:'isAjax',value:1});
		$.ajax({
			url:$('#update_industrytypeform').attr('action')+'/update_industrytype/'+id,
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
					$("#update_industrytypeform")[0].reset();
					window.location.href = base_url+'industrytype';
				}
				else if(response == 2)
				{
					$("#update_industrytypeform")[0].reset();
					$("#form_success").css("display","none");
					$("#form_error").css("display","block");
					$(".error_msg").html("Something wrong, please check again.");
				}
				else if(response == 3)
				{
					window.location.href = base_url+'industrytype';
				}
				else
				{
					appendMsgs("#update_industrytypeform",response);
				}
			},
			error:function(){
				ajaxindicatorstop();
			}
		});
	});

	$("#add_designation").on("click",function(e){
		e.preventDefault();
		formdata = $("#add_desgnationform").serializeArray();
		formdata.push({name:'isAjax',value:1});
		$.ajax({
			url:$('#add_desgnationform').attr('action')+'/add_designation',
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
					$("#add_desgnationform")[0].reset();
					window.location.href = base_url+'designation';
				}
				else if(response == 2)
				{
					$("#add_desgnationform")[0].reset();
					$("#form_success").css("display","none");
					$("#form_error").css("display","block");
					$(".error_msg").html("Something wrong, please check again.");
				}
				else if(response == 3)
				{
					window.location.href = base_url+'designation';
				}
				else
				{
					appendMsgs("#add_desgnationform",response);
				}
			},
			error:function(){
				ajaxindicatorstop();
			}
		});
	});

	
	$(".update_designation").on("click",function($this){

         var id =  $(this).closest('tr').find('.update_designation').attr("for");

         var csrfName =  $(this).closest('tr').find('.update_designation').attr('data-csrf_token_name');
         var csrfHash =  $(this).closest('tr').find('.update_designation').attr('data-csrf_token_hash');
         
         $.ajax({
            url:base_url+'designation/update_designation/'+id,
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
                  $('#update_designationmodal').modal('show'); 
                  $("#des_name").val(response.des_name);
                  $("#des_status").val(response.des_status);
                  $("#des_id").val(response.des_id);

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

	$("#update_designation").on("click",function(e){
		e.preventDefault();
		id = $("#des_id").val();
		formdata = $("#update_designationform").serializeArray();
		formdata.push({name:'isAjax',value:1});
		$.ajax({
			url:$('#update_designationform').attr('action')+'/update_designation/'+id,
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
					$("#update_designationform")[0].reset();
					window.location.href = base_url+'designation';
				}
				else if(response == 2)
				{
					$("#update_designationform")[0].reset();
					$("#form_success").css("display","none");
					$("#form_error").css("display","block");
					$(".error_msg").html("Something wrong, please check again.");
				}
				else if(response == 3)
				{
					window.location.href = base_url+'designation';
				}
				else
				{
					appendMsgs("#update_industrytypeform",response);
				}
			},
			error:function(){
				ajaxindicatorstop();
			}
		});
	});



	$("#customer").on("click",function(e){
		e.preventDefault();
		formdata = $("#customerform").serializeArray();
		formdata.push({name:'isAjax',value:1});
		$.ajax({
			url:$('#customerform').attr('action'),
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
					$("#customerform")[0].reset();
					window.location.href = base_url+'customer/allcustomers';
				}
				else if(response == 2)
				{
					$("#customerform")[0].reset();
					$("#form_success").css("display","none");
					$("#form_error").css("display","block");
					$(".error_msg").html("Something wrong, please check again.");
				}
				else if(response == 3)
				{
					window.location.href = base_url+'customer/allcustomers';
				}
				else
				{
					appendMsgs("#customerform",response);
				}
			},
			error:function(){
				ajaxindicatorstop();
			}
		});
	});

	$("#corporateclient").on("click",function(e){
		e.preventDefault();
		formdata = $("#corporateclientform").serializeArray();
		formdata.push({name:'isAjax',value:1});

		$.ajax({
			url:$('#corporateclientform').attr('action'),
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
					$("#corporateclientform")[0].reset();
					window.location.href = base_url+'corporate';
				}
				else if(response == 2)
				{
					$("#corporateclientform")[0].reset();
					$("#form_success").css("display","none");
					$("#form_error").css("display","block");
					$(".error_msg").html("Something wrong, please check again.");
				}
				else if(response == 3)
				{
					window.location.href = base_url+'corporate';
				}
				else
				{
					appendMsgs("#corporateclientform",response);
				}
			},
			error:function(){
				ajaxindicatorstop();
			}
		});
	});

	$("#corporatecontact").on("click",function(e){
		e.preventDefault();
		var id = $("#cc_id").val();
		formdata = $("#corporatecontactform").serializeArray();
		formdata.push({name:'isAjax',value:1});
		$.ajax({
			url:$('#corporatecontactform').attr('action'),
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
					$("#corporatecontactform")[0].reset();
					window.location.href = base_url+'businessowners/businesscontact/'+id;
				}
				else if(response == 2)
				{
					$("#corporatecontactform")[0].reset();
					$("#form_success").css("display","none");
					$("#form_error").css("display","block");
					$(".error_msg").html("Something wrong, please check again.");
				}
				else if(response == 3)
				{
					window.location.href = base_url+'corporate/corporateclients';
				}
				else
				{
					appendMsgs("#corporatecontactform",response);
				}
			},
			error:function(){
				ajaxindicatorstop();
			}
		});
	});


	$("#businessowners").on("click",function(e){
		alert(123);
		e.preventDefault();
		formdata = $("#businessownersform").serializeArray();
		formdata.push({name:'isAjax',value:1});

		$.ajax({
			url:$('#businessownersform').attr('action'),
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
					$("#businessownersform")[0].reset();
					window.location.href = base_url+'businessowners';
				}
				else if(response == 2)
				{
					$("#businessownersform")[0].reset();
					$("#form_success").css("display","none");
					$("#form_error").css("display","block");
					$(".error_msg").html("Something wrong, please check again.");
				}
				else if(response == 3)
				{
					window.location.href = base_url+'businessowners';
				}
				else
				{
					appendMsgs("#businessownersform",response);
				}
			},
			error:function(){
				ajaxindicatorstop();
			}
		});
	});

	

	$(".update_businessowner").on("click",function($this){

         var id =  $(this).closest('tr').find('.update_businessowner').attr("for");

         var csrfName =  $(this).closest('tr').find('.update_businessowner').attr('data-csrf_token_name');
         var csrfHash =  $(this).closest('tr').find('.update_businessowner').attr('data-csrf_token_hash');
         
         $.ajax({
            url:base_url+'businessowners/update_contact/'+id,
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
                  $('#update_ownermodal').modal('show'); 
                  $("#ccname").val(response.bop_name);
                  $("#bo_id").val(response.bo_id);
                  $("#ccdesignation").val(response.bop_designation);
                  $("#ccmobile").val(response.bop_mobile);
                  $("#des_name").val(response.bop_designation);
                  $("#des_status").val(response.bop_email);
                  $("#des_id").val(response.bop_status);
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

	$("#add_businesscontact").on("click",function(e){
		alert(123);
		e.preventDefault();
		var id = $("#bo_id").val();
		formdata = $("#add_businesscontactform").serializeArray();
		formdata.push({name:'isAjax',value:1});
		$.ajax({
			url:base_url+'businessowners/add_contact/'+id,
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
					$("#add_businesscontactform")[0].reset();
					window.location.href = base_url+'businessowners/ownercontact/'+id;
				}
				else if(response == 2)
				{
					$("#add_businesscontactform")[0].reset();
					$("#form_success").css("display","none");
					$("#form_error").css("display","block");
					$(".error_msg").html("Something wrong, please check again.");
				}
				else if(response == 3)
				{
					window.location.href = base_url+'businessowners';
				}
				else
				{
					appendMsgs("#add_businesscontactform",response);
				}
			},
			error:function(){
				ajaxindicatorstop();
			}
		});
	});

	$("#update_businesscontact").on("click",function(e){
		alert(123);
		e.preventDefault();
		var id = $("#bo_id").val();
		formdata = $("#update_businesscontactform").serializeArray();
		formdata.push({name:'isAjax',value:1});
		$.ajax({
			url:base_url+'businessowners/update_contact/'+id,
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
					$("#update_businesscontactform")[0].reset();
					window.location.href = base_url+'businessowners/ownercontact/'+id;
				}
				else if(response == 2)
				{
					$("#update_businesscontactform")[0].reset();
					$("#form_success").css("display","none");
					$("#form_error").css("display","block");
					$(".error_msg").html("Something wrong, please check again.");
				}
				else if(response == 3)
				{
					window.location.href = base_url+'businessowners';
				}
				else
				{
					appendMsgs("#update_businesscontactform",response);
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
					window.location.href = base_url+'inquiry/allinquiries';
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
					window.location.href = base_url+'inventory';
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
					window.location.href = base_url+'purchase/purchasedetail/'+response.id;
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

	//client contact
//<--------------------------------------------------------------------------------------------------------------->//

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
		id = $("#uc_id").val();
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
//employee section


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

// $("#updateproduct").on("click",function(e){
// 	e.preventDefault();
// 	id = $("#p_id").val();
// 	formdata = $("#update_productsform").serializeArray();
// 	formdata.push({name:'isAjax',value:1});
// 	$.ajax({
// 		url:$('#update_productsform').attr('action')+'/update_products/'+id,
// 		type:'POST',
// 		data:formdata,
// 		dataType:"JSON",
// 		beforeSend:function(){
// 			ajaxindicatorstart("Please wait.",base_url);
// 		},
// 		success:function(response)
// 		{
// 			ajaxindicatorstop();
// 			if(response == 1)
// 			{
// 				$("#update_productsform")[0].reset();
// 				window.location.href = base_url+'products';
// 			}
// 			else if(response == 2)
// 			{
// 				$("#update_productsform")[0].reset();
// 				$("#form_success").css("display","none");
// 				$("#form_error").css("display","block");
// 				$(".error_msg").html("Something wrong, please check again.");
// 			}
// 			else if(response == 3)
// 			{
// 				window.location.href = base_url+'products';
// 			}
// 			else
// 			{
// 				appendMsgs("#update_productsform",response);
// 			}
// 		},
// 		error:function(){
// 			ajaxindicatorstop();
// 		}
// 	});
// });

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
		alert(id);
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

	//unit section

	$("#add_unit").on("click",function(e){
		e.preventDefault();
		formdata = $("#add_unitform").serializeArray();
		formdata.push({name:'isAjax',value:1});
		$.ajax({
			url:$('#add_unitform').attr('action')+'/add_unit',
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
					$("#add_unitform")[0].reset();
					window.location.href = base_url+'unit';
				}
				else if(response == 2)
				{
					$("#add_unitform")[0].reset();
					$("#form_success").css("display","none");
					$("#form_error").css("display","block");
					$(".error_msg").html("Something wrong, please check again.");
				}
				else if(response == 3)
				{
					window.location.href = base_url+'unit';
				}
				else
				{
					appendMsgs("#add_unitform",response);
				}
			},
			error:function(){
				ajaxindicatorstop();
			}
		});
	});

	$(".update_unit").on("click",function($this){

		var id =  $(this).closest('tr').find('.update_unit').attr("for");

		var csrfName =  $(this).closest('tr').find('.update_unit').attr('data-csrf_token_name');
		var csrfHash =  $(this).closest('tr').find('.update_unit').attr('data-csrf_token_hash');

		$.ajax({
			url:base_url+'unit/update_unit/'+id,
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
					$('#update_unitmodal').modal('show');
					$("#u_name").val(response.u_name);
					$("#u_status").val(response.u_status);
					$("#u_id").val(response.u_id);

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

	$("#update_unit").on("click",function(e){
		e.preventDefault();
		id = $("#u_id").val();
		formdata = $("#update_unitform").serializeArray();
		formdata.push({name:'isAjax',value:1});
		$.ajax({
			url:$('#update_unitform').attr('action')+'/update_unit/'+id,
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
					$("#update_unitform")[0].reset();
					window.location.href = base_url+'unit';
				}
				else if(response == 2)
				{
					$("#update_unitform")[0].reset();
					$("#form_success").css("display","none");
					$("#form_error").css("display","block");
					$(".error_msg").html("Something wrong, please check again.");
				}
				else if(response == 3)
				{
					window.location.href = base_url+'unit';
				}
				else
				{
					appendMsgs("#update_unitform",response);
				}
			},
			error:function(){
				ajaxindicatorstop();
			}
		});
	});

	//toys section

	$("#add_toys").on("click",function(e){
		e.preventDefault();
		formdata = $("#add_toysform").serializeArray();
		formdata.push({name:'isAjax',value:1});

		$.ajax({
			url:$('#add_toysform').attr('action')+'/add_toys',
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
					$("#add_toysform")[0].reset();
					window.location.href = base_url+'toys';
				}
				else if(response == 2)
				{
					$("#add_toysform")[0].reset();
					$("#form_success").css("display","none");
					$("#form_error").css("display","block");
					$(".error_msg").html("Something wrong, please check again.");
				}
				else if(response == 3)
				{
					window.location.href = base_url+'toys';
				}
				else
				{
					appendMsgs("#add_toysform",response);
				}
			},
			error:function(){
				ajaxindicatorstop();
			}
		});
	});

	//update toys

	$("#toys_update").on("click",function(e){
		e.preventDefault();
		formdata = $("#update_toysform").serializeArray();
		formdata.push({name:'isAjax',value:1});
		$.ajax({
			url:$('#update_toysform').attr('action')+'/update_toys/',
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
					$("#update_toysform")[0].reset();
					window.location.href = base_url+'toys';
				}
				else if(response == 2)
				{
					$("#update_toysform")[0].reset();
					$("#form_success").css("display","none");
					$("#form_error").css("display","block");
					$(".error_msg").html("Something wrong, please check again.");
				}
				else if(response == 3)
				{
					window.location.href = base_url+'toys';
				}
				else
				{
					appendMsgs("#update_toysform",response);
				}
			},
			error:function(){
				ajaxindicatorstop();
			}
		});
	});

	//cloth section

	$("#add_cloth").on("click",function(e){
		e.preventDefault();
		formdata = $("#add_clothform").serializeArray();
		formdata.push({name:'isAjax',value:1});

		$.ajax({
			url:$('#add_clothform').attr('action')+'/add_cloth',
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
					$("#add_clothform")[0].reset();
					window.location.href = base_url+'cloth';
				}
				else if(response == 2)
				{
					$("#add_clothform")[0].reset();
					$("#form_success").css("display","none");
					$("#form_error").css("display","block");
					$(".error_msg").html("Something wrong, please check again.");
				}
				else if(response == 3)
				{
					window.location.href = base_url+'cloth';
				}
				else
				{
					appendMsgs("#add_clothform",response);
				}
			},
			error:function(){
				ajaxindicatorstop();
			}
		});
	});

	$("#cloth_update").on("click",function(e){
		e.preventDefault();
		formdata = $("#update_clothform").serializeArray();
		formdata.push({name:'isAjax',value:1});
		$.ajax({
			url:$('#update_clothform').attr('action')+'/update_cloth/',
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
					$("#update_clothform")[0].reset();
					window.location.href = base_url+'cloth';
				}
				else if(response == 2)
				{
					$("#update_clothform")[0].reset();
					$("#form_success").css("display","none");
					$("#form_error").css("display","block");
					$(".error_msg").html("Something wrong, please check again.");
				}
				else if(response == 3)
				{
					window.location.href = base_url+'cloth';
				}
				else
				{
					appendMsgs("#update_clothform",response);
				}
			},
			error:function(){
				ajaxindicatorstop();
			}
		});
	});

	$("#add_accounts").on("click",function(e){
		// alert(123);
		e.preventDefault();
		formdata = $("#add_accountform").serializeArray();
		formdata.push({name:'isAjax',value:1});
		$.ajax({
			url:$('#add_accountform').attr('action')+'/add_account',
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
					$("#add_accountform")[0].reset();
					window.location.href = base_url+'account';
				}
				else if(response == 2)
				{
					$("#add_accountform")[0].reset();
					$("#form_success").css("display","none");
					$("#form_error").css("display","block");
					$(".error_msg").html("Something wrong, please check again.");
				}
				else if(response == 3)
				{
					window.location.href = base_url+'account';
				}
				else
				{
					appendMsgs("#add_accountform",response);
				}
			},
			error:function(){
				ajaxindicatorstop();
			}
		});
	});

	$(".update_account").on("click",function($this){

		var id =  $(this).closest('tr').find('.update_account').attr("for");

		var csrfName =  $(this).closest('tr').find('.update_account').attr('data-csrf_token_name');
		var csrfHash =  $(this).closest('tr').find('.update_account').attr('data-csrf_token_hash');

		$.ajax({
			url:base_url+'account/update_account/'+id,
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
					$('#update_accountmodal').modal('show');
					$("#a_name").val(response.acc_name);
					$("#status").val(response.acc_status);
					$("#acc_id").val(response.acc_id);

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

	$("#update_account").on("click",function(e){
		e.preventDefault();
		id = $("#acc_id").val();
		formdata = $("#update_accountform").serializeArray();
		formdata.push({name:'isAjax',value:1});
		$.ajax({
			url:$('#update_accountform').attr('action')+'/update_account/'+id,
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
					$("#update_accountform")[0].reset();
					window.location.href = base_url+'account';
				}
				else if(response == 2)
				{
					$("#update_accountform")[0].reset();
					$("#form_success").css("display","none");
					$("#form_error").css("display","block");
					$(".error_msg").html("Something wrong, please check again.");
				}
				else if(response == 3)
				{
					window.location.href = base_url+'account';
				}
				else
				{
					appendMsgs("#update_accountform",response);
				}
			},
			error:function(){
				ajaxindicatorstop();
			}
		});
	});

	//ledger add
	$("#add_detail").on("click",function(e){
		// alert(123);
		e.preventDefault();
		var id = $("#acc_id").val();
		// alert(id);
		formdata = $("#add_ledgerform").serializeArray();
		formdata.push({name:'isAjax',value:1});
		$.ajax({
			url:base_url+'account/add_ledgerdetail/'+ id,
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
					$("#add_ledgerform")[0].reset();
					window.location.href = base_url+'account/ledger/'+id;
				}
				else if(response == 2)
				{
					$("#add_ledgerform")[0].reset();
					$("#form_success").css("display","none");
					$("#form_error").css("display","block");
					$(".error_msg").html("Something wrong, please check again.");
				}
				else if(response == 3)
				{
					window.location.href = base_url+'account';
				}
				else
				{
					appendMsgs("#add_ledgerform",response);
				}
			},
			error:function(){
				ajaxindicatorstop();
			}
		});
	});
});






