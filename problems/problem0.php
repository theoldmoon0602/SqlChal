<?php

return [
    'text' => '
KosenProconTwitter の運営をはじめた kyumina くん。とりあえず、一番最初のユーザがなんという名前なのか調べることにしました。
そこで、あなたにユーザidが1の人のscreen_nameを取得するようにお願いしてきました。
あなたの仕事は、 users テーブルから ユーザidが1の人を指定して、その screen_name を取得することです。

kyumina 「データを取り出すは select 文を使うねんで。 from users でテーブル名を指定して、 
select screen_name from users で screen_name を取得できる。それから、 where 句を使って、 id = 1を設定するんや」',
    'name' => 'Kyumina くんとはじめてのユーザ',
    'point' => 10,
    'answer_query' => 'screen_name from users where id=1;',
];