function onblureg(type)
{
	  var vuser;
	  if(type=='user'){  
	    if( $("#reg_username").val() == '' )
	    {
	    	 $("#reg_name").html('<strong>*</strong>请输入用户名'); 
	    	 return false;
	    }else{
	    	
	    	var url = '/index.php/user/regusername?_j='+ new Date().getTime();
	    	$.ajax({'url':url,'async':false,'data':{'username':$("#reg_username").val()},'dataType':'json',
	    	'success':function(rs){
	    	       if( rs.status == false )
	               {
	                   $("#reg_name").html('<strong>*</strong>用户名已经被注册了!');
	                       vuser =  false;
	               }else{  
	            	  $("#reg_name").html('<img src="/img/bm_tck_dg.jpg" />');
	            	       vuser =  true;
	               }
	    	   }     
	    	});
	    	 	
	    }
	    
	  }
	   if(vuser == false)
	   {
		   return false;
	   }
	   
	  
	    if( $("#reg_nickname").val() == '' )
	    {
	    	 $("#reg_nkname").html('<strong>*</strong>请输入真实姓名');
	    	 return false;
	    }else{
	    	$("#reg_nkname").html('<img src="/img/bm_tck_dg.jpg" />');
	    }
	
	
		if( $("#reg_telephone").val() == '' )
	    {
	    	 $("#reg_phone").html('<strong>*</strong>请输入手机号码');
	    	 return false;
	    }else{
	    	var regphone = /1(?:[38]\d|4[57]|5[01256789])\d{8}/;
	        if(!regphone.test($("#reg_telephone").val()))
	        {
	        	$("#reg_phone").html('<strong>*</strong>请输入有效的手机号');
	            return false;
	        }
	    	$("#reg_phone").html('<img src="/img/bm_tck_dg.jpg" />');
	    }
		
	
	if( $("#reg_password").val() == '' ){
    	$("#reg_pwd").html('<strong>*</strong>请输入密码');
   	    return false;
    }else{
    	var eig_pwd =  /^(?!\D+$)(?![^a-zA-Z]+$)\S{8,16}$/; 
    	if(!eig_pwd.test($("#reg_password").val()))
   	    {
   	    	$("#reg_pwd").html('<strong>*</strong>密码长度8~16位，数字、字母、<br />字符至少包含两种');
   	        return false;
   	    }
    	$("#reg_pwd").html('<img src="/img/bm_tck_dg.jpg" />');
    }
	if( $("#reg_password_confim").val() == '' ){
    	$("#reg_cpwd").html('<strong>*</strong>请输入确认密码');
   	    return false;
    }else{
    	$("#reg_cpwd").html('<img src="/img/bm_tck_dg.jpg" />');
    }
	if($("#reg_password").val() != $("#reg_password_confim").val())
	{
	 	$("#reg_cpwd").html('<strong>*</strong>俩次输入的密码不一样');
   	    return false;
    }else{
    	$("#reg_cpwd").html('<img src="/img/bm_tck_dg.jpg" />');
    }
	
    
		if($("#vcode_value").val() == '')
	    {   
			$("#reg_vcode").html('<img src="/img/tck_pic.jpg" />请输入验证码');
	   	    return false;
	    }else{
	    	var url = '/index.php/api/regvcode?_j='+ new Date().getTime();
	    	$.ajax({'url':url,'async':false,'data':{'vcode':$("#vcode_value").val()},'dataType':'json',
	    	'success':function(rs){
	    	       if( rs.status == 'false' )
	               {
	                  var vcode = false;	   
	                  $("#reg_vcode").html('<img src="/img/tck_pic.jpg" />请输入正确的验证码');
	               }else{  
	            	  $("#reg_vcode").html('<img src="/img/bm_tck_dg.jpg" />');
	               }
	    	   }     
	    	});
	    	if( vcode == false ) return false;
	    }
    
	bm_reg();
	
   

}



function bm_reg(){
	
    $.ajax({url: '/index.php/user/ajax_join?_n='+ new Date().getTime(),
        type: 'POST',
        data: {username : $('#reg_username').val(),nickname:$('#reg_nickname').val(), password : $('#reg_password').val(),password_confim : $('#reg_password_confim').val(),telephone: $('#reg_telephone').val()},
        dataType: 'json',
        beforeSend : function(){
        },
        error: function(){
        },
        success: function(data){
            if (data['status'] == 'success'){
                //alert(data['msg']);
                window.location.reload();
            }else if(data['status'] == 'falis'){
            	alert(data['msg']);
            }
        },
        complete : function(){
        }
    });
}



function bm_login(){
    
	$.ajax({url: '/index.php/user/ajax_login?_n='+ new Date().getTime(),
        type: 'POST',
        data: {username : $('#bm_username').val(), password : $('#bm_password').val()},
        dataType: 'json',
        beforeSend : function(){
        },
        error: function(){
        },
        success: function(data){
            if (data['status'] == 'success'){
                //alert(data['msg']);
                window.location.reload();
            }else if(data['status'] == 'falis'){
            	alert(data['msg']);
            }
        },
        complete : function(){
        }
    });
}


//更换验证码
function lvcode()
{
	document.getElementById('vcode').src='/index.php/api/vcode?_j='+Math.random();	
}
function upimg_reg()
{
	var title   = $("#title").val();
	var img     = $("#img").val();
	var content = $("#content").val();                        
    
	if(title == '')
    {
    	$("#img_title").html('请输入作品标题!');
        return false;
    }
	if(img == '')
    {
    	$("#img_val").html('请上传作品!');
        return false;
    }
	if(content == '')
    {
    	$("#img_content").html('请输入活动宣言!');
        return false;
    }
    return true;
}

