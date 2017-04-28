<?php

return [
    'story' => 'pawoo.netがpixiv社の運営のもとにあるのは周知の事実ですが、それでは @pixiv にはどのくらいの数のリプライが飛んでいるのでしょうか。運営の負荷を見積もるためにはこの値は参考になりそうです。',
    'text' => '<code>@pixiv&nbsp;</code> が含まれるようなツイートの内容 <code>tweets.content</code>を、そのid <code>tweets.id</code> に昇順に表示してください。',
    'name' => '運営へのリプライ',
    'point' => 140,
    'answer_query' => ' content from tweets where content like \'%@pixiv %\' order by id;',
    'sample' => ' content from tweets where content like \'%@pixiv %\' order by id;',
];