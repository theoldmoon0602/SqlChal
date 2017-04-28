<?php
return [
    'story' => 'さて、KosenProconTwitterに向けられる当然の需要として、ユーザ名とツイートを同時に表示したい、というものがあります。これは基礎のクエリですが、複数のテーブルを結合しなければ実現できないため、簡単な問題ではありません。
inner join 句をうまく使って、これを実現してみましょう。',
    'text' => 'ツイートの内容<code>tweets.content</code>とその発言者のユーザ名<code>users.username</code> を、ツイートのid <code>tweets.id</code> について昇順に100件表示してください。',
    'point' => 120,
    'name' => '基本のキ',
    'answer_query' => 'username, content from tweets inner join users on users.id = tweets.user_id order by tweets.id asc limit 100',
    'sample' => 'username, content from tweets inner join users on users.id = tweets.user_id order by tweets.id asc limit 100'
];