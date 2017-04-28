<?php

return [
    'story' => 'もっともマストドンを楽しんでいる人といえば、それは例えば最もたくさんツイートしている人です。そんな人を調べるため、あなたは、各ユーザの総ツイート文字数を調べることにしました。',
    'text' => '各ユーザについて、そのユーザのツイート <code>tweets.content</code> の文字数の合計を表示してください。データは、ユーザのid <code>tweets.user_id</code>に昇順にソートしてください',
    'name' => '総ツイート文字数',
    'point' => 150,
    'answer_query' => ' sum(length(content)) from tweets group by user_id order by user_id;',
    'sample' => ' sum(length(content)) from tweets group by user_id order by user_id;',
];