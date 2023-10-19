<h1>
    New order has been created!!!
</h1>

<table>
    <tr>
        <th>Order ID</th>
        <td>{{ $order->id }}</td>
    </tr>
    <tr>
        <th>order status</th>
        <td>{{ $order->status }}</td>
    </tr>
    <tr>
        <th>Order Price</th>
        <td>${{ $order->total_price }}</td>
    </tr>
</table>
