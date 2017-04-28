<?php

return [
    'story' => 'KosenProconTwitter が大盛況になったときのことを考えた kyumina くんとあなたはヘビーユーザにお礼をできるようにしようと思いました。
ヘビーユーザーとは、もっともたくさんツイートをしたユーザと、もっともフォロワーの多いユーザです。
そこで、もっともたくさんツイートした5人のユーザと、もっともたくさんフォローされている5人のユーザのユーザidを取得することにしました。
サンプルでは、それぞれについて 1人ずつのidを取得しています。
',
    'text' => 'もっともツイート数の多いユーザ5人のユーザid <code>users.id</code> と、もっとも被フォロー数の多いユーザ5人のユーザid <code>users.id</code> を昇順に取得してください。ただし、重複は排除してください',
    'name' => 'ヘビーユーザ',
    'point' => 250,
    'answer_query' => '* from (select user_id from tweets group by user_id order by count(*) desc limit 5 )as hoge  union select * from (select to_id from followings group by to_id order by count(*) desc limit 5) as piyo order by 1;',
    'sample' => '* from (select user_id from tweets group by user_id order by count(*) desc limit 1 )as hoge  union select * from (select to_id from followings group by to_id order by count(*) desc limit 1) as piyo order by 1;',
];