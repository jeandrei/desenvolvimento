<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>List of Jokes</title>
</head>
<body>
	<p><a href="?addjoke">Add your own joke</a></p><!--?addjoke vai passar addjoke para o GET (isset($_GET['addjoke'])) se for verdadeiro entra no if-->
	<p>Here ara all tha jokes in the database:</p>
	<?php foreach ($jokes as $joke): ?>
		<blockquote style="border: 1px solid black;">
			<p>
				<?php echo htmlspecialchars($joke, ENT_QUOTES, 'UTF-8'); ?>
			</p>
		</blockquote>
	<?php endforeach; ?>
</body>
</html>