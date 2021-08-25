@extends('layouts.admin.app')
@section('title','Home Page')
@section('content')
<?php
$s3_bucket_url = rtrim(\Config::get('app.s3_bucket_url'),'/');
?>
<form action="{{ url('admin/setting/save_home_page_data') }}" data-image="{{ url('admin/setting/upload_home_page_banner') }}" class="database_operation_form">
<section class="content">
      <div class="container-fluid">
        <!-- COLOR PALETTE -->
        <div class="card card-default color-palette-box">
          <div class="card-body">
          <div class="home_page_setting_conatiner">
          @foreach($home_jewellery as $key_parent => $home)
            <div class="row custom_parent">
                <div class="col-sm-12">
                  <div class="row">
                    <div class="col-sm-4 mb-3">
                    {{ csrf_field() }}
                      <input type="hidden" name="mode[]" value="update" />
                      <input type="hidden" name="id[]" value="{{ $home['id'] }}" />
                      <label>Enter Banner Title</label>
                      <input type="text" value="{{ $home['banner_title'] }}" name="banner_title[]" placeholder="Entrt Banner Title"  class="form-control" >
                    </div>
                    <div class="col-sm-4 mb-3">
                      <label>Enter Banner Alt Text</label>
                      <input type="text" value="{{ $home['banner_alt'] }}" name="banner_alt_text[]" placeholder="Entrt Banner Alt Text"  class="form-control" >
                    </div>
					<div class="col-sm-4 mb-3">
                      <label>Enter Banner priority</label>
                      <input type="number" min="1" value="{{ $home['index_count'] }}" name="banner_index[]" placeholder="Enter Banner priority"  class="form-control" >
                    </div>
                    <div class="col-sm-12 mb-3">
                      <label>Select Collection Name</label>
                      <select name="collection[]" class="form-control" >
                        <option value="">Select Collection Name</option>
                        @foreach($collection as $col)
                        <option <?php if($home['collection_id']==$col['id']) { echo "selected"; } ?> value="{{ $col['id'] }}">{{ $col['collection_name'] }}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="col-sm-12 mb-3">
                    <label>Select Banner</label>
                        <div id="drop-image_{{ $key_parent }}" data-index="{{ $key_parent }}" data-id="#drop-image_{{ $key_parent }}"  class="drop-control home-image-upload drop-area-custom" data-key="image" data-url="{{ url('admin/products/upload_product_image') }}"> 
                            <input type="file" style="z-index: 5;"  data-index="{{ $key_parent }}"  name="image{{ $key_parent }}"  data-from=".database_operation_form" data-parent="#drop-image_{{ $key_parent }}" class="upload_image_home_page custom_img_home" >
                            <input type="hidden"  id="image_{{ $key_parent }}" value="{{ $home['banner_url'] }}" name="image_name[]" />  
							<input type="hidden"  id="image1_{{ $key_parent }}" value="{{ $home['banner_url_safari'] }}" name="image_name1[]" />  							
							
                            <div class="upload_placeholder">
                            <?php 
                            $img_arr = explode('public/',$home['banner_url']);
                            if(isset($img_arr[1]))
                              $im=$img_arr[1];
                            else 
                              $im=$img_arr[0];
                            if($home['banner_url'])
                              //$image=url('public/'.$im);
                              $image=$s3_bucket_url.$im;
                            else 
                              $image=url('public/setting/upload-img.png');

                            ?>
                                <img  id="disp_image{{ $key_parent }}" class="disp_img_after_home"  src="{{ $image }}" alt="logo" >
                            </div>
                            <br>
                        </div>
						<p>**Image Dimensions must be min of 1920 W & 600H</p>
                    </div>
                    <div class="col-sm-12 mb-3">
                    <p>Grid Section :</p>
                    <?php 
                    $meta_data=json_decode(json_encode(json_decode($home['grid_meta'])),true);
                    ?>
                    </div>
                    <div class="col-sm-12 mb-3">
                       <div class="mcs-horizontal-example">
                      <?php foreach($meta_data as $i => $data) { 
                        
                        $img_arr_in = explode('public/',$data['grid-image']);
                        if(isset($img_arr_in[1]))
                          $im_in=$img_arr_in[1];
                        else 
                          $im_in=$img_arr_in[0];
                        
                        if($data['grid-image'])
                          // $img=url('public/'.$im_in);
							$img = $s3_bucket_url.$im_in;
                        else 
                          $img=url('public/setting/upload-img.png');
                        ?>
                            <div class="item home_image_section">
                                <div class="row">
                                  <div class="col-sm-12">
                                     <div class="form-group">
                                        <label>Upload image</label>
                                        <div id="drop-image_{{ $key_parent }}{{ $i }}" data-index="{{ $key_parent }}{{ $i }}" style="height:100px" data-id="#drop-image_{{ $key_parent }}{{ $i }}" class="drop-control home-image-upload drop-area-custom" data-key="image" data-url="{{ url('admin/products/upload_product_image') }}"> 
                                          <input type="file"   data-index="{{ $key_parent }}{{ $i }}"  name="image{{ $key_parent }}{{ $i }}" data-from=".database_operation_form" data-parent="#drop-image" class="upload_image_home_page custom_img" style="z-index: 5;" >
                                          <input type="hidden" value="{{ $data['grid-image'] }}" id="image_{{ $key_parent }}{{ $i }}" name="image_inner_name[{{ $i }}][]" />    
										  <input type="hidden" value="{{ $data['grid-image-safari'] }}" id="image1_{{ $key_parent }}{{ $i }}" name="image_inner_name1[{{ $i }}][]" />    
                                          <div class="upload_placeholder">
                                              <img  id="disp_image{{ $key_parent }}{{ $i }}" class="disp_img_after"  src="{{ $img }}" alt="logo" >
                                          </div>
                                          <br>
                                      </div>
									  <p>* Image width & height should be same</p>
                                     </div>
									 
                                     <div class="col-sm-12">
                                      <div class="form-group">
                                        <label>Select Category</label>
                                        <select name="category[{{ $i }}][]"  data-id="#prod_{{ $key_parent }}{{ $i }}"  class="form-control home_category">
                                          <option value="">Select Category</option>
                                          @foreach($category as $cat)
                                          <option <?php if($cat['id']==$data['category-id']) { echo 'selected'; } ?> value="{{ $cat['id'] }}">{{ $cat['categorey_name'] }}</option>
                                          @endforeach
                                        </select>
                                      </div>
                                     </div>
                                     <div class="col-sm-12">
                                      <div class="form-group">
                                        <label>Image Alt Text</label>
                                        <input type="text" name="image_alt_text[{{ $i }}][]" value="{{ $data['image_alt_text'] }}" placeholder="Image Alt Text" class="form-control"  />
                                      </div>
                                     </div>
									 <div class="col-sm-12">
                                      <?php 
                                      $product =get_product(array('id','product_name'),$data['category-id']);
                                      ?>
                                      <div class="form-group">
                                        <label>Select Product</label>
                                        <select name="product[{{ $i }}][]"  id="prod_{{ $key_parent }}{{ $i }}"  class="form-control home_category">
                                          <option value="">Select Product</option>
                                          @foreach($product as $prod)
                                          <option <?php if($prod['id']==$data['product-id']) { echo 'selected'; } ?> value="{{ $prod['id'] }}">{{ $prod['product_name'] }}</option>
                                          @endforeach
                                        </select>
                                      </div>
                                     </div>
                                     <div class="col-sm-12">
                                      <div class="form-group">
                                        <input type="checkbox" <?php if($data['visible-on-hover']==1) { echo "checked"; }  ?> value="1" name="hover{{ $key_parent }}{{ $i }}" name=""> <label >Visible on hover</label><br>
                                        <input type="checkbox" <?php if($data['visible-on-mobile']==1) { echo "checked"; }  ?> value="1" name="mobile{{ $key_parent }}{{ $i }}"> <label >Visible on mobile</label>
                                      </div>
                                     </div> 
                                  </div>
                                </div>
                            </div>
                            <?php } 
                            
                            ?> 
                      </div>
                      <div class="col-sm-12 text-right" >
                       @if($key_parent==(count($home_jewellery)-1))
                        <a href="javascript:void(0);" data-parent="{{ $key_parent+1 }}" class="add-icon mr-2 add_new_home_group"  style="display: inline-flex;">
                          <img src="{{ url('public/assets/images/add.svg') }}" class="img-fluid" alt="add-image">
                        </a>
                        @endif
						@if($key_parent!=0)
                        <a href="javascript:void(0);" data-id="{{ $home['id'] }}" class="minus-icon delete_home_page_item" style="display: inline-flex;">
                          <img src="{{ url('public/assets/images/minus.svg') }}" class="img-fluid" alt="add-image">
                        </a>
						@endif
                    </div>
                  </div>
                </div>
                @endforeach
                </div>
            </div>
          </div>
        </div>
</section>
<div class="card">
<div class="card-footer">
      <div class="row">
          <div class="col-sm-12">
            <button class="btn rounded-0 bg-success text-white form_btn">Save</button>
          </div>
        </div>
      </div> 
</div>
</form>
@endsection