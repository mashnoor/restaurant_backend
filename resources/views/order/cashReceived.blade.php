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
  <div class="invoice-table">
    <table width="100%" style="text-align:center; width:100%;">
      <tr><td class="title">Restaurant Management System</td></tr>
      <tr><td class="subtitle">Invoice Table</td></tr>
    </table>
    <table width="100%" style="margin-top:30px;">
      <tr>
        {{-- <td width="20%" class="subtitles">Order No: {{ $orderManages->id }}</td> --}}
        <td colspan="2" width="50%" class="subtitles">&nbsp;</td>
        <td width="30%" class="subtitles">Invoice No: {{ $orderManages->id }}</td>
      </tr>
      <tr>
        <td width="20%" class="subtitles">&nbsp;</td>
        <td width="50%" class="subtitles">&nbsp;</td>
        <td width="30%" class="subtitles">Order Date: <?php echo date('M j, Y'); ?></td>
      </tr>
    </table>
  
    <table width="100%" style="text-align:center; width:100%;">
      <tr><td class="title">Order Details</td></tr>
    </table>
    <table class="order-details" border="1" width="100%" style="margin-top:10px;">
      <tr>
        <td width="20%" class="mintitle">Menu Name</td>
        <td width="15%" class="mintitle">Quantity</td>
        <td width="15%" class="mintitle">Price</td>
        <td width="15%" class="mintitle">Discount</td>
        <td width="20%" class="mintitle">Total</td>
       
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
      <tr>
        <td colspan="4" width="80%">Total Amount</td>
        <td width="20%">{{ $grandTotal }}</td>
      </tr>

    </table>

  </div>
</body>
</html>

<script>
  window.print();
</script>
