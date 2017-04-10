create table if not exists users (
  id integer PRIMARY KEY AUTOINCREMENT ,
  username text unique not NULL ,
  password text NOT NULL
);

CREATE TABLE IF NOT EXISTS submissions (
  id integer PRIMARY KEY AUTOINCREMENT ,
  user_id integer not null,
  problem_id integer NOT NULL ,
  query text not null,
  accepted text not null,
  execution_time integer not null,
  created_at integer not null
);