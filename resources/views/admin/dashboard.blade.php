@include('admin.layouts.header')
<div class="container-fluid mt-3">
    <div class="row">
        <div class="col-lg-4 col-sm-12">
            <div class="card gradient-1">
                <div class="card-body">
                    <h3 class="card-title text-white">Total User</h3>
                    <div class="d-inline-block">
                        <h2 class="text-white">{{ $tuser }}</h2>
                        <p class="text-white mb-0">{{ date('d M Y') }}</p>
                    </div>
                    <span class="float-right display-5 opacity-5"><i class="fa fa-money"></i></span>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-sm-12">
            <div class="card gradient-2">
                <div class="card-body">
                    <h3 class="card-title text-white">Total Tables</h3>
                    <div class="d-inline-block">
                        <h2 class="text-white">{{ $ttable }}</h2>
                        <p class="text-white mb-0">{{ date('d M Y') }}</p>
                    </div>
                    <span class="float-right display-5 opacity-5"><i class="fa fa-money"></i></span>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-sm-12">
            <div class="card gradient-3">
                <div class="card-body">
                    <h3 class="card-title text-white">Total Menus</h3>
                    <div class="d-inline-block">
                        <h2 class="text-white">{{ $tmenu }}</h2>
                        <p class="text-white mb-0">{{ date('d M Y') }}</p>
                    </div>
                    <span class="float-right display-5 opacity-5"><i class="fa fa-money"></i></span>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-sm-12">
            <div class="card gradient-4">
                <div class="card-body">
                    <h3 class="card-title text-white">Total Sub Menus</h3>
                    <div class="d-inline-block">
                        <h2 class="text-white">{{ $tsmenu }}</h2>
                        <p class="text-white mb-0">{{ date('d M Y') }}</p>
                    </div>
                    <span class="float-right display-5 opacity-5"><i class="fa fa-money"></i></span>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-sm-12">
            <div class="card gradient-5">
                <div class="card-body">
                    <h3 class="card-title text-white">Total Products</h3>
                    <div class="d-inline-block">
                        <h2 class="text-white">{{ $tproduct }}</h2>
                        <p class="text-white mb-0">{{ date('d M Y') }}</p>
                    </div>
                    <span class="float-right display-5 opacity-5"><i class="fa fa-money"></i></span>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-sm-12">
            <div class="card gradient-8">
                <div class="card-body">
                    <h3 class="card-title text-white">Pending Orders</h3>
                    <div class="d-inline-block">
                        <h2 class="text-white">{{-- {{ $tproduct }} --}} 5</h2>
                        <p class="text-white mb-0">{{ date('d M Y') }}</p>
                    </div>
                    <span class="float-right display-5 opacity-5"><i class="fa fa-money"></i></span>
                </div>
            </div>
        </div>
    </div>
</div>
@include('admin.layouts.footer')