<head>
  {{-- <link rel="stylesheet" type="text/css" href="{{asset ('')}}mainassets/css/style.css"> --}}
  <link rel="stylesheet" type="text/css" href="{{asset ('')}}mainassets/css/bootstrap/css/bootstrap.min.css">
  <script type="text/javascript" src="{{asset ('')}}mainassets/js/bootstrap/js/bootstrap.min.js "></script>


  <style>
    * {
        padding: 0;
        margin-left: 1.5px;
        margin-top: 5px;
        margin-right: 2px;
        margin-bottom: 3px;

    }

    table,
    th,
    td {
        border: solid black 1px;
        border-collapse: collapse;
    }

    table {
       
        width: 14cm;
        /* height: 1cm;
        margin-top: 3px;
        margin-bottom: 2px;
        margin-left: 0.5px;
        margin-right: 1.5px; */
        float: left;
    }

    td {
        text-align: center;
    }

    /* .qrcode{ width: 2cm; } */
    .custpo{
        width: 3cm;
        text-align: center;
    }

    .partno {
        width: 4cm;
        text-align: center;
    }

    .partname {
        width: 3cm;
        text-align: center;
    }

    .shelfno {
        width: 3.5cm;
        text-align: center;
    }

    .qty {
      width: 1.5cm;
      text-align: center;
    }
    .trcontent{
      height:2cm;
      text-align: center;
    }

</style>
</head>


<div class="col-6">


  <div class="d-flex justify-content-center">
    <div class="table border-4" widht="100%">
        <table>
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
          <th class="qrcode "  style="font-size:12px;border-color:black;">QR code</th>
          <th class="custpo"  style="font-size:12px;border-color:black;">Cust PO</th>
          <th class="partno"  style="font-size:12px;border-color:black;">Item No</th>
          <th class="partname"style="font-size:12px;border-color:black;">Item Description</th>
          <th class="shelfno"style="font-size:12px;border-color:black;">Shelf No</th>
          <th class="qty"  style="font-size:12px;border-color:black;">Qty</th>

        </tr>
      </thead>
      <tbody>
        @foreach($param as $key => $value)   
        <tr class="trcontent">   
          <?php $barcode =   $value->partno . ':' . $value->partname . ':' . $value->qty. ':' . $value->dest . ':' . $value->custpo . ':' . $value->shelfno . ':' . $value->sequence_no ?>
          <td class="text-center qrcode" style="font-size: 12px;border-color:black;align:center"> {!! QrCode::size(40)->generate($barcode) !!}</td>
          <td   class="text-center custpo" style="font-size: 12px;border-color:black;align:center">{{$value->custpo}}</td>
          <td  class="text-center partno" style="font-size:12px;border-color:black;align:center">{{$value->partno}}</td>
          <td class="text-center partname"style="font-size: 12px;border-color:black;align:center">{{$value->partname}}</td>
          <td class="text-center shelfno"style="font-size: 12px;border-color:black;align:center">{{$value->shelfno}}</td>
          <td class="text-center qty"  style="font-size: 12px;border-color:black;align:center">{{$value->qty}}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  </div>
</div>