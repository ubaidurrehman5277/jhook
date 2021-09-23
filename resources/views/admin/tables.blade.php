@include('admin.layouts.header')
<link rel="stylesheet" href="{{ asset('css/plugins/tables/css/datatable/dataTables.bootstrap4.min.css') }}">
<style>
	#DataTables_Table_0_wrapper{padding:0px 0px;}
	#DataTables_Table_0_wrapper label .form-control-sm{border: 1px solid #dddfe1}
</style>
<div class="row">
	<div class="col-md-12">
		<div class="card border-info">
			<div class="card-header bg-info">
				<h3 class="text-white">Expense List</h3>
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<table class="table table-striped zero-configuration">
						<thead>
							<tr>
								<th>#</th>
								<th>Table No:</th>
								<th>Table Capacity</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							@forelse($tables as $key => $value)
								<tr>
									<td>{{ ++$key }}</td>
									<td>{{ $value->table_no }}</td>
									<td>{{ $value->capacity }}</td>
									<td>{{ $value->amount }}</td>
									<td>
										<a href="{{ route('add-expense').'?id='.$value->id }}"><i class="fa fa-edit"></i></a>
									</td>
								</tr>
							@empty
								<tr>
									<th class="text-center" colspan="7">There is no record.</th>
								</tr>
							@endforelse
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<script src="{{ asset('css/plugins/tables/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('css/plugins/tables/js/datatable/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('css/plugins/tables/js/datatable-init/datatable-basic.min.js') }}"></script>
@include('admin.layouts.footer')