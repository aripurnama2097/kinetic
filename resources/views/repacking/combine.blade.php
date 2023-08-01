<head>
  {{-- <link rel="stylesheet" type="text/css" href="{{asset ('')}}mainassets/css/style.css"> --}}
  <link rel="stylesheet" type="text/css" href="{{asset ('')}}mainassets/css/bootstrap/css/bootstrap.min.css">
  <script type="text/javascript" src="{{asset ('')}}mainassets/js/bootstrap/js/bootstrap.min.js "></script>
</head>


<div class="col-12">


  <div class="d-flex justify-content-center">
    <div class="table" widht="100%">
        <table  class="border border-dark border-3 col-10  mt-2">
      <thead>
        <tr>
          <td align="center" colspan="6" style="border-color:black;font-size:20px;font-weight:bold" > PT JVC Kenwood Electronics Indonesia</td>
        </tr>
        <tr>
        <td text-align="center"class="text-center " style="font-size:14px;" colspan="6" > PROD NO : {{$param[0]->prodno}}</td>  
        </tr>
        <tr>
        <td  text-align="center"class="text-center "  style="font-size:14px;" colspan="6" > CARTON NO :{{$param[0]->carton_no}}</td>
      </tr>
      <tr>
        <td  text-align="center" class="text-center"    style="font-size:14px;" colspan="6" > TOTAL ITEM:{{ $totalItem}}</td>
      </tr>
        <tr>
          <th class="text-center mb-1" style="font-size: 14px;border-color:black;">QR code</th>
          <th class="text-center mb-1"style="font-size: 14px;border-color:black;">Cust PO</th>
          <th class="text-center mb-1"style="font-size: 14px;border-color:black;">Item No</th>
          <th class="text-center mb-1"style="font-size: 14px;border-color:black;">Item Description</th>
          <th class="text-center mb-1"style="font-size: 14px;border-color:black;">Shelf No</th>
          <th class="text-center mb-1"style="font-size: 14px;border-color:black;">Qty</th>

        </tr>
      </thead>
      <tbody>
        @foreach($param as $key => $value)   
        <tr>   
          {{-- @if (is_array($label) || is_object($label))
          @foreach ($label as $lbl )            --}}
          <?php $barcode =   $value->partno . ':' . $value->partname . ':' . $value->partname . ':' . $value->custpo . ':' . $value->custpo . ':' . $value->shelfno . ':' . $value->qty; ?>
          <td class="text-center mb-1" style="font-size: 13px;border-color:black;"> {!! QrCode::size(50)->generate($barcode) !!}</td>
          <td class="text-center mb-1"style="font-size: 13px;border-color:black;">{{$value->custpo}}</td>
          <td class="text-center mb-1"style="font-size: 13px;border-color:black;">{{$value->partno}}</td>
          <td class="text-center mb-1"style="font-size: 13px;border-color:black;">{{$value->partname}}</td>
          <td class="text-center mb-1"style="font-size: 13px;border-color:black;">{{$value->shelfno}}</td>
          <td class="text-center mb-1"style="font-size: 13px;border-color:black;">{{$value->qty}}</td>
         
         
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  </div>
</div>