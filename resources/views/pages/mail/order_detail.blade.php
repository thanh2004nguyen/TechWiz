<!DOCTYPE html>
<html>
<head>
    <title>Order Details</title>
</head>
<body>
    <h2>Order Details</h2>
    <p>Hi {{ $user->name }},</p>
    <p>Thank you for your order. Here are the details:</p>

    <h3>Order ID: {{ $order->order_id }}</h3>
    <p>Order Date: {{ $order->created_at }}</p>

    <h4>Products:</h4>
    <ul>
        @foreach ($order->orderdetail as $detail)
            <li>{{ $detail->product_name }} - {{ $detail->product_price }}VND</li>
        @endforeach
    </ul>

    <p>Total: {{ $order->order_total }}VND</p>

    <p>If you have any questions or need further assistance, please don't hesitate to contact us.</p>

    <p>Best regards,<br>TREE ONE </p>
</body>
</html>