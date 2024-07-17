function btn_register() {
    var base_url = $('#base_url').val();
    var user_type = $('#user_type').val();
	/*var username=$('#username').val();
	var mobile=$('#mobile').val();
	var first_name=$('#first_name').val();
	var last_name=$('#last_name').val();
	var company_name=$('#company_name').val();*/
    var location = $('#location').val();
	var latitude = $('#search_lat').val();
	var longitude = $('#search_lon').val();
	var password = $('#password').val();
	var conf_password = $('#conf_password').val();
	var email = $('#email').val().trim();
    var emailRegex = /^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
    var phoneRegex = /^\d{10}$/;

	/*if(first_name=='') {
		$('#err_firstname').fadeIn().html('Please enter First Name').css({'color':'red','margin-bottom':'5px'});
		setTimeout(function(){$("#err_firstname").html("&nbsp;");},3000);
		$("#first_name").focus();
		return false;
	}
	if(last_name=='') {
		$('#err_lastname').fadeIn().html('Please enter Last Name').css({'color':'red','margin-bottom':'5px'});
		setTimeout(function(){$("#err_lastname").html("&nbsp;");},3000);
		$("#last_name").focus();
		return false;
	}
    if(location=='') {
		$('#err_address').fadeIn().html('Please enter legal address').css({'color':'red','margin-bottom':'5px'});
		setTimeout(function(){$("#err_address").html("&nbsp;");},3000);
		$("#location").focus();
		return false;
	}*/

	if(email == '') {
		$('#err_email').fadeIn().html('Please enter email or phone number').css({'color':'red','margin-bottom':'5px'});
        //$('#email').fadeIn().prop('placeholder', 'Please enter email or phone number').css({'color':'red','margin-bottom':'5px'});
		setTimeout(function(){$("#err_email").html("&nbsp;");},3000);
		$("#email").focus();
        $("#email").css('border','1px solid red');
		return false;
	} else {
        if(!isNaN(email)) {
            if(!phoneRegex.test(email)) {
                $("#err_email").fadeIn().html("Please enter a valid phone number").css({'color':'red','margin-bottom':'5px'});
                //$('#email').fadeIn().prop('placeholder', 'Please enter email or phone number').css({'color':'red','margin-bottom':'5px'});
                setTimeout(function(){$("#err_email").html("&nbsp;");},5000)
                $("#email").focus();
                $("#email").css('border','1px solid red');
                return false;
            }
        } else {
            if(!emailRegex.test(email)) {
                $("#err_email").fadeIn().html("Please enter a valid email").css({'color':'red','margin-bottom':'5px'});
                //$('#email').fadeIn().prop('placeholder', 'Please enter email or phone number').css({'color':'red','margin-bottom':'5px'});
                setTimeout(function(){$("#err_email").html("&nbsp;");},5000)
                $("#email").focus();
                $("#email").css('border','1px solid red');
                return false;
            }
        }
    }

	if(password=='') {
		$('#err_password').fadeIn().html('Please enter password').css({'color':'red','margin-bottom':'5px'});
        //$('#password').fadeIn().prop('placeholder', 'Please enter password').css({'color':'red','margin-bottom':'5px'});
		setTimeout(function(){$("#err_password").html("&nbsp;");},3000);
		$("#password").focus();
        $("#password").css('border','1px solid red');
		return false;
	}
   	if(password.length<6) {
		$('#err_password').fadeIn().html('please enter at least 6 character').css({'color':'red','margin-bottom':'5px'});
		setTimeout(function(){$("#err_password").html("&nbsp;");},3000);
		$("#password").focus();
		return false;
	}
	if(conf_password=='') {
		$('#err_confpassword').fadeIn().html('Please enter confirm password').css({'color':'red','margin-bottom':'5px'});
		setTimeout(function(){$("#err_confpassword").html("&nbsp;");},3000);
		$("#conf_password").focus();
		return false;
	}
   	if(conf_password.length<6) {
		$('#err_confpassword').fadeIn().html('please enter at least 6 character').css({'color':'red','margin-bottom':'5px'});
		setTimeout(function(){$("#err_confpassword").html("&nbsp;");},3000);
		$("#conf_password").focus();
		return false;
	}
	if (password != conf_password) {
		$('#err_check_pass').fadeIn().html('Password Mismatch').css({'color':'red','margin-bottom':'5px'});
		setTimeout(function(){$("#err_check_pass").html("&nbsp;");},3000);
		return false;
	}
    if(user_type == '') {
		$('#err_usertype').fadeIn().html('Please select user type').css({'color':'red','margin-bottom':'5px'});
		setTimeout(function(){$("#err_usertype").html("&nbsp;");},3000);
		$("#user_type").focus();
		return false;
	}

    if ($("#agreecheck").is(":checked") == false) {
        $('.erroragree').text('Please agree to the terms and conditions.');
        setTimeout(function(){$(".erroragree").html("&nbsp;");},3000);
        return false; // Prevent form submission
    }

	$.ajax({
		url: base_url+'save',
		type: 'POST',
		//data: {user_type:user_type, first_name:first_name, last_name:last_name, company_name:company_name, email:email, password:password, location:location, latitude:latitude, longitude:longitude},
        data: {user_type:user_type, email:email, password:password, location:location, latitude:latitude, longitude:longitude},
		dataType:'json',
		beforeSend : function(){
			$("#rSignUp").text("Please Wait...");
			$("#rSignUp").prop("disable", "true");
		},
		success:function(returndata) {
			if(returndata.result == 'email') {
				$('#err_email').fadeIn().html('You are already registered with us.').css({'color':'red','margin-bottom':'5px'});
				setTimeout(function(){$("#err_email").html("");},3000);
				$("#email").focus();
				$("#rSignUp").text("Sign Up");
				return false;
			}
			if(returndata.result == 'success') {
				$('#signUp_form').hide();
				$('.select-user').hide();
				$('#register-messages p').text(returndata.data);
				$('#register-messages').show();
				$("#signUp_form")[0].reset();
                // location.href = base_url+'profile';
			// } else if(returndata.result == 'success_email') {
			// 	$('#signUp_form').hide();
			// 	$('.select-user').hide();
			// 	$('#register-messages p').text(returndata.data);
			// 	$('#register-messages').show();
			// 	$("#signUp_form")[0].reset();
            //     setTimeout(function(){
            //         location.href = base_url+'email_verification';
            //     },3000);
			} else {
				$('#err-messages p').text(returndata.data);
				$('#err-messages').show();
				setTimeout(function () {
                 	$('#err-messages').hide();
             	}, 20000);
				$("#rSignUp").text("Sign Up");
			}
		}
	});
}
function checkPass() {
	var x = document.getElementById("password");
  	if (x.type === "password") {
    	x.type = "text";
  	} else {
    	x.type = "password";
  	}
}
function checkConfPass() {
	var x = document.getElementById("conf_password");
  	if (x.type === "password") {
    	x.type = "text";
  	} else {
    	x.type = "password";
  	}
}
