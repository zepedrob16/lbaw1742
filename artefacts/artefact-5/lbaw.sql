DROP TABLE IF EXISTS user_table cascade;
DROP TABLE IF EXISTS report cascade;
DROP TABLE IF EXISTS friendship cascade;
DROP TABLE IF EXISTS friend_request cascade;
DROP TABLE IF EXISTS post cascade;
DROP TABLE IF EXISTS image_post cascade;
DROP TABLE IF EXISTS text_post cascade;
DROP TABLE IF EXISTS link_post cascade;
DROP TABLE IF EXISTS post_reaction cascade;
DROP TABLE IF EXISTS post_comment cascade;
DROP TABLE IF EXISTS conversation_message cascade;
DROP TABLE IF EXISTS media_category cascade;
DROP TABLE IF EXISTS media_tag cascade;
DROP TABLE IF EXISTS moderator cascade;
DROP TABLE IF EXISTS member cascade;
DROP TABLE IF EXISTS admin cascade;
DROP TABLE IF EXISTS post_tag cascade;
DROP TABLE IF EXISTS post_category cascade;

-- Tables

CREATE TABLE user_table (
  id INTEGER NOT NULL ,
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
);

CREATE TABLE post (
  postnumber INTEGER NOT NULL,
  author text NOT NULL,
  title text NOT NULL,
  time_stamp timestamp NOT NULL,
  upvotes smallint,
  downvotes smallint,
  balance smallint
);

CREATE TABLE post_comment (
  id INTEGER NOT NULL,
  id_post INTEGER,
  id_user INTEGER,
  body text NOT NULL,
  time_stamp timestamp NOT NULL
);

