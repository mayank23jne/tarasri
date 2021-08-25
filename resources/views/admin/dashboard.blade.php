@extends('layouts.admin.app')
@section('title','Dashboard')
@section('content')
<section class="content">
      <div class="container-fluid">
        <!-- Info boxes -->
        <div class="row">
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fa fa-th"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Active products</span>
                <span class="info-box-number">
				{{ $product_count }}
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-users"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Customers</span>
                <span class="info-box-number">{{ $users_count }}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

          <!-- fix for small devices only -->
          <div class="clearfix hidden-md-up"></div>

          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-success elevation-1"><i class="fa fa-info-circle"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Enquiry</span>
                <span class="info-box-number">{{ $enquiry_count }}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-warning elevation-1"><i class="fa fa-comments"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Contact Us</span>
                <span class="info-box-number">{{ $contact_count }}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
        </div>
		<div class="row">
			<div class="col-sm-12 columnchart_material">
				<div class="card card-default color-palette-box">
				  <div class="card-body">
				     <div class="row mb-10">
						<div class="col-sm-10">
						</div>
						<div class="col-sm-2">
							<select class="form-control" id="cart_year_filter">
								<option <?php if(Request::segment(3)==date("Y")) { echo "selected"; }  ?>><?php echo date("Y") ?></option>
								<option <?php if(Request::segment(3)==date("Y",strtotime("-1 year"))) { echo "selected"; }  ?> ><?php echo date("Y",strtotime("-1 year")) ?></option>
								<option  <?php if(Request::segment(3)==date("Y",strtotime("-2 year"))) { echo "selected"; }  ?>><?php echo date("Y",strtotime("-2 year")) ?></option>
								<option  <?php if(Request::segment(3)==date("Y",strtotime("-3 year"))) { echo "selected"; }  ?>><?php echo date("Y",strtotime("-3 year")) ?></option>
								<option  <?php if(Request::segment(3)==date("Y",strtotime("-4 year"))) { echo "selected"; }  ?>><?php echo date("Y",strtotime("-4 year")) ?></option>
							</select>
						</div>
					 </div>
					 <div id="columnchart_material" style="width: 100%; height: 500px;"></div>
				  </div>
				 </div>
			</div>
		</div>
        <!-- /.row -->
        <!-- /.row -->
      </div><!--/. container-fluid -->
    </section>
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable(<?php echo json_encode($char_arr) ?>);

        var options = {
          chart: {
            title: 'Customers And Enquiry',
            subtitle: '',
          }
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>
@endsection