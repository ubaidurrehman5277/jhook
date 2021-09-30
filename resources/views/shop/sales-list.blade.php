@include('user.header')
<link rel="stylesheet" href="{{ asset('assets/css/plugins/tables/css/datatable/dataTables.bootstrap4.min.css') }}">
<style>
	#DataTables_Table_0_wrapper{padding:0px 0px;}
	#DataTables_Table_0_wrapper label .form-control-sm{border: 1px solid #dddfe1}
</style>
<div class="row">
	<div class="col-md-12">
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
		<div class="card border-info">
			<div class="card-header bg-info">
				<h3 class="text-white">Orders List</h3>
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<table class="table table-striped zero-configuration">
						<thead>
							<tr>
								<th>#</th>
								<th>OrderId</th>
								<th>Menu Name x Item/Kg</th>
								<th>Total Price</th>
								<th>Status</th>
								<th>Date</th>
								<th style="text-align: center;">Action</th>
							</tr>
						</thead>
						<tbody>
							@forelse($record as $key => $value)
								@php
									$dddd = explode(',' , $value->product_name);
							    $mm = $all_menus->where('id',$dddd[0])->first();
								@endphp
								<tr>
									<td>{{ ++$key }}</td>
									<td>{{ $value->id }}</td>
									<td>{{ ($mm) ? $mm->product_name : "" }} x {{ $value->quantity }}</td>
									<td>{{ $value->price }}</td>
									<td>{{ ucfirst($value->status) }}</td>
									<td>{{ date('d/m/Y' , strtotime($value->created_at)) }}</td>
									<td style="text-align: center;">
										<a href="{{ route('shop-sale').'?orderid='.$value->id }}"><i class="fa fa-edit"></i></a>
									</td>
								</tr>
							@empty
								<tr>
									<th class="text-center" colspan="6">There is no record.</th>
								</tr>
							@endforelse
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<script src="{{ asset('assets/css/plugins/tables/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/css/plugins/tables/js/datatable/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/css/plugins/tables/js/datatable-init/datatable-basic.min.js') }}"></script>
@include('user.footer')