CREATE TABLE post_reaction (
  postnumber INTEGER NOT NULL,
  id INTEGER NOT NULL,
  balance BIT NOT NULL,
  reactor INTEGER NOT NULL,
  reacted INTEGER NOT NULL
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

CREATE TABLE report (
  id INTEGER NOT NULL,
  time_stamp timestamp NOT NULL,
  author INTEGER NOT NULL,
  criminal INTEGER NOT NULL
);

CREATE TABLE friendship (
  id INTEGER NOT NULL,
  start date,
  user1 INTEGER NOT NULL,
  user2 INTEGER NOT NULL
);

CREATE TABLE friend_request (
  id INTEGER NOT NULL,
  dateRequest date,
  dateConfirmation date,
  sender INTEGER NOT NULL,
  receiver INTEGER NOT NULL
);

CREATE TABLE conversation_message (
 	id_sender INTEGER NOT NULL,
  id_recipient INTEGER NOT NULL,
 	title text NOT NULL
);

CREATE TABLE media_category (
 	cat_id INTEGER NOT NULL,
 	title text NOT NULL
);

CREATE TABLE media_tag (
 	tag_id INTEGER NOT NULL,
 	title text NOT NULL,
  rating FLOAT
);

CREATE TABLE member (
  id_user INTEGER NOT NULL
);

CREATE TABLE moderator (
 	id_user INTEGER NOT NULL,
 	reports smallint
);

CREATE TABLE admin (
 	id_user INTEGER NOT NULL
);

CREATE TABLE post_tag(
  postnumber INTEGER NOT NULL,
  tag_id INTEGER NOT NULL
);

CREATE TABLE post_category(
  postnumber INTEGER NOT NULL,
  cat_id INTEGER NOT NULL
);

-- Primary Keys


ALTER TABLE ONLY user_table
   ADD CONSTRAINT user_id_pkey PRIMARY KEY (id);

ALTER TABLE ONLY user_table
   ADD CONSTRAINT user_username_unike UNIQUE (username);

ALTER TABLE ONLY user_table
   ADD CONSTRAINT user_email_unike UNIQUE (email);

ALTER TABLE ONLY post
    ADD CONSTRAINT post_pkey PRIMARY KEY (postnumber);

ALTER TABLE ONLY post_comment
    ADD CONSTRAINT post_comment_pkey PRIMARY KEY (id);

ALTER TABLE ONLY post_reaction
    ADD CONSTRAINT post_reaction_pkey PRIMARY KEY (id);
   
ALTER TABLE ONLY image_post
    ADD CONSTRAINT image_post_pkey PRIMARY KEY (id_post);

ALTER TABLE ONLY text_post
    ADD CONSTRAINT text_post_pkey PRIMARY KEY (id_post);

ALTER TABLE ONLY link_post
    ADD CONSTRAINT link_post_pkey PRIMARY KEY (id_post);

ALTER TABLE ONLY report
   ADD CONSTRAINT report_id_pkey PRIMARY KEY (id);
 
ALTER TABLE ONLY friendship
   ADD CONSTRAINT friendship_id_pkey PRIMARY KEY (id);

 ALTER TABLE ONLY friend_request
   ADD CONSTRAINT friend_request_id_pkey PRIMARY KEY (id);

 ALTER TABLE ONLY conversation_message
   ADD CONSTRAINT conversation_message_pkey PRIMARY KEY (id_sender);

 ALTER TABLE ONLY media_category
   ADD CONSTRAINT media_category_pkey PRIMARY KEY (cat_id);

 ALTER TABLE ONLY media_tag
   ADD CONSTRAINT media_tag_pkey PRIMARY KEY (tag_id);

 ALTER TABLE ONLY member
   ADD CONSTRAINT member_pkey PRIMARY KEY (id_user);

 ALTER TABLE ONLY moderator
   ADD CONSTRAINT moderator_pkey PRIMARY KEY (id_user); 

 ALTER TABLE ONLY admin
   ADD CONSTRAINT admin_pkey PRIMARY KEY (id_user); 

 ALTER TABLE ONLY post_tag
   ADD CONSTRAINT post_tag_pk PRIMARY KEY (tag_id); 

 ALTER TABLE ONLY post_category
   ADD CONSTRAINT post_category_pk PRIMARY KEY (cat_id); 


-- Foreign Keys

ALTER TABLE ONLY report
   ADD CONSTRAINT report_id_user_fkey FOREIGN KEY (author) REFERENCES user_table(id) ON UPDATE CASCADE;

ALTER TABLE ONLY report
   ADD CONSTRAINT report_id2_user_fkey FOREIGN KEY (criminal) REFERENCES user_table(id) ON UPDATE CASCADE;

ALTER TABLE ONLY friendship
    ADD CONSTRAINT friendship_id_user_fkey FOREIGN KEY (user1) REFERENCES user_table(id) ON UPDATE CASCADE;

ALTER TABLE ONLY friendship
    ADD CONSTRAINT friendship_id2_user_fkey FOREIGN KEY (user2) REFERENCES user_table(id) ON UPDATE CASCADE;

ALTER TABLE ONLY friend_request
    ADD CONSTRAINT friend_request1_id_user_fkey FOREIGN KEY (sender) REFERENCES user_table(id) ON UPDATE CASCADE;

ALTER TABLE ONLY friend_request
    ADD CONSTRAINT friend_request2_id_user_fkey FOREIGN KEY (receiver) REFERENCES user_table(id) ON UPDATE CASCADE;

ALTER TABLE ONLY post_comment
    ADD CONSTRAINT id_post_fkey FOREIGN KEY (id_post) REFERENCES post(postnumber) ON UPDATE CASCADE;

ALTER TABLE ONLY post_comment
    ADD CONSTRAINT id_user_fkey FOREIGN KEY (id_user) REFERENCES user_table(id) ON UPDATE CASCADE;

ALTER TABLE ONLY post_reaction
    ADD CONSTRAINT id_user FOREIGN KEY (reactor) REFERENCES user_table(id) ON UPDATE CASCADE;

ALTER TABLE ONLY post_reaction
    ADD CONSTRAINT id_post FOREIGN KEY (reacted) REFERENCES post(postnumber) ON UPDATE CASCADE;

ALTER TABLE ONLY image_post
    ADD CONSTRAINT image_post_id_post_fkey FOREIGN KEY (id_post) REFERENCES post(postnumber) ON UPDATE CASCADE;

ALTER TABLE ONLY text_post
    ADD CONSTRAINT text_post_id_post_fkey FOREIGN KEY (id_post) REFERENCES post(postnumber) ON UPDATE CASCADE;

ALTER TABLE ONLY link_post
    ADD CONSTRAINT link_post_id_post_fkey FOREIGN KEY (id_post) REFERENCES post(postnumber) ON UPDATE CASCADE;

ALTER TABLE ONLY conversation_message
    ADD CONSTRAINT conversation_id_sender_fkey FOREIGN KEY (id_sender) REFERENCES user_table(id) on UPDATE CASCADE;
    
ALTER TABLE ONLY conversation_message
    ADD CONSTRAINT conversation_id_recipient_fkey FOREIGN KEY (id_recipient) REFERENCES user_table(id) on UPDATE CASCADE;
   
ALTER TABLE ONLY media_category
    ADD CONSTRAINT media_category_id_post_fkey FOREIGN KEY (cat_id) REFERENCES post(postnumber) on UPDATE CASCADE;

ALTER TABLE ONLY media_tag
    ADD CONSTRAINT media_tag_id_post_fkey FOREIGN KEY (tag_id) REFERENCES post(postnumber) on UPDATE CASCADE;
    
ALTER TABLE ONLY moderator
    ADD CONSTRAINT moderator_id_user_fkey FOREIGN KEY (id_user) REFERENCES user_table(id) on UPDATE CASCADE;

ALTER TABLE ONLY member
    ADD CONSTRAINT member_id_user_fkey FOREIGN KEY (id_user) REFERENCES user_table(id) on UPDATE CASCADE;
    
ALTER TABLE ONLY admin
    ADD CONSTRAINT admin_id_user_fkey FOREIGN KEY (id_user) REFERENCES user_table(id) on UPDATE CASCADE;

ALTER TABLE ONLY post_tag
    ADD CONSTRAINT postnumber_tag_fkey FOREIGN KEY (postnumber) REFERENCES post(postnumber) on UPDATE CASCADE;

ALTER TABLE ONLY post_tag
    ADD CONSTRAINT postnumber_tag_id_fkey FOREIGN KEY (tag_id) REFERENCES media_tag(tag_id) on UPDATE CASCADE;
    
ALTER TABLE ONLY post_category
    ADD CONSTRAINT postnumber_cat_fkey FOREIGN KEY (postnumber) REFERENCES post(postnumber) on UPDATE CASCADE;

ALTER TABLE ONLY post_category
    ADD CONSTRAINT postnumber_cat_id_fkey FOREIGN KEY (cat_id) REFERENCES media_category(cat_id) on UPDATE CASCADE;
