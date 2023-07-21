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
       


  // foreach ($get_content as $key => $value) {

  //     $content  = 'BEGIN:VCARD' . "\n";
  //     $content .= 'VERSION:2.1' . "\n";
  //     $content .= 'FN:' . $value->partno . "\n";
  //     $content .= 'ADR;TYPE=work;' .
  //       'LABEL="' . $value->partno . '":'
  //       . $value->partname . ';'
  //       . $value->balance_issue . ' pcs;'
  //       . $value->dest . ';'
  //       . $value->custpo . ';'
  //       . $value->mcshelfno . ';'
  //       . $value->idnumber
  //       . "\n";
  //     $content   .= 'END:VCARD';


  //     // var_dump($content);

  //     $tempDir = './phpqrcode/imgservice/';
  //     $filename  = $value->idnumber;

  //     QRcode::png($content, $tempDir . $filename . '.png', QR_ECLEVEL_L, 1);
      // var_dump($dataQR);
      echo'<div>';
      echo '<table width="80%" cellpadding="0" cellspacing="0">';
      echo '<tr>';
      echo '<td  align="center" style="font-weight:bold;font-size:25px;">PT JVCKenwood Electronics Indonesia</td>'; 
      echo '</tr>';

      echo '<tr>';
      echo '<td colspan="6" align="center" style="font-size:16px;">PROD NO:</td>';
      echo '</tr>';

      echo '<tr>';
      echo '<td colspan="6" align="center" style="font-size:16px;">CARTON NO:</td>';
      echo '</tr>';

      echo '<tr>';
      echo '<td colspan="6" align="center" style="font-size:16px;">TOTAL ITEM:</td>';
      echo '</tr>';
      echo '</table>';
      echo '</div>';
      // echo '</table>';

      // echo '<table width="80%" cellpadding="0" cellspacing="0">';
      echo'<div>';
      echo '<table width="80%" cellpadding="0" cellspacing="0">';
      echo '<tr colspan="6" style="font-size:16px;">QR Code</tr';
      echo '<tr style="font-size:16px;cellspacing:20px">Cust PO</tr';
      echo '<tr style="font-size:16px;">ITEM NO</tr';
      echo '<tr style="font-size:16px;">ITEM DESCRIPTION</tr';
      echo '<tr style="font-size:16px;">SHELF</tr';
      echo '<tr style="font-size:16px;">QTY</tr';
      
      echo '</table>';
      echo '</div>';
   
     


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


        // }
      // }
    // }
  ?>
</body>




<!-- @endsection -->