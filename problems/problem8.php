<?php

return [
    'text' => '
なかよしMAPの実装を進めていた kyumina くんは、なかよしMAPでは、フォローしている人がフォローしている人も取得する必要があることに気が付きました。
あなたに課せられたタスクは、「idが55のユーザがフォローしている人が、フォローしている人のユーザidを、昇順で、もれなく重複がないように列挙すること」です。

あなた「必要なデータも、文法もすべてこの手の中……。やるだけ」
',
    'name' => 'Kyumina くんとなかよしMAP2',
    'point' => 300,
    'answer_query' => ' id from users inner join (select followee_id from follow_relations where follower_id=55) as friends on users.id=followee_id order by users.id;',
];