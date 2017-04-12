<?php

return [
    'text' => '
ある日、 kyumina くんの元に一通の封書が届きました。そこには「KosenProconTwitter でもなかよしMAPしたいです」 と書いてありました。
なかよしMAPとは、ユーザのフォロー関係をグラフで表したものです。 ユーザの声に応えるため、 kyumina くんはなかよしMAPの実装をすることにしました。
しかし、最初からすべてを実装するのは大変なので、とりあえずあるユーザの友達の一覧を取得することにしました。友達とは、フォローしているかつ、フォローされている関係のことを言います。
あなたの仕事は、 ユーザ id が 24 のユーザがフォローしていて、かつ、 ユーザ id 24 のユーザをフォローしているようなユーザの ユーザ id を昇順で列挙することです。

ふるつき 「ぼくの解法だと、 in 句とサブクエリを使ったんだよなぁ」
',
    'name' => 'Kyumina くんとなかよしMAP',
    'point' => 300,
    'answer_query' => ' follower_id from follow_relations where followee_id = 24 and follower_id in (select followee_id from follow_relations where follower_id = 24) order by follower_id;',
];