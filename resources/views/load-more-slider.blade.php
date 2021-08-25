
<?php
$user_agent = $_SERVER['HTTP_USER_AGENT'];
$browser = "";
if(stripos($user_agent,'Chrome') !== false)
{
	$browser = "Chrome";
} elseif(stripos($user_agent,'Safari') !== false) {
	$browser = "Safari";
} elseif(preg_match('/Firefox/i', $user_agent)) {
	$browser = "FireFox";
} else {
	$browser = "Other";
}
$s3_bucket_url = rtrim(\Config::get('app.s3_bucket_url'),'/');
foreach ($home_jewellery as $jewellery) {
?>
<div class="container-fluid">
	<div class="custom-container">
		<div class="wow fadeInUp">
			<a  href="<?php echo url('') ?>/collection-list/<?php echo getSinglerow('collection','slug',array('id'=>$jewellery['collection_id'])) ?>/<?php echo $jewellery['id'] ?>">
			<div class="position-relative d-flex align-items-center jewellery-image-two">
			@if($browser == 'Chrome' || $browser == 'FireFox')
				<img style="min-width: 100%;" src="<?php echo $s3_bucket_url  . $jewellery['banner_url'] ?>" class="img-fluid  ">
			@else
				<img style="min-width: 100%;" src="<?php echo $s3_bucket_url  . $jewellery['banner_url_safari'] ?>" class="img-fluid  ">
			@endif
			</div>
			</a>
		</div>
	</div>
</div>
<div class="px-3">
	<div class="custom-container">
		<div class="products position-relative">
			<div class="owl-carousel owl-theme product-slider d-lg-none first-slider">
			<?php
			$gridJewellery = json_decode($jewellery['grid_meta'], true);
			foreach ($gridJewellery as $grid) {
			if(isset($grid['visible-on-mobile']) && $grid['visible-on-mobile'] == 1){
			?>
			<div class="<?php echo isset($grid['visible-on-hover']) && $grid['visible-on-hover'] == 1 ? "img-hover" : ""; echo isset($grid['visible-on-mobile']) && $grid['visible-on-mobile'] == 1 ? '' : 'd-none grid-none mobile-visible' ?>">
				<div class="img-hover text-center">
					<div class="fav">
					<?php
					$fev=0;
					if(Session::get('usersession'))
					{
						if(is_fevrate(Session::get('usersession')->user_id,$grid['product-id'])) {
							$fev=1;
						}
					}
					?>
					<button class="btn <?php if($fev) { ?>remove_to_fevrate <?php } else { ?>add_to_fevrate <?php } ?>" data-id="{{ $grid['product-id'] }}" data-user="<?php if(Session::get('usersession')) { echo  Session::get('usersession')->user_id; } ?>">
					<?php if($fev) { ?><img class="fev_icon_{{ $grid['product-id'] }}" src="{{ url('') }}/public/assets/images/fav_fill.svg"><?php } else { ?><img class="fev_icon_{{ $grid['product-id'] }}" src="{{ url('') }}/public/assets/images/fav.svg"><?php } ?>	
					</button> 
					</div>
					<?php
					$reff_data=$grid['product-id'];
					if(getSinglerow('products','slug',array('id'=>$grid['product-id'])))
					{
						$reff_data=getSinglerow('products','slug',array('id'=>$grid['product-id']));
					}
					?>
					<a style="color: inherit;width:100%" href="<?php echo url('') ?>/collection-single/<?php echo $reff_data; ?>" class="d-inline-block">
						<?php
						$img_arr = explode('public/',$grid['grid-image-safari']);
						if($browser == 'Chrome' || $browser == 'FireFox'){
							$img_arr = explode('public/',$grid['grid-image']);
						}
						$im=$img_arr[0];
						if(isset($img_arr[1])){
							$im=$img_arr[1];
						}
						$image=$s3_bucket_url.$im;
						?>
						<img alt="{{ $grid['image_alt_text'] }}" src="<?php if ($image) { echo $image; } ?>" class="img-fluid1">
					</a>
				</div>
			</div>
			<?php } ?>
			<?php } ?>
			</div>
			
			<div class="d-none d-lg-block">
				<div class="row mx-2">
					<div class="col-sm-6 col-md-3 col-lg-3 col-xl-3 px-2 mb-3 mb-xl-0 wow fadeInUp">
						<div class="row overflow-hidden position-relative ">
							<?php
							$i=1;
							foreach ($gridJewellery as $grid) {
							?>
							<div class="col-md-6 mb-0 pl-md-0 pr-md-0 <?php echo isset($grid['visible-on-hover']) && $grid['visible-on-hover'] == 1 ? "img-hover" : "img-no-hover" ?>">
								<?php
								$reff_data=$grid['product-id'];
								if(getSinglerow('products','slug',array('id'=>$grid['product-id'])))
								{
									$reff_data=getSinglerow('products','slug',array('id'=>$grid['product-id']));
								}
								?>
								<a style="color: inherit;width:100%" href="<?php echo url('') ?>/collection-single/<?php echo $reff_data; ?>" class="d-inline-block">
									<?php
									$img_arr = explode('public/',$grid['grid-image-safari']);
									if($browser == 'Chrome' || $browser == 'FireFox'){
										$img_arr = explode('public/',$grid['grid-image']);
									}
									$im=$img_arr[0];
									if(isset($img_arr[1])){
										$im=$img_arr[1];
									}
									$image = $s3_bucket_url.$im;
									?>
									<img alt="{{ $grid['image_alt_text'] }}" src="<?php if ($image) { echo $image; } ?>" class="img-fluid1">
								</a>
								<div class="no-hover-fav">
									<?php
									$fev=0;
									if(Session::get('usersession'))
									{
										if(is_fevrate(Session::get('usersession')->user_id,$grid['product-id']))
										{
											$fev=1;
										}
									}
									?>
									<button class="btn <?php if($fev) { ?> remove_to_fevrate <?php } else { ?>add_to_fevrate <?php } ?>" data-id="{{ $grid['product-id'] }}" data-user="<?php if(Session::get('usersession')) { echo  Session::get('usersession')->user_id; } ?>">
									<?php if($fev) { ?><img class="fev_icon_{{ $grid['product-id'] }}" src="{{ url('') }}/public/assets/images/fav_fill.svg"><?php } else { ?>
									<img class="fev_icon_{{ $grid['product-id'] }}" src="{{ url('') }}/public/assets/images/fav.svg"><?php } ?>	
									</button> 
								</div>
								<div class="bigimg">
									<a style="color: inherit;width:100%" href="<?php echo url('') ?>/collection-single/<?php echo $reff_data; ?>" class="d-inline-block">
										<img alt="{{ $grid['image_alt_text'] }}" src="<?php if ($image) { echo $image; } ?>" class="img-fluid1">
									</a>
									<span class="d-block font-16"><?php
									$productname = $grid['product-name'];
									if(isset($grid['product-modal']) && $grid['product-modal']!=""){
										$productname = $grid['product-name']."-".$grid['product-modal'];
									}
									echo $productname; ?></span>
									<div class="fav">
										<button class="btn <?php if($fev) { ?> remove_to_fevrate <?php } else { ?>add_to_fevrate <?php } ?>" data-id="{{ $grid['product-id'] }}" data-user="<?php if(Session::get('usersession')) { echo  Session::get('usersession')->user_id; } ?>">
										<?php if($fev) { ?> <img class="fev_icon_{{ $grid['product-id'] }}" src="{{ url('') }}/public/assets/images/fav_fill.svg"> <?php } else { ?><img class="fev_icon_{{ $grid['product-id'] }}" src="{{ url('') }}/public/assets/images/fav.svg"><?php } ?>	
										</button> 
									</div>
								</div>
							</div>
							@if($i%4==0)
								</div>
								</div>
								<div class="col-sm-6 col-md-3 col-lg-3 col-xl-3 px-2 mb-3 mb-xl-0 wow fadeInUp">
								<div class="row overflow-hidden position-relative ">
							@endif
							<?php $i++; } ?>
						</div>
					</div>
				</div>
			</div>
			
		</div>
	</div>
</div>            
<?php } ?>