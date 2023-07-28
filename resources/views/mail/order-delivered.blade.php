<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<style type="text/css">
		*{
			margin: 0;
			padding: 0;
			color: black;
			font-family: sans-serif;
		}
	</style>
</head>
<body>
	<div style="width: 100%; min-height: 100vh; display: flex; justify-content: center; align-items: center;">
		<div style="width: fit-content; height: fit-content; border: solid 2px #5a9a5a; border-top: solid 8px #090; margin: 20px;">
			<p style="background-color: #cfc; padding:10px 30px;">
				Your Order has been Delivered
			</p>
			<p style="background-color:#efe; padding: 10px 30px;">
				Hi {{auth() -> user() -> name}}, <br><br>
				We are delighted to inform you that your order has been successfully delivered. <br>
				We hope you are satisfied with your purchase.
			</p>
			<h4 style="background-color:#efe; padding: 10px 30px; font-weight: lighter;">Thank you for choosing UPABHOG.</small>
			<p style="background-color:#efe; padding: 10px 30px; text-align: right; font-style: oblique;">
				Regards, <br>
				Upabhog Team
			</p>
		</div>
	</div>
</body>
</html>