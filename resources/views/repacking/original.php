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
  // $custpo          =$param2[0] ->custpo;
  // $partno          =$param2[0]->partno;
  // $partname        =$param2[0]->partname;
  // $dest            =$param2[0]->dest;
  // $shelfno         =$param2[0]->mcshelfno;
  // $prodno          = $param2[0]->prodno;
  // $balance_issue   =$param2[0]->balance_issue;
  // $stdpack         = $param2[0]->stdpack;

  // $scan_issue      =$param2[0]->scan_issue;



  foreach ($param2 as $key => $value) {

      $content  = 'BEGIN:VCARD' . "\n";
      $content .= 'VERSION:2.1' . "\n";
      $content .= 'FN:' . $value->partno . "\n";
      $content .= 'ADR;TYPE=work;' .
        'LABEL="' . $value->partno . '":'
        . $value->partname . ';'
        . $value->balance_issue . ' pcs;'
        . $value->dest . ';'
        . $value->custpo . ';'
        . $value->mcshelfno . ';'
        . $value->idnumber
        . "\n";
      $content   .= 'END:VCARD';


      // var_dump($content);

      $tempDir = './phpqrcode/imgservice/';
      $filename  = $value->idnumber;

      QRcode::png($content, $tempDir . $filename . '.png', QR_ECLEVEL_L, 1);
      // var_dump($dataQR);

      echo '<table width="500px" cellpadding="0" cellspacing="0">';
      echo '<tr>';
      echo '<td colspan="6" align="center" style="font-weight:bold;">PT JVCKenwood Electronics Indonesia</td>';
      echo '</tr>';
      echo '<tr>';
      echo '<td width="70px" align="center" style="font-weight:bold;">ROHS OK</td>';
      echo '<td width="85px" style="font-weight:bold;">CustPO</td>';
      echo '<td width="110px">: ' . substr($value->custpo, 0, 15) . '</td>';
      echo '<td width="98px" style="font-weight:bold;">IDNo</td>';
      echo '<td width="90px">: ' . $value->idnumber . '</td>';
      echo '</tr>';
      echo '<tr>';
      echo '<td rowspan="2" align="center" valign="middle"><img style="max-height: 70px;" src="./phpqrcode/imgservice/' . $value->idnumber . '.png" /></td>';
      echo '<td style="font-weight:bold;">PartNo</td>';
      echo '<td>: ' . substr($value->partno, 0, 15) . '</td>';
      echo '<td style="font-weight:bold;">CustNm</td>';
      echo '<td>: ' . substr($value->dest, 0, 11) . '</td>';
      echo '</tr>';
      echo '<tr>';
      echo '<td style="font-weight:bold;">PartNm</td>';
      echo '<td>: ' . substr($value->partname, 0, 15) . '</td>';
      echo '<td style="font-weight:bold;">ShelfNo</td>';
      echo '<td>: ' . substr($value->mcshelfno, 0, 11) . '</td>';
      echo '</tr>';
      echo '<tr>';
      echo '<td align="center" style="font-weight:bold;">QTY</td>';
      echo '<td>: ' . substr($value->scan_issue, 0, 15) . '</td>';
      echo '<td style="font-weight:bold;"><u>CtnNo</td>';
      echo '<td style="font-weight:bold;">Prod No</td>';
      echo '<td>: ' . substr($value->prodno, 0, 11) . '</td>';
      echo '</tr>';
      echo '<td align="center" style="font-weight:bold;">&nbsp</td>';
      echo '<td style="font-weight:bold;"></td>';
      echo '<td style="font-weight:bold; color:blue;" colspan="2">Barcode Release</td>';
      echo '</tr>';
      echo '</table>';
      echo '<br>';




 //	mencetak di sato small printer
 $barcode = $value->partno . ':' . $value->partname . ':' . $value->scan_issue . ':' . $value->dest . ':' . $value->custpo . ':' . $value->mcshelfno . ':' . $value->idnumber;

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

          $data .= $esc . 'H0150' . $esc . 'V0085' . $esc . 'L0101' . $esc . 'M' . 'CustPO: ' . substr($value->custpo, 0, 15);
          $data .= $esc . 'H0515' . $esc . 'V0085' . $esc . 'L0101' . $esc . 'M' . 'ID.No: ' . substr($value->idnumber, 0, 11);

          $data .= $esc . 'H0150' . $esc . 'V0135' . $esc . 'L0101' . $esc . 'M' . 'PartNo: ' . substr($value->partno, 0, 15);
          $data .= $esc . 'H0515' . $esc . 'V0135' . $esc . 'L0101' . $esc . 'M' . 'CustNm: ' . substr($value->dest, 0, 11);

          $data .= $esc . 'H0150' . $esc . 'V0185' . $esc . 'L0101' . $esc . 'M' . 'PartNm: ' . substr($value->partname, 0, 15);
          $data .= $esc . 'H0515' . $esc . 'V0185' . $esc . 'L0101' . $esc . 'M' . 'ShelfNo: ' . substr($value->mcshelfno, 0, 11);

          $data .= $esc . 'H0040' . $esc . 'V0235' . $esc . 'L0101' . $esc . 'M' . 'QTY: ' . substr($value->scan_issue, 0, 15);
          $data .= $esc . 'H0270' . $esc . 'V0235' . $esc . 'L0101' . $esc . 'M' . 'CtnNo:';
          $data .= $esc . 'H0515' . $esc . 'V0235' . $esc . 'L0101' . $esc . 'M' . 'ProdNo: ' . substr($value->prodno, 0, 11);
          $data .= $esc . 'Q1';
          $data .= $esc . 'Z';
          $handle = $data;

          $print = $handle;


          date_default_timezone_set('Asia/Jakarta');
          $Ymd = gmdate("Ymd");
          $wkt = date('His');
          // ================= //

          $host		= getenv("REMOTE_ADDR");

        //   $myfile 	= fopen("\\\\$host\\PrintSato\\print_". substr($value->idnumber, -6) .".txt", "w") or die("Unable to open file!");
        //   $txt 		= $print;
        //   fwrite($myfile, $txt);
        //   fclose($myfile);
 echo '--------------- --------------- --------------- --------------- --------------- --------------- --------------- ---------------';


        }
      // }
    // }
  ?>
</body>




<!-- @endsection -->
