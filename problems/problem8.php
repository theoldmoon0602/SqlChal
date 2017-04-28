<?php

return [
    'story' => 'さて、ウォーミングアップはおしまいです。これからは頭を捻らないと解けない問題が始まります。

あなたは、 kyumina くんからの頼みを受けて、たくさんツイートをする人はどれくらいの数をツイートするのか調べることになりました。試しに、上から20人程度のツイート数を取得してみることにしましょう。
この問題は難しいので、少しだけヒントをかいておきます。
<code>select count(*) from tweets group by user_id</code>',
    'text' => 'ツイート数をユーザid <code>tweets.user_id</code> ごとに集計し、その数が多い順に20件までをソートして表示してください。',
    'point' => 120,
    'name' => 'ツイートカウント',
    'answer_query' => 'count(*) from tweets group by user_id order by count(*) desc limit 20',
    'sample' =>  'count(*) from tweets group by user_id order by count(*) desc limit 20'
];