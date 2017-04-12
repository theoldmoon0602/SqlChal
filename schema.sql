create table if not exists users (
  id integer PRIMARY KEY AUTOINCREMENT ,
  username text unique not NULL ,
  password text NOT NULL,
  solved text DEFAULT "",
  score integer DEFAULT 0,
  last_submission_time integer
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

DROP TABLE problems;
CREATE TABLE if NOT EXISTS problems (
  id integer PRIMARY KEY AUTOINCREMENT ,
  name text NOT NULL UNIQUE ,
  point integer NOT NULL ,
  answer_query text NOT NULL,
  text text not NULL,
  sample  text not null
);