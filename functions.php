<?php

require_once('settings.php');

function getStartTime() {
	return strtotime(START_DATE);
}
function getEndTime() {
//	return strtotime('2017-02-11 12:00');
	return strtotime(END_DATE);
}

function csrfcheck($csrf) {
	return password_verify(session_id(), $csrf);
}

function csrf() {
	return password_hash(session_id(), PASSWORD_DEFAULT);
}

function checktime($t = null) {
	if (is_null($t)) {
		$t = time();
	}
	return getStartTime() <= $t && $t < getEndTime();
}

function o($s) {
	echo htmlspecialchars($s, ENT_QUOTES, 'utf-8');
}
function db() {
	$pdo = new PDO('sqlite:../database.db');
	$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	return $pdo;
}

// login
function login($params) {
	$pdo = db();
	$stmt = $pdo->prepare('select id, password from users where username = :username');
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
function register($params) {
	$password = password_hash($params['password'], PASSWORD_DEFAULT);

	$pdo = db();
	$stmt = $pdo->prepare('insert into users(username, password) values (:username, :password)');
	$stmt->bindValue(':username', $params['username'], PDO::PARAM_STR);
	$stmt->bindValue(':password', $password, PDO::PARAM_STR);
	if (!$stmt->execute()) {
		throw new Exception('Failed to register new user');
	}
	return 'Added new user. please log in';
}

/**
 * 問題の総数を返す
 * @return int
 */
function getProblemCount() {
    $pdo = db();
    $stmt = $pdo->query("select count() from problems");
    $stmt->execute();
    return (int)$stmt->fetchColumn();
}

/**
 * ユーザ数をカウントする
 * @return int
 */
function getUserCount() {
    $pdo = db();
    $stmt = $pdo->query("select count() from users");
    $stmt->setFetchMode(PDO::FETCH_NUM);
    return (int)$stmt->fetchColumn();
}

class RankingSubmission {
    public function __construct($author_name, $execution_time, $point)
    {
        $this->author_name =$author_name;
        $this->execution_time = $execution_time;
        $this->point = $point;
    }
}
/**
 * ある問題におけるランキングを求める
 * @param int $problem_id
 * @return RankingSubmission[]
 */
function getRankingAbout($problem_id) {
    $pdo = db();
    /**
     * @var PDOStatement $stmt
     *
     * problem_id で submittions を絞り、 execution_time, created_at が小さい順に並べたあと、 user_id からユーザ情報を取得する
     */
    $stmt = $pdo->prepare("select users.username as author_name, execution_time ".
        "from submissions inner join users on users.id = submissions.user_id ".
        "where submissions.problem_id=? and submissions.accepted='AC' order by execution_time, created_at;");
    $stmt->execute([$problem_id]);
    $result = [];
    $userCount = getUserCount();
    $i = 1;
    while ($row = $stmt->fetch()) {
        $result[] = new RankingSubmission($row["author_name"], $row["execution_time"],$userCount-$i+1);
        $i++;
    }
    return $result;
}


class ScoreBoardUser {
    public function __construct($username, $point)
    {
        $this->username = $username;
        $this->point = $point;
    }
}
/**
 * 順位表を求める
 * @return ScoreBoardUser[]
 */
function getScoreBoard() {
    // usersにユーザごとの総得点を集計する
    $users = [];
    for ($problem_id = 0; $problem_id < getProblemCount(); $problem_id++) {
        foreach(getRankingAbout($problem_id) as $rank => $v) {
            if (! isset($users[$v->author_name])) {
                $users[$v->author_name] = 0;
            }
            $users[$v->author_name] += $v->point;
        }
    }

    // resultはキーなしの配列で、要素にusernameとpointを持ってる
    $result = [];
    foreach ($users as $username => $point) {
        $result[]=new ScoreBoardUser($username, $point);
    }

    // point をキーとしてソートする
    usort($result, function($a, $b) {
        $a = $a->point;
        $b = $b->point;
        if ($a == $b) {
            return 0;
        }
        return ($a < $b) ? 1 : -1;
    });

    return $result;
}

/**
 * ユーザの順位を求める
 * @param string $username
 */
function getUserRank($username) {
    $scoreBoard = getScoreBoard();
    foreach ($scoreBoard as $rank => $scoreBoardUser) {
        if ($scoreBoardUser->username == $username) {
            return $rank + 1;
        }
    }
    return 0;
}

class UserSubmission {
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
function getUserSubmissions($user_id) {
    $pdo = db();
    $stmt = $pdo->prepare("select id, user_id, problem_id, query, accepted, execution_time, created_at ".
        "from submissions where submissions.user_id=? order by created_at desc;");
    $stmt->execute([$user_id]);
    $stmt->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, "UserSubmission");
    return $stmt->fetchAll();
}

/**
 * @param PDOStatement $rows
 * @param int $limit
 * @return string
 */
function format_to_table($rows, $limit = -1) {
    if ($limit == 0) {
        return "";
    }
    $rows->setFetchMode(PDO::FETCH_ASSOC);
    $cur = 0;

    // first line
    $th = "";
    $td = "";
    foreach ($rows->fetch() as $k => $v) {
        $th .= "<th>$k</th>";
        $td .= "<td>$v</td>";
    }
    $tableHtml = "<table><tr>$th</tr><tr>$td</tr>";
    $cur++;

    // other lines
    while (($limit == -1 || $cur < $limit) && $row = $rows->fetch()) {
        $td = "";
        foreach ($row as $v) {
            $td .="<td>$v</td>";
        }
        $tableHtml .= "<tr>$td</tr>";
        $cur++;
    }

    return $tableHtml;
}
/**
 * @return PDO
 */
function target_db() {
    $pdo = new PDO("pgsql: dbname=root host=localhost", "user", "user");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $pdo;
}
/**
 * @param $query
 * @return array
 */
function execute_query($query) {
    // execute query and measure the time
    $pdo = target_db();
    $t1 = time();
    $rows = $pdo->query("SELECT " . $query);
    $t2 = time();

    return [
        'rows' => $rows,
        'time' => $t2-$t1,
    ];
}

function debug($s) {
    $fp = fopen("log.txt", "a");
    fwrite($fp, $s);
    fclose($fp);
}

/**
 * @param PDOStatement $stmt1
 * @param PDOStatement $stmt2
 * @return bool
 */
function is_same_result($stmt1, $stmt2) {
    $stmt1->setFetchMode(PDO::FETCH_NUM);
    $stmt2->setFetchMode(PDO::FETCH_NUM);

    while (true) {
        $row1 = $stmt1->fetch();
        $row2 = $stmt2->fetch();
        if ($row1 === false && $row2 === false) {
            return true;
        }
        debug(count($row1)."\n");
        debug(count($row2)."\n");
        if (count($row1) !== count($row2)) {
            break;
        }
        for ($i = 0; $i < count($row1); $i++) {
            debug(count($row1[$i])."\n");
            debug(count($row2[$i])."\n");

            if ($row1[$i] !== $row2[$i]) {
                return false;
            }
        }
    }
    return false;
}

function load_answer_query($id) {
    return file_get_contents(__DIR__."/problems/answer_$id.sql");
}

function insertSubmission($user_id, $problem_id, $query, $accepted, $execution_time) {
    $pdo = db();
    $stmt = $pdo->prepare("insert into submissions(user_id, problem_id, query, accepted, execution_time, created_at) values (?,?,?,?,?,?)");
    $stmt->execute([$user_id, $problem_id, $query, $accepted, $execution_time, time()]);
}