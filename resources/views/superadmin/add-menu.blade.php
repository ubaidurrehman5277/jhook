@include('admin.layouts.header')
@php
	$menu_name = $price = $_menu = $assuming_price = "";
	if(!empty(old())){
		$menu_name = old('menu_name');
		$price = old('price');
		$_menu = old('_menu');
		$assuming_price = old('assuming_price');
	}else if(isset($data) and !empty($data)){
		$menu_name = $data->name;
		$price = $data->price;
		$_menu = $data->main_menu;
		$assuming_price = $data->asuming_price;
	}
@endphp
<div class="row">
	<div class="col-md-6">
		<div class="card border-info">
			<div class="card-header bg-info">
				<h3 class="text-white">Add Menu</h3>
			</div>
			<div class="card-body">
				<form action="{{ (!empty($data)) ? route('add-menu')."?id=".$data->id : route('add-menu') }}" method="post">
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
						<div class="col-md-12 form-group">
							<label for="">Menu Name  <span class="req">*</span></label>
							<input type="text" name="menu_name" class="form-control menu_name" value="{{ $menu_name }}">
							@error('menu_name') <div class="text-danger">{!! $message !!}</div> @enderror
						</div>
						<div class="col-md-12 form-group">
							<label for="">Price</label>
							<input type="text" name="price" class="form-control price" value="{{ $price }}">
							@error('price') <div class="text-danger">{!! $message !!}</div> @enderror
						</div>
						<div class="col-md-12 form-group">
							<label for="">Assuming Price</label>
							<input type="text" name="assuming_price" class="form-control assuming_price" value="{{ $assuming_price }}">
							@error('assuming_price') <div class="text-danger">{!! $message !!}</div> @enderror
						</div>
						<div class="col-md-12 form-group">
							<label for="sel1">Main Menu</label><br>
              <select name="main_menu" class="form-control" id="main_menu">
              	<option value="">Choose an Option</option>
                @foreach ($menus as $menu)
                  <option value="{{ $menu->id }}" {{ $_menu == ($menu->id)?"selected":"" }}>
                  	{{ $menu->name }}
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
								<th>Name</th>
								<th>Price</th>
								<th>Main Menu</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							@forelse($items as  $item)
								@php
									if (!empty($item->main_menu)) {
										$mmdad = $items->where('id',$item->main_menu)->first();
										$mm = ($mmdad) ? $mmdad->name : "";
									}else{
										$mm = "";
									}
								@endphp
								<tr>
									<td>{{ $item->name }}</td>
									<td>{{ $item->price }}</td>
									<td>{{ $mm }}</td>
									<td>
										<a href="{{ route('add-menu').'?id='.$item->id }}"><i class="fa fa-edit"></i></a>
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
@include('admin.layouts.footer')