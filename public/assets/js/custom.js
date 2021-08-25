$(document).on('click','.delete_image',function(){
	var _this=$(this);
	var id = $(this).attr('data-id');
	$.get(BASE_URL+'/admin/products/delete_prod_image_final/'+id,function(fb){
		$(_this).parent('.img_block_small').remove();
	})
});

$(document).on('click','.remove_image',function(){
	var _this=$(this);
	var image = $(this).attr('data-image');
	var image_str=$('#image').val();
	 var res = image_str.split(",");
	 console.log(res)
	var new_str='';
	var k=0;
	for(i=0;i<res.length;i++)
	{
		if(res[i]!=image)
		{
			if(k==0)
			{ 
				new_str+=res[i];
			}
			else 
			{
				new_str+=','+res[i];
			}
			k++;
		}
	}
	$('#image').val(new_str);
	$(_this).parent('.img_block_small').remove();
});
CKEDITOR.config.height = 150;
CKEDITOR.config.width = 'auto';
CKEDITOR.config.extraPlugins = 'embedbase';
CKEDITOR.config.embed_provider = 'https://ckeditor.iframe.ly/api/oembed?url={url}&callback={callback}';
CKEDITOR.config.autoEmbed_widget = 'customEmbed';
var initSample = ( function() { 
    if($('textarea').hasClass('blog_description')) {
	var wysiwygareaAvailable = isWysiwygareaAvailable(),
		isBBCodeBuiltIn = !!CKEDITOR.plugins.get( 'bbcode' );

	return function() {
		var editorElement = CKEDITOR.document.getById( 'blog_description' );

		// :(((
		if ( isBBCodeBuiltIn ) {
			editorElement.setHtml(
				'Hello world!\n\n' +
				'I\'m an instance of [url=https://ckeditor.com]CKEditor[/url].'
			);
		}

		// Depending on the wysiwygarea plugin availability initialize classic or inline editor.
		if ( wysiwygareaAvailable ) {
			CKEDITOR.replace( 'blog_description',{
			//extraPlugins: "embed",
			filebrowserUploadUrl: $('#ck_url').val(),
			filebrowserUploadMethod: 'form',
			linkShowTargetTab:'false'
			});
		} else {
			editorElement.setAttribute( 'contenteditable', 'true' );
			CKEDITOR.inline( 'blog_description' );

			// TODO we can consider displaying some info box that
			// without wysiwygarea the classic editor may not work.
		}
	};

	function isWysiwygareaAvailable() {
		// If in development mode, then the wysiwygarea must be available.
		// Split REV into two strings so builder does not replace it :D.
		if ( CKEDITOR.revision == ( '%RE' + 'V%' ) ) {
			return true;
		}

		return !!CKEDITOR.plugins.get( 'wysiwygarea' );
	}
 }
} )();
 if($('textarea').hasClass('blog_description')) {
    initSample();
 }
 
 if($('textarea').hasClass('lendingpage_description'))
 {
	 CKEDITOR.replace('description[]', {
		/*filebrowserUploadUrl: "{{route('upload', ['_token' => csrf_token() ])}}",
		filebrowserUploadMethod: 'form',
		linkShowTargetTab:'false'*/
		extraPlugins: "N1ED-editor"
	});
 }
(function($){
    $(window).on("load",function(){
      $(".mcs-horizontal-example").mCustomScrollbar({
        axis:"x",
        theme:"dark-3"
      });
    });
    $(".multi-select-dropdown").select2({
        closeOnSelect:false,
        placeholder: "Select"
    });
  })(jQuery);
