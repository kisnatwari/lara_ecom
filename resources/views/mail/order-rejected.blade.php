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
			box-sizing: border-box;
        }
    </style>
</head>

<body>
    <div style="width: 100%; min-height: 100vh; display: flex; justify-content: center; align-items: center;">
        <div
            style="width: fit-content; height: fit-content; border: solid 2px #9a5a5a; border-top: solid 8px #900; margin: 20px;">
            <p style="background-color: #fcc; padding:10px 30px;">
                Your Product Order has been Canceled
            </p> 
            <div style="background-color:#fee; padding: 10px 30px;">
                Hi {{ auth()->user()->name }}, <br><br>
                We regret to inform you that your order for the product
                <strong>{{ $order->product->product_name }}</strong>
                has been canceled by the seller. <br>
                We apologize for any inconvenience caused.
            
				<div style="width: fit-content; margin: 30px auto; background-color: #fdd; border: dashed 2px #fbb;">
					<p style="padding: 5px 30px; font-size: 20px">
						{{$order -> product -> product_name}}
					</p>
					<p style="padding: 5px 30px;">
						<strong>Rs {{$order -> product -> price}} per unit</strong>
					</p>
					<p style="padding: 5px 30px;">
						<strong>{{$order -> quantity}} Units</strong>
					</p>
					<p style="padding: 5px 30px;">
						<strong>
							Total price: {{$order -> product -> price * $order -> quantity}}
						</strong>
					</p>
				</div>
			</div>
            <h4 style="background-color:#fee; padding: 10px 30px; font-weight: lighter;">Please contact the seller for
                more information.</small>
                <p style="background-color:#fee; padding: 10px 30px; text-align: right; font-style: oblique;">
                    Regards, <br>
                    Upabhog Team
                </p>
        </div>
    </div>
</body>

</html>
