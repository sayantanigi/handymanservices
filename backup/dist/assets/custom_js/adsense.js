function create_adsense() {
	var admin_url=$('#admin_url').val();
	var title=$('#title').val();
	var link=$('#link').val();
	if(title=="") {
		$("#title_err").fadeIn().html("Please Enter Title").css("color","red");
		setTimeout(function(){$("#title_err").fadeOut("&nbsp;");},2000)
		$("#title").focus();
		return false;
	}
	var form_data= new FormData();
	var image =$('#image')[0].files[0];
	form_data.append('image',image);
	form_data.append('title',title);
	form_data.append('link',link);
	$.ajax({
		type:"post",
		url:admin_url+"Adsense/create_action",
		cache:false,
		contentType: false,
		processData:false,
		async:false,
		data:form_data,
		success:function(returndata) {
			if(returndata==1) {
				location.reload();
			} else{
				$("#adsense_err").fadeIn().html("This adsense already exits ").css("color","red");
				setTimeout(function(){$("#adsense_err").fadeOut("&nbsp;");},2000)
				$("#title").focus();
				return false;
			}
		}
	});
}

function getValue(id) {
	var admin_url = $("#admin_url").val();
	$.ajax({
		type:'post',
		cache:false,
		url:admin_url+'Adsense/get_value',
		data:{
			id:id,
		},
		success:function(returndata) {
			var obj=$.parseJSON(returndata);
			$("#edit_title").val(obj.title);
			$("#edit_link").val(obj.link);
			$("#id").val(obj.id);
			$("#show_img").html(obj.image);
			$("#old_image").val(obj.old_image);
		}
	});
}

function update_adsense() {
	var admin_url=$('#admin_url').val();
	var title=$('#edit_title').val();
	var link=$('#edit_link').val();
	var old_image=$("#old_image").val();
	var id=$("#id").val();
	if(title=="") {
		$("#edit_title_err").fadeIn().html("Please Enter Title").css("color","red");
		setTimeout(function(){$("#edit_title_err").fadeOut("&nbsp;");},2000)
		$("#edit_title").focus();
		return false;
	}
	var form_data= new FormData();
	var image=$('#edit_image')[0].files[0];
	form_data.append('image',image);
	form_data.append('title',title);
	form_data.append('link',link);
	form_data.append('old_image',old_image);
	form_data.append('id',id);
	$.ajax({
		type:"post",
		url:admin_url+"Adsense/update_action",
		cache:false,
		contentType: false,
		processData:false,
		async:false,
		data:form_data,
		success:function(returndata) {
			if(returndata==1) {
				location.reload();
			} else {
				$("#edit_title_err").fadeIn().html("This adsense already exits ").css("color","red");
				setTimeout(function(){$("#edit_title_err").fadeOut("&nbsp;");},2000)
				$("#edit_title").focus();
				return false;
			}
		}
	});
}

function adsenseDelete(obj,cid) {
	var admin_url=$('#admin_url').val();
	$.confirm({
	    title: 'Confirm!',
	    content: confirmTextDelete,
	    buttons: {
	        confirm: function () {
	            $(".id"+cid).fadeOut();
				var datastring="cid="+cid;
				$.ajax({
					type:"POST",
					url:admin_url+'Adsense/delete',
					data:datastring,
					cache:false,
					success:function(returndata) {
						if(returndata = 1){
							location.reload();
							table.draw();
						} else if(returndata = 0){
							location.reload();
							table.draw();
						}
					}
				});
	        },
	        cancel: function () {
	            location.reload();
	        },
	    }
	});
}
