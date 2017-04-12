<?php

return [
    'text' => '
さらなる KosenProconTwitter の発展を画策する kyumina くんは、たくさんフォローされている人気者の高専生に広告をお願いするため、
最もフォローされているユーザを特定することにしました。しかし、 kyumina くんはSQLに明るくないためこのようなユーザを特定することができませんでした。
そのくせ、あなたの偉大なる SQL 力に嫉妬した kyumina くんは、screen_name をフォロー数の少ない順に取得したい、と言い出しました。
あなたの任務は、 kyumina くんにかわって、被フォロー数の最も多いユーザ50人の screen_name をフォロー数の少ない順に取得することです。
ユーザのフォロー関係を表す follow_relations テーブルを有効に活用しましょう。 followee_id はフォローされているユーザの idを表し、 
follower_id はそのユーザをフォローしているユーザのidを表しています。

あなた「group by 句とサブクエリ、 inner join をうまく使えば……できる気がする……」',
    'name' => 'Kyumina くんと人気者',
    'point' => 350,
    'answer_query' => 'cnt, screen_name from users inner join (select count(*) as cnt, followee_id from follow_relations group by followee_id order by count(*) desc limit 50) as hoge on hoge.followee_id = users.id order by cnt;',
];