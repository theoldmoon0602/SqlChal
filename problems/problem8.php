<?php

return [
    'story' => 'ユーザのレコメンド機能の実装を考えていた kyumina くんが、あなたに「あるユーザについて、そのユーザがフォローしているユーザがフォローしている」ようなユーザを取得したいとお願いしてきました。
これはさほど難しいタスクではないだろうと考えたあなたは、さっそくこの仕事にとりかかりました。そして、 kyumina くんが
サンプルでは、ユーザidが1のユーザについて、求められるクエリを実行しています。',
    'text' => 'ユーザidが550のユーザにフォローされているユーザがフォローしているユーザのユーザidを昇順で、重複がないように取得してください。',
    'name' => 'user recommendation',
    'point' => 250,
    'answer_query' => 'distinct id from users inner join (select to_id from followings where from_id=550) as friends on users.id=to_id order by users.id;',
    'sample' => 'distinct id from users inner join (select to_id from followings where from_id=1) as friends on users.id=to_id order by users.id;',
];