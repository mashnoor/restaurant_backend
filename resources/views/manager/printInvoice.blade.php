<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>{{-- Restaurant Management System --}}</title>
</head>

<body>
  <style>
    html, body, div,fieldset, form, label, legend, table, caption, tbody, tfoot, thead, tr, th, td,{margin: 0; padding: 0; border: 0; outline: 0; font-weight: inherit; font-style: inherit; font-size: 100%; font-family: inherit; vertical-align:top;}:focus {outline: 0;}

    table {border-collapse: collapse; border-spacing: 0;} input, select {vertical-align:middle;} abbr[title], dfn[title] {border-bottom:1px dotted; cursor:help;} 
    body {font-family: 'FreeSerif',sans-serif;}
    td.title{ font-size:30px; line-height:36px; color:#000;}
    td.subtitle{ font-size:24px; line-height:30px; color:#000;}
    td.mintitle{ font-size:20px; line-height:24px; color:#000;}
    .order-details tr, .order-details td{ border:1px solid #cecece; text-align:center; padding:10px 0px;}

  </style>
  <div class="invoice-table" style="width: 380px; margin:0 auto;">
    <table width="100%" style="text-align:center; width:100%;">
      <tr><td class="title">Flavours</td></tr>
      <tr><td class="subtitles">Shaheb Bazar Zero Point (2nd Floor of Bata Shop)<br>
        Rajshahi, Contact Telephone: 772826,<br>
        Mobile: 01713-228276, 01713-228278.
      </td></tr>
    </table>
    <table class="order-details" border="1" width="100%" style="margin-top:10px;">
      <tr>
        <td class="subtitles" style="text-align: center;"> <strong>Cash Copy</strong></td>
      </tr>
    </table>
    <table width="100%" style="margin-top:30px;">
      <tr>
        <td width="50%" class="subtitles">Bill No: {{ $orderManages->id }}</td>
        <td width="50%">VAT Reg: <strong>12011059900</strong></td>
      </tr>
      <tr>
        <td width="50%" class="subtitles">Table Name:</td>
        <td width="50%">Mushak - 11 - KA</td>
      </tr>
      <tr>
        <td width="50%" class="subtitles">Waiter Name: Admin</td>
        <td width="50%">&nbsp;</td>
      </tr>
      <tr>
        <td width="50%" class="subtitles">Bill Date: <?php echo date('M j, Y'); ?></td>
        <td width="50%">&nbsp;</td>
      </tr>
    </table>
  
    <table class="order-detailss" width="100%" style="margin-top:10px;">
      <tr style="border-bottom:2px solid #ccc;">
        <td width="35%" class="mintitle">Menu Name</td>
        <td width="10%" class="mintitle">Qt</td>
        <td width="15%" class="mintitle">Rate</td>
        <td width="25%" class="mintitle">Discount</td>
        <td width="15%" class="mintitle">Total</td>
      </tr>
     <?php $grandTotal = 0; ?>
      @foreach($orderManages->menus as $menu)
      <tr>
        <td>{{ $menu->name }}</td>
        <td>{{ $menu->pivot->quantity }}</td>
        <td>{{ $menu->pivot->price }}</td>
        <td>{{ $menu->pivot->discount }}</td>
        <td>{{ $menu->pivot->total }}</td>
        <?php $grandTotal += $menu->pivot->total; ?>
      </tr>
      @endforeach
      <tr style="border-top:2px solid #ccc;">
        <td colspan="4" width="80%"><strong>Net Payable</strong></td>
        <td width="20%">{{ $grandTotal }}</td>
      </tr>
      <tr>
        <td colspan="5">
        <?php
          echo App\Helper::numtowords($grandTotal);
        ?>
        </td>
      </tr>
    </table>
    <table width="100%" style="text-align:center; width:100%; margin-top:30px;">
      <tr><td class="subtitle">Thank you for coming!</td></tr>
      <tr><td class="subtitles">Developed & Maintain by raj IT Solutions Ltd.</td></tr>
    </table>
  </div>
</body>
</html>

<script>
  window.print();
</script>
