<head>
  <link rel="stylesheet" type="text/css" href="{{asset ('')}}mainassets/css/style.css">
  <link rel="stylesheet" type="text/css" href="{{asset ('')}}mainassets/css/bootstrap/css/bootstrap.min.css">
  <script type="text/javascript" src="{{asset ('')}}mainassets/js/bootstrap/js/bootstrap.min.js "></script>
</head>


{{-- <div class="container"> --}}

  <div class="col-6">


    {{-- <h3 colspan="6" class="text-center mt-3"> PT JVC Kenwood Electronics Indonesia</h3> --}}
    <div class="d-flex justify-content-center">
      <div class="table" widht="80%">
        
        {{-- {{dd($packing_no)}} --}}
        {{-- {{dd($param)}} --}}
        {{-- @foreach($param as $key => $value)  --}}
        {{-- {{dd($boxno)}} --}}
          <table style="border-color:black" class="border border-dark border-3 col-12  mt-2">
            <tbody>
              <tr >
                <td align="center" colspan="3" style="font-weight:bold;border-color:black">PT JVCKenwood Electronics Indonesia</td>
              </tr>
              <tr>
                <td  rowspan="3" width="70px" align="center" style="font-weight:bold;font-size: 30px;vertical-align:middle;border-color:black">{{$param[0]->shipvia}} </td> 
                <td  style="border-color:black">BOX NO</td>
                <td  style="border-color:black">: {{ $param['boxno'] }}</td>
              </tr>
              <tr style="width:70%" style="height:5px">
                <td>DESTINATION</td>
                <td>: {{$param[0]->dest}}</td>
              </tr>
              <tr style="height:5px">
                <td>PACK.LIST NO</td>
                <td>: {{$param['packing_no']}}</td>
              </tr>
              <tr style="height:5px">
                <td>SHIPMENT</td>
                <td>VANNING DATE</td>
                <td>: {{$param[0]->vandate}}</td>
              </tr>
              <tr>
                
              </tr>
            </tbody>
          </table>
          {{-- @endforeach --}}











        {{-- <table class="table-border">
          <tbody> --}}
         {{-- @foreach($param as $key => $value)   --}}

              {{-- <tr>
              <td align="center" colspan="3" style="font-weight:bold;">PT JVCKenwood Electronics Indonesia</td>
              </tr>
              <tr>
                <td  rowspan="3" width="70px" align="center" style="font-weight:bold;font-size: 30px;">{{$value->shipvia}} </td>  
                {{-- <td rowspan="4" align="center" style="font-weight:bold;font-size: 15px;"valign="middle">SHIPMENT</td>          --}}
              
                {{-- <td width="85px" style="font-weight:bold;">BOX NO : </td> --}}
                {{-- @foreach($boxno as $key ) --
                <td width="110px">{{$key}}</td>
                {{-- @endforeach --
              </tr>
              <tr>
                <td width="85px" style="font-weight:bold;">DEST     :</td>
                <td width="110px">  {{$value->dest}}</td>
              </tr>
              <tr>
                <td style="font-weight:bold;">PACKING LIST:</td>
                <td width="85px">  {{$value->shipvia}}</td>
              </tr>
              <tr>
                <td style="font-weight:bold;">VANDATE:</td>
                <td width="85px">  {{$value->vandate}}</td>
              </tr> --}}
            {{-- @endforeach    --}}
            {{-- </tbody>
        </table> --}}
      </div>
    </div>
  </div>
{{-- </div> --}}
   

