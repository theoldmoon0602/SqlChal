<?php

return [
    'text' => '
Kyumina くんはKosenProconTwitterにリプライ機能を追加したので、あるいツイートへのリプライを取得できるようにしたいと思いました。
リプライとは、ツイートに対する返信のことで、一つのツイートに対していくつもリプライをするということも可能です。
あなたの仕事は、idがn番のツイートに対するリプライを再帰的にすべて取得し、時系列順に（つまり時刻に昇順に）表示することです。

あなた「再帰的に取得……そんなことができるのかな……？ いや、できるぞ。 with recursive 句でできる。それにサブクエリを組み合わせれば……」
',
    'name' => 'Kyumina くんとリプライチェーン',
    'point' => 400,
    'answer_query' => 'text from tweets inner join (with recursive hoge(id) as ( select id from tweets where in_reply_to_status_id=156 union all select tweets.id from tweets inner join hoge on in_reply_to_status_id=hoge.id) select id from hoge) as piyo on tweets.id=piyo.id  order by tweets.created_at;',
];