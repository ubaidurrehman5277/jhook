@include('superadmin.layouts.header')
@php
	$name = $qty = $price = "";
	// if(!empty(old())){
	// 	$paid_by = old('paid_by');
	// 	$paid_to = old('paid_to');
	// 	$amount = old('amount');
	// 	$description = old('description');
	// }else if(isset($data) and !empty($data)){
	// 	$paid_by = $data->paid_by;
	// 	$paid_to = $data->paid_to;
	// 	$amount = $data->amount;
	// 	$description = $data->description;
	// }
@endphp
<div class="row">
	<div class="col-md-12">
		<div class="card border-info">
			<div class="card-header bg-info">
				<h3 class="text-white">Add New Gradient</h3>
			</div>
			<div class="card-body">
				<form action="" method="post">
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
							@php
	                            if (isset($_POST['name'])) {
	                              $_product_name = $_POST['name'];
	                            }elseif(!empty($data)){
	                              $_product_name = $data['name'];
	                            }else{
	                              $_product_name = "";
	                            }
	                          @endphp
							<label for="">Product Name <span class="req">*</span></label>
							<input type="text" name="name" class="form-control name" value="{{ $_product_name }}">
							@error('name') <div class="text-danger">{!! $message !!}</div> @enderror
						</div>
						<div class="col-md-6 form-group">
							@php
	                            if (isset($_POST['qty'])) {
	                              $_qty = $_POST['qty'];
	                            }elseif(!empty($data)){
	                              $_qty = $data['qty'];
	                            }else{
	                              $_qty = "";
	                            }
	                          @endphp
							<label for=""> Quantity <span class="req">*</span></label>
							<input type="text" name="qty" class="form-control qty" value="{{ $_qty }}">
							@error('qty') <div class="text-danger">{!! $message !!}</div> @enderror
						</div>
						
						<div class="col-md-12 text-right">
							<button class="btn btn-success">Submit</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@include('superadmin.layouts.footer')