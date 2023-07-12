<head>
  <link rel="stylesheet" type="text/css" href="{{asset ('')}}mainassets/css/style.css">
  <link rel="stylesheet" type="text/css" href="{{asset ('')}}mainassets/css/bootstrap/css/bootstrap.min.css">
  <script type="text/javascript" src="{{asset ('')}}mainassets/js/bootstrap/js/bootstrap.min.js "></script>
</head>


{{-- <div class="container"> --}}

  <div class="col-12">


    {{-- <h3 colspan="6" class="text-center mt-3"> PT JVC Kenwood Electronics Indonesia</h3> --}}
    <div class="d-flex justify-content-center">
      <div class="table" widht="80%">
          <table class="border border-dark border-3 col-12 mt-2">
            <thead>
              <tr>
                <th >CUSTPO</td>
                <th >ITEM NO</td>
                <th >ITEM DESC</td>
                <th >PACKING DETAIL</td>
                <th >TOTAL QTY</td>
              </tr>
            </thead>
            <tbody>
              @foreach ($data as $value )               
             <tr>     
                <td>{{$value->custpo}}</td>
                <td>{{$value->partno}}</td>
                <td>{{$value->partname}}</td>
                <td>{{$value->act_running}}</td>
                <td>{{$value->demand}}</td>
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


