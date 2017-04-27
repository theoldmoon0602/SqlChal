<?php

return [
    'story' => 'kyumina くんが集めてきたデータを眺めていたあなたは、やはり、pawoo.net の運営元である pixiv のアカウントがユーザ id の 1番を持っているのかどうかが気になりました。そこで、 idが1であるアカウントの情報を取得してみることにしました。
取得するデータに条件を与えるには <code>where</code> 句を使うことになりそうです。',
    'text' => '<code>id</code> が 1 であるユーザの<code>username</code>を <code>users</code> テーブルから取得してください。',
    'name' => '一番最初のアカウント',
    'point' => 50,
    'answer_query' => 'username from users where id=1',
    'sample' => "'there is no sample' as no_sample",
];