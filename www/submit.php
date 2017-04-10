<?php

require_once("../functions.php");

session_start();

if (! isset($_POST["query"]) || !isset($_POST["id"]) || !isset($_POST["print_limit"])) {
    echo json_encode([
        "error" => 'invalid request'
    ]);
    exit;
}

if (! $_SESSION['id']) {
    echo json_encode([
        "error" => "please login"
    ]);
    exit;
}

if (! csrfcheck($_POST["csrf_token"])) {
    echo json_encode([
        "error" => "csrf detected",
    ]);
    exit;
}

try {
    $a = execute_query($_POST["query"]);
    $c = execute_query(load_answer_query($_POST["id"]));

    $ac = is_same_result($a['rows'], $c['rows']);

    $result = execute_query($_POST["query"]);
    $html = format_to_table($result['rows'], $_POST["print_limit"]);

    insertSubmission($_SESSION["id"], $_POST["id"], $_POST["query"], ($ac)?'AC':'WA', $result["time"]);

    echo json_encode([
        'result' => $html,
        'accepted' => $ac,
        'time' => $result['time'],
        'error' => '',
    ]);
}
catch (Exception $e) {
    echo json_encode([
        'error' => $e->getMessage(),
    ]);
}