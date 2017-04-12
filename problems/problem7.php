<?php

return [
    'text' => '
KosenProconTwitter が大盛況になったときのことを考えた kyumina くんはヘビーユーザにお礼をできるようにしようと思いました。
ヘビーユーザーとは、もっともたくさんツイートをしたユーザ、もっともいいねされたユーザ、もっともフォロワーの多いユーザの三種類のユーザです。
あなたの仕事は、 この三種類のユーザについてそれぞれ 5人ずつ、そのid を特定することです。
ユーザ id は昇順にソートしてください。ツイートに対するいいねは、 favorites テーブルから取得できます。
サンプルでは、それぞれについて 1人ずつのidを取得しています。

kyumina 「union select はCTFでも大活躍って師匠が言ってました ^ω^」
あなた「union するときは order by の使い方に注意しないといけないな」
',
    'name' => 'Kyumina くんとヘビーユーザ',
    'point' => 250,
    'answer_query' => '* from (select user_id from tweets group by user_id order by count(*) desc limit 5 )as hoge union select user_id from tweets where id=(select favoree_tweet_id from favorites group by favoree_tweet_id order by count(*) desc limit 5) union select * from (select followee_id from follow_relations group by followee_id order by count(*) desc limit 5) as piyo order by 1;',
    'sample' => '* from (select user_id from tweets group by user_id order by count(*) desc limit 1 )as hoge union select user_id from tweets where id=(select favoree_tweet_id from favorites group by favoree_tweet_id order by count(*) desc limit 1) union select * from (select followee_id from follow_relations group by followee_id order by count(*) desc limit 1) as piyo order by 1;',
];