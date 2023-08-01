<head>
  <link rel="stylesheet" type="text/css" href="{{asset ('')}}mainassets/css/style.css">
  <link rel="stylesheet" type="text/css" href="{{asset ('')}}mainassets/css/bootstrap/css/bootstrap.min.css">
  <script type="text/javascript" src="{{asset ('')}}mainassets/js/bootstrap/js/bootstrap.min.js "></script>
</head>


{{-- <div class="container"> --}}

  <div class="col-12">

{{-- {{dd($qty)}} --}}
    {{-- <h3 colspan="6" class="text-center mt-3"> PT JVC Kenwood Electronics Indonesia</h3> --}}
    <div class="d-flex justify-content-center">
      <div class="table" widht="80%">
          <table class="border border-dark border-3 col-12 mt-2">
            <thead>
              <tr>
                <th class="text-center" >CUSTPO</td>
                <th class="text-center">ITEM NO</td>
                <th class="text-center">ITEM DESC</td>
                <th class="text-center" colspan="2">PACKING DETAIL</td>
                <th class="text-center">TOTAL QTY</td>
              </tr>
            </thead>
            <tbody>
              @foreach ($data as $value )               
             <tr>     
              {{-- @foreach($qty_running as $key) 
                 @foreach($qty as $keyval)  --}}
                <td class="text-center">{{$value->custpo}}</td>
                <td class="text-center">{{$value->partno}}</td>
                <td class="text-center">{{$value->partname}}</td>
                <td class="text-center"></td>
                <td class="text-center"></td>
                <td class="text-center">{{$value->demand}}</td>
                 {{-- @endforeach
                @endforeach --}}
              </tr>
              @endforeach
             
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


