<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Order Email</title>
</head>
<body style="font-family: Arial, Helvetica, sans-serif; font-size:16px;">
@if ($mailData['userType'] == 'customer')
<h1>Thanks For your order</h1>
  <h2>Your order ID is:{{ $mailData['order']->id}}</h2>
  @else
  <h1>You have received an order:</h1>
  <h2> order ID :{{ $mailData['order']->id}}</h2>
@endif
  
  <h2 class="mb-3">Shipping Address</h2>
  <address>
      <strong>{{ $mailData['order']->first_name }} {{ $mailData['order']->last_name }}</strong><br>
      {{ $mailData['order']->address }}<br>
      {{ $mailData['order']->city }}, {{ $mailData['order']->zip }} {{ countryInfo($mailData['order']->country_id)->name }}<br>
      Phone: {{ $mailData['order']->mobile }}<br>
      Email: {{ $mailData['order']->email }}
  </address>
  <h2>Products</h2>
  <table>
                                            <thead>
                                                <tr style="background:#CCC;">
                                                    <th>Product</th>
                                                    <th>Price</th>
                                                    <th>Qty</th>                                        
                                                    <th>Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($mailData['order']->items as $item)
                                                <tr>
                                                    <td>{{ $item->name }}</td>
                                                    <td>{{ $item->price }}</td>                                        
                                                    <td>{{ $item->qty }}</td>
                                                    <td>{{ $item->total }}</td>
                                                </tr>
                                                @endforeach
                                                <tr>
                                                    <th colspan="3" align="right">Subtotal:</th>
                                                    <td>{{ number_format($mailData['order']->subtotal,2) }}</td>
                                                </tr>
                                                
                                                <tr>
                                                    <th colspan="3" align="right">Shipping:</th>
                                                    <td>{{ number_format($mailData['order']->shipping,2) }}</td>
                                                </tr>
                                                <tr>
                                                    <th colspan="3" align="right">Discount: {{ !empty($mailData['order']->coupon_code ) ? '('.$mailData['order']->coupon_code.')' : ''}}</th>
                                                    <td>{{ number_format($mailData['order']->discount,2) }}</td>
                                                </tr>
                                                <tr>
                                                    <th colspan="3" align="right">Grand Total:</th>
                                                    <td>{{ number_format($mailData['order']->grand_total,2) }}</td>
                                                </tr>
                                            </tbody>
                                        </table>			
</body>
</html>