$(document).on('change','#cart_year_filter',function(){
	var year=$(this).val();
	window.location.href=BASE_URL+'/admin/dashboard/'+year;
});
$(document).on('submit','.database_operation_form',function(){
    var url=$(this).attr('action');
    var data=new FormData($(this)[0]);
    var popup=$(this).attr('data-pop');
    $(".form_btn").prop('disabled', true);
    $.ajax({
        type:'POST',
        url:url,
        data:data,
        contentType:false,
        processData:false,
        success:function(fb)
        {
            $('.form_btn').removeAttr('disabled');
            var resp=$.parseJSON(fb);
            if(resp.status=='true')
            {
               
                //swal('Success',resp.message,'success');
                
				toastr.success(resp.message,'Success');
                $(popup).modal('hide');
                if(resp.reload==0)
                {
                    $('.database_operation_form').trigger('reset');
                    $('.dataTable').DataTable().ajax.reload();
                }
                else if(resp.reload==5)
                {

                }
                else
                {
                    window.location.href=resp.reload;
                }
            }
            else
            {
                var type=typeof resp.message;
                if(type=='object')
                {
                    msg='';
                    $.each( resp.message, function( key, value ) {
                       msg+=' '+value;
                     });
                    toastr.error(msg,'Warning');
                }
                else 
                {
                  toastr.error(resp.message,'Warning');
                }
            }
        },
		error:function(e){
			console.log(e);
		}


    });
    return false;
});
$(document).on('submit','.database_operation_form_new',function(){
    var url=$(this).attr('action');
    var data=new FormData($(this)[0]);
    var popup=$(this).attr('data-pop');
    $(".form_btn").prop('disabled', true);
    $.ajax({
        type:'POST',
        url:url,
        data:data,
        contentType:false,
        processData:false,
        success:function(fb)
        {
            $('.form_btn').removeAttr('disabled');
            var resp=$.parseJSON(fb);
            if(resp.status=='true')
            {
               
                //swal('Success',resp.message,'success');
                
				toastr.success(resp.message,'Success');
                $(popup).modal('hide');
                if(resp.reload==0)
                {
                    $('.database_operation_form_new').trigger('reset');
                    $('.dataTable').DataTable().ajax.reload();
                }
                else if(resp.reload==5)
                {

                }
                else
                {
                    window.location.href=resp.reload;
                }
            }
            else
            {
                var type=typeof resp.message;
                if(type=='object')
                {
                    msg='';
                    $.each( resp.message, function( key, value ) {
                       msg+=' '+value;
                     });
                    toastr.error(msg,'Warning');
                }
                else 
                {
                  toastr.error(resp.message,'Warning');
                }
            }
        }


    });
    return false;
});
$(document).on('click','.delete_landing_page',function(){
	if(confirm('Do You Want To Delete This Landing Page'))
     {
		var id=$(this).attr('data-id');
        var token=$("input[name='_token']").val();
		$.post(BASE_URL+'/admin/landing_page_operation',{'action':'delete','_token':token,'id':id},function(fb){
            location.reload();
        });
	 }
});
var cout=1;
$(document).on('click','.add_new_editor',function(){
	$('#editor_block').append('<div class="form-group"><label>Enter description </label><textarea name="description[]" class="mt-4 desc_'+cout+'" id="desc_'+cout+'"></textarea></div>'); 
	 
	 
	 	var wysiwygareaAvailable = isWysiwygareaAvailable(),
		isBBCodeBuiltIn = !!CKEDITOR.plugins.get( 'bbcode' );

		var editorElement = CKEDITOR.document.getById( 'desc_'+cout);

		// :(((
		if ( isBBCodeBuiltIn ) {
			editorElement.setHtml(
				'Hello world!\n\n' +
				'I\'m an instance of [url=https://ckeditor.com]CKEditor[/url].'
			);
		}

		// Depending on the wysiwygarea plugin availability initialize classic or inline editor.
		if ( wysiwygareaAvailable ) {
			CKEDITOR.replace( 'desc_'+cout);
		} else {
			editorElement.setAttribute( 'contenteditable', 'true' );
			CKEDITOR.inline( 'desc_'+cout);

			// TODO we can consider displaying some info box that
			// without wysiwygarea the classic editor may not work.
		}

	function isWysiwygareaAvailable() {
		// If in development mode, then the wysiwygarea must be available.
		// Split REV into two strings so builder does not replace it :D.
		if ( CKEDITOR.revision == ( '%RE' + 'V%' ) ) {
			return true;
		}

		return !!CKEDITOR.plugins.get( 'wysiwygarea' );
	}
	
	
	cout++;
});
$(document).ready(function(){
    $('.local_datatable').DataTable({
        responsive:true,
    });
    if($('table').hasClass('datatable'))
    { 
        var url=$('.datatable').attr('data-url');
        var json_url=$('.datatable').attr('json-url');
        $.get(json_url,function(fb){
        $('.datatable').DataTable({ 
            processing: true,
            serverSide: true,
            ajax:{
             url:url,
            },
            columns:$.parseJSON(fb),
           });
        });
       
    }
    $('.datatable_local').DataTable();
});
$(document).on('change','.manage_status',function(){
    var id=$(this).attr('data-id');
    var url=$(this).attr('data-url');
    var token=$("input[name='_token']").val();
    var status = $("input[name='status_"+id+"']:checked").val();
    if(!status)
        status=0;
    $.post(url,{'id':id,'status':status,'action':'status','_token':token},function(fb){
        toastr.success('Status Successfully Changed','Success');
    })
});
$(document).on('click','.update_role',function(){
    var id=$(this).attr('data-id');
    var data_url=$(this).attr('data-url');
    var token=$("input[name='_token']").val();
    $.post(data_url,{id:id,'_token':token,'action':'get_update_info'},function(fb){
        $('#form_block').html(fb);
        $('#update_role_popup').modal('show');
    })
});
$(document).on('click','.update_user',function(){
    var id=$(this).attr('data-id');
    var name=$(this).attr('data-name');
    var email=$(this).attr('data-email');
    var mobile=$(this).attr('data-mobile');
    var role=$(this).attr('data-role');
    $('#name').val(name);
    $('#id').val(id);
    $('#email').val(email);
    $('#mobile').val(mobile);
    $('#email').val(email);
    $('#r1').prop("selected", true);
    $('#role_'+role).prop("selected", true);
    $('#update_user_popup').modal('show');
});
$(document).on('change','#role_filter',function(){
    var id=$(this).val();
    var url=$('.datatable').attr('data-url');
    var json_url=$('.datatable').attr('json-url');
   // url=url+'/'+id;
    $.get(json_url,function(fb){
    $('.datatable').DataTable().destroy();
    $('.datatable').DataTable({ 
        processing: true,
        serverSide: true,
        ajax:{
         url:url,
         data:{'role':id}
        },
        columns:$.parseJSON(fb),
       });
    });
});
$(document).on('click','.delete_meta_seo',function(){
    var id=$(this).attr('data-id');
    if(confirm("Do You Want To Delete This"))
    {
        var token=$("input[name='_token']").val();
        $.post(BASE_URL+'/admin/setting/meta_seo_manage_operation',{'id':id,'action':'delete','_token':token},function(fb){
            toastr.success('Successfully Deleted','Success');
            $('.dataTable').DataTable().ajax.reload();
        }) 
    }
});
$(document).on('click','.update_meta_seo',function(){
    var id=$(this).attr('data-id');
    var page_name=$(this).attr('data-page');
    var title=$(this).attr('data-title');
    var description=$(this).attr('data-description');
    var keywords=$(this).attr('data-keywords');
    $('#id').val(id);
    $('#'+page_name).prop("selected", true);
    $('#title').val(title);
    $('#description').val(description);
    $('#keywords').val(keywords);
    $('#update_meta_data').modal('show');
});
$(document).on('click','.delete_seo_file',function(){
 if(confirm('Do You Want To Delete This File')) {
        var id=$(this).attr('data-id');
        var token=$("input[name='_token']").val();
        $.post(BASE_URL+'/admin/setting/delete_seo_file',{'id':id,'_token':token},function(){
            location.reload();
        })
    }
});
$(document).on('click','.update_seo_file',function(){
    var id=$(this).attr('data-id');
    var title=$(this).attr('data-title');
    $('#file_id').val(id);
    $('#file_title').val(title);
    $('#edit_seo_file_popup').modal('show');
});
$(document).on('click','.delete_blog',function(){
    if(confirm('Do You Want To Delete This Blog'))
    {
        var id=$(this).attr('data-id');
        var token=$("input[name='_token']").val();
        $.post(BASE_URL+'/admin/blog_operation/',{'action':'delete','_token':token,'id':id},function(fb){
           // location.reload();
        });
       /* $.post(BASE_URL+'/admin/blog_operation/',{'action':'delete','_token':token,'id':id},function(){
            location.reload();
        });
        */
    }
    
});
$(document).on('click','.update_category',function(){
    var id=$(this).attr('data-id');
    var cat=$(this).attr('data-cat');
    $('#cat_id').val(id);
    $('#cat_name').val(cat);
    $('#update_cat_popup').modal('show');
});
$(document).on('click','.update_collection',function(){
    var id=$(this).attr('data-id');
    var col=$(this).attr('data-col');
    var alt=$(this).attr('data-alt');
    var slug=$(this).attr('data-slug');
    $('#col_id').val(id);
    $('#col_name').val(col);
    $('#alt_text').val(alt);
    $('#slug').val(slug);
    $('#update_col_popup').modal('show');
});
$(document).on('click','.update_occasion',function(){
    var id=$(this).attr('data-id');
    var col=$(this).attr('data-oc');
    $('#oc_id').val(id);
    $('#oc_name').val(col);
    $('#update_col_popup').modal('show');
});
$(document).ready(function() {
	$(".drop-area").on('dragenter', function (e){
	e.preventDefault();
	$(this).css('background', 'white');
	});

	$(".drop-area").on('dragover', function (e){
	e.preventDefault();
	});

	$(".drop-area").on('drop', function (e){
	$(this).css('background', 'white');
	e.preventDefault();
    var image = e.originalEvent.dataTransfer.files;
	console.log(image);
    var id=$('.drop-area').attr('data-id');
	createFormData(image,id);
    });
    
   /* fevicon upload */
    $("#drop-fevicon").on('dragenter', function (e){
    e.preventDefault();
    $(this).css('background', 'white');
    });

    $("#drop-fevicon").on('dragover', function (e){
    e.preventDefault();
    });

    $("#drop-fevicon").on('drop', function (e){
    $(this).css('background', 'white');
    e.preventDefault();
    var image = e.originalEvent.dataTransfer.files;
    var id=$('#drop-fevicon').attr('data-id');
    createFormData_fevicon(image,id);
    });
});
function createFormData(image,id) {
    var type=$(id).attr('data-key');
    var token=$("input[name='_token']").val();
	var formImage = new FormData();
	if($('div').hasClass('manage_product_block_page'))
	{ 
		 for(i=0; i<image.length; i++) {  
			formImage.append('image[]', image[i]);  
		 }
	}
	else 
	{
		formImage.append(type, image[0]);  
	}
    formImage.append('action', type);
    formImage.append('_token', token);
	uploadFormData(formImage,id);
}
var product_image_count=0;
function uploadFormData(formData,id) {
  $('#loader1').removeClass('hide_div');
  $('#page_overlay').removeClass('hide_div');
   $.ajax({
	url: $(id).attr('data-url'),
	type: "POST",
	data: formData,
	contentType:false,
	cache: false,
	processData: false,
	success: function(data){
        $('#loader1').addClass('hide_div');
        $('#page_overlay').addClass('hide_div');
        var resp=$.parseJSON(data)
        if(resp.status=='true')
        {
			if($('div').hasClass('product_image_box'))
			{
				$('.upload_placeholder').remove();
				if(!$('div').hasClass('edit_prod'))
				{
					$('.product_image_box').append('<div id="product_image_display_box"></div>');
				}
			}
			
			if($('div').hasClass('manage_product_block_page'))
			{
				console.log(resp.image);
				for(ii=0;ii<resp.image.length;ii++)
				{
					$('#product_image_display_box').append('<div class="img_block_small"><a data-image="'+resp.image[ii]+'" class="remove_image" href="javascript:;" >X</a><img class="product_upload_image A"   src="'+BASE_URL+'/'+resp.image[ii]+'" alt="logo" ></div>');
				}
				var img= $('#image').val();
					if(img)
					{
						var new_img=img+','+resp.str;
					}
					else 
					{
						var new_img=resp.str;
					}
					$('#image').val(new_img);
			}
			else 
			{
				var str = resp.image;
				var res = str.split("tarasri.in");
				$('#disp_image').attr({'src':resp.image});
				$('#disp_image').css({'display':'block'});
				if(!$('div').hasClass('product_image_box'))
				{
					$(id).children('img').attr({'src':resp.image});
					$('#disp_image').addClass('disp_img_after');
					$('#image').val(res[1]);
				}
				else 
				{
					
					$('#product_image_display_box').append('<div class="img_block_small"><a data-image="'+res[1]+'" class="remove_image" href="javascript:;" >X</a><img class="product_upload_image A"   src="'+resp.image+'" alt="logo" ></div>');
					var img= $('#image').val();
					if(img)
					{
						var new_img=img+','+res[1];
					}
					else 
					{
						var new_img=res[1];
					}
					$('#image').val(new_img);
				}

			}
			
            $('#drag_image_text').css({'display':'none'});
            $('.image_delete_btn').css({'display':'block'});
        }
        else
        {
            var type=typeof resp.message;
            if(type=='object')
            {
                msg='';
                $.each( resp.message, function( key, value ) {
                    msg+=' '+value;
                    });
                toastr.error(msg,'Warning');
            }
            else 
            {
                toastr.error(resp.message,'Warning');
            }
        }
	}
});
}

