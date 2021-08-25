$(document).ready(function() {
	if($('.blog-carousel').length>0){
		// setTimeout(function(){
			if (screen.width < 250){
				$('.container-slider').carousel1({
					num: 5,
					maxWidth: 125,
					maxHeight: 100,
					distance: 20,
					scale: 0.8,
					animationTime: 1000,
					showTime: 4000
				});
			} else if (screen.width < 576){
				$('.container-slider').carousel1({
					num: 5,
					maxWidth: 225,
					maxHeight: 190,
					distance: 15,
					scale: 0.8,
					animationTime: 1000,
					showTime: 4000
				});
			}  else if (screen.width < 768){
				$('.container-slider').carousel1({
					num: 5,
					maxWidth: 250,
					maxHeight: 150,
					distance: 20,
					scale: 0.8,
					animationTime: 1000,
					showTime: 4000
				});
			} else if (screen.width < 992){
				$('.container-slider').carousel1({
					num: 5,
					maxWidth: 400,
					maxHeight: 275,
					distance: 20,
					scale: 0.9,
					animationTime: 1000,
					showTime: 4000
				});
			} else if (screen.width < 1170){
				$('.container-slider').carousel1({
					num: 5,
					maxWidth: 500,
					maxHeight: 300,
					distance: 20,
					scale: 0.9,
					animationTime: 1000,
					showTime: 4000
				});
			} else {
				$('.container-slider').carousel1({
					num: 5,
					maxWidth: 778,
					maxHeight: 580,
					distance: 40,
					scale: 0.9,
					animationTime: 1000,
					showTime: 4000
				});
			}
		// },2000);
	}
});
$(document).on('click','.product_form_submit',function(){
    let userId = $('#fev_user_id').val();
    let _token = $("input[name='_token']").val();
    let message = $('#message').val();
    if(message=='') {
        $("#feedbackSection").css({background: "red",height: "80px",display: "block"});
        $("#feedbackSection").html("<span>Please Enter Message</span>");
        setTimeout(()=>{
            $("#feedbackSection").css({display: "none"});
        },2000);
    } else {
         $.get(BASE_URL+'/getFevList/'+userId,function(fb){
        	let resp = $.parseJSON(fb);
        	console.log(resp.status)
        	if(resp.status=="true") {
                resp.data.map((item)=>{
                	$.post(BASE_URL+'/product_enquiry',{message:message,user_id:userId,product_id:item.product_id,_token:_token},function(fb){
                		console.log(fb);
                	})
                })
                 $("#feedbackSection").css({background: "green",height: "80px",display: "block"});
                    $("#feedbackSection").html("<span>Success</span>");
                    setTimeout(()=>{
                        $("#feedbackSection").css({display: "none"});
                 },2000);
                 $('#myModal11').modal('hide');
        	} else {
                console.log(resp.data);
        	}
        })     
    }
   
});