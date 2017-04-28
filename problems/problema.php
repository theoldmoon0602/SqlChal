<?php

return [
    'story' => 'たくさんツイートしている人のユーザidを取得することに成功したあなたは、次はその人の名前もしりたいと考えました。これには別のテーブルからユーザ名を取得する必要があり、さらに group by 句の結果に対して inner join を実行する必要がありそうです。これにはサブクエリを使う必要があるでしょう。意外にも、難しいしごとになりそうです。
あなたは早速、クエリの作成に取り掛かりました。',
    'text' => '最も多くツイートをしている20人のユーザのid <code>users.id</code> と ユーザ名<code>users.username</code> を表示してください。ただし、ツイート数に降順にソートしてください。ツイートの発言アカウントのidは <code>tweets.user_id</code> に記録されています・',
    'point' => 220,
    'name' => 'username',
    'answer_query' => 'user_id, username from users inner join (select user_id, count(user_id) as cnt from tweets group by user_id order by count(user_id) desc limit 20) as uid on users.id=uid.user_id order by  uid.cnt desc',
    'sample' => 'user_id, username from users inner join (select user_id, count(user_id) as cnt from tweets group by user_id order by count(user_id) desc limit 20) as uid on users.id=uid.user_id order by  uid.cnt desc'
];