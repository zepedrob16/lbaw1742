DROP TABLE IF EXISTS user;
DROP TABLE IF EXISTS report;
DROP TABLE IF EXISTS friendship;
DROP TABLE IF EXISTS friend_request;
DROP TABLE IF EXISTS post;
DROP TABLE IF EXISTS image_post;
DROP TABLE IF EXISTS text_post;
DROP TABLE IF EXISTS link_post;
DROP TABLE IF EXISTS post_reaction;
DROP TABLE IF EXISTS post_comment;
DROP TABLE IF EXISTS conversation;
DROP TABLE IF EXISTS media_category;
DROP TABLE IF EXISTS media_tag;
DROP TABLE IF EXISTS moderator;
DROP TABLE IF EXISTS member;
DROP TABLE IF EXISTS admin;

CREATE TABLE user (
  id INTEGER NOT NULL SERIAL,
  username text NOT NULL,
  password text NOT NULL,
  firstname text NOT NULL,
  lastname text NOT NULL,
  email text NOT NULL,
  datebirth date NOT NULL,
  nationality text,
  quote text,
  avatar text,
  upvotes smallint,
  downvotes smallint,
  balance smallint
)

CREATE TABLE report (
  id INTEGER NOT NULL,
  timestamp TIMESTAMPZ NOT NULL
);

CREATE TABLE friendship (
  id INTEGER NOT NULL,
  start date
);

CREATE TABLE friend_request (
  id INTEGER NOT NULL,
  dateRequest date,
  dateConfirmation date
);

CREATE TABLE post (
  id_post INTEGER NOT NULL,
  title text NOT NULL,
  timestamp timestampz NOT NULL,
  upvotes smallint,
  downvotes smallint,
  balance smallint
);
 
CREATE TABLE image_post (
 	id_post INTEGER NOT NULL,
 	image text NOT NULL,
  source text NOT NULL
);

CREATE TABLE text_post (
 	id_post INTEGER NOT NULL,
 	opinion text NOT NULL,
 	source text NOT NULL
);

CREATE TABLE link_post (
 	id_post INTEGER NOT NULL,
 	url text NOT NULL
);

CREATE TABLE post_reaction (
  id INTEGER NOT NULL,
  id_user INTEGER NOT NULL,
  id_post INTEGER NOT NULL,
  balance BIT NOT NULL
);

CREATE TABLE post_comment (
  id INTEGER NOT NULL,
  id_post INTEGER,
  id_comment INTEGER,
  body text NOT NULL,
  timestamp TIMESTAMPZ NOT NULL
);

CREATE TABLE conversation (
 	id_sender INTEGER NOT NULL,
  id_recipient INTEGER NOT NULL,
 	title text NOT NULL
);

CREATE TABLE media_category (
 	id_post INTEGER NOT NULL,
 	title text NOT NULL
);

CREATE TABLE media_tag (
 	id_post INTEGER NOT NULL,
 	title text NOT NULL,
  rating FLOAT
);

CREATE TABLE moderator (
 	id_user INTEGER NOT NULL,
 	reports smallint
);

CREATE TABLE member (
 	id_user INTEGER NOT NULL
);

CREATE TABLE admin (
 	id_user INTEGER NOT NULL
);

-- Primary Keys and Uniques
ALTER TABLE ONLY report
   ADD CONSTRAINT report_id_pkey PRIMARY KEY (id);
   
ALTER TABLE ONLY user
   ADD CONSTRAINT user_id_pkey PRIMARY KEY (id);
   ADD CONSTRAINT user_username_uk UNIQUE (username);
   ADD CONSTRAINT user_email_uk UNIQUE (email);
   
ALTER TABLE ONLY friendship
   ADD CONSTRAINT friendship_id_pkey PRIMARY KEY (id);
   
 ALTER TABLE ONLY friend_request
   ADD CONSTRAINT friend_request_id_pkey PRIMARY KEY (id);
   
ALTER TABLE ONLY post
    ADD CONSTRAINT post_pkey PRIMARY KEY (id);

ALTER TABLE ONLY image_post
    ADD CONSTRAINT image_post_pkey PRIMARY KEY (id_post);

