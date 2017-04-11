<?php
require_once('../functions.php');

session_start();


$msgs = [];
$errors = [];


if (isset($_POST['login']) && isset($_POST['username']) && isset($_POST['password'])) {
	try {
		$msgs []= login($_POST);
	} catch (Exception $e) {
		$errors []= $e->getMessage();
	}
}
else if (isset($_POST['register']) && isset($_POST['username']) && isset($_POST['password'])) {
	try {
		$msgs []= register($_POST);
	} catch (Exception $e) {
		$errors []= $e->getMessage();
	}
}


$content = '../main.php';
if (isset($_SESSION['id'])) {
	if (isset($_GET['problem']) &&
        0 <= $_POST['problem'] && $_POST['problem'] < getProblemCount() &&
        checktime()) {
	    $id = $_GET['problem'];
		$content = '../problem.php';
	}
	else if (isset($_GET['scoreboard'])) {
		$content = '../scoreboard.php';
	}
	else if (isset($_GET['user'])) {
		$content = '../user.php';
	}
	else if (isset($_GET['logout'])) {
		unset($_SESSION['username']);
		unset($_SESSION['id']);
	}
}
else {
	if (isset($_GET['login'])) {
		$content = '../login.php';
	}
}

?>

<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Joken SQL Challenge</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<script
  src="jquery-3.1.1.min.js"
  ></script>
<div id="container">
	<header>
		<h1><a href="./">Joken SQL Challenge #1</a></h1>
		<nav>
			<ul>
                <li><a href="./#problems">Problems</a></li>
				<li><a href="?scoreboard">Scoreboard</a></li>
				<?php if (isset($_SESSION['id'])) { ?>
				<li><a href="?user"><?php o($_SESSION['username'] . "/rank:" . getUserRank($_SESSION['id'])); ?></a></li>
				<?php } else { ?>
				<li><a href="?login">Login/Register</a></li>
				<?php } ?>
			</ul>
		</nav>
	</header>
	<main>
		<ul id="messages">
		<?php foreach ($msgs as $m) { ?>
			<li><?php o($m); ?></li>
		<?php } ?>
		</ul>
		<ul id="errors">
		<?php foreach ($errors as $e) { ?>
			<li><?php o($e); ?></li>
		<?php } ?>
		</ul>
		<?php include_once($content); ?>
	</main>
</div>
</body>
</html>
