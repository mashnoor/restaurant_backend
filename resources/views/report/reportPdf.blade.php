<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sales Report</title>
</head>

<body>
  <style>
    /*html, body, div,fieldset, form, label, legend, table, caption, tbody, tfoot, thead, tr, th, td,{margin: 0; padding: 0; border: 0; outline: 0; font-weight: inherit; font-style: inherit; font-size: 100%; font-family: inherit; vertical-align:top;}:focus {outline: 0;}*/
table, caption, tbody, tfoot, thead, tr, th, td,{margin: 0; padding: 0; border: 0; outline: 0; font-weight: inherit; font-style: inherit; font-size: 100%; font-family: inherit; vertical-align:top;}:focus {outline: 0;}
    table.order-details{border-collapse: collapse; border-spacing: 0;} 
    
    /*body {font-family: 'FreeSerif',sans-serif;}*/
    table{ font-size:12px; }
    td.title{ font-size:30px; line-height:36px; color:#000;}
    td.subtitle{ font-size:24px; line-height:30px; color:#000;}
    td.mintitle{ font-size:20px; line-height:24px; color:#000;}
    td.mintitles{ font-weight: bold;font-size:12px; line-height:18px;}
    .order-details{border:1px solid #000;}
    .order-details tr.border-bottom{border-bottom:1px solid #000;}
    .order-details tr, .order-details td{ border:0px solid #cecece; text-align:center; padding:10px 0px;}
    table.payment tr{ border:1px solid #000; text-align:center; padding:10px 0px;}
    .only-border tr, .only-border td{border-top:2px solid #000;}

  </style>

  <div class="invoice-table">
    <table width="100%" style="text-align:center; width:100%;">
      <tr><td class="title">Flavours</td></tr>
      <tr><td class="subtitles">Shaheb Bazar, Zero Point (2nd Floor of Bata Shop) Rajshahi.</td></tr>
      <tr><td class="subtitles">Contact Telephone: 772826, Mobile: 01713-228276, 01713-228278</td></tr>
    </table>
    <div class="border" style="border-top:2px solid #000;">&nbsp;</div>
  
    <table width="100%" style="text-align:center; width:100%; margin-top:0px;">
      <tr><td class="titles"><strong>VAT Registration No. : 12011059900</strong></td></tr>
    </table>
    <table width="100%" style="margin-top:30px;">
      <tr>
        <td width="40%" class="subtitles"><strong>Current Date:</strong> <?php echo date('j-M-Y');  ?> </td>
        <td width="20%" class="subtitles">&nbsp;</td>
        <td width="40%" class="subtitles">&nbsp;</td>
      </tr>
    </table>
  
    <table class="order-details" border="1" width="100%" style="margin-top:10px;">
      <tr class="border-bottom" style="border-bottom:1px solid #000;">
        <td width="10%" class="mintitles">SI</td>
        <td width="12%" class="mintitles">Table Name</td>
        <td width="15%" class="mintitles">Payment Mode</td>
        <td width="13%" class="mintitles">Total Bill</td>
        <td width="12%" class="mintitles">Total VAT</td>
        <td width="15%" class="mintitles">Total Discount</td>
        <td width="15%" class="mintitles">Net Payble</td>
      </tr>
      <?php 
       $sub_total = 0;
       $total_vat = 0;
       $total_discount = 0;
       $total_cash = 0;
       $reportSummery = [];
       $id_void=0;
       $i = 0;
      ?>
      @foreach ($reports as $report)
        
     <?php  if($report->status == 6) { $id_void=$report->id; } ?>
      <tr>
        <td>{{ $report->id }}</td>
        <td>{{ $report->code }}</td>
        <td>{{ App\Helper::getPaymentModes()[$report->payment_modes] }}</td>
        <td>{{ $report->sub_total }}</td>
        <td>{{ $report->vat }}</td>
        <td>{{ $report->discount }}</td>
        <td>{{ $report->cash_received }}</td>
        <?php 
        $sub_total += $report->sub_total;
        $total_vat += $report->vat;
        $total_discount += $report->discount;
        $total_cash += $report->cash_received;

        if(array_key_exists(App\Helper::getPaymentModes()[$report->payment_modes], $reportSummery))
        {
          foreach ($reportSummery as $i => $val) {
            if ($i == App\Helper::getPaymentModes()[$report->payment_modes]) {
              $reportSummery[$i] = $reportSummery[$i] + $report->cash_received;
            }
          }
        }
        else
        {
          $reportSummery[App\Helper::getPaymentModes()[$report->payment_modes]] = $report->cash_received;
        }

        $i++;
        ?>
      </tr>
      @endforeach

      <?php 
      $reportSummeryArray = array();
      $m = 0;
      foreach($reportSummery as $ekey => $eval)
      {
        $reportSummeryArray[] = array(0 => $ekey, 1 => $eval);
        $m++;
      }
      ?>

      <tr>
        <td width="10%">&nbsp;</td>
        <td width="12%"><strong>Total Summery</strong></td>
        <td width="15%">&nbsp;</td>
        <td width="13%"><strong>{{ $sub_total }}</strong></td>
        <td width="12%"><strong>{{ $total_vat }}</strong></td>
        <td width="15%"><strong>{{ $total_discount }}</strong></td>
        <td width="15%"><strong>{{ round($total_cash) }}</strong></td>
      </tr>
      <?php  
      $void_discount = 0;
      $void_total = 0;
      $total_void_discount = 0;
      ?>

      <?php if($id_void !=0){ ?>
      <tr class="border-top" style="border-top:1px solid #000; text-align:left;">
        <td width="10%"><strong>Void</strong></td>
        <td colspan="6">&nbsp;</td>
      </tr>

    <?php } ?>
    @foreach ($reports as $report)

     <?php
     if($report->status == 6) { ?>
      <tr>
        <td>{{ $report->id }}</td>
        <td>{{ $report->code }}</td>
        <td>{{ App\Helper::getPaymentModes()[$report->payment_modes] }}</td>
        <td>{{ $report->net_total - $report->cash_received }}</td>
        <td>0.00</td>
        <td>0.00</td>
        <td>0.00</td>
        <?php 
        $void_discount = $report->net_total - $report->cash_received ;
        $total_void_discount = $total_void_discount + ($report->net_total - $report->cash_received);
        $i++;
        ?>
      </tr>
      <?php } ?>

      @endforeach  
    <?php if($id_void !=0){ ?>
    <tr class="border-top" style="border-top:1px solid #000;">
      <td colspan="2">&nbsp;</td>
      <td><strong>Total Void</strong></td>
      <td><strong>{{ $total_void_discount }}</strong></td>
      <td colspan="3">&nbsp;</td>
    </tr>
    <?php } ?>
    </table>

    <table width="100%" style="text-align:center; width:100%; margin-top:30px">
      <tr><td class="subtitle">Payment Mode</td></tr>
    </table>
  
    <table class="table-mode payment-mode" border="1" width="33%" style="margin:10px auto 0px; border-spacing: 0;">
      @foreach ($reportSummeryArray as $element)
      <tr>
        <td width="50%" style="border:1px solid #fff; text-align:center; padding:10px 0px;"> {{ $element[0] }} </td>
        <td width="50%" style="border:1px solid #fff; text-align:center; padding:10px 0px;">{{ round($element[1]) }}</td>
      </tr>
      @endforeach
      <tr>
        <td width="50%" style="border-top:1px solid #000; text-align:center; padding:10px 0px;"><strong>Total Collection</strong></td>
        <td width="50%" style="border-top:1px solid #000; text-align:center; padding:10px 0px;"><strong>{{ round($total_cash) }}</strong></td>
      </tr>
    </table>

  </div>
</body>
</html>
