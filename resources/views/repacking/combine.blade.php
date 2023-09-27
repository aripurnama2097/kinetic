<head>
  {{-- <link rel="stylesheet" type="text/css" href="{{asset ('')}}mainassets/css/style.css"> --}}
  <link rel="stylesheet" type="text/css" href="{{asset ('')}}mainassets/css/bootstrap/css/bootstrap.min.css">
  <script type="text/javascript" src="{{asset ('')}}mainassets/js/bootstrap/js/bootstrap.min.js "></script>
</head>


<div class="col-6">


  <div class="d-flex justify-content-center">
    <div class="table border-4" widht="100%">
        <table  class="border border-dark border-3 col-10  mt-2">
      <thead>
        <tr>
          <td align="center" colspan="6" style="border-color:black;font-size:20px;" > PT JVC Kenwood Electronics Indonesia</td>
        </tr>
        <tr>     
            <td  align="center"  rowspan="1" colspan="6"  style="font-weight:bold;font-size: 20px;vertical-align:middle;border-color:black">PART LIST </td>
        
        <tr>
          <td  align="center"  cellspacing ="2" class="text-center " style="font-size:14px;border-color:black;" colspan="6" > PROD NO : {{$param[0]->prodno}}</td>  
        </tr>
        <tr>
          <td  align="center"  class="text-center "  style="font-size:14px;" colspan="6" > CARTON NO :{{$combine_no}}</td>
        </tr>
        <tr>
          <td  align="center"  class="text-center"    style="font-size:14px;" colspan="6" > TOTAL ITEM:{{ $totalItem}}</td>
        </tr>

      </tr>
        <tr >
          <th class="text-center mb-1" style="font-size:12px;border-color:black;">QR code</th>
          <th class="text-center mb-1"style="font-size:12px;border-color:black;">Cust PO</th>
          <th class="text-center mb-1"style="font-size:12px;border-color:black;width:200px">Item No</th>
          <th class="text-center mb-1"style="font-size:12px;border-color:black;">Item Description</th>
          <th class="text-center mb-1"style="font-size:12px;border-color:black;">Shelf No</th>
          <th class="text-center mb-1"style="font-size:12px;border-color:black;">Qty</th>

        </tr>
      </thead>
      <tbody>
        @foreach($param as $key => $value)   
        <tr>   
          {{-- @if (is_array($label) || is_object($label))
          @foreach ($label as $lbl )      
                --}}

          <?php $barcode =   $value->partno . ':' . $value->partname . ':' . $value->qty. ':' . $value->dest . ':' . $value->custpo . ':' . $value->shelfno . ':' . $value->sequence_no ?>
          <td class="text-center mb-1" style="font-size: 12px;border-color:black;"> {!! QrCode::size(50)->generate($barcode) !!}</td>
          <td class="text-center mb-1"style="font-size: 12px;border-color:black;">{{$value->custpo}}</td>
          <td class="text-center mb-1"style="font-size: 12px;border-color:black;">{{$value->partno}}</td>
          <td class="text-center mb-1"style="font-size: 12px;border-color:black;">{{$value->partname}}</td>
          <td class="text-center mb-1"style="font-size: 12px;border-color:black;">{{$value->shelfno}}</td>
          <td class="text-center mb-1"style="font-size: 12px;border-color:black;">{{$value->qty}}</td>
         
         
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  </div>
</div>