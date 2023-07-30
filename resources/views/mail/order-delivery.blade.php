<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style type="text/css">
        * {
            margin: 0;
            padding: 0;
            color: black;
            font-family: sans-serif;
        }
    </style>
</head>

<body>
    <div style="width: 100%; min-height: 100vh; display: flex; justify-content: center; align-items: center;">
        <div
            style="width: fit-content; height: fit-content; border: solid 2px #5a5a9a; border-top: solid 8px #009; margin: 20px;">
            <p style="background-color: #cfc; padding:10px 30px;">
                Your Product is Out for Delivery
            </p>
            <div style="background-color:#efe; padding: 10px 30px;">
                <p>
                    Hi {{ auth()->user()->name }}, <br><br>
                    We are pleased to inform you that your product is out for delivery. <br>
                    Please keep your phone with you and keep checking email as our delivery executive will contact you
                    shortly.
                </p>
                <div style="width: fit-content; margin: 30px auto; background-color: #dfd; border: dashed 2px #bfb;">
                    <p style="padding: 5px 30px; font-size: 20px">
                        {{ $order->product->product_name }}
                    </p>
                    <p style="padding: 5px 30px;">
                        <strong>Rs {{ $order->product->price }} per unit</strong>
                    </p>
                    <p style="padding: 5px 30px;">
                        <strong>{{ $order->quantity }} Units</strong>
                    </p>
                    <p style="padding: 5px 30px;">
                        <strong>
                            Total price: {{ $order->product->price * $order->quantity }}
                        </strong>
                    </p>
                </div>
            </div>
            <h4 style="background-color:#efe; padding: 10px 30px; font-weight: lighter;">Thank you for choosing
                UPABHOG.</small>
                <p style="background-color:#efe; padding: 10px 30px; text-align: right; font-style: oblique;">
                    Regards, <br>
                    Upabhog Team
                </p>
        </div>
    </div>
</body>

</html>
