@include('superadmin.layouts.header')
@php
	$name = $cnic = $phone = $address = "";
	if(!empty(old())){
		$name = old('name');
		$cnic = old('cnic');
		$phone = old('phone');
		$address = old('address');
	}else if(isset($data) and !empty($data)){
		$name = $data->name;
		$cnic = $data->cnic;
		$phone = $data->phone;
		$address = $data->address;
	}
@endphp
<div class="row">
	<div class="col-md-12">
		<div class="card border-info">
			<div class="card-header bg-info">
				<h3 class="text-white">Add User</h3>
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
						
						<div class="col-md-12">							
							<label for="" class="font-weight-bolder">User Type <span class="req">*</span></label>
							<div class="form-group">
	                            <label class="radio-inline mr-3">
	                                <input type="radio" name="type" value="cashier" checked> Cashier</label>
	                            <label class="radio-inline mr-3">
	                                <input type="radio" name="type" value="shop"> Shop Keeper</label>
							</div>
							@error('email') <div class="text-danger">{!! $message !!}</div> @enderror
						</div>
						<div class="col-md-6 form-group">
							@php
	                            if (isset($_POST['email'])) {
	                              $_email = $_POST['email'];
	                            }elseif(!empty($data)){
	                              $_email = $data['email'];
	                            }else{
	                              $_email = "";
	                            }
	                        @endphp
							<label for="">Email <span class="req">*</span></label>
							<input type="text" name="email" class="form-control email" value="{{ $_email }}">
							@error('email') <div class="text-danger">{!! $message !!}</div> @enderror
						</div>
						<div class="col-md-6 form-group">
							<label for="">Password <span class="req">*</span></label>
							<input type="text" name="password" class="form-control password" value="{{-- {{ $password }} --}}">
							@error('password') <div class="text-danger">{!! $message !!}</div> @enderror
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