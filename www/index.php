<?php
require_once('../functions.php');
ini_set("display_errors", 1);

session_start();


$msgs = [];
$errors = [];


if (isset($_POST['login']) && isset($_POST['username']) && isset($_POST['password'])) {
    try {
        $msgs [] = login($_POST);
    } catch (Exception $e) {
        $errors [] = $e->getMessage();
    }
} else if (isset($_POST['register']) && isset($_POST['username']) && isset($_POST['password'])) {
    try {
        $msgs [] = register($_POST);
    } catch (Exception $e) {
        $errors [] = $e->getMessage();
    }
}


$content = '../main.php';
while (1) {
    if (isset($_GET['problem']) &&
        1 <= $_GET['problem'] && $_GET['problem'] <= getProblemCount() &&
        checktime()
    ) {
        if (!isset($_SESSION["id"])) {
            $errors[] = "Please Login";
            break;
        }
        $id = $_GET['problem'];
        $content = '../problem.php';
    } else if (isset($_GET['scoreboard'])) {
        $content = '../scoreboard.php';
    } else if (isset($_GET['schema'])) {
        $content = '../schema.php';
    } else if (isset($_GET['user'])) {
        if (!isset($_SESSION["id"])) {
            $errors[] = "Please Login";
            break;
        }
        $content = '../user.php';
    } else if (isset($_GET['logout'])) {
        if (!isset($_SESSION["id"])) {
            $errors[] = "Please Login";
            break;
        }
        unset($_SESSION['username']);
        unset($_SESSION['id']);
    } else if (isset($_GET['login'])) {
        if (isset($_SESSION["id"])) {
            break;
        }
        $content = '../login.php';
    }

    break;
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
<script src="jquery-3.1.1.min.js"></script>
<div id="container">
    <header>
        <h1 id="site-title">Joken SQL Challenge #1</h1>
        <nav id="top-link">
            <ul>
                <li class="link-button"><a href="./">TOP</a></li>
                <li class="link-button"><a href="./#problems">Problems</a></li>
                <li class="link-button"><a href="?schema">Schema</a></li>
                <li class="link-button"><a href="?scoreboard">Scoreboard</a></li>
                <?php if (isset($_SESSION['id'])) { ?>
                    <li class="link-button"><a
                                href="?user"><?php o($_SESSION['username'] . "/rank:" . getUserRank($_SESSION['id'])); ?></a>
                    </li>
                <?php } else { ?>
                    <li class="link-button"><a href="?login">Login/Register</a></li>
                <?php } ?>
            </ul>
        </nav>
    </header>
    <main>
        <ul class="messages">
            <?php foreach ($msgs as $m) { ?>
                <li><?php o($m); ?></li>
            <?php } ?>
        </ul>
        <ul class="errors">
            <?php foreach ($errors as $e) { ?>
                <li><?php o($e); ?></li>
            <?php } ?>
        </ul>
        <?php include_once($content); ?>
    </main>
</div>
</body>
</html>
