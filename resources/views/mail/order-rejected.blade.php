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
		<div style="width: fit-content; height: fit-content; border: solid 2px #9a5a5a; border-top: solid 8px #900; margin: 20px;">
			<p style="background-color: #fcc; padding:10px 30px;">
				Your Product Order has been Canceled
			</p>
			<p style="background-color:#fee; padding: 10px 30px;">
				Hi {{auth() -> user() -> name}}, <br><br>
				We regret to inform you that your product order has been canceled by the seller. <br>
				We apologize for any inconvenience caused.
			</p>
			<h4 style="background-color:#fee; padding: 10px 30px; font-weight: lighter;">Please contact the seller for more information.</small>
			<p style="background-color:#fee; padding: 10px 30px; text-align: right; font-style: oblique;">
				Regards, <br>
				Upabhog Team
			</p>
		</div>
	</div>
</body>
</html>