<?php

return [
    'story' => 'kyumina くんは大変な事に気が付きました。 KosenProconTwitter にはまだ、タイムラインの機能が存在しないのです。
タイムラインとは、あるユーザがフォローしている人のツイートが、時系列順に並んだものです。Twitterを名乗るからには必須の機能でした。
これは致命的なミスです。 kyumina くんは急いで実装を始めることにしました。そこで、あなたに、タイムラインを取得するようなクエリを作るように依頼してきました。
依頼の内容は、ユーザ id が 20 の人にフォローされているユーザのツイートを、時刻に降順に並べて取得することです。 
サンプルでは、ユーザidが2の人について、これを実行しています。',
    'text' => 'ユーザidが20の人のタイムライン（そのユーザにフォローされているユーザのツイートを時刻（ <code>created_at</code> ）に昇順に並べたもの）を表示してください。',
    'name' => 'kyumina くんとタイムライン',
    'point' => 250,
    'answer_query' => ' content from tweets where user_id in (select to_id from followings where from_id=20) order by created_at;',
    'sample' => ' content from tweets where user_id in (select to_id from followings where from_id=2) order by created_at;',
];