function createFormData_fevicon(image,id) {
    var type=$(id).attr('data-key');
    var token=$("input[name='_token']").val();
	var formImage = new FormData();
    formImage.append(type, image[0]);
    formImage.append('action', type);
    formImage.append('_token', token);
	uploadFormData_fevicon(formImage,id);
}

function uploadFormData_fevicon(formData,id) {
    $('#loader1').removeClass('hide_div');
    $('#page_overlay').removeClass('hide_div');
    $.ajax({
	url: $('#drop-fevicon').attr('data-url'),
	type: "POST",
	data: formData,
	contentType:false,
	cache: false,
	processData: false,
	success: function(data){
        $('#loader1').addClass('hide_div');
        $('#page_overlay').addClass('hide_div');
        var resp=$.parseJSON(data)
        if(resp.status=='true')
        {
            $('#fevicon_show').attr({'src':resp.image});
        }
        else
        {
            var type=typeof resp.message;
            if(type=='object')
            {
                msg='';
                $.each( resp.message, function( key, value ) {
                    msg+=' '+value;
                    });
                toastr.error(msg,'Warning');
            }
            else 
            {
                toastr.error(resp.message,'Warning');
            }
        }
	}
});
}

$(document).on('change','.upload_image',function(){
    var frm=$(this).attr('data-from');
    var parent=$(this).attr('data-parent');
    var data=new FormData($(frm)[0]);
    var name=$(this).attr('name');
    $('#loader1').removeClass('hide_div');
    $('#page_overlay').removeClass('hide_div');
    $.ajax({
        type:'POST',
        url:$(frm).attr('data-image'),
        data:data,
        contentType:false,
        processData:false,
        success:function(fb)
        {
            $('#loader1').addClass('hide_div');
            $('#page_overlay').addClass('hide_div');
            var resp=$.parseJSON(fb);
            if(resp.status=='true')
            {
				if($('div').hasClass('product_image_box'))
				{
					$('.upload_placeholder').remove();
					if(!$('div').hasClass('edit_prod'))
					{
						$('.product_image_box').append('<div id="product_image_display_box"></div>');
					}
				}
				
				
			if($('div').hasClass('manage_product_block_page'))
			{
                for(var ii=0;ii<resp.image.length;ii++)
				{
					$('#product_image_display_box').append('<div class="img_block_small"><a data-image="'+resp.image[ii]+'" class="remove_image" href="javascript:;" >X</a><img class="product_upload_image A"   src="'+BASE_URL+'/'+resp.image[ii]+'" alt="logo" ></div>');
					
				}
				var img= $('#image').val();
				if(img)
				{
					var new_img=img+','+resp.str;
				}
				else 
				{
					var new_img=resp.str;
				}
				$('#image').val(new_img);
			}
			else 
			{
				$(parent).children('img').attr({'src':resp.image});
                var str = resp.image;
                var res = str.split("tarasri.in");
                if(name=='fevicon')
                    $('#fevicon_show').attr({'src':resp.image});
                else 
				{
					if(!$('div').hasClass('product_image_box'))
					{
						alert('dfd')
						$('#disp_image').children('img').attr({'src':resp.image});
						$('#disp_image').addClass('disp_img_after');
						$('#image').val(res[1]);
					}
					else 
					{
						$('#product_image_display_box').append('<div class="img_block_small"><a data-image="'+res[1]+'" class="remove_image" href="javascript:;" >X</a><img class="product_upload_image"  src="'+resp.image+'" alt="logo" ></div>');
						var img= $('#image').val();
						if(img)
						{
							var new_img=img+','+res[1];
						}
						else 
						{
							var new_img=res[1];
						}
						$('#image').val(new_img);
					}
				}
			}



                $('#disp_image').css({'display':'block'});
                $('#drag_image_text').css({'display':'none'});
                $('.image_delete_btn').css({'display':'block'}); 
                $('#disp_image').addClass('disp_img_after');
                $('#drag_image_text').css({'display':'none'});
				
				
				
            }
            else
            {
                var type=typeof resp.message;
                if(type=='object')
                {
                    msg='';
                    $.each( resp.message, function( key, value ) {
                       msg+=' '+value;
                     });
                    toastr.error(msg,'Warning');
                }
                else 
                {
                  toastr.error(resp.message,'Warning');
                }
            }
        }


    });

});
$(document).on('change','.upload_image_blog',function(){
    var frm=$(this).attr('data-from');
    var parent=$(this).attr('data-parent');
    var data=new FormData($(frm)[0]);
    var name=$(this).attr('name');
    $('#loader1').removeClass('hide_div');
    $('#page_overlay').removeClass('hide_div');
    $.ajax({
        type:'POST',
        url:$(frm).attr('data-image'),
        data:data,
        contentType:false,
        processData:false,
        success:function(fb)
        {
            $('#loader1').addClass('hide_div');
            $('#page_overlay').addClass('hide_div');
            var resp=$.parseJSON(fb);
            if(resp.status=='true')
            {
				$('.upload_placeholder').remove();
				$('.product_image_box').append('<div id="product_image_display_box"></div>');	
				var str = resp.image;
				var res = str.split("tarasri.in");
				$('#disp_image').attr({'src':resp.image});
				$('#disp_image').css({'display':'block'});
			   
					$('#product_image_display_box').append('<img data-alt="" data-id="'+resp.reff_id+'" class="product_upload_image blog_image"  src="'+resp.image+'" alt="logo" >');
					$('#ref_id').val(resp.reff_id);
					$('#blog_image_alt').modal('show'); 
					$('#image').val(1);
				
				$('#drag_image_text').css({'display':'none'});
            }
            else
            {
                var type=typeof resp.message;
                if(type=='object')
                {
                    msg='';
                    $.each( resp.message, function( key, value ) {
                       msg+=' '+value;
                     });
                    toastr.error(msg,'Warning');
                }
                else 
                {
                  toastr.error(resp.message,'Warning');
                }
            }
        }


    });

});
$(document).on('change','.upload_video',function(){
    var data=new FormData($('.database_operation_form')[0]);
    $('#loader1').removeClass('hide_div');
    $('#page_overlay').removeClass('hide_div');
    $.ajax({
        type:'POST',
        url:BASE_URL+'/admin/products/upload_product_video',
        data:data,
        contentType:false,
        processData:false,
        success:function(fb)
        {
            $('#loader1').addClass('hide_div');
            $('#page_overlay').addClass('hide_div');
            var resp=$.parseJSON(fb);
            if(resp.status=='true')
            {
                var str = resp.image;
                var res = str.split("tarasri.in");
                $('#disp_video').css({'display':'block'});
                $('#disp_video').html('<div class="upload_placeholder_video_block"><span class="video_delete_btn delete_btn_video">x</span><video width="250" height="180" controls><source src="'+resp.image+'" type="video/mp4">Your browser does not support the video tag.</video></div>');
                $('.video_delete_btn').css({'display':'block'});
                $('#video').val(res[1]);
            }
            else
            {
                var type=typeof resp.message;
                if(type=='object')
                {
                    msg='';
                    $.each( resp.message, function( key, value ) {
                       msg+=' '+value;
                     });
                    toastr.error(msg,'Warning');
                }
                else 
                {
                  toastr.error(resp.message,'Warning');
                }
            }
        }


    });
});
$(document).on('click','#product_image',function(){
    var image = $('#image').val();
    var token=$("input[name='_token']").val();
    $.post(BASE_URL+'/admin/delete_image',{'_token':token,'image':image},function(fb){
        $('#image').val('');
        $('#product_image').css({'display':'none'});
        $('#disp_image').attr('src',BASE_URL+'/public/setting/upload-img.png');
        $('#disp_image').removeClass('disp_img_after');
    })
});
$(document).on('click','.video_delete_btn',function(){
    var image = $('#video').val();
    var token=$("input[name='_token']").val();
    $.post(BASE_URL+'/admin/delete_image',{'_token':token,'image':image},function(fb){
             $('#video').val('');
             $('#disp_video').html('<div class="upload_placeholder"><img  src="'+BASE_URL+'/public/setting/upload-video.png" alt="logo" ><p>Upload Video</p></div>');
             $('.video_delete_btn').css({'display':'none'});
    })
});

