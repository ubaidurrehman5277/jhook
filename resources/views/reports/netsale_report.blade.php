<!DOCTYPE html>
<html>
<head>
	<title></title>
    <style>
      body{
        background-color: none;
      }
    </style>
</head>
<body>
  <div  style="width: 100%; ">
  <div  style="text-align: center; width: inherit;">
    <h4>Net Sale Report</h4>
  </div>
  <div style="width: inherit;">
    <table style="border: 1px solid black; width: inherit;border-collapse: collapse;">
      <thead style="font-size: 12px; width: 100%; border-bottom: 1px solid black">
        <tr>
          <th scope="col" style="border-right: 1px solid black;text-align: center;">#</th>
          <th scope="col" style="border-right: 1px solid black;text-align: center;">OrderId</th>
          <th scope="col" style="border-right: 1px solid black;text-align: center;">Table No</th>
          <th scope="col" style="border-right: 1px solid black;text-align: center;">Total Item/Kg</th>
          <th scope="col" style="border-right: 1px solid black;text-align: center;">Total Price</th>
          <th scope="col" style="border-right: 1px solid black;text-align: center;">Date</th>
        </tr>
      </thead>
      <tbody style="font-size: 10px;">
        @if(!empty($record))
          @php $tt = 0; @endphp
          @foreach($record as $key => $value)
            @php
              $mm = $menus->where('id',$value->cat_id)->first();
              $tt = $tt + $value->total_price;
            @endphp
            <tr>
              <td style="border-right: 1px solid black; border-bottom: 1px solid black; padding:5px;text-align: center;">{{ ++$key }}</td>
              <td style="border-right: 1px solid black; border-bottom: 1px solid black; padding:5px;text-align: center;">{{ $value->id }}</td>
              <td style="border-right: 1px solid black; border-bottom: 1px solid black; padding:5px;text-align: center;">{{ $value->table_no }}</td>
              <td style="border-right: 1px solid black; border-bottom: 1px solid black; padding:5px;text-align: center;">{{ $value->qty }}</td>
              <td style="border-right: 1px solid black; border-bottom: 1px solid black; padding:5px;text-align: center;">{{ number_format($value->total_price) }}</td>
              <td style="border-right: 1px solid black; border-bottom: 1px solid black; padding:5px;text-align: center;">{{ (!empty($value->date))?date('d/m/Y' , strtotime($value->date)):"" }}</td>
            </tr>
          @endforeach
          <tr>
            <th style="border-right: 1px solid black; border-bottom: 1px solid black; padding:5px;text-align: right;" colspan="5">Total : </th>
            <th style="border-right: 1px solid black; border-bottom: 1px solid black; padding:5px;text-align: left;">{{ number_format($tt) }}</th>
          </tr>
        @else
          <tr>
            <td  colspan="6" style="text-align: center;">There is no record</td>
          </tr>
        @endif
      </tbody>
    </table>
  </div>
</div>

</body>
</html>