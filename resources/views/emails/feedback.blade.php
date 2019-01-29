<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		Submitted by ({{ $email }})<br /><br />
		
		{!! nl2br(htmlentities($body)) !!}

	</body>
</html>