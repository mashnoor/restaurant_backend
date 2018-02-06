<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>{{-- Restaurant Management System --}}</title>
<link href="https://fonts.googleapis.com/css?family=Slabo+27px" rel="stylesheet">
</head>

<body>
  <style>
    html, body, div,fieldset, form, label, legend, table, caption, tbody, tfoot, thead, tr, th, td,{margin: 0; padding: 0; border: 0; outline: 0; font-weight: inherit; font-style: inherit; font-size: 100%; font-family: inherit; vertical-align:top;}:focus {outline: 0;}

    table {border-collapse: collapse; border-spacing: 0;} input, select {vertical-align:middle;} abbr[title], dfn[title] {border-bottom:1px dotted; cursor:help;} 
    body {font-family: 'Slabo 27px', serif;}
    td.title{ font-size:30px; line-height:36px; color:#000;}
  td.subtitle{ font-size:14px; line-height:20px; color:#000;}
  .billing, .order-detailss{font-size:12px; line-height:12px;}  
td.subtitles { font-size:12px; line-height:12px; color:#000;} 
td.mintitle{ font-size:13px; line-height:12px; color:#000;}  
.order-details tr, .order-details td{ border:1px solid #000; text-align:center; padding:20px 0px;}
    .order-detailsss tr, .order-detailsss td{ padding:10px 0px;border-left:0px;border-right:0px;border-top:2px solid #000;border-bottom:5px solid #000;}
    .billing tr, .billing td{padding:1px 0px;}

  </style>
  <div class="invoice-table" style="width: 100%; margin:0 auto;">
    <table width="100%" style="text-align:center; width:100%;margin:0 auto;">
      <tr><td class="title">Flavours</td></tr>
      <tr><td class="subtitles">Shaheb Bazar Zero Point (2nd Floor of Bata Shop)<br>
        Rajshahi, Contact Telephone: 772826,<br>
        Mobile: 01713-228276, 01713-228278.
      </td></tr>
    </table>
    <table class="order-detailsss" border="0" width="100%" style="width:100%;margin:10px auto 0px;">
      <tr>
        <td class="subtitles" style="text-align: center;"> <strong>Cash Copy</strong></td>
      </tr>
    </table>
    <table class="billing" width="100%" style="width:100%;margin:10px auto 0px;">
      <tr>
        <td width="55%" class="subtitles">Bill No: {{ $orderManages->id }}</td>
        <td width="45%">VAT Reg: <strong>12011059900</strong></td>
      </tr>
      <tr>
        <td width="55%" class="subtitles">Table Name: {{ $orderManages->table->code }}</td>
        <td width="45%">Mushak - 11 - KA</td>
      </tr>
      <tr>
        <td width="55%" class="subtitles">Waiter Name: {{ $orderManages->waiterName->name }}</td>
        <td width="45%">&nbsp;</td>
      </tr>
      <tr>
        <td width="55%" class="subtitles">Bill Date: <?php echo date('M j, Y'); ?></td>
        <td width="45%">&nbsp;</td>
      </tr>
    </table>
  
    <table class="order-detailss" width="100%" style="width:100%;margin:10px auto 0px;">
      <tr style="border-bottom:3px solid #000;">
        <td width="65%" class="mintitle">Menu Name</td>
        <td width="10%" class="mintitle">Qt</td>
        <td width="15%" class="mintitle">Rate</td>
        <td width="10%" class="mintitle">Amount</td>
      </tr>
     <?php $grandTotal = 0; ?>
      @foreach($orderManages->menus as $menu)
      <tr>
        <td>{{ $menu->name }}</td>
        <td>{{ round($menu->pivot->quantity) }}</td>
        <td>{{ round($menu->pivot->price) }}</td>
        <td>{{ round($menu->pivot->total) }}</td>

        <?php $grandTotal += $menu->pivot->total; ?>
      </tr>
      @endforeach
      <tr style="border-top:3px solid #000;">
        <td colspan="3" width="90%">Total Amount</td>
        <td width="10%"><strong>{{ $grandTotal }}</strong></td>
      </tr>
      
       <tr style="">
       
         <?php if($orderManages->discount_cash != 0) { ?>
          <td colspan="3" width="90%">Discount(cash)</td>
          <td width="10%">{{ $orderManages->discount_cash }}</td>
        <?php } ?>
        <?php if($orderManages->discount != 0) { ?>
         <td colspan="3" width="90%">Discount(%)</td>
            <td width="10%">{{ $orderManages->discount }}</td>
        <?php } ?>
      </tr>
   
      <tr style="">
        <td colspan="3" width="90%">VAT</td>
        <td width="10%">{{ $orderManages->vat }}</td>
      </tr>

      <tr style="border-top:3px solid #000;">
	<td>&nbsp;</td>
        <td colspan="2" width="90%"><strong>Net Payable</strong></td>
        <td width="10%">{{ round($orderManages->cash_received) }}</td>
      </tr>
      <tr>
        <td colspan="5">
        <?php
          //echo App\Helper::numtowords($grandTotal);
        ?>
        {{ App\Helper::numtowords(round($orderManages->cash_received)) }}
        </td>
      </tr>
    </table>
    <table width="100%" style="text-align:center; width:100%; margin:10px auto 0px;">
      <tr><td class="subtitle">Thank you for coming!</td></tr>
      <tr><td class="subtitles">Developed & Maintain by raj IT Solutions Ltd.</td></tr>
    </table>
  </div>
</body>
</html>

<script>
  window.print();
</script>
