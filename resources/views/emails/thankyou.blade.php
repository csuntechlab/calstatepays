<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		Hello {{ $email }}, thank you for your feedback! This is an email generated to let you know we received your
        feedback or issue.<br />
		For your reference, you wrote:<br/>
		{!! nl2br(htmlentities($body)) !!}
	</body>
</html>