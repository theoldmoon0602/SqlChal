<?php

return [
    'story' => 'ユーザidを連番で与えていると、bot からのランダムなリクエストを受け付けてしまうと風のうわさで聞いたあなたは、 マストドンでは果たしてユーザidは連番なのかが気になりました。
そこで、ユーザidを登録時の時系列順に表示することでこれを確かめることにしました。データをあるカラムの値によって整列するには <code>order by</code> 句を使うとも聞いたので、良い練習になるでしょう。',
    'text' => '<code>users</code>テーブルから、 <code>id</code> を取得してください。ただし、データは <code>created_at</code> カラムの値に昇順にソートしてください。',
    'name' => 'ユーザidのヒミツ',
    'point' => 60,
    'answer_query' => 'id from users order by created_at',
    'sample' => "'there is no sample' as no_sample",
];