/* product video upload start */
$(document).ready(function(){
    $(".drop-video").on('dragenter', function (e){
    e.preventDefault();
    $(this).css('background', 'white');
    });

    $(".drop-video").on('dragover', function (e){
    e.preventDefault();
    });

    $(".drop-video").on('drop', function (e){
    $(this).css('background', 'white');
    e.preventDefault();
    var image = e.originalEvent.dataTransfer.files;
    var id=$('.drop-video').attr('data-id');
    createFormDataVideo(image,id);
    });
});
function createFormDataVideo(image,id) {
    var type=$(id).attr('data-key');
    var token=$("input[name='_token']").val();
	var formImage = new FormData();
    formImage.append(type, image[0]);
    formImage.append('action', type);
    formImage.append('_token', token);
	uploadFormDataVideo(formImage,id);
}
function uploadFormDataVideo(formData,id) {
    $('#loader1').removeClass('hide_div');
    $('#page_overlay').removeClass('hide_div');
    $.ajax({
     url: $(id).attr('data-url'),
     type: "POST",
     data: formData,
     contentType:false,
     cache: false,
     processData: false,
     success: function(data){
        $('#loader1').addClass('hide_div');
        $('#page_overlay').addClass('hide_div');
         var resp=$.parseJSON(data)
         if(resp.status=='true')
         {
             var str = resp.image;
             var res = str.split("tarasri.in");
             $(id).children('img').attr({'src':resp.image});
            // $('#disp_video').attr({'src':resp.image});
             $('#disp_video').css({'display':'block'});
             $('#disp_video').html('<div class="upload_placeholder_video_block"><span class="video_delete_btn delete_btn_video">x</span><video width="250" height="180" controls><source src="'+resp.image+'" type="video/mp4">Your browser does not support the video tag.</video></div>');
             $('.video_delete_btn').css({'display':'block'});
             $('#video').val(res[1]);
         }
         else
         {
             var type=typeof resp.message;
             if(type=='object')
             {
                 msg='';
                 $.each( resp.message, function( key, value ) {
                     msg+=' '+value;
                     });
                 toastr.error(msg,'Warning');
             }
             else 
             {
                 toastr.error(resp.message,'Warning');
             }
         }
     }
 });
 }
