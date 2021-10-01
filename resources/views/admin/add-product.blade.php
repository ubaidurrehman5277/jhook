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
	<div class="col-md-12">
		<div class="card border-info">
			<div class="card-header bg-info">
				<h3 class="text-white">Add New Product</h3>
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
	                            if (isset($_POST['product_name'])) {
	                              $_product_name = $_POST['product_name'];
	                            }elseif(!empty($data)){
	                              $_product_name = $data['product_name'];
	                            }else{
	                              $_product_name = "";
	                            }
	                          @endphp
							<label for="">Product Name <span class="req">*</span></label>
							<input type="text" name="product_name" class="form-control product_name" value="{{ $_product_name }}">
							@error('product_name') <div class="text-danger">{!! $message !!}</div> @enderror
						</div>
						<div class="col-md-3 form-group">
							@php
	                            if (isset($_POST['pack'])) {
	                              $_pack = $_POST['pack'];
	                            }elseif(!empty($data)){
	                              $_pack = $data['pack'];
	                            }else{
	                              $_pack = 0;
	                            }
	                          @endphp
							<label for=""> Pack <span class="req">*</span></label>
							<input type="number" name="pack" class="form-control pack" value="{{ $_pack }}">
							@error('pack') <div class="text-danger">{!! $message !!}</div> @enderror
						</div>
						<div class="col-md-3 form-group">
							@php
	                            if (isset($_POST['pieces'])) {
	                              $_pieces = $_POST['pieces'];
	                            }elseif(!empty($data)){
	                              $_pieces = $data['pieces'];
	                            }else{
	                              $_pieces = 0;
	                            }
	                          @endphp
							<label for=""> Pieces <span class="req">*</span></label>
							<input type="number" name="pieces" class="form-control pieces" value="{{ $_pieces }}">
							@error('pieces') <div class="text-danger">{!! $message !!}</div> @enderror
						</div>
						<div class="col-md-3 form-group">
							@php
	                            if (isset($_POST['quantity'])) {
	                              $_quantity = $_POST['quantity'];
	                            }elseif(!empty($data)){
	                              $_quantity = $data['quantity'];
	                            }else{
	                              $_quantity = "";
	                            }
	                          @endphp
							<label for=""> Quantity <span class="req">*</span></label>
							<input type="text" name="quantity" class="form-control quantity" value="{{ $_quantity }}" readonly>
							@error('quantity') <div class="text-danger">{!! $message !!}</div> @enderror
						</div>

						<div class="col-md-3 form-group">
							@php
	                            if (isset($_POST['price'])) {
	                              $_price = $_POST['price'];
	                            }elseif(!empty($data)){
	                              $_price = $data['price'];
	                            }else{
	                              $_price = "";
	                            }
	                          @endphp
							<label for=""> Price <span class="req">*</span></label>
							<input type="text" name="price" class="form-control price" value="{{ $_price }}">
							@error('price') <div class="text-danger">{!! $message !!}</div> @enderror
						</div>

						<div class="col-md-6 form-group">
							@php
	                            if (isset($_POST['assuming_price'])) {
	                              $_assuming_price = $_POST['assuming_price'];
	                            }elseif(!empty($data)){
	                              $_assuming_price = $data['assuming_price'];
	                            }else{
	                              $_assuming_price = "";
	                            }
	                          @endphp
							<label for=""> Cost Price <span class="req">*</span></label>
							<input type="text" name="assuming_price" class="form-control assuming_price" value="{{ $_assuming_price }}">
							@error('assuming_price') <div class="text-danger">{!! $message !!}</div> @enderror
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
<script>
	$(document).ready(function(){
		$('.pack , .pieces').on('change',function(){
			var pack = $('.pack').val();
			var pieces = $('.pieces').val();
			$('.quantity').val(Number(pack)*Number(pieces));
		})
	})
</script>
@include('admin.layouts.footer')