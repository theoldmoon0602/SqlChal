<?php


return [
    'story' => 'kyumina くんが pawoo.net からデータを収集してきました（これは本物のデータなので迂闊に取り扱わないでください）。とりあえず、このデータを用いてSQLクエリを発行していくことになりそうです。
まずは、データがどのくらいの量なのかを調べることにしましょう。これには、 <code>count</code>集約関数を用いることができそうです',
    'text' => '<code>tweets</code>テーブルに保存されているデータの件数を求めてください',
    'name' => 'kyumina くんとレコード件数',
    'point' => 75,
    'answer_query' => 'count(*) from tweets',
    'sample' => "'there is no sample' as no_sample",
];