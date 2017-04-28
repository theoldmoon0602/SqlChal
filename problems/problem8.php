<?php

return [
    'story' => 'ユーザのレコメンド機能の実装を考えていた kyumina くんが、あなたに「あるユーザについて、そのユーザがフォローしているユーザがフォローしている」ようなユーザを取得したいとお願いしてきました。
これはさほど難しいタスクではないだろうと考えたあなたは、さっそくこの仕事にとりかかりました。
ユーザのフォロー関係は <code>followings</code> テーブルに保存されており、 <code>from_id</code> の idを持つユーザが、 <code>to_id</code> のidを持つユーザをフォローしています。',
    'text' => 'ユーザidが4070のユーザにフォローされているユーザがフォローしているユーザのユーザidを昇順で、重複がないように取得してください。',
    'name' => 'user recommendation',
    'point' => 250,
    'answer_query' => 'to_id from followings where from_id in (select to_id from followings where from_id=4070) order by to_id;',
    'sample' => 'to_id from followings where from_id in (select to_id from followings where from_id=4070) order by to_id;',
];