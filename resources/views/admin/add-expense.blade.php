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
				<h3 class="text-white">Add New Expense</h3>
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
						<div class="col-md-4 form-group">
							@php
	                            if (isset($_POST['paid_by'])) {
	                              $_paid_by = $_POST['paid_by'];
	                            }elseif(!empty($data)){
	                              $_paid_by = $data['paid_by'];
	                            }else{
	                              $_paid_by = "";
	                            }
	                        @endphp
							<label for="">Paid By <span class="req">*</span></label>
							<input type="text" name="paid_by" class="form-control paid_by" value="{{ $_paid_by }}">
							@error('paid_by') <div class="text-danger">{!! $message !!}</div> @enderror
						</div>
						<div class="col-md-4 form-group">
							@php
	                            if (isset($_POST['paid_to'])) {
	                              $_paid_to = $_POST['paid_to'];
	                            }elseif(!empty($data)){
	                              $_paid_to = $data['paid_to'];
	                            }else{
	                              $_paid_to = "";
	                            }
	                          @endphp
							<label for=""> Paid To <span class="req">*</span></label>
							<input type="text" name="paid_to" class="form-control paid_to" value="{{ $_paid_to }}">
							@error('paid_to') <div class="text-danger">{!! $message !!}</div> @enderror
						</div>
						<div class="col-md-4 form-group">
							@php
	                            if (isset($_POST['amount'])) {
	                              $_amount = $_POST['amount'];
	                            }elseif(!empty($data)){
	                              $_amount = $data['amount'];
	                            }else{
	                              $_amount = 0;
	                            }
	                          @endphp
							<label for=""> Paid Amount <span class="req">*</span></label>
							<input type="number" name="amount" class="form-control amount" value="{{ $_amount }}">
							@error('amount') <div class="text-danger">{!! $message !!}</div> @enderror
						</div>
						<div class="col-md-12 form-group">
							@php
	                            if (isset($_POST['detail'])) {
	                              $_detail = $_POST['detail'];
	                            }elseif(!empty($data)){
	                              $_detail = $data['detail'];
	                            }else{
	                              $_detail = "";
	                            }
	                          @endphp
							<label for="detail"> Detail</label>
							 <textarea class="form-control detail" name="detail" rows="5" id="detail" placeholder="Please Enter Detail Here">{{ $_detail }}</textarea>
							@error('quantity') <div class="text-danger">{!! $message !!}</div> @enderror
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
{{-- <script>
	$(document).ready(function(){
		$('.pack , .pieces').on('change',function(){
			var pack = $('.pack').val();
			var pieces = $('.pieces').val();
			$('.quantity').val(Number(pack)*Number(pieces));
		})
	})
</script> --}}
@include('admin.layouts.footer')