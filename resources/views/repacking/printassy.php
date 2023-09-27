<head>
  <style type="text/css">
    .body2 {
      font: 82.5%/1.6 Arial;
    }

    table {
      border: 1px solid #000
    }

    td,
    th {
      border: none
    }
  </style>
</head>


<?php
include('./phpqrcode/qrlib.php');
?>

<body>
<?php


  // DECLARE PARAMETER
  // $custpo          =$param[0] ->custpo;
  // $partno          =$param[0]->partno;
  // $partname        =$param[0]->partname;
  // $dest            =$param[0]->dest;
  // $shelfno         =$param[0]->shelfno;
  // $prodno          = $param[0]->prodno;
  // $balance_issue   =$param[0]->balance_issue;
  // $stdpack         = $param[0]->stdpack;

  // $qty_input      =$param[0]->qty_input;

          $getid =  $param[0]->idnumber;

       
	        $label 	= intval($param[0]->qty_input / $stdpack[0]->stdpack);
					$sisa  	=$param[0]->qty_input % $stdpack[0]->stdpack;
					$qtystd = $label;
					$qtybal = $sisa;
					if($sisa > 0){$label++;}

          else if($sisa > 0){$getid++;}
					
					for ($y=1; $y<=$qtystd; $y++){

  // foreach ($param as $key => $param[0]) {

            $content  = 'BEGIN:VCARD' . "\n";
            $content .= 'VERSION:2.1' . "\n";
            $content .= 'FN:' . $param[0]->partno . "\n";
            $content .= 'ADR;TYPE=work;' .
              'LABEL="' . $param[0]->partno . '":'
              . $param[0]->partname . ';'
              . $stdpack[0]->stdpack . ' pcs;'
              . $param[0]->dest . ';'
              . $param[0]->custpo . ';'
              . $param[0]->shelfno . ';'
              . $getid
              . "\n";
            $content   .= 'END:VCARD';


      // var_dump($content);

      $tempDir = './phpqrcode/imgservice/';
      $filename  = $getid;

      QRcode::png($content, $tempDir . $filename . '.png', QR_ECLEVEL_L, 1);
      // var_dump($dataQR);

      echo '<table width="500px" cellpadding="0" cellspacing="0">';
      echo '<tr>';
      echo '<td colspan="6" align="center" style="font-weight:bold;">PT JVCKenwood Electronics Indonesia</td>';
      echo '</tr>';
      echo '<tr>';
      echo '<td width="70px" align="center" style="font-weight:bold;">ROHS OK</td>';
      echo '<td width="85px" style="font-weight:bold;">CustPO</td>';
      echo '<td width="110px">: ' . substr($param[0]->custpo, 0, 15) . '</td>';
      echo '<td width="98px" style="font-weight:bold;">IDNo</td>';
      echo '<td width="90px">: ' . $getid . '</td>';
      echo '</tr>';
      echo '<tr>';
      echo '<td rowspan="2" align="center" valign="middle"><img style="max-height: 70px;" src="./phpqrcode/imgservice/' . $getid . '.png" /></td>';
      echo '<td style="font-weight:bold;">PartNo</td>';
      echo '<td>: ' . substr($param[0]->partno, 0, 15) . '</td>';
      echo '<td style="font-weight:bold;">CustNm</td>';
      echo '<td>: ' . substr($param[0]->dest, 0, 11) . '</td>';
      echo '</tr>';
      echo '<tr>';
      echo '<td style="font-weight:bold;">PartNm</td>';
      echo '<td>: ' . substr($param[0]->partname, 0, 15) . '</td>';
      echo '<td style="font-weight:bold;">ShelfNo</td>';
      echo '<td>: ' . substr($param[0]->shelfno, 0, 11) . '</td>';
      echo '</tr>';
      echo '<tr>';
      echo '<td align="center" style="font-weight:bold;">QTY</td>';
      echo '<td>: ' . substr($stdpack[0]->stdpack, 0, 15) . '</td>';
      echo '<td style="font-weight:bold;"><u>CtnNo</td>';
      echo '<td style="font-weight:bold;">Prod No</td>';
      echo '<td>: ' . substr($param[0]->prodno, 0, 11) . '</td>';
      echo '</tr>';
      echo '<td align="center" style="font-weight:bold;">&nbsp</td>';
      echo '<td style="font-weight:bold;"></td>';
      echo '<td style="font-weight:bold; color:blue;" colspan="2">Barcode Release</td>';
      echo '</tr>';
      echo '</table>';
      echo '<br>';




 //	mencetak di sato small printer
 $barcode = $param[0]->partno . ':' . $param[0]->partname . ':' . $stdpack[0]->stdpack . ':' . $param[0]->dest . ':' . $param[0]->custpo . ':' . $param[0]->shelfno . ':' . $getid;

          if (strlen(strlen($barcode)) == 1) {
            $len = '000' . strlen($barcode);
          } else if (strlen(strlen($barcode)) == 2) {
            $len = '00' . strlen($barcode);
          } else if (strlen(strlen($barcode)) == 3) {
            $len = '0' . strlen($barcode);
          } else {
            $len = strlen($barcode);
          }
          $esc = chr(27);
          $data = '';
          $data .= $esc . 'A';
          $data .= $esc . 'H0070' . $esc . 'V0010' . $esc . 'L0202' . $esc . 'L0202' . $esc . 'S' . 'PT JVCKenwood Electronics Indonesia';
          $data .= $esc . 'H0032' . $esc . 'V0085' . $esc . 'L0101' . $esc . 'M' . 'Rohs OK';
          $data .= $esc . 'H0035' . $esc . 'V0120' . $esc . '2D30,L,03,0,0' . $esc . 'DN' . $len . ',' . $barcode;

          $data .= $esc . 'H0150' . $esc . 'V0085' . $esc . 'L0101' . $esc . 'M' . 'CustPO: ' . substr($param[0]->custpo, 0, 15);
          $data .= $esc . 'H0515' . $esc . 'V0085' . $esc . 'L0101' . $esc . 'M' . 'ID.No: ' . substr($getid, 0, 11);

          $data .= $esc . 'H0150' . $esc . 'V0135' . $esc . 'L0101' . $esc . 'M' . 'PartNo: ' . substr($param[0]->partno, 0, 15);
          $data .= $esc . 'H0515' . $esc . 'V0135' . $esc . 'L0101' . $esc . 'M' . 'CustNm: ' . substr($param[0]->dest, 0, 11);

          $data .= $esc . 'H0150' . $esc . 'V0185' . $esc . 'L0101' . $esc . 'M' . 'PartNm: ' . substr($param[0]->partname, 0, 15);
          $data .= $esc . 'H0515' . $esc . 'V0185' . $esc . 'L0101' . $esc . 'M' . 'ShelfNo: ' . substr($param[0]->shelfno, 0, 11);

          $data .= $esc . 'H0040' . $esc . 'V0235' . $esc . 'L0101' . $esc . 'M' . 'QTY: ' . substr($stdpack[0]->stdpack, 0, 15);
          $data .= $esc . 'H0270' . $esc . 'V0235' . $esc . 'L0101' . $esc . 'M' . 'CtnNo:';
          $data .= $esc . 'H0515' . $esc . 'V0235' . $esc . 'L0101' . $esc . 'M' . 'ProdNo: ' . substr($param[0]->prodno, 0, 11);
          $data .= $esc . 'Q1';
          $data .= $esc . 'Z';
          $handle = $data;

          $print = $handle;


          date_default_timezone_set('Asia/Jakarta');
          $Ymd = gmdate("Ymd");
          $wkt = date('His');
          // ================= //

          // $host		= getenv("REMOTE_ADDR");
        
          // $myfile 	= fopen("\\\\$host\\PrintSato\\print_". substr($value->idnumber, -6) .".txt", "w") or die("Unable to open file!");
          // $txt 		= $print;
          // fwrite($myfile, $txt);
          // fclose($myfile);
 echo '--------------- --------------- --------------- --------------- --------------- --------------- --------------- ---------------';


        }

      // }
      // }
    // }
  ?>
</body>




<!-- @endsection -->