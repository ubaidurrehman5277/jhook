<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Jhook Resturant</title>
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/images/favicon.png') }}">
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
    <script src="{{ asset('assets/css/plugins/common/common.min.js') }}"></script>
    <style>
        .req{color:red;font-weight:bolder;}
        .main {
          width: 480px;
          margin: 0 auto;
        }
        table {
          width: 100%;
        }
        .theading {
          font-weight: bold;
          color: #b89f87 ;
        }
        td {
          padding: 10px 0px;
        }
        table tr:nth-child(even){
          border-bottom: 2px solid #e8e8e8;
        }
        table tr:nth-child(odd){
          border-bottom: 2px solid #eae3dc;
        }
        .total {
          border: 1px solid #b59b81;
          border-style: dashed;
          padding: 10px 0px;
          color: #b0947a;
        }
        h2,h5{
          color: #b0947a;
        }
    </style>
    <script>
        var _token = '{{ csrf_token() }}';
    </script>
</head>
<body>

  <div class="main">
    <div class="row mt-3">
      <div class="col-5">
        <h2>INVOICE</h2>
        <h5>INVOICE</h5>
       <p style="font-weight: bold;">00001</p>
       <h5>Date</h5>
        {{ date('M d, Y') }}
      </div>
      <div class="col-7">
        <h5>Jhook Resturant</h5>
        <p><b>Main Saraiki Chaock Road Rajanpur</b></p>
      </div>
    </div>

    <div class="row mt-3">
      <div class="col-12">
        <table>
          <tr style="border-bottom: 3px solid #b89f87;">
            <th class="theading">Item</th>
            <th class="theading">Description</th>
            <th class="theading">Quantity</th>
            <th class="theading">Price</th>
            <th class="theading">Total</th>
          </tr>
          <tr>
            <td>Beef Karhai</td>
            <td>1kg/with Makhan</td>
            <td>2</td>
            <td>1800</td>
            <td>3600</td>
          </tr>
          <tr>
            <td>Chinese</td>
            <td>1 Dish with rita salad </td>
            <td>2</td>
            <td>300</td>
            <td>600</td>
          </tr>
          <tr>
            <td>Raishme Kabab</td>
            <td>Saikh Kabab </td>
            <td>4</td>
            <td>50</td>
            <td>200</td>
          </tr>
        </table>
        <div class="col-12 total">
          <div class="row">
            <div class="col-6">
              <span style="padding-left: 10px;">DUE DATE</span>
              <span style="font-weight: bold;font-size: 22px;padding:0px 10px; ">{{ date('M d,Y')}}</span>
            </div>
            <div class="col-6">
               <span style="padding-left: 10px;">TOTAL BILL</span>
              <span style="font-weight: bold;font-size: 22px;padding: 0px 10px;">3900</span>
            </div>
          </div>
        </div>
        <hr>
        <div style="text-align: center;font-size: 14px">
          <p>Powered By: FuTechSol 0300-5525909</p>
        </div>
      </div>
    </div>
  </div>

  <script src="{{ asset('assets/js/custom.min.js') }}"></script>
  <script src="{{ asset('assets/js/settings.js') }}"></script>
  <script src="{{ asset('assets/js/gleek.js') }}"></script>
  <script src="{{ asset('assets/js/styleSwitcher.js') }}"></script>
</body>
</html>