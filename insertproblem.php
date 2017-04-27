<?php

$pdo = new PDO("sqlite:./database.db");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
foreach (glob("problems/*.php") as $fileName) {
    $a = include $fileName;
    print("Inserting $fileName".PHP_EOL);
    $stmt = $pdo->prepare('INSERT INTO problems(story, text, answer_query, point, name, sample) VALUES (?,?,?,?,?,?)');
    $stmt->execute([
        $a["story"],
        $a["text"],
        $a["answer_query"],
        $a["point"],
        $a["name"],
        $a["sample"],
    ]);
}
