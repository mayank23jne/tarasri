$(document).on('submit','.database_operation_form',function(){
    var url=$(this).attr('action');
    var data=new FormData($(this)[0]);
    $.ajax({
        type:'POST',
        url:url,
        data:data,
        contentType:false,
        processData:false,
        success:function(fb)
        {
            var resp=$.parseJSON(fb);
            if(resp.status=='true')
            {
                $('.database_operation_form').trigger('reset');
                //swal('Success',resp.message,'success');
                 toastr.success(resp.message,'Success');
                 setTimeout(function(){
                    window.location.href=resp.reload;
                 },1000)
                    
            }
            else
            {
               toastr.error(resp.message,'Warning');
            }
        }


    });
    return false;
});