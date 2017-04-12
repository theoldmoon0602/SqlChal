<?php

return [
    'text' => '
kyumina くんは大変な事に気が付きました。 KosenProconTwitter にはまだ、タイムラインの機能が存在しないのです。
タイムラインとは、あるユーザがフォローしている人のツイートが、時系列順に並んだものです。Twitterを名乗るからには必須の機能でした。
これは致命的なミスです。 kyumina くんは急いで実装を始めることにしました。そこで、あなたに、タイムラインを取得するようなクエリを作るように依頼してきました。
依頼の内容は、ユーザ id が　1 の人にフォローされているユーザのツイートを、時刻に降順に並べて取得することです。 
follow_relations テーブルの follower_id が 1 のデータから、 ユーザid が 1のユーザにフォローされているユーザを取得して、
tweets テーブルの user_id と結びつけることで、タイムラインを作成してください。

kyumina 「SNSを作るなら必須のクエリじゃん :pingu-hi:」
',
    'name' => 'Kyumina くんとタイムライン',
    'point' => 300,
    'answer_query' => 'select text from tweets where user_id in (select followee_id from follow_relations where follower_id=1) order by created_at;',
];