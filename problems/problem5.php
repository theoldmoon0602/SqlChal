<?php

return [
    'story' => '試しにすべてのツイートの情報を取得しようと <code>select content from tweets;</code> を実行したあなたは、そのデータ量にとても驚かされることになりました。これではとてもすべてを見ることはできません。
そこであなたは <code>limit</code> 句のことを思い出しました。これは<code>select</code>文で表示するデータの件数を制限するために用いられます。',
    'text' => '<code>tweets</code> テーブルから、<code>content</code> カラムの値を取得してください。ただし、表示件数は 50 件で、 <code>id</code> の値によって昇順にソートしてください。',
    'name' => '多すぎるツイート',
    'point' => 60,
    'answer_query' => 'content from tweets order by id limit 50',
    'sample' => 'content from tweets order by id limit 50',
];
