<section class="section">
    <h3 class="section-title">users</h3>
    <div>ユーザ情報</div>
    <div>
        <pre>
        <code>
create table users (
    id integer primary key, -- ID
    username text unique not null, -- ユーザ名（英数。一意。@名）
    display_name text, -- 表示名（日本語有り、重複OK)
    created_at text not null -- アカウントの作成時刻
);
        </code>
        </pre>
    </div>
</section>
<section class="section">
    <h3 class="section-title">tweets</h3>
    <div>ツイート</div>
    <div>
        <pre>
        <code>
create table tweets (
    id integer primary key,
    content text, -- ツイート内容
    user_id integer not null, -- ツイートしてるユーザのid
    created_at text not null, -- ツイート時刻
    in_reply_to integer, -- リプライなら、リプライ先のツイートのid

    foreign key user_id reference users(id),
    foreign key in_reply_to reference tweets(id)
);
        </code>
        </pre>
    </div>
</section>
<section class="section">
    <h3 class="section-title">followings</h3>
    <div>フォロー関係</div>
    <div>
        <pre>
        <code>
create table followings (
    from_id integer, -- フォローしているユーザのid
    to_id integer, -- フォローされているユーザのid

    foreign key from_id references users(id),
    foreign key to_id references users(id)
);
        </code>
        </pre>
    </div>
</section>