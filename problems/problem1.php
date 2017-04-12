<?php

return [
  'text' => '
kyumina くんは、高専生は自分の知り合いが参加しているSNSにならば参加するだろうと考え、現在SNSに参加しているユーザの一覧を
辞書順で取得したいと思いましたが、その方法がわかりませんでした。
あなたに与えられた任務は、 kyumina くんの代わりに、存在するユーザをすべて、辞書順で列挙するようなSQLクエリを完成させることです。
ユーザの情報は users テーブルに、ユーザ名は screen_name カラムに記録されています。
サンプルでは、最初の 10 人を省いたデータを表示しています。

kyumina 「データを整列させて取り出すには order by 句を使うねんで（にっこり」',
    'name' => 'Kyumina くんとユーザたち',
    'point' => 50,
    'answer_query' => 'screen_name from users order by screen_name;',
    'sample' => 'screen_name from users order by screen_name limit 10 offset 10;',
];