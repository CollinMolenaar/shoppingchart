<!DOCTYPE html>
<html>
<head>
    <title>Order Confirmation</title>
</head>
<body>
<h2>Thank you for your purchase!</h2>
<p>Here are the details of your order:</p>

<table border="1" cellpadding="10">
    <thead>
    <tr>
        <th>Product Name</th>
        <th>Price</th>
        <th>Quantity</th>
        <th>Total</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($cart as $item)
    <tr>
        <td>{{ $item['name'] }}</td>
        <td>${{ number_format($item['price'], 2) }}</td>
        <td>{{ $item['quantity'] }}</td>
        <td>${{ number_format($item['total'], 2) }}</td>
    </tr>
    @endforeach
    </tbody>
    <tfoot>
    <tr>
        <td colspan="3" align="right"><strong>Grand Total:</strong></td>
        <td>${{ number_format($totalAmount, 2) }}</td>
    </tr>
    </tfoot>
</table>

<p>We will send your sale code shortly and we hope to see you again soon!</p>
</body>
</html>