/* product video upload end */
$(document).on('change','.home_category',function(){
    var id=$(this).val();
    var data=$(this).attr('data-id');
    $.get(BASE_URL+'/admin/setting/get_product_list/'+id,function(fb){
        $(data).html(fb);
    })
});
/* home page image */
$(document).ready(function(){
    $(".home-image-upload").on('dragenter', function (e){
    e.preventDefault();
    $(this).css('background', 'white');
    });

    $(".home-image-upload").on('dragover', function (e){
    e.preventDefault();
    });

    $(".home-image-upload").on('drop', function (e){
    var index=$(this).attr('data-index');
    $(this).css('background', 'white');
    e.preventDefault();
    var image = e.originalEvent.dataTransfer.files;
    var id=$('.home-image-upload').attr('data-id');
    console.log(e.originalEvent)
    createFormDataHome(image,id,index);
    });
});
function createFormDataHome(image,id,index) {
    var type=$(id).attr('data-key');
    var token=$("input[name='_token']").val();
	var formImage = new FormData();
    formImage.append(type, image[0]);
    formImage.append('action', type);
    formImage.append('_token', token);
	uploadFormDataHome(formImage,id,index);
}
function uploadFormDataHome(formData,id,index) {
    $('#loader1').removeClass('hide_div');
  $('#page_overlay').removeClass('hide_div');
    $.ajax({
     url: $(id).attr('data-url'),
     type: "POST",
     data: formData,
     contentType:false,
     cache: false,
     processData: false,
     success: function(data){
        $('#loader1').addClass('hide_div');
        $('#page_overlay').addClass('hide_div');
         var resp=$.parseJSON(data)
         if(resp.status=='true')
         {
             var str = resp.image;
             var res = str.split("amazonaws.com");
            // $('#disp_video').attr({'src':resp.image});
            $('#disp_image'+index).css({'display':'block'});
			$('#disp_image'+index).addClass('disp_img_after');
             $('#disp_image'+index).attr({'src':resp.image});
             $('#image_'+index).val(res[1]);
			 if($('div').hasClass('home_image_section'))
			 {
				var str1 = resp.safari_image;
				var res1 = str1.split("amazonaws.com");
				$('#image1_'+index).val(res1[1]);
			 }
			 
         }
         else
         {
             var type=typeof resp.message;
             if(type=='object')
             {
                 msg='';
                 $.each( resp.message, function( key, value ) {
                     msg+=' '+value;
                     });
                 toastr.error(msg,'Warning');
             }
             else 
             {
                 toastr.error(resp.message,'Warning');
             }
         }
     }
 });
 }
 $(document).on('change','.upload_image_home_page',function(e){
    $('#loader1').removeClass('hide_div');
    $('#page_overlay').removeClass('hide_div');
    var data_name=$(this).attr('name');
     var data_form=$(this).attr('data-from');
     var index=$(this).attr('data-index');
     var url=$(data_form).attr('data-image');
    var data=new FormData($(data_form)[0]);
    $.ajax({
        type:'POST',
        url:url+'/'+data_name,
        data:data,
        contentType:false,
        processData:false,
        cache: false,
        success:function(fb)
        {
            $('#loader1').addClass('hide_div');
            $('#page_overlay').addClass('hide_div');
            var resp=$.parseJSON(fb);
            if(resp.status=='true')
            {
				var str = resp.image;
                var res = str.split("amazonaws.com");
                $('#disp_image'+index).css({'display':'block'});
                $('#disp_image'+index).attr({'src':resp.image});
				$('#disp_image'+index).addClass('disp_img_after');
                $('#image_'+index).val(resp.image.split('s3')[1]);
	  			if($('div').hasClass('home_image_section'))
				{
					var str1 = resp.safari_image;
					var res1 = str1.split("amazonaws.com"); console.log(str1); console.log(res1);
					$('#image1_'+index).val(resp.safari_image.split('s3')[1]);
				}
            }
            else
            {
                var type=typeof resp.message;
                if(type=='object')
                {
                    msg='';
                    $.each( resp.message, function( key, value ) {
                       msg+=' '+value;
                     });
                    toastr.error(msg,'Warning');
                }
                else 
                {
                  toastr.error(resp.message,'Warning');
                }
            }
        }


    });

 });
