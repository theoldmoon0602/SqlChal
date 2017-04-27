<?php

return [
'story' => 'あなたと kyumina くんは協議の結果、KosenProconTwitter にはデフォルトでなかよしMAPを組み込むことにしました。なかよしMAPとは、ユーザのフォロー関係をグラフにあらわしたものです。
グラフを描画する部分は kyumina くんにお任せして、あなたは必要なデータを取得するクエリを書くことにしました。それは、あるユーザについて、そのユーザがフォローしているかつ、そのユーザをフォローしているようなユーザを列挙することです。
サンプルでは、ユーザidが1024のユーザに対してこれを行っています。',
'text' => 'ユーザidが38のユーザについて、そのユーザがフォローしていて（<code>followings.from_id=38</code>）、そのユーザにフォローされている（<code>followings.to_id=38</code>）ようなユーザのユーザidを昇順に列挙してください。',
'name' => 'おともだち',
'point' => 100,
'answer_query' => 'from_id from followings where to_id=38 and from_id in (select to_id from followings where from_id=38) order by from_id;',
'sample' => 'from_id from followings where to_id=1024 and from_id in (select to_id from followings where from_id=1024) order by from_id;',
];