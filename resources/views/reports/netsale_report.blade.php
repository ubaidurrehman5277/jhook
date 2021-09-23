dssss<!DOCTYPE html>
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
          <th scope="col" style="border-right: 1px solid black;text-align: center;">ID</th>
          <th scope="col" style="border-right: 1px solid black;text-align: center;">Name</th>
          <th scope="col" style="border-right: 1px solid black;text-align: center;">CNIC No.</th>
          <th scope="col" style="border-right: 1px solid black;text-align: center;">Ticket Type</th>
          <th scope="col" style="border-right: 1px solid black;text-align: center;">Audience Type</th>
          <th scope="col" style="border-right: 1px solid black;text-align: center;">Price</th>
          <th scope="col" style="border-right: 1px solid black;text-align: center;">Date</th>
        </tr>
      </thead>
      <tbody style="font-size: 10px;">
        @if(!empty($record))
          @foreach($record as $key => $value)
            <tr>
              <td style="border-right: 1px solid black; border-bottom: 1px solid black; padding:5px;text-align: center;">{{ ++$key }}</td>
              <td style="border-right: 1px solid black; border-bottom: 1px solid black; padding:5px;text-align: center;">{{ $value->id }}</td>
              <td style="border-right: 1px solid black; border-bottom: 1px solid black; padding:5px;">{{ $value->name }}</td>
              <td style="border-right: 1px solid black; border-bottom: 1px solid black; padding:5px;text-align: center;">{{ $value->cnic }}</td>
              <td style="border-right: 1px solid black; border-bottom: 1px solid black; padding:5px;text-align: center;">{{ ucfirst($value->type) }}</td>
              <td style="border-right: 1px solid black; border-bottom: 1px solid black; padding:5px;text-align: center;">{{ ucfirst($value->users) }}</td>
              <td style="border-right: 1px solid black; border-bottom: 1px solid black; padding:5px;text-align: center;">{{ $value->price }}</td>
              <td style="border-right: 1px solid black; border-bottom: 1px solid black; padding:5px;text-align: center;">{{ (!empty($value->created_at))?date('d/m/Y' , strtotime($value->created_at)):"" }}</td>
            </tr>
          @endforeach
        @else
          <tr>
            <td  colspan="7" style="text-align: center;">There is no record</td>
          </tr>
        @endif
      </tbody>
    </table>
  </div>
</div>

</body>
</html>