ALTER TABLE ONLY text_post
    ADD CONSTRAINT text_post_pkey PRIMARY KEY (id_post);

ALTER TABLE ONLY link_post
    ADD CONSTRAINT link_post_pkey PRIMARY KEY (id_post);
    
ALTER TABLE ONLY post_comment
    ADD CONSTRAINT post_comment_pkey PRIMARY KEY (id);
    
ALTER TABLE ONLY post_reaction
    ADD CONSTRAINT post_reaction_pkey PRIMARY KEY (id);
   
-- Foreign Keys

ALTER TABLE ONLY report
   ADD CONSTRAINT report_id_user_fkey FOREIGN KEY (author) REFERENCES user(id) ON UPDATE CASCADE;
   ADD CONSTRAINT report_id_user_fkey FOREIGN KEY (criminal) REFERENCES user(id) ON UPDATE CASCADE;
   
ALTER TABLE friendship
    ADD CONSTRAINT friendship_id_user_fkey FOREIGN KEY (user1) REFERENCES user(id) ON UPDATE CASCADE;
    ADD CONSTRAINT friendship_id_user_fkey FOREIGN KEY (user2) REFERENCES user(id) ON UPDATE CASCADE;
    
ALTER TABLE friend_request
    ADD CONSTRAINT friend_request_id_user_fkey FOREIGN KEY (sender) REFERENCES user(id) ON UPDATE CASCADE;
    ADD CONSTRAINT friend_request_id_user_fkey FOREIGN KEY (receiver) REFERENCES user(id) ON UPDATE CASCADE;

ALTER TABLE ONLY post_reaction
    ADD CONSTRAINT id_user FOREIGN KEY (reactor) REFERENCES user(id) ON UPDATE CASCADE;
    
ALTER TABLE ONLY post_reaction
    ADD CONSTRAINT id_post FOREIGN KEY (reacted) REFERENCES post(id) ON UPDATE CASCADE;
    
ALTER TABLE ONLY post_comment
    ADD CONSTRAINT id_post FOREIGN KEY (parent) REFERENCES post(id) ON UPDATE CASCADE;
    
ALTER TABLE ONLY post_comment
    ADD CONSTRAINT id_comment FOREIGN KEY (parent) REFERENCES comment(id) ON UPDATE CASCADE;

ALTER TABLE ONLY image_post
    ADD CONSTRAINT image_post_id_post_fkey FOREIGN KEY (id_post) REFERENCES post(id) ON UPDATE CASCADE;

ALTER TABLE ONLY text_post
    ADD CONSTRAINT text_post_id_post_fkey FOREIGN KEY (id_post) REFERENCES post(id) ON UPDATE CASCADE;

ALTER TABLE ONLY link_post
    ADD CONSTRAINT link_post_id_post_fkey FOREIGN KEY (id_post) REFERENCES post(id) ON UPDATE CASCADE;

ALTER TABLE ONLY conversation
    ADD CONSTRAINT conversation_id_sender_fkey FOREIGN KEY (id_sender) REFERENCES user(id) on UPDATE CASCADE;
    
ALTER TABLE ONLY conversation
    ADD CONSTRAINT conversation_id_recipient_fkey FOREIGN KEY (id_recipient) REFERENCES user(id) on UPDATE CASCADE;
    
ALTER TABLE ONLY media_category
    ADD CONSTRAINT media_category_id_post_fkey FOREIGN KEY (id_post) REFERENCES post(id) on UPDATE CASCADE;

ALTER TABLE ONLY media_tag
    ADD CONSTRAINT media_tag_id_post_fkey FOREIGN KEY (id_post) REFERENCES post(id) on UPDATE CASCADE;
    
ALTER TABLE ONLY moderator
    ADD CONSTRAINT moderator_id_user_fkey FOREIGN KEY (id_user) REFERENCES user(id) on UPDATE CASCADE;
    
ALTER TABLE ONLY member
    ADD CONSTRAINT member_id_user_fkey FOREIGN KEY (id_user) REFERENCES user(id) on UPDATE CASCADE;
    
ALTER TABLE ONLY admin
    ADD CONSTRAINT admin_id_user_fkey FOREIGN KEY (id_user) REFERENCES user(id) on UPDATE CASCADE;