<?php

require_once('settings.php');

function getStartTime()
{
    return strtotime(START_DATE);
}

function getEndTime()
{
//	return strtotime('2017-02-11 12:00');
    return strtotime(END_DATE);
}

function csrfcheck($csrf)
{
    return password_verify(session_id(), $csrf);
}

function csrf()
{
    return password_hash(session_id(), PASSWORD_DEFAULT);
}

function checktime($t = null)
{
    if (is_null($t)) {
        $t = time();
    }
    return getStartTime() <= $t && $t < getEndTime();
}

function h($s)
{
    return htmlspecialchars($s, ENT_QUOTES, 'utf-8');
}

function o($s)
{
    echo h($s);
}

function db()
{
    $pdo = new PDO('sqlite:../database.db');
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $pdo;
}

// login
function login($params)
{
    $pdo = db();
    $stmt = $pdo->prepare('SELECT id, password FROM users WHERE username = :username');
    $stmt->bindParam(':username', $params['username'], PDO::PARAM_STR);
    if (!$stmt->execute()) {
        throw new Exception("Failed to login.");
    }
    $r = $stmt->fetchAll()[0];
    if (password_verify($params['password'], $r['password'])) {
        $_SESSION['username'] = $params['username'];
        $_SESSION['id'] = $r['id'];
        return 'Logged in. Welcome ' . $params['username'];
    }
    throw new Exception('Failed to login.');
}

// register
function register($params)
{
    $password = password_hash($params['password'], PASSWORD_DEFAULT);

    $pdo = db();
    $stmt = $pdo->prepare('INSERT INTO users(username, password) VALUES (:username, :password)');
    $stmt->bindValue(':username', $params['username'], PDO::PARAM_STR);
    $stmt->bindValue(':password', $password, PDO::PARAM_STR);
    if (!$stmt->execute()) {
        throw new Exception('Failed to register new user');
    }
    return 'Added new user. please log in';
}

function isUserSolved($user_id, $problem_id)
{
    $pdo = db();
    $stmt = $pdo->prepare('SELECT count(*) FROM submissions WHERE user_id=? AND problem_id=? AND accepted="AC"');
    $stmt->execute([$user_id, $problem_id]);
    $stmt->setFetchMode(PDO::FETCH_NUM);
    return $stmt->fetch()[0] > 0;
}

/**
 * 問題の総数を返す
 * @return int
 */
function getProblemCount()
{
    $pdo = db();
    $stmt = $pdo->query("SELECT count() FROM problems");
    $stmt->execute();
    return (int)$stmt->fetchColumn();
}

class Problem
{
    public $id;
    public $text;
    public $name;
    public $point;
    public $answer_query;
    public $sample;
    public $story;
}

/**
 * @param $id
 * @return Problem
 */
function getProblem($id)
{
    $pdo = db();
    $stmt = $pdo->query("SELECT * FROM problems WHERE id=?;");
    $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "Problem");
    $stmt->execute([$id]);
    return $stmt->fetch();
}

/**
 * すべての問題を取得する
 * @return Problem[]
 */
function getProblems()
{
    $pdo = db();
    $stmt = $pdo->query("SELECT * FROM problems;");
    $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "Problem");
    $stmt->execute();
    $problems = $stmt->fetchAll();
    return $problems;
}

class UserResult
{
    public $username;
    public $results;
    public $score;
}

/**
 * @return UserResult[]
 */
function getScoreBoard()
{
    $problemCount = getProblemCount();
    $pdo = db();
    $stmt = $pdo->prepare('SELECT username, solved, score FROM users ORDER BY score DESC, last_submission_time ASC');
    $stmt->execute();
    $userResults = [];
    while ($row = $stmt->fetch()) {
        $solveds = explode(',', $row["solved"]);
        $results = [];
        for ($i = 1; $i <= $problemCount; $i++) {
            $results[] = in_array($i, $solveds);
        }
        $userResult = new UserResult();
        $userResult->username = $row['username'];
        $userResult->results = $results;
        $userResult->score = $row['score'];

        $userResults[] = $userResult;
    }
    return $userResults;
}


function getUserRank($id)
{
    $pdo = db();
    $stmt = $pdo->prepare('SELECT id FROM users ORDER BY score DESC, last_submission_time ASC');
    $stmt->execute();
    $i = 1;
    while ($row = $stmt->fetch()) {
        if ($row['id'] == $id) {
            break;
        }
        $i++;
    }
    return $i;
}

