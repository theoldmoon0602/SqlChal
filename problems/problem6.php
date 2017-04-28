<?php

return [
'story' => "データベースの勉強をしていたあなたは、外部キーについて、実際にクエリを発行しながら勉強をしようと思い立ちました。幸い、 kyumina くんが集めてきたデータは、ツイートとその発言者が id によって結び付けられていたので、これを用いることにします。
例えば、ユーザ名 が ueokande であるようなアカウントの発言をすべて、時系列順に取得するクエリは次のようになりそうです。ここで、 <code>user_id</code>カラムは、発言したアカウントの id が記録されています。
<code>select content from tweets inner join users on username='ueokande' where user_id=????? order by tweets.created_at;</code>",
'text' => '上記ストーリーのサンプルを完成させてください。',
'point' => 100,
'name' => '内部結合の練習',
'answer_query' => "content from tweets inner join users on username='ueokande' where user_id=users.id order by tweets.created_at",
'sample' =>  "content from tweets inner join users on username='ueokande' where user_id=users.id order by tweets.created_at"
];