@extends('layouts.admin.app')
@section('title','Edit Landing Pages')
@section('content')
<section class="content">
      <div class="container-fluid">
        <!-- COLOR PALETTE -->
        <div class="card card-default color-palette-box">
		  <div class="card-body">
            <form action="{{ url('admin/edit-landing-page/'.$landingpage->id) }}" class="database_operation_form" >    
			<div class="col-sm-12">
				<div class="form-group">
					<label>Enter Title</label>
					{{ csrf_field() }}
					<input required type="text" name="title" value="{{ $landingpage->title }}" placeholder="Enter Title" class="form-control" />
				</div>
            </div>
			<div class="col-sm-12">
				<div class="form-group">
					<label>Enter Slug</label>
					<input required type="text" value="{{ $landingpage->slug }}" name="slug" placeholder="Enter Slug" class="form-control" />
				</div>
            </div>
			<div class="col-sm-12">
				<div class="form-group">
					<label>Enter SEO Title</label>
					<input required type="text" value="{{ $landingpage->seo_title }}" name="seo_title" placeholder="Enter SEO Title" class="form-control" />
				</div>
            </div>
			<div class="col-sm-12">
				<div class="form-group">
					<label>Enter SEO Keyword</label>
					<textarea class="form-control" name="seo_keyowrd">{{ $landingpage->seo_keyowrd }}</textarea>
				</div>
            </div>
			<div class="col-sm-12">
				<div class="form-group">
					<label>Enter SEO Description</label>
					<textarea class="form-control" name="seo_description">{{ $landingpage->seo_description }}</textarea>
				</div>
            </div>
			<div class="col-sm-12">
				<div class="form-group">
					<label>Enter Description</label>
					<textarea style="height:500px" class="form-control" name="description[]">{{ $landingpage_editor[0]['description'] }}</textarea>
				</div>
            </div>
			<div class="col-sm-12">
				<div class="form-group">
					<input type="radio" <?php if($landingpage->show_position==1) { echo "checked"; } ?> name="show_on" checked value="1"> <label>Main Menu</label>
					<input <?php if($landingpage->show_position==2) { echo "checked"; } ?> type="radio" name="show_on" value="2"> <label>Collection Menu</label>
					<input <?php if($landingpage->show_position==4) { echo "checked"; } ?> type="radio" name="show_on" value="4"> <label>Footer Menu</label>
					<input <?php if($landingpage->show_position==3) { echo "checked"; } ?> type="radio" name="show_on" value="3"> <label>Link</label>
				</div>
            </div>
			
			<div class="col-sm-12">
				<div class="form-group">
					<button class="btn btn-info form_btn">Update</button>
				</div>
            </div>
			</form>
          </div>
        </div>
</section>
@endsection