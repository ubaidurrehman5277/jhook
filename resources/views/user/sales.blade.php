@include('user.header')
@php
	$menu = $table = $qty = $total_price = "";
	$order_detail = array();
	if(!empty(old())){
		$meun = old('meun');
		$table = old('table');
		$qty = old('qty');
		$total_price = old('total_price');
	}else if(isset($data) and !empty($data)){
		$meun = $data->cat_id;
		$table = $data->table_no;
		$qty = $data->qty;
		$total_price = $data->total_price;
		$order_detail = json_decode($data->order_detail , true);
	}
	$_orderId = ($data) ? $data->id : "";
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
					<div class="row">
						<div class="col-md-12 form-group">
							<label for="">Select Table</label>
							<select name="table" class="form-control"  {{ (!empty($data))?"readonly disabled":"" }}>
								<option value="">Choose an Option</option>
								@forelse($tables as $value)
									<option value="{{ $value->id }}" {{ ($table == $value->id) ? "selected" : "" }}>{{ $value->table_no }}</option>
								@empty
								@endforelse
							</select>
							@error('table')
								<span class="text-danger">{!! $message !!}</span>
							@enderror
						</div>
						<div class="col-md-12 form-group">
							<label for="">Select Menu</label>
							<select name="menu" class="form-control">
								<option value="">Choose an Option</option>
								@forelse($menus as $value)
									@php
										$m = $all_menus->where('id',$value->main_menu)->first();
										$m_name = ($m) ? $value->name." - ".$m->name : $value->name;
									@endphp
									<option value="{{ $value->id }}" date-price = "{{ $value->price }}" data-asprice="{{ $value->asuming_price }}">{{ $m_name }}</option>
								@empty
								@endforelse
							</select>
							@error('menu')
								<span class="text-danger">{!! $message !!}</span>
							@enderror
						</div>
						<div class="col-md-6 form-group">
							<label for="">Total Item/Kg</label>
							<input type="number" class="form-control" name="qty" value="0">
							@error('qty')
								<span class="text-danger">{!! $message !!}</span>
							@enderror
						</div>
						<div class="col-md-6 form-group">
							<label for="">Total Price</label>
							<input type="text" class="form-control" name="total_price" value="1" readonly>
							<input type="hidden" name="assuming_price" class="as_price" value="0" readonly>
							@error('total_price')
								<span class="text-danger">{!! $message !!}</span>
							@enderror
						</div>
						<div class="col-md-12">
							<button class="btn btn-primary float-right">Place Order</button>
						</div>
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
							<td>{{ $value['price'] }}</td>
						</tr>
					@empty
					@endforelse
					<tr>
						<th>Total :</th>
						<td>{{ $tt }}</td>
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
@include('user.footer')