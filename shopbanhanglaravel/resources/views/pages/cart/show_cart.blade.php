@extends('layout')
@section('content')
//{{  \Debugbar::info("Hello")}}
<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="{{URL::to('/')}}">Trang chủ</a></li>
				  <li class="active">Giỏ hàng của bạn</li>
				</ol>
			</div>
			<div class="table-responsive cart_info">
				<?php
					$content = Cart::content();	
				?>
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="image">Hình ảnh Sản phẩm</td>
							<td class="description">Mô tả</td>
							<td class="price">Giá</td>
							<td class="quantity">Số lượng</td>
							<td class="total">Tổng tiền</td>
							<td></td>
						</tr>
					</thead>
					<tbody>
					 @foreach($content as $v_content)
						<tr>
							<td class="cart_product">
								<a href=""><img src="{{URL::to('uploads/product/'.$v_content->options->image)}}" width="100" alt=""/></a>
							</td>
							<td class="cart_description">
								<h4><a href="">{{$v_content->name}}</a></h4>
								<p>Web ID: 1089772</p>
							</td>
							<td class="cart_price">
								<p>{{number_format($v_content->price).' '.'VNĐ'}}</p>
							</td>


							<td class="cart_quantity">
								<div class="cart_quantity_button">
									<input class="cart_quantity_input" type="text" name="quantity" value="{{$v_content->qty}}" autocomplete="off" size="2">
									<input type="submit" value="Cập nhật" name="update_qty" class="btn btn-default btn-sm">

								
								</div>
							</td>


							<td class="cart_total">
								<p class="cart_total_price">{{Cart::subtotal().' '.'VNĐ'}}</p>
							</td>
							<td class="cart_delete">
								<a class="cart_quantity_delete" href="{{URL::to('/delete-to-cart/'.$v_content->rowId)}}"><i class="fa fa-times"></i></a>
							</td>
						</tr>
					@endforeach 
						

					</tbody>
				</table>
			</div>
		</div>
	</section> <!--/#cart_items-->
@endsection 