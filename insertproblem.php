<?php

$pdo = new PDO("sqlite:./database.db");
foreach (glob("problems/*.php") as $fileName) {
    $a = include $fileName;
    $stmt = $pdo->prepare('INSERT INTO problems(text, answer_query, point, name, sample) VALUES (?,?,?,?,?)');
    $stmt->execute([
        $a["text"],
        $a["answer_query"],
        $a["point"],
        $a["name"],
        $a["sample"],
    ]);
}