/**
 * ユーザ数をカウントする
 * @return int
 */
function getUserCount()
{
    $pdo = db();
    $stmt = $pdo->query("SELECT count() FROM users");
    $stmt->setFetchMode(PDO::FETCH_NUM);
    return (int)$stmt->fetchColumn();
}

class UserSubmission
{
    public $id;
    public $user_id;
    public $problem_id;
    public $query;
    public $accepted;
    public $execution_time;
    public $created_at;
}

/**
 * ユーザの提出をすべて求める
 * @return UserSubmission[]
 */
function getUserSubmissions($user_id)
{
    $pdo = db();
    $stmt = $pdo->prepare("select id, user_id, problem_id, query, accepted, execution_time, created_at " .
        "from submissions where submissions.user_id=? order by created_at desc;");
    $stmt->execute([$user_id]);
    $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "UserSubmission");
    return $stmt->fetchAll();
}


/**
 * @param PDOStatement $rows
 * @param int $limit
 * @return string
 */
function format_to_table($rows, $limit = -1)
{
    if ($limit == 0) {
        return "";
    }
    $rows->setFetchMode(PDO::FETCH_ASSOC);
    $cur = 0;

    // first line
    $th = "";
    $td = "";
    foreach ($rows->fetch() as $k => $v) {
        $th .= "<th>" . h($k) . "</th>";
        $td .= "<td>" . h($v) . "</td>";
    }
    $tableHtml = "<table><tr>$th</tr><tr>$td</tr>";
    $cur++;

    // other lines
    while (($limit == -1 || $cur < $limit) && $row = $rows->fetch()) {
        $td = "";
        foreach ($row as $v) {
            $td .= "<td>" . h($v) . "</td>";
        }
        $tableHtml .= "<tr>$td</tr>";
        $cur++;
    }

    return $tableHtml;
}

/**
 * @return PDO
 */
function target_db()
{
    $pdo = new PDO("pgsql: dbname=challenge host=localhost", "challenger", "challenger");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->beginTransaction();
    $stmt = $pdo->query('set local statement_timeout=5000');
    $stmt->closeCursor();

    return $pdo;
}

/**
 * @param $query
 * @return array
 */
function execute_query($query)
{
    // execute query and measure the time
    $pdo = target_db();
    $t1 = time();
    $rows = $pdo->query("SELECT " . $query);
    $t2 = time();
    $pdo->commit();

    return [
        'rows' => $rows,
        'time' => $t2 - $t1,
    ];
}

function debug($s)
{
    $fp = fopen("log.txt", "a");
    fwrite($fp, $s);
    fclose($fp);
}

/**
 * @param PDOStatement $stmt1
 * @param PDOStatement $stmt2
 * @return bool
 */
function is_same_result($stmt1, $stmt2)
{
    $stmt1->setFetchMode(PDO::FETCH_NUM);
    $stmt2->setFetchMode(PDO::FETCH_NUM);

    while (true) {
        $row1 = $stmt1->fetch();
        $row2 = $stmt2->fetch();
        if ($row1 === false && $row2 === false) {
            return true;
        }
        if (count($row1) !== count($row2)) {
            break;
        }
        for ($i = 0; $i < count($row1); $i++) {
            if ($row1[$i] !== $row2[$i]) {
                return false;
            }
        }
        $i++;
    }
    return false;
}

function load_answer_query($id)
{
    return file_get_contents(__DIR__ . "/problems/answer_$id.sql");
}

function insertSubmission($user_id, $problem_id, $query, $accepted, $execution_time)
{
    $pdo = db();

    if ($accepted == 'AC' && !isUserSolved($user_id, $problem_id)) {
        $stmt = $pdo->prepare("UPDATE users SET " .
            "score=(SELECT score FROM users WHERE id=:user_id)+(SELECT point FROM problems WHERE id=:problem_id)," .
            "solved=(SELECT solved FROM users WHERE id=:user_id)||','||:problem_id," .
            "last_submission_time=:time " .
            "WHERE id=:user_id;");
        $stmt->execute([
            'user_id' => $user_id,
            'problem_id' => $problem_id,
            'time' => time(),
        ]);
    }

    $stmt = $pdo->prepare("INSERT INTO submissions(user_id, problem_id, query, accepted, execution_time, created_at) VALUES (?,?,?,?,?,?)");
    $stmt->execute([$user_id, $problem_id, $query, $accepted, $execution_time, time()]);
}