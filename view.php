<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
		  content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Game</title>
</head>
<body>
	<form action="index.php" method="post">
		<!--Hidden field for the word that needs translation-->
		<input type="hidden" name="action" values="new_word">

		<!--Display current word for translation-->
		<p>Translate: <?= $currentWord; ?></p>

		<!--Input field for the user's answer-->
		<label for="user_answer">Your Answer:</label>
		<input type="text" id="user_answer" name="user_answer" required>

		<button type="submit">Submit Answer</button>
	</form>
</body>
</html>