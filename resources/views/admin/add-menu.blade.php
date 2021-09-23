@include('admin.layouts.header')
{{-- @php
	$paid_by = $paid_to = $amount = $description = "";
	if(!empty(old())){
		$paid_by = old('paid_by');
		$paid_to = old('paid_to');
		$amount = old('amount');
		$description = old('description');
	}else if(isset($data) and !empty($data)){
		$paid_by = $data->paid_by;
		$paid_to = $data->paid_to;
		$amount = $data->amount;
		$description = $data->description;
	}
@endphp --}}
<div class="row">
	<div class="col-md-6">
		<div class="card border-info">
			<div class="card-header bg-info">
				<h3 class="text-white">Add Menu</h3>
			</div>
			<div class="card-body">
				<form action="{{ route('add-menu') }}" method="post">
					@csrf
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
						<div class="col-md-6 form-group">
							<label for="">Menu Name  <span class="req">*</span></label>
							<input type="text" name="menu_name" class="form-control menu_name" value="{{-- {{ $menu_name }} --}}">
							@error('menu_name') <div class="text-danger">{!! $message !!}</div> @enderror
						</div>
						<div class="col-md-6 form-group">
							<label for="">Price</label>
							<input type="text" name="price" class="form-control price" value="{{-- {{ $price }} --}}">
							@error('price') <div class="text-danger">{!! $message !!}</div> @enderror
						</div>
						<div class="col-md-12 form-group">
							 <label for="sel1">Main Menu</label><br>
                              <select name="main_menu" class="form-control" id="main_menu">
                                @foreach ($menus as $menu)
									 @php
		                                    if (!empty(old('main_menu'))) {
		                                      $_menu = old('main_menu');
		                                    }elseif(!empty($menus)){
		                                      $_menu = $menu->name;
		                                    }else{
		                                      $_menu = "";
		                                    }
		                              @endphp
                                      <option value="{{ $menu->name }}" {{ $_menu == ($menu->name)?"selected":"" }}>{{ $menu->name }}
                                    </option>
                                @endforeach
                              </select>
						</div>

						<div class="col-md-12 text-right">
							<button class="btn btn-success">Submit</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>

	<div class="col-md-6">
		<div class="card border-info">
			<div class="card-header bg-info">
				<h3 class="text-white">Menu List</h3>
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<table class="table table-striped zero-configuration">
						<thead>
							<tr>
								<th>#</th>
								<th>Product Name</th>
								<th>Product Quantity</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							{{-- @forelse($products as  $product) --}}
								<tr>
									<td>{{-- {{ $product['id'] }} --}}</td>
									<td>{{-- {{ $product['product_name'] }} --}}</td>
									<td>{{-- {{ $product['quantity'] }} --}}</td>
									<td>
										<a href="{{-- {{ route('add-product').'?id='.$product['id'] }} --}}"><i class="fa fa-edit"></i></a>
									</td>
								</tr>
							{{-- @empty
								<tr>
									<th class="text-center" colspan="6">There is no record.</th>
								</tr>
							@endforelse --}}
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>

</div>
@include('admin.layouts.footer')