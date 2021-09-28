@include('admin.layouts.header')
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
				<h3 class="text-white">Purchase List</h3>
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<table style="text-align: center;" class="table table-striped zero-configuration">
						<thead>
							<tr>
								<th>#</th>
								<th>Product Name</th>
								<th>Product Quantity</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							@forelse($products as  $product)
								<tr>
									<td>{{ $product['id'] }}</td>
									<td>{{ $product['product_name'] }}</td>
									<td>{{ $product['quantity'] }}</td>
									<td>
										<a href="{{ route('product-list').'?id='.$product->id }}"><i class="fa fa-trash"></i></a>
										<a href="{{ route('add-product').'?id='.$product['id'] }}"><i class="fa fa-edit"></i></a>
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
@include('admin.layouts.footer')