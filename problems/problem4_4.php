<?php
return [
    'story' => 'さて、KosenProconTwitterに向けられる当然の需要として、ユーザ名とツイートを一度に表示したい、というものがあります。これは基礎のクエリですが、複数のテーブルを結合しなければ実現できないため、簡単な問題ではありません。
inner join 句をうまく使って、これを実現してみましょう。',
    'text' => 'ツイートをidに昇順に100件、その発言者の <code>username</code> とともに表示してください。',
    'point' => 150,
    'name' => '基本のキ',
    'answer_query' => 'username, content from tweets inner join users on users.id = tweets.user_id order by tweets.id asc limit 100',
    'sample' => 'username, content from tweets inner join users on users.id = tweets.user_id order by tweets.id asc limit 100'
];