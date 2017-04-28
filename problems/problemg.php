<?php

return [
    'story' => 'Kyumina くんはKosenProconTwitterにリプライ機能を追加したので、あるいツイートへのリプライを取得できるようにしたいと思いました。
リプライとは、ツイートに対する返信のことで、一つのツイートに対していくつもリプライをするということも可能です。リプライとして発言されたツイートには、リプライ先のツイートのidが、 <code>tweets.in_reply_to</code>に記されています。
あなたは、自分の全力を尽くした仕事として、リプライチェーンを取得するクエリを書くことにしました。 <code> with recursive</code>句を用いれば、なんとかできそうな気配がします。',
    'text' => 'idが1020432のツイートに対して、そのツイートに対するリプライ、リプライに対するリプライ、リプライに対するリプライに対するリプライ……の内容（<code>tweets.content</code>）を再帰的にすべて取得してください。ツイートは <code>tweets.created_at</code> に昇順にソートしてください',
    'name' => 'Kyumina くんとリプライチェーン',
    'point' => 400,
    'answer_query' => 'content from tweets inner join (with recursive hoge(id) as ( select id from tweets where in_reply_to=1020432 union all select tweets.id from tweets inner join hoge on in_reply_to=hoge.id) select id from hoge) as piyo on tweets.id=piyo.id  order by tweets.created_at ;',
    'sample' => 'content from tweets inner join (with recursive hoge(id) as ( select id from tweets where in_reply_to=1020432 union all select tweets.id from tweets inner join hoge on in_reply_to=hoge.id) select id from hoge) as piyo on tweets.id=piyo.id  order by tweets.created_at limit 10;',
];