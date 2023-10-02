<head>
  <link rel="stylesheet" type="text/css" href="{{asset ('')}}mainassets/css/style.css">
  <link rel="stylesheet" type="text/css" href="{{asset ('')}}mainassets/css/bootstrap/css/bootstrap.min.css">
  <script type="text/javascript" src="{{asset ('')}}mainassets/js/bootstrap/js/bootstrap.min.js "></script>

  <script LANGUAGE="JavaScript">

    function printWindow(){
        bV = parseInt(navigator.appVersion)
    if (bV >= 4) window.print();
    }

  
</script>
</head>


<body onload="printWindow()">
  <div class="col-12">
    <div class="d-flex justify-content-center">
      <div class="table" widht="80%">
          <table class="border border-dark border-3 col-12 mt-2">
            <thead>
              <tr>
                <?php $content = $data[0]->skid_no . ':' . $packing_no  ?>
               
                <th class="text-center mb-1"style="font-size: 12px;border-color:black;">{!! QrCode::size(50)->generate($content) !!} </th>
                <th  style="border-color:black"class="text-center" > SKID NO : {{$data[0]->skid_no }}</th>
                <th  style="border-color:black"class="text-center" > TOTAL CARTON : {{$tot_carton[0]->tot_carton }}</th>
                <th class="text-center mb-1"   style="border-color:black;">GW :  {{$gw[0]->total_gw }} </th>
              </tr>
              <tr>
              
                {{-- <th   style="border-color:black" class="text-center" >CARTON NO</td> --}}
                <th style="border-color:black"class="text-center" >CUSTPO</td>
                <th style="border-color:black"class="text-center">ITEM NO</td>
                <th style="border-color:black"class="text-center">ITEM DESC</td>
                <th style="border-color:black"class="text-center" colspan="3">PACKING DETAIL</td>
                <th style="border-color:black"class="text-center">TOTAL QTY</td>
                  
               
              </tr> 
            </thead>
            <tbody>
              @foreach ($data as $value )               
             <tr style="border-color:black">     
             </tr>
             <tr>
                <td style="border-color:black"class="text-center">{{$value->custpo}}</td>
                <td style="border-color:black" class="text-center">{{$value->partno}}</td>
                <td style="border-color:black"class="text-center">{{$value->partname}}</td>
                <td style="border-color:black"class="text-center">{{$value->tot_scan}} </td>
                <td style="border-color:black"class="text-center">X</td>
                <td style="border-color:black"class="text-center">{{$value->qty_running}}</td>
                <td style="border-color:black"class="text-center">{{$value->sum_total}}</td>     
              </tr>
              @endforeach           
            </tbody>
          </table>
      </div>
    </div>
  </div>
</body>