$(document).on('click','.delete_home_page_item',function(){
    $(this).closest('.row').remove();
    var id=$(this).attr('data-id');
    $.get(BASE_URL+'/admin/setting/delete_home_page_item/'+id,function(fb){
        
    });
});
var count=0;
$(document).on('click','.add_new_home_group',function(){
    var parent=$(this).attr('data-parent');
    var next_parent=parent+1;
    var grid_str='';
    var ids=[];
$('.add-icon').remove();
for(i=0;i<15;i++)
{
  grid_str+='<div class="item"> <div class="row"> <div class="col-sm-12"> <div class="form-group"> <label>Upload image</label> <div id="drop-image_'+parent+i+'" data-index="'+parent+i+'" style="height:100px" data-id="#drop-image_'+parent+i+'" class="drop-control home-image-upload drop-area-custom" data-key="image" data-url="'+BASE_URL+'/admin/products/upload_product_image"> <input type="file" data-index="'+parent+i+'" name="image'+parent+i+'" data-from=".database_operation_form" data-parent="#drop-image" class="upload_image_home_page custom_img" style="z-index: 5;" > <input type="hidden" value="" id="image_'+parent+i+'" name="image_inner_name['+i+'][]"/> <div class="upload_placeholder"> <img id="disp_image'+parent+i+'" class="" src="'+BASE_URL+'/public/setting/upload-img.png" alt="logo" > </div><br></div><p>* Image width & height should be same</p></div><div class="col-sm-12"> <div class="form-group"> <label>Select Category</label> <select name="category['+i+'][]" data-id="#prod_'+parent+i+count+'"  class="cat_'+parent+' form-control home_category"> <option value="">Select Category</option> </select> </div></div><div class="col-sm-12"><div class="form-group"><label>Image Alt Text</label><input type="text" name="image_alt_text['+i+'][]" placeholder="Image Alt Text" class="form-control"  /></div></div><div class="col-sm-12"> <div class="form-group"> <label>Select Product</label> <select name="product['+i+'][]" id="prod_'+parent+i+count+'" class="form-control home_category"> <option value="">Select Product</option> </select> </div></div><div class="col-sm-12"> <div class="form-group"> <input type="checkbox" value="1" name="hover'+parent+i+'" name=""> <label >Visible on hover</label><br><input type="checkbox" value="1" name="mobile'+parent+i+'"> <label >Visible on mobile</label> </div></div></div></div></div>';
  ids.push('#cat_'+parent+i);
  count++;
}
grid_str+='</div><div class="col-sm-12 text-right"><a href="javascript:void(0);" data-parent="'+next_parent+'" class="add-icon mr-2 add_new_home_group" style="display: inline-flex;"> <img src="'+BASE_URL+'/public/assets/images/add.svg" class="img-fluid" alt="add-image"> </a> <a href="javascript:void(0);" class="minus-icon remove_home_page_item" style="display: inline-flex;"> <img src="'+BASE_URL+'/public/assets/images/minus.svg" class="img-fluid" alt="add-image"> </a> </div></div>';
    $('.home_page_setting_conatiner').append('<div class="row custom_parent"> <div class="col-sm-12"> <div class="row"> <div class="col-sm-6 mb-3"> <input type="hidden" name="mode[]" value="insert"/> <label>Enter Banner Title</label> <input type="text" value="" name="banner_title[]" placeholder="Entrt Banner Title" class="form-control" > </div><div class="col-sm-6 mb-3"> <label>Enter Banner Alt Text</label> <input type="text" value="" name="banner_alt_text[]" placeholder="Entrt Banner Alt Text" class="form-control" > </div><div class="col-sm-12 mb-3"> <label>Select Collection Name</label> <select name="collection[]" id="collection_'+parent+'" class="form-control" > <option value="">Select Collection Name</option> </select> </div><div class="col-sm-12 mb-3"> <label>Select Banner</label> <div id="drop-image_'+parent+'" data-index="'+parent+'" data-id="#drop-image_'+parent+'" class="drop-control home-image-upload drop-area-custom" data-key="image" data-url="'+BASE_URL+'/admin/products/upload_product_image"> <input type="file" style="z-index: 5;" data-index="'+parent+'" name="image'+parent+'" data-from=".database_operation_form" data-parent="#drop-image_'+parent+'" class="upload_image_home_page custom_img_home" > <input type="hidden" id="image_'+parent+'" value="" name="image_name[]"/> <div class="upload_placeholder"> <img id="disp_image'+parent+'" class="" src="'+BASE_URL+'/public/setting/upload-img.png" alt="logo" > </div><br></div><p>**Image Dimensions must be min of 1920 W & 600H</p></div><div class="col-sm-12 mb-3"> <p>Grid Section :</p></div></div> <div class="col-sm-12 mb-3"><div class="mcs-horizontal-example">'+grid_str);
   
    $.get(BASE_URL+'/admin/setting/get_collection',function(fb){
        $('#collection_'+parent).html(fb);
    });
    $.get(BASE_URL+'/admin/setting/get_category',function(fb){
        $(".cat_"+parent).html(fb);
    });
    $(".mcs-horizontal-example").mCustomScrollbar({
        axis:"x",
        theme:"dark-3"
      });
    
});
$(document).on('click','.remove_home_page_item',function(){
    $(this).closest('.row').remove(); 
});

