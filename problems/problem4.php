<?php

return [
    'text' => '
前回のクエリの実行に時間がかかったことに驚いた kyumina くんは、いわゆるツイ廃と呼ばれる人種のツイート数がどの程度になるのか見積もりたいと考えました。
そこで、ツイート数が多い人から順に20人のツイート数を表示することにしました。しかし、大変難しく、まったく歯が立ちませんでした。
あなたは ツイート数の多い順に20人分のツイート数を表示してください。 
ツイートが誰のものか調べるには、 tweets テーブルの user_id カラムを参照してください。
この値は、 users テーブルの id カラムの値を参照しています。

kyumina「これはなかなか難しい……。group by 句 は必須だぞい！」',
    'name' => 'Kyumina くんとツイ廃',
    'point' => 200,
    'answer_query' => 'count(id) from tweets group by user_id order by count(id) desc limit 20;',
];