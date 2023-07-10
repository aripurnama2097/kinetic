<head>
  <link rel="stylesheet" type="text/css" href="{{asset ('')}}mainassets/css/style.css">
  <link rel="stylesheet" type="text/css" href="{{asset ('')}}mainassets/css/bootstrap/css/bootstrap.min.css">
  <script type="text/javascript" src="{{asset ('')}}mainassets/js/bootstrap/js/bootstrap.min.js "></script>
</head>


<div class="container">

  <h3 class="text-center mt-3"> PT JVC Kenwood Electronics Indonesia</h3>
  {{-- 

    ------------------------------------------------------------------------------
  </div> --}}
  {{-- @foreach($get_content as $key => $value)  --}}
    <p class="text-center mb-1"> PROD NO :</p>  
    <p class="text-center mb-1"> CARTON NO :</p>
    <p class="text-center mb-1"> TOTAL ITEM:</p>
{{-- @endforeach --}}
<div class="d-flex justify-content-center">
  <div class="table" widht="100%">
    <table class="table-border-style">
      <thead>
        <tr>
          <th class="text-center mb-1" style="font-size: 15px;">QR code</th>
          <th class="text-center mb-1"style="font-size: 15px;">Cust PO</th>
          <th class="text-center mb-1"style="font-size: 15px;">Item No</th>
          <th class="text-center mb-1"style="font-size: 15px;">Item Description</th>
          <th class="text-center mb-1"style="font-size: 15px;">Shelf No</th>
          <th class="text-center mb-1"style="font-size: 15px;">Qty</th>

        </tr>
      </thead>
      <tbody>
        @foreach($get_content as $key => $value)   
        <tr>   
          {{-- @if (is_array($label) || is_object($label))
          @foreach ($label as $lbl )            --}}
          <?php $barcode =   $value->partno . ':' . $value->partname . ':' . $value->partname . ':' . $value->custpo . ':' . $value->custpo . ':' . $value->shelfno . ':' . $value->qty; ?>
          <td class="text-center mb-1" style="font-size: 15px;"> {!! QrCode::size(50)->generate($barcode) !!}</td>
          <td class="text-center mb-1"style="font-size: 15px;">{{$value->custpo}}</td>
          <td class="text-center mb-1"style="font-size: 15px;">{{$value->partno}}</td>
          <td class="text-center mb-1"style="font-size: 15px;">{{$value->partname}}</td>
          <td class="text-center mb-1"style="font-size: 15px;">{{$value->shelfno}}</td>
          <td class="text-center mb-1"style="font-size: 15px;">{{$value->qty}}</td>
         
         
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  </div>
</div>