<?php

return [
    'story' => 'マストドンは歴史の浅いSNSですが、既に古参ユーザの存在が現れつつあります（要出典）。
そこで、あなたは古参ユーザの情報を取得してみることにしました。',
    'text' => 'ユーザid <code>users.id</code> が 150 より若い ユーザの名前 <code>users.display_name</code> を表示してください。データは、 ユーザid <code>users.id</code> に昇順にソートしてください。',
    'name' => '古参ユーザ',
    'point' => 75,
    'answer_query' => 'display_name from users where id < 150 order by id',
    'sample' => 'display_name from users where id < 150 order by id',
];