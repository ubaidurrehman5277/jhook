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
    </div>
</div>
@include('admin.layouts.footer')