<table style="border:solid 1px #ccc;border-radius:10px;padding:20px;">
	<tr><th style="text-align:center;"><h3>New Product Inquiry</h3></th></tr>
	<tr><td style="text-align:center;"><h4><u>Product Detail:</u></h4></td></tr>
	<tr>
		<td><img height="300" src="{{$product_image}}"></td>
	</tr>
	<tr>
		<td style="padding:10px 2px;">
		Product Name : {{getSinglerow('products','product_name',array('id'=>$product_id))}}
		</td>
	</tr>
	<tr>
		<td style="padding:10px 2px;">
		Product Design Number : {{getSinglerow('products','design_model_no',array('id'=>$product_id))}}
		</td>
	</tr>
	<tr><td style="text-align:center;" ><h4><u>User Detail:</u></h4></td></tr>
	<tr><td style="padding:10px 2px;" >Name : {{$name}}</td></tr>
	<tr><td style="padding:10px 2px;" >Email : {{$email}}</td></tr>
	<tr><td style="padding:10px 2px;" >Mobile No : {{$mobile}}</td></tr>
	<tr><td style="padding:10px 2px;" >Message :{{ $message1 }}</td></tr> 
	<tr><td style="padding:10px 2px;" >Inquiry Time : <b>{{$time}}</b></td></tr>
</table> 