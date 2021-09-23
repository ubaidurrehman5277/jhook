@include('admin.layouts.header')
<div class="container-fluid mt-3">
    <div class="row">
        <div class="col-lg-4 col-sm-12">
            <div class="card gradient-7">
                <div class="card-body">
                    <h3 class="card-title text-white">Total Purchase Quantity</h3>
                    <div class="d-inline-block">
                        <h2 class="text-white">{{-- {{ $total_purchase_qty }} --}} 5</h2>
                        <p class="text-white mb-0">{{-- {{ date('d M Y') }} --}} 22/03/2021</p>
                    </div>
                    <span class="float-right display-5 opacity-5"><i class="fa fa-money"></i></span>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-sm-12">
            <div class="card gradient-8">
                <div class="card-body">
                    <h3 class="card-title text-white">Total Sale Quantity</h3>
                    <div class="d-inline-block">
                        <h2 class="text-white">{{-- {{ $total_sale_qty }} --}} 230</h2>
                        <p class="text-white mb-0">{{-- {{ date('d M Y') }} --}} 24/04/2022</p>
                    </div>
                    <span class="float-right display-5 opacity-5"><i class="fa fa-money"></i></span>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-sm-12">
            <div class="card gradient-9">
                <div class="card-body">
                    <h3 class="card-title text-white">Total Available Stock Price</h3>
                    <div class="d-inline-block">
                        <h2 class="text-white">{{-- {{ number_format($_stock_price) }} --}} 2320</h2>
                        <p class="text-white mb-0">{{-- {{ date('d M Y') }} --}} </p>
                    </div>
                    <span class="float-right display-5 opacity-5"><i class="fa fa-money"></i></span>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-sm-12">
            <div class="card gradient-1">
                <div class="card-body">
                    <h3 class="card-title text-white">Net Sale Amount</h3>
                    <div class="d-inline-block">
                        <h2 class="text-white">{{-- {{ number_format($sale) }} --}} 2335</h2>
                        <p class="text-white mb-0">{{ date('d M Y') }}</p>
                    </div>
                    <span class="float-right display-5 opacity-5"><i class="fa fa-money"></i></span>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-sm-12">
            <div class="card gradient-2">
                <div class="card-body">
                    <h3 class="card-title text-white">Total Ledger</h3>
                    <div class="d-inline-block">
                        <h2 class="text-white">{{-- {{ number_format($ledger) }} --}}3457</h2>
                        <p class="text-white mb-0">{{ date('d M Y') }}</p>
                    </div>
                    <span class="float-right display-5 opacity-5"><i class="fa fa-money"></i></span>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-sm-12">
            <div class="card gradient-3">
                <div class="card-body">
                    <h3 class="card-title text-white">Today's Expense</h3>
                    <div class="d-inline-block">
                        <h2 class="text-white">{{-- {{ number_format($expense) }} --}} 2457</h2>
                        <p class="text-white mb-0">{{ date('d M Y') }}</p>
                    </div>
                    <span class="float-right display-5 opacity-5"><i class="fa fa-money"></i></span>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-sm-12">
            <div class="card gradient-4">
                <div class="card-body">
                    <h3 class="card-title text-white">Total Purchase</h3>
                    <div class="d-inline-block">
                        <h2 class="text-white">{{-- {{ number_format($total_purchase) }} --}} 54565</h2>
                        <p class="text-white mb-0">{{ date('d M Y') }}</p>
                    </div>
                    <span class="float-right display-5 opacity-5"><i class="fa fa-money"></i></span>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-sm-12">
            <div class="card gradient-5">
                <div class="card-body">
                    <h3 class="card-title text-white">Total Sales</h3>
                    <div class="d-inline-block">
                        <h2 class="text-white">{{-- {{ number_format($total_sale) }} --}} 466576</h2>
                        <p class="text-white mb-0">{{ date('d M Y') }}</p>
                    </div>
                    <span class="float-right display-5 opacity-5"><i class="fa fa-money"></i></span>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-sm-12">
            <div class="card gradient-6">
                <div class="card-body">
                    <h3 class="card-title text-white">Total Available Product</h3>
                    <div class="d-inline-block">
                        <h2 class="text-white">{{-- {{ $total_qty }} --}} 344</h2>
                        <p class="text-white mb-0">{{ date('d M Y') }}</p>
                    </div>
                    <span class="float-right display-5 opacity-5"><i class="fa fa-money"></i></span>
                </div>
            </div>
        </div>
    </div>
</div>
@include('admin.layouts.footer')