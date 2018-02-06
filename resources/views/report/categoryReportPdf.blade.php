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
        <td width="12%" class="mintitles">Category Name</td>
        <td width="15%" class="mintitles">Menu Name</td>
        <td width="13%" class="mintitles">Quantity</td>
        <td width="12%" class="mintitles">Price</td>
        <td width="15%" class="mintitles">Total</td>
      </tr>
      <?php 
      $totalQuantity = 0;
      $totalPrice = 0;
      $grandTotal = 0;
      ?>
      @foreach ($categories as $categorie)
        <tr>
          <td>{{ $categorie->name }}</td>
          <td>{{ $categorie->Menu }}</td>
          <td>{{ $categorie->Quantity }}</td>
          <td>{{ $categorie->price }}</td>
          <td>{{ $categorie->Total }}</td>
          <?php 
          $totalQuantity += $categorie->Quantity;
          $totalPrice += $categorie->price;
          $grandTotal += $categorie->Total;
          ?>
        </tr>
      @endforeach    

      <tr>
        <td width="10%">&nbsp;</td>
        <td width="12%"><strong>Total Summery</strong></td>
        <td width="13%"><strong>{{ $totalQuantity }}</strong></td>
        <td width="12%"><strong>{{ $totalPrice }}</strong></td>
        <td width="15%"><strong>{{ $grandTotal }}</strong></td>
      </tr>
    </table>
  </div>
</body>
</html>
