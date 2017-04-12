<?php

return [
    'text' => '
kyumina くんはSNSの宣伝をするなら、使っているユーザ数を宣伝材料にするのが良いだろうと考えました。そこで、サービスに登録しているユーザの総数を
取得するようなクエリを考えましたが、結局わかりませんでした。
さあ、 kyumina くんの代わりに、 KosenProconTwitter に登録しているユーザの総数を取得してあげましょう。
登録されているユーザ情報はすべて、 users テーブルに、もれなく重複がないように格納されています。

kyumina 「 count っていう集約関数をつかうと行数を取得できるゾ 」',
    'name' => 'Kyumina くんとユーザ数',
    'point' => 75,
    'answer_query' => 'count(*) from users;',
];