$(document).on('click','.update_design_style',function(){
    var id=$(this).attr('data-id');
    var name=$(this).attr('data-cat');
    $('#did').val(id);
    $('#dname').val(name);
    $('#design_style_popup').modal('show');
});
$(document).on('click','.update_metal',function(){
    var id=$(this).attr('data-id');
    var name=$(this).attr('data-cat');
    $('#mid').val(id);
    $('#mname').val(name);
    $('#design_style_popup').modal('show');
});
$(document).on('click','.update_gemstone',function(){
    var id=$(this).attr('data-id');
    var name=$(this).attr('data-cat');
    $('#mid').val(id);
    $('#mname').val(name);
    $('#design_style_popup').modal('show');
});
$(document).on('click','.update_purity',function(){
    var id=$(this).attr('data-id');
    var name=$(this).attr('data-cat');
    $('#mid').val(id);
    $('#mname').val(name);
    $('#design_style_popup').modal('show');
});
$(document).on('click','.update_diamond_type',function(){
    var id=$(this).attr('data-id');
    var name=$(this).attr('data-cat');
    $('#mid').val(id);
    $('#mname').val(name);
    $('#design_style_popup').modal('show');
});
$(document).on('click','.update_testimonial',function(){
    var id=$(this).attr('data-id');
    var user=$(this).attr('data-user');
	var data_comment=$(this).attr('data-comment');
    $('#id').val(id);
	$('#message').val(data_comment);
    $('#usr_'+user).attr('selected','selected');
    $('#update_cat_popup').modal('show');
});
$(document).on('click','.update_our_partners',function(){
	var id=$(this).attr('data-id');
    var alt=$(this).attr('data-alt');
	var title=$(this).attr('data-title');
	$('#id').val(id);
	$('#alt_text').val(alt);
    $('#title').val(title);
    $('#up_myModal').modal('show');
	
});
$(document).on('click','.delete_our_partners',function(){
	var id=$(this).attr('data-id');
	if(confirm('Do Your Want to delete partner'))
	{
		var token=$("input[name='_token']").val();
		$.post(BASE_URL+'/admin/setting/our_partners_manage_operation',{'id':id,'action':'delete','_token':token},function(fb){
			toastr.success('Partner Successfully Deleted','Success');
			/*setTimeout(function(){
				location.reload();
			});*/
		})
	}
});

/*blog image*/
$(document).ready(function(){
	$(".drop-area-blog").on('dragenter', function (e){
		e.preventDefault();
		$(this).css('background', 'white');
	});

	$(".drop-area-blog").on('dragover', function (e){
		e.preventDefault();
	});

	$(".drop-area-blog").on('drop', function (e){
		$(this).css('background', 'white');
		e.preventDefault();
		var image = e.originalEvent.dataTransfer.files;
		var id=$('.drop-area-blog').attr('data-id');
		createFormData_blog(image,id);
	});
});
function createFormData_blog(image,id) {
	var type=$(id).attr('data-key');
    var token=$("input[name='_token']").val();
	var formImage = new FormData();
    formImage.append(type, image[0]);
    formImage.append('action', type);
    formImage.append('_token', token);
	uploadFormData_blog(formImage,id);
}
function uploadFormData_blog(formData,id) {
  $('#loader1').removeClass('hide_div');
  $('#page_overlay').removeClass('hide_div');
   $.ajax({
	url: $(id).attr('data-url'),
	type: "POST",
	data: formData,
	contentType:false,
	cache: false,
	processData: false,
	success: function(data){
        $('#loader1').addClass('hide_div');
        $('#page_overlay').addClass('hide_div');
        var resp=$.parseJSON(data)
        if(resp.status=='true')
        {
			$('.upload_placeholder').remove();
			$('.product_image_box').append('<div id="product_image_display_box"></div>');	
            var str = resp.image;
            var res = str.split("tarasri.in");
            $('#disp_image').attr({'src':resp.image});
            $('#disp_image').css({'display':'block'});
           
				$('#product_image_display_box').append('<img data-alt="" data-id="'+resp.reff_id+'" class="product_upload_image blog_image"  src="'+resp.image+'" alt="logo" >');
				$('#ref_id').val(resp.reff_id);
				$('#blog_image_alt').modal('show'); 
				$('#image').val(1);
			
            $('#drag_image_text').css({'display':'none'});
        }
        else
        {
            var type=typeof resp.message;
            if(type=='object')
            {
                msg='';
                $.each( resp.message, function( key, value ) {
                    msg+=' '+value;
                    });
                toastr.error(msg,'Warning');
            }
            else 
            {
                toastr.error(resp.message,'Warning');
            }
        }
	}
});
}
$(document).on('click','.blog_image',function(){
	$('#ref_id').val($(this).attr('data-id'));
	$('#alt_text').val($(this).attr('data-alt'));
	$('#blog_image_alt').modal('show');
});
$(document).on('click','.delete_crimsonbride',function(){
	if(confirm('Do You Want To Delete This Crimson Bride'))
     {
		var id=$(this).attr('data-id');
        var token=$("input[name='_token']").val();
		$.post(BASE_URL+'/admin/crimsonbride_operation',{'action':'delete','_token':token,'id':id},function(fb){
            location.reload();
        });
	 }
	 /*if(confirm('Do You Want To Delete This Crimson Bride'))
     {
        
        
     }*/
});
$(document).on('click','.landing_page_link',function(){
	$('#p1').text($(this).attr('data-link'));
	$('#ShareableLink').modal('show');
});
function copyToClipboard(element) {
	  var $temp = $("<input>");
	  $("body").append($temp);
	  $temp.val($(element).text()).select();
	  document.execCommand("copy");
	  $temp.remove();
	  toastr.success('Link Copy','Success');
}

$('.blog_manage_status').change(function(){
	var status = $(this).val();
	$.get(BASE_URL+'/change_blog_manage_status/'+status,function(fb){
		 toastr.success('Status Changed','Success');
	});
});
$(document).on('click','.add_new_items',function(){
    $('.show_items').append('<div class="row mb-2 item_element"><div class="col-sm-12"><label style=" width: 100%; ">Name <a  href="javascript:;" class="remove_item btn-sm btn btn-danger float-right">X</a></label><input type="text" required="required" name="name[]" class="form-control" placeholder="Enter Name" /></div><div class="col-sm-5"><div class="form-group"><label>Designation</label><input required="required" type="text" name="designation[]" placeholder="Designation" class="form-control"><label>Image</label><input required="required" type="file" name="image[]" class="form-control"></div></div><div class="col-sm-7"><div class="form-group"><label style="width:100%">About </label><textarea required="required" style=" height: 105px; " name="about[]" cols="4" class="form-control"></textarea></div></div></div>');
});
$(document).on('click','.remove_item',function(){
    $(this).closest('.item_element').remove();
});
