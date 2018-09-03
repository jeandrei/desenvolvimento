<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/jokecms/includes/helpers.inc.php'; ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8">
	<meta name="author" content="Jeandrei Walter" />
	<meta name="description" content="Log In" />
	<title>Log In</title>
</head>
	<body>
		<h1>Log In</h1>
		<p>Please log in to view the page that you ruequested.</p>
		<?php if (isset($loginError)): ?>
			<p><?php htmlout($loginError); ?></p>
		<?php endif; ?>
		<form action="" method="post">
			<div>
				<label for="email">Email:<input type="text" 
					name="email" id="email"></label>
			</div>

			<div>
				<label for="password">Password:<input type="password" 
					name="password" id="password"></label>
			</div>
			
			<div>
				<input type="hidden" name="action" value="login">
				<input type="submit" value="Log in">
			</div>
		</form>
		<p><a href="/jokecms/admin/">Return to JMS home</a></p>
	</body>
</html>