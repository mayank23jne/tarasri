@extends('layouts.admin.app')
@section('title','Add Landing Pages')
@section('content')
<section class="content">
      <div class="container-fluid">
        <!-- COLOR PALETTE -->
        <div class="card card-default color-palette-box">
		  <div class="card-body">
            <form action="{{ url('admin/add-landing-page') }}" class="database_operation_form" >    
			<div class="col-sm-12">
				<div class="form-group">
					<label>Enter Title</label>
					{{ csrf_field() }}
					<input required type="text" name="title" placeholder="Enter Title" class="form-control" />
				</div>
            </div>
			<div class="col-sm-12">
				<div class="form-group">
					<label>Enter Slug</label>
					<input required type="text" name="slug" placeholder="Enter Slug" class="form-control" />
				</div>
            </div>
			<div class="col-sm-12">
				<div class="form-group">
					<label>Enter SEO Title</label>
					<input required type="text"  name="seo_title" placeholder="Enter SEO Title" class="form-control" />
				</div>
            </div>
			<div class="col-sm-12">
				<div class="form-group">
					<label>Enter SEO Keyword</label>
					<textarea class="form-control" name="seo_keyowrd"></textarea>
				</div>
            </div>
			<div class="col-sm-12">
				<div class="form-group">
					<label>Enter SEO Description</label>
					<textarea class="form-control" name="seo_description"></textarea>
				</div>
            </div>
			<div class="col-sm-12" id="editor_block">
				<div class="form-group">
					<label>Enter Description</label>
					<textarea class="form-control lendingpage_description" style="height:500px" name="description[]"></textarea>
				</div>  
            </div>
			<div class="col-sm-12">
				<div class="form-group">
					<input type="radio" name="show_on" checked value="1"> <label>Main Menu</label>
					<input type="radio" name="show_on" value="2"> <label>Collection Menu</label>
					<input type="radio" name="show_on" value="4"> <label>Footer Menu</label>
					<input type="radio" name="show_on" value="3"> <label>Link</label>
					
				</div>
            </div>
			
			<div class="col-sm-12">
				<div class="form-group">
					<button class="btn btn-info form_btn">Add</button>
				</div>
            </div>
			</form>
          </div>
        </div>
</section>
@endsection