@include('admin.layouts.header')
@php
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
@endphp
<div class="row">
	<div class="col-md-12">
		<div class="card border-info">
			<div class="card-header bg-info">
				<h3 class="text-white">Add Table</h3>
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
	                            if (isset($_POST['table_no'])) {
	                              $_table_no = $_POST['table_no'];
	                            }elseif(!empty($data)){
	                              $_table_no = $data['table_no'];
	                            }else{
	                              $_table_no = "";
	                            }
	                          @endphp
							<label for="">Table No: <span class="req">*</span></label>
							<input type="number" name="table_no" class="form-control table_no" value="{{ $_table_no }}">
							@error('table_no') <div class="text-danger">{!! $message !!}</div> @enderror
						</div>
						<div class="col-md-6 form-group">
							@php
	                            if (isset($_POST['capacity'])) {
	                              $_capacity = $_POST['capacity'];
	                            }elseif(!empty($data)){
	                              $_capacity = $data['capacity'];
	                            }else{
	                              $_capacity = "";
	                            }
	                          @endphp
							<label for="">Capacity <span class="req">*</span></label>
							<input type="number" name="capacity" class="form-control capacity" value="{{ $_capacity }}">
							@error('capacity') <div class="text-danger">{!! $message !!}</div> @enderror
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
@include('admin.layouts.footer')