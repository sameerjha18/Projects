$(document).ready(function(){
	$("#add_inquirydetail").on("click",function(e){
		e.preventDefault();
		id = $('#inq_id').val();
		formdata = $("#add_inquirydetailform").serializeArray();
		formdata.push({name:'isAjax',value:1});
		$.ajax({
			url:base_url+'supervisor/add_inquirydetails/'+id,
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
					window.location.href = base_url+'supervisor/inspectiondetails/'+id;
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
					window.location.href = base_url+'supervisor/dashboard';
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
			url:base_url+'/supervisor/update_inquirydetails/'+id+'/'+inqid,
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
					window.location.href = base_url+'supervisor/inspectiondetails/'+inqid;
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
					window.location.href = base_url+'supervisor/allinquiry';
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

	// $("#uploadimage").on("click",function(e){
	// 	e.preventDefault();
	// 	id = $('#inq_id').val();
	// 	formdata = $("#imageuploadform").serializeArray();
	// 	formdata.push({name:'isAjax',value:1});
	// 	$.ajax({
	// 		url:base_url+'supervisor/upload_photographs/'+id,
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
	// 				$("#imageuploadform")[0].reset();
	// 				window.location.href = base_url+'supervisor/inspectiondetails/'+id;
	// 			}
	// 			else if(response == 2)
	// 			{
	// 				$("#imageuploadform")[0].reset();
	// 				$("#form_success").css("display","none");
	// 				$("#form_error").css("display","block");
	// 				$(".error_msg").html("Something wrong, please check again.");
	// 			}
	// 			else if(response == 3)
	// 			{
	// 				window.location.href = base_url+'supervisor/dashboard';
	// 			}
	// 			else
	// 			{
	// 				appendMsgs("#imageuploadform",response);
	// 			}
	// 		},
	// 		error:function(){
	// 			ajaxindicatorstop();
	// 		}
	// 	});
 //    });
    
    $("#uploadimage").on("click",function(e){
		e.preventDefault();
		id = $('#inq_id').val();
		var form = $('#imageuploadform')[0];
		var data = new FormData(form);
		$.ajax({
			url:base_url+'supervisor/upload_photographs/'+id,
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
					window.location.href = base_url+'supervisor/inspectiondetails/'+id;;
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
					window.location.href = base_url+'supervisor/dashboard';
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
});