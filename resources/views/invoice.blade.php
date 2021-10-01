<style>
    #total-print{
box-shadow: 0 0 1in -0.25in rgba(0, 0, 0, 0.5);
padding:2mm;
margin: 0 auto;
width: 100%;
background: #FFF;}

::selection {background: #f31544; color: #FFF;}
::moz-selection {background: #f31544; color: #FFF;}
h1{
font-size: 1.5em;
color: #222;
}
h2{font-size: .9em;}
h3{
font-size: 1.2em;
font-weight: 300;
line-height: 2em;
}
p{
font-size: .7em;
color: #666;
line-height: 1.2em;
}

#top, #mid,#bot{ /* Targets all id with 'col-' */
border-bottom: 1px solid #EEE;
}
#top{min-height: 100px;}
#mid{min-height: 80px;}
#bot{ min-height: 50px;}
#top .logo{
//float: left;
  height: 60px;
  width: 60px;
  background: url(http://michaeltruong.ca/images/logo1.png) no-repeat;
  background-size: 60px 60px;
}
.clientlogo{
float: left;
  height: 60px;
  width: 60px;
  background: url(http://michaeltruong.ca/images/client.jpg) no-repeat;
  background-size: 60px 60px;
border-radius: 50px;
}
.info{
display: block;
//float:left;
margin-left: 0;
}
.title{
float: right;
}
.title p{text-align: right;}
table{
width: 100%;
border-collapse: collapse;
}
.tabletitle{
background: #EEE;
}
.service{border-bottom: 1px solid #EEE;}
.item{width: 24mm;}
.itemtext{font-size: .5em;}
#legalcopy{
margin-top: 5mm;
}
</style>
<div id="total-print" style="display: none;">
  <center id="top">
    <div class="logo"></div>
    <div class="info">
      <h1>Jhok Restaurant</h1>
    </div><!--End Info-->
  </center><!--End InvoiceTop-->
  <div style="width: 100%;">
    <div style="width: 48%;float:left;"><b>Invoice No. : </b>{{ $invoice_no }}</div>
    <div style="width: 48%;float:left;text-align: right;"><b>Date : </b>{{ date('d/m/Y h:i:s A') }}</div>
  </div>
  <div id="mid">
    <div class="info">
      <h2>Contact Info</h2>
      <p style="margin-left: 10px;">
        Address : Main Indus Highway, Rajanpur City</br>
        Phone   : 0332-1751930</br>
      </p>
    </div>
  </div><!--End Invoice Mid-->
    
  <div id="bot">
    <div id="table">
      <table style="width: 100%; font-size: 16px; border-collapse: collapse;">
        <tr class="tabletitle">
          <th style="border: 1px solid #333; padding: 0px 8px;" class="item" style="font-size:18px;">Name</th>
          <th style="border: 1px solid #333; padding: 0px 8px;" class="Hours" style="font-size:18px;">Item/Kg</th>
          <th style="border: 1px solid #333; padding: 0px 8px;" class="Rate" style="font-size:18px;">Sub Total</th>
        </tr>
        @php $tt = 0; @endphp
        @forelse($session_value as $value)
          @php $tt = $tt + $value['price'];
            $mmm = $products->where('id',$value['product_name'])->first();
            $m_name = ($mmm) ? $mmm->product_name : "";
          @endphp
          <tr class="service">
            <td style="border: 1px solid #333; text-align: center;" class="tableitem"><p class="itemtext">{{ $m_name }}</p></td>
            <td style="border: 1px solid #333; text-align: center;" class="tableitem"><p class="itemtext">{{ $value['qty'] }}</p></td>
            <td style="border: 1px solid #333; text-align: center;" class="tableitem"><p class="itemtext">{{ number_format($value['price']) }}</p></td>
          </tr>
        @empty
        @endforelse
        <tr class="tabletitle">
          
          <td style="border: 1px solid #333; text-align: center;" colspan="2" class="Rate"><h2>Total</h2></td>
          <td style="border: 1px solid #333; text-align: center;" class="payment"><h2>{{ number_format($tt) }}</h2></td>
        </tr>
      </table>
    </div><!--End Table-->
    <div id="legalcopy">
      <p class="legal" style="font-size: 18px;text-align: center;"><strong>Thank you for your business!</strong></p>
      <p class="legal" style="font-family: cursive; text-align: center;margin-bottom: 5px;">Powered By:<strong> Future Technology Solution : 0300-5525909</strong></p>
    </div>
  </div><!--End InvoiceBot-->
</div><!--End Invoice-->

<script>
  $(document).ready(function(){
    $('#total-print').css('display','block');
    printJS({
      printable: 'total-print',
      type: 'html',
      style: '@page { size: portrait; }',
    })
    $('#total-print').css('display','none');
  })
</script>