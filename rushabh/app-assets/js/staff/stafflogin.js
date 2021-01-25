$(document).ready(function(){
	$("#login").on("click",function(e){
		e.preventDefault();
		userpassword = $("#userpassword").val();
		if(userpassword!='')
		{
			var pass = SHA1(userpassword);
			$("#userpassword").val(pass);
		}
		formdata = $("#loginform").serializeArray();
		formdata.push({name:'isAjax',value:1});
		//console.log(formdata);
		$.ajax({
			url:base_url+'stafflogin',
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
					window.location.href= base_url+"staff/dashboard";
				}
				else if(response == 2)
				{
					$("#loginform")[0].reset();
					$("#errormessage").html("Enter valid login credential.");
				}
				else
				{
					console.log(response);
					appendLogin("#loginform",response);
				}
			},
			error:function(){
				ajaxindicatorstop();
			}
		});
	});
	$("#forgotpassword").on("click",function(e){
	
		e.preventDefault();
		formdata = $("#forgotpasswordform").serializeArray();
		formdata.push({name:'isAjax',value:1});
		$.ajax({
			url:$('#forgotpasswordform').attr('action'),
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
					alert("Password sent on your registered email address");

					$("#forgotpasswordform")[0].reset();
					window.location.href = base_url;

				}
				else if(response.result =='fail')
				{
					alert("Email address is not available");
					$("#forgotpasswordform")[0].reset();
				}
				else
				{
					appendLogin("#forgotpasswordform",response);
				}
			},
			error:function(){
				ajaxindicatorstop();
			}
		});
	});
});