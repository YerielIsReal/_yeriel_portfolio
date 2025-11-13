
//
$_POST_TEST = function(form,url){
	$.ajax({
		type: "POST", 
		url: url, 
		dataType : "html", 
		timeout : 5000, 
		cache : false, 
		contentType: "application/x-www-form-urlencoded; charset=UTF-8", 
		data: $('#'+form).serialize(),
		success: function(data){
			alert(data);
		}
		,error: function(request, status, error){
			alert("ajax error");
		}
	});
}


//
$_POST = function(form,url){
	$('#'+form).ajaxForm({
		url:url,
		dataType : 'text', 
		beforeSerialize: function(){
			var loader = $("[id$='loader']").length;
			var formbtn = $("[id$='formbtn']").length;
			var percent = $("[id$='percent']").length;
			if(percent) $('#percent').show();
			if(loader&&formbtn){
				$('#formbtn').hide();
				$('#loader').show();
			}
		},
		//beforeSubmit : function(){},
		uploadProgress: function(event, position, total, percentComplete){
			var progress_ck; 
			try{
				progress_ck=$.isFunction(progress);
			}catch (err) { 
				progress_ck = false; 
			}
			if(progress_ck) progress();
			else{
				var percent = $("[id$='percent']").length;
				if(percent) $('#percent').html(percentComplete+'%');
			}
		},
		success : function(data) {
			var status = $("[id$='status']").length;
			if(status){
				$('#status').html(data);
			}
			try{ 
				eval(data);
			}catch (err) { 
				alert('오류가 발생하였습니다. 잠시후에 다시 이용해주세요.');
			}
			
		},
		complete : function() {
			var complete_ck; 
			try{ 
				complete_ck=$.isFunction(complete); 
			}catch (err) { 
				complete_ck = false; 
			}
			if(complete_ck) complete();
			else{
				var loader = $("[id$='loader']").length;
				var formbtn = $("[id$='formbtn']").length;
				var percent = $("[id$='percent']").length;
				if(percent) $('#percent').hide();
				if(loader&&formbtn){
					$('#loader').hide();
					$('#formbtn').show();
				}
			}
		}
	});
	$('#'+form).submit();
};