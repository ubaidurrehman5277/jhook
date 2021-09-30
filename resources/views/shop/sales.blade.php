@include('user.header')
@php
	$menu = $table = $qty = $product = $total_price = "";
	$order_detail = array();
	if(!empty(old())){
		$menu = old('menu');
		$product = old('product');
		$qty = old('qty');
		$total_price = old('total_price');
	}else if(isset($data) and !empty($data)){
		$meun = $data->cat_id;
		$table = $data->table_no;
		$qty = $data->qty;
		$total_price = $data->total_price;
		$order_detail = json_decode($data->order_detail , true);
	}
	$_orderId = (!empty($data)) ? $data->id : "";
@endphp
<div class="row">
	<div class="col-md-12">
        @if(session()->has("success"))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
              {!! session("success") !!}
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
        @endif
        @if(session()->has("error"))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              {!! session("error") !!}
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
        @endif
    </div>
	<div class="col-md-6">
		<div class="card border-info">
			<div class="card-header bg-info">
				<h3 class="text-white">Order</h3>
			</div>
			<div class="card-body">
				<form action="" method="post" accept-charset="utf-8">
					@csrf
					@if(request()->has('orderid'))
						<input type="hidden" name="orderid" value="{{ request('orderid') }}">
					@endif
					<div class="row">
						<div class="col-md-12 form-group">
							<label for="">Select Product</label>
							<select name="pname" class="form-control pname"  {{ (!empty($data))?"readonly disabled":"" }}>
								<option value="">Choose an Option</option>
								@forelse($products as $value)
									<option value="{{ $value->id }}" data-price = "{{ $value->price }}" data-quantity="{{ $value->quantity }}" {{ ($product == $value->id) ? "selected" : "" }}>{{ $value->product_name }}</option>
								@empty
								@endforelse
							</select>
							@error('table')
								<span class="text-danger">{!! $message !!}</span>
							@enderror
						</div>

						<div class="col-md-12 form-group">
							<label for="">Available Quantity</label>
							<input type="number" class="form-control available_quantity" name="available_quantity" value="0" readonly>
							@error('available_quantity')
								<span class="text-danger">{!! $message !!}</span>
							@enderror
						</div>

						<div class="col-md-6 form-group">
							<label for="">Total Item/Kg</label>
							<input type="number" class="form-control qty" name="qty" value="0" min="0">
							@error('qty')
								<span class="text-danger">{!! $message !!}</span>
							@enderror
						</div>
						<div class="col-md-6 form-group">
							<label for="">Total Price</label>
							<input type="text" class="form-control total_price" name="total_price" value="0" readonly>
							<input type="hidden" name="assuming_price" class="as_price" value="0" readonly>
							@error('total_price')
								<span class="text-danger">{!! $message !!}</span>
							@enderror
						</div>
					@if(!empty($data) and $data->status == 'paid')
					@else
						<div class="col-md-12">
							<button class="btn btn-primary float-right">Place Order</button>
						</div>
					@endif
					</div>
				</form>
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<div class="card border-info">
			<div class="card-header bg-info">
				<h3 class="text-white">Invoice List</h3>
			</div>
			<div class="card-body">
				<h3 class="text-center">Order Detail</h3>
				<table class="table">
					@php $tt = 0; @endphp
					@forelse($order_detail as $key => $value)
						@php $tt = $tt + $value['price']; @endphp
						<tr>
							<td>{{ $value['name']." x ".$value['qty'] }}</td>
							<td>{{ number_format($value['price']) }}</td>
						</tr>
					@empty
					@endforelse
					<tr>
						<th>Total :</th>
						<td>{{ number_format($tt) }}</td>
					</tr>
					@if(!empty($data) and $data->status == 'pending')
						<tr>
							<td>
								<a href="{{ route('order-status').'?cancel='.$_orderId }}" class="text-danger float-right" onclick="return confirm('Are you sure want to cancel this order?')">Cancel</a>
							</td>
							<td>
								<a href="{{ route('order-status').'?paid='.$_orderId }}" class="btn btn-success w-100" style="font-size:22px;">Paid</a>
							</td>
						</tr>
					@elseif(!empty($data))
						<tr>
							<th colspan="2">
								<button type="button" class="btn btn-secondary w-100">{{ ucfirst($data->status) }}</button>
							</th>
						</tr>
					@endif
				</table>
			</div>
		</div>
	</div>
</div>

@if(session()->has('paid'))
	@php
		$session_value = session()->get('paid');
		session()->forget('paid');
	@endphp
	@include('invoice2' , compact('session_value'));
    <script src="{{ asset('assets/js/print.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('assets/js/print.min.css') }}">
@endif
<script>
	$(document).ready(function(){
		$('input[name="qty"]').on('keyup , change',function(){
			var qty = $(this).val();
			var price = $('.pname').find('option:selected').attr('data-price');
			console.log(price);
			if (price == 0 || price == undefined) {
				var total = 0;
				$('.total_price').val(total);
			}else{
				var total = parseInt(price) * parseInt(qty);
				$('.total_price').val(total);
			}
		})
		$('.pname').on('change',function(){
			var qty = $('.qty').val();
			var price = $('.pname').find('option:selected').attr('data-price');
			var quantity = $('.pname').find('option:selected').attr('data-quantity');	
			console.log(quantity);
			if (price == "" || price == undefined) 
			{
				var total = 0;
				$('.total_price').val(total);	

			}else{
				var total = parseInt(price) * parseInt(qty);
				$('.total_price').val(total);	
			}

			if (quantity == "" || quantity == undefined ) {
				var quantity = 0;
				$('.available_quantity').val(quantity);
			}else {
				var quantity = $('.pname').find('option:selected').attr('data-quantity');
				$('.available_quantity').val(quantity);
			}
		})
	})
</script>
@include('user.footer')