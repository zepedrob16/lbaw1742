DROP TABLE IF EXISTS users cascade;
DROP TABLE IF EXISTS post cascade;
DROP TABLE IF EXISTS report cascade;
DROP TABLE IF EXISTS friendship cascade;
DROP TABLE IF EXISTS friend_request cascade;
DROP TABLE IF EXISTS image_post cascade;
DROP TABLE IF EXISTS text_post cascade;
DROP TABLE IF EXISTS link_post cascade;
DROP TABLE IF EXISTS post_reaction cascade;
DROP TABLE IF EXISTS post_comment cascade;
DROP TABLE IF EXISTS conversation_message cascade;
DROP TABLE IF EXISTS media_tag cascade;
DROP TABLE IF EXISTS moderator cascade;
DROP TABLE IF EXISTS member cascade;
DROP TABLE IF EXISTS admin cascade;
DROP TABLE IF EXISTS post_tag cascade;
DROP TABLE IF EXISTS password_resets cascade;

-- Tables

SET datestyle = dmy;

CREATE TABLE users (
  id SERIAL UNIQUE,
  username text,
  password text NOT NULL,
  name text,
  lastname text,
  email text NOT NULL,
  datebirth date,
  nationality text,
  quote text,
  avatar text,
  upvotes smallint,
  downvotes smallint,
  balance smallint,
  remember_token text,
  admin_or_not INTEGER NOT NULL
);

CREATE TABLE password_resets (
  email text,
  token text,
  created_at text
);

CREATE TABLE post (
  postnumber SERIAL UNIQUE ,
  author text ,
  preview text NOT NULL,
  title text NOT NULL,
  type text NOT NULL,
  time_stamp time ,
  upvotes smallint,
  downvotes smallint,
  balance smallint,
  media_category text
);

CREATE TABLE post_comment (
  id SERIAL UNIQUE,
  id_post INTEGER,
  id_author INTEGER,
  id_parent INTEGER,
  body text NOT NULL,
  time_stamp time NOT NULL
);

CREATE TABLE post_reaction (
  id SERIAL UNIQUE,
  postnumber INTEGER NOT NULL,
  balance smallint NOT NULL,
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
  id SERIAL UNIQUE ,
  time_stamp date NOT NULL,
  title text NOT NULL,
  type text NOT NULL,
  author INTEGER NOT NULL,
  criminal INTEGER NOT NULL,
  postid INTEGER NOT NULL
);

CREATE TABLE friendship (
  id SERIAL UNIQUE,
  start date,
  user1 INTEGER NOT NULL,
  user2 INTEGER NOT NULL
);

CREATE TABLE friend_request (
  id SERIAL UNIQUE,
  dateRequest date,
  dateConfirmation date,
  sender INTEGER NOT NULL,
  receiver INTEGER NOT NULL
);

CREATE TABLE conversation_message (
  id_conversation SERIAL UNIQUE,
  id_sender INTEGER NOT NULL,
  id_recipient INTEGER NOT NULL,
  body text NOT NULL,
  title text NOT NULL,
  time_stamp date NOT NULL,
  read smallint
);

CREATE TABLE media_tag (
  tag_id SERIAL UNIQUE,
  title text NOT NULL,
  rating FLOAT
);

CREATE TABLE member (
  id_user INTEGER NOT NULL,
  reports smallint
);

CREATE TABLE moderator (
  id_user INTEGER NOT NULL
);

CREATE TABLE admin (
  id_user INTEGER NOT NULL
);

CREATE TABLE post_tag(
  id SERIAL UNIQUE,
  postnumber INTEGER NOT NULL,
  tag_id INTEGER NOT NULL
);

-- Primary Keys


ALTER TABLE ONLY users
   ADD CONSTRAINT user_id_pkey PRIMARY KEY (id);

ALTER TABLE ONLY users
   ADD CONSTRAINT user_username_unike UNIQUE (username);

ALTER TABLE ONLY users
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
   ADD CONSTRAINT conversation_message_pkey PRIMARY KEY (id_conversation);

 ALTER TABLE ONLY media_tag
   ADD CONSTRAINT media_tag_pkey PRIMARY KEY (tag_id);

 ALTER TABLE ONLY member
   ADD CONSTRAINT member_pkey PRIMARY KEY (id_user);

 ALTER TABLE ONLY moderator
   ADD CONSTRAINT moderator_pkey PRIMARY KEY (id_user); 

 ALTER TABLE ONLY admin
   ADD CONSTRAINT admin_pkey PRIMARY KEY (id_user); 

 ALTER TABLE ONLY post_tag
   ADD CONSTRAINT post_tag_pk PRIMARY KEY (id); 


-- Foreign Keys

ALTER TABLE ONLY report
   ADD CONSTRAINT report_id_user_fkey FOREIGN KEY (author) REFERENCES users(id) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE ONLY report
   ADD CONSTRAINT report_id2_user_fkey FOREIGN KEY (criminal) REFERENCES users(id) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE ONLY friendship
    ADD CONSTRAINT friendship_id_user_fkey FOREIGN KEY (user1) REFERENCES users(id) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE ONLY friendship
    ADD CONSTRAINT friendship_id2_user_fkey FOREIGN KEY (user2) REFERENCES users(id) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE ONLY friend_request
    ADD CONSTRAINT friend_request1_id_user_fkey FOREIGN KEY (sender) REFERENCES users(id) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE ONLY friend_request
    ADD CONSTRAINT friend_request2_id_user_fkey FOREIGN KEY (receiver) REFERENCES users(id) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE ONLY post_comment
    ADD CONSTRAINT id_post_fkey FOREIGN KEY (id_post) REFERENCES post(postnumber) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE ONLY post_comment
    ADD CONSTRAINT id_user_fkey FOREIGN KEY (id_author) REFERENCES users(id) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE ONLY post_reaction
    ADD CONSTRAINT id_user FOREIGN KEY (reactor) REFERENCES users(id) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE ONLY post_reaction
    ADD CONSTRAINT id_user_2 FOREIGN KEY (reacted) REFERENCES users(id) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE ONLY post_reaction
    ADD CONSTRAINT reaction_post_fkey FOREIGN KEY (postnumber) REFERENCES post(postnumber) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE ONLY image_post
    ADD CONSTRAINT image_post_id_post_fkey FOREIGN KEY (id_post) REFERENCES post(postnumber) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE ONLY text_post
    ADD CONSTRAINT text_post_id_post_fkey FOREIGN KEY (id_post) REFERENCES post(postnumber) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE ONLY link_post
    ADD CONSTRAINT link_post_id_post_fkey FOREIGN KEY (id_post) REFERENCES post(postnumber) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE ONLY conversation_message
    ADD CONSTRAINT conversation_id_sender_fkey FOREIGN KEY (id_sender) REFERENCES users(id) ON DELETE CASCADE ON UPDATE CASCADE;
    
ALTER TABLE ONLY conversation_message
    ADD CONSTRAINT conversation_id_recipient_fkey FOREIGN KEY (id_recipient) REFERENCES users(id) ON DELETE CASCADE ON UPDATE CASCADE;
    
ALTER TABLE ONLY moderator
    ADD CONSTRAINT moderator_id_user_fkey FOREIGN KEY (id_user) REFERENCES users(id) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE ONLY member
    ADD CONSTRAINT member_id_user_fkey FOREIGN KEY (id_user) REFERENCES users(id) ON DELETE CASCADE ON UPDATE CASCADE;
    
ALTER TABLE ONLY admin
    ADD CONSTRAINT admin_id_user_fkey FOREIGN KEY (id_user) REFERENCES users(id) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE ONLY post_tag
    ADD CONSTRAINT postnumber_tag_fkey FOREIGN KEY (postnumber) REFERENCES post(postnumber) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE ONLY post_tag
    ADD CONSTRAINT postnumber_tag_id_fkey FOREIGN KEY (tag_id) REFERENCES media_tag(tag_id) ON DELETE CASCADE ON UPDATE CASCADE;


ALTER TABLE ONLY post
    ADD CONSTRAINT postauthor_tag_id_fkey FOREIGN KEY (author) REFERENCES users(username) ON DELETE CASCADE ON UPDATE CASCADE;


    

INSERT INTO "users" (username, password, name, lastname, email, datebirth, nationality, quote, avatar, upvotes, downvotes, balance, admin_or_not) VALUES ('bcurless0', 'HmeeUgMD7', 'Inès', 'Curless', 'lcurless0@google.com', '2002/01/09', 'Kazakhstan', 'Vivamus metus arcu, adipiscing molestie, hendrerit at, vulputate vitae, nisl. Aenean lectus. Pellentesque eget nunc. Donec quis orci eget orci vehicula condimentum.', null, 0, 0, 0, 0);
INSERT INTO "users" (username, password, name, lastname, email, datebirth, nationality, quote, avatar, upvotes, downvotes, balance, admin_or_not) VALUES ('cnolleth1', 'b6eeebM', 'Léandre', 'Nolleth', 'cnolleth1@illinois.edu', '1977/05/05', 'Brazil', 'Cras in purus eu magna vulputate luctus. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Vivamus vestibulum sagittis sapien.', null, 0, 0, 0, 0);
INSERT INTO "users" (username, password, name, lastname, email, datebirth, nationality, quote, avatar, upvotes, downvotes, balance, admin_or_not) VALUES ('rdennehy2', '2ivVAD', 'Bérengère', 'Dennehy', 'ldennehy2@census.gov', '1979/08/11', 'Indonesia', 'Suspendisse potenti.', null, 0, 0, 0, 0);
INSERT INTO "users" (username, password, name, lastname, email, datebirth, nationality, quote, avatar, upvotes, downvotes, balance, admin_or_not) VALUES ('jhruska3', 'tQBf6E6zN', 'Wá', 'Hruska', 'khruska3@jalbum.net', '1987/09/06', 'Indonesia', 'Nulla justo. Aliquam quis turpis eget elit sodales scelerisque.', null, 0, 0, 0, 0);
INSERT INTO "users" (username, password, name, lastname, email, datebirth, nationality, quote, avatar, upvotes, downvotes, balance, admin_or_not) VALUES ('chumburton4', 'F3JPPx', 'Léone', 'Humburton', 'ehumburton4@utexas.edu', '2008/03/24', 'Egypt', 'Nullam orci pede, venenatis non, sodales sed, tincidunt eu, felis. Fusce posuere felis sed lacus. Morbi sem mauris, laoreet ut, rhoncus aliquet, pulvinar sed, nisl.', null, 0, 0, 0, 0);
INSERT INTO "users" (username, password, name, lastname, email, datebirth, nationality, quote, avatar, upvotes, downvotes, balance, admin_or_not) VALUES ('hcharker5', 'iwXcscQaQ', 'Irène', 'Charker', 'rcharker5@vistaprint.com', '1970/10/10', 'China', 'Cras non velit nec nisi vulputate nonummy. Maecenas tincidunt lacus at velit.', null, 0, 0, 0, 0);
INSERT INTO "users" (username, password, name, lastname, email, datebirth, nationality, quote, avatar, upvotes, downvotes, balance, admin_or_not) VALUES ('srubinowitsch6', 'dVeDO9FuzEh', 'Marie-hélène', 'Rubinowitsch', 'crubinowitsch6@usgs.gov', '1999/03/15', 'Indonesia', 'Vivamus in felis eu sapien cursus vestibulum. Proin eu mi.', null, 0, 0, 0, 0);
INSERT INTO "users" (username, password, name, lastname, email, datebirth, nationality, quote, avatar, upvotes, downvotes, balance, admin_or_not) VALUES ('ndenziloe7', 'Ih4CjNyGaJ', 'Eugénie', 'Denziloe', 'jdenziloe7@gravatar.com', '1960/11/21', 'Sweden', 'Suspendisse accumsan tortor quis turpis. Sed ante. Vivamus tortor. Duis mattis egestas metus. Aenean fermentum.', null, 0, 0, 0, 0);
INSERT INTO "users" (username, password, name, lastname, email, datebirth, nationality, quote, avatar, upvotes, downvotes, balance, admin_or_not) VALUES ('epaulich8', 'PgR0Yb', 'Crééz', 'Paulich', 'lpaulich8@youtu.be', '1982/10/19', 'Greece', 'Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae.', null, 0, 0, 0, 0);
INSERT INTO "users" (username, password, name, lastname, email, datebirth, nationality, quote, avatar, upvotes, downvotes, balance, admin_or_not) VALUES ('sgriss9', 'rz64uv4rxUa', 'Céline', 'Griss', 'dgriss9@samsung.com', '1957/03/19', 'Philippines', 'Ut tellus. Nulla ut erat id mauris vulputate elementum. Nullam varius. Nulla facilisi. Cras non velit nec nisi vulputate nonummy.', null, 0, 0, 0, 0);
INSERT INTO "users" (username, password, name, lastname, email, datebirth, nationality, quote, avatar, upvotes, downvotes, balance, admin_or_not) VALUES ('bbeelbya', 'wDhFYVIZUCs', 'Loïca', 'Beelby', 'hbeelbya@ning.com', '1978/06/27', 'China', 'Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae.', null, 0, 0, 0, 0);
INSERT INTO "users" (username, password, name, lastname, email, datebirth, nationality, quote, avatar, upvotes, downvotes, balance, admin_or_not) VALUES ('kstearleyb', 'LweWxKJOE4', 'Véronique', 'Stearley', 'istearleyb@flickr.com', '1985/04/13', 'Poland', 'Quisque id justo sit amet sapien dignissim vestibulum.', null, 0, 0, 0, 0);
INSERT INTO "users" (username, password, name, lastname, email, datebirth, nationality, quote, avatar, upvotes, downvotes, balance, admin_or_not) VALUES ('dmedinac', 'taVz0yB', 'Célia', 'Medina', 'dmedinac@shop-pro.jp', '1972/03/15', 'Mexico', 'Proin interdum mauris non ligula pellentesque ultrices.', null, 0, 0, 0, 0);
INSERT INTO "users" (username, password, name, lastname, email, datebirth, nationality, quote, avatar, upvotes, downvotes, balance, admin_or_not) VALUES ('xscoldingd', 'zNEG3Z', 'Eléa', 'Scolding', 'tscoldingd@cnbc.com', '1973/02/15', 'China', 'Nulla facilisi.', null, 0, 0, 0, 0);
INSERT INTO "users" (username, password, name, lastname, email, datebirth, nationality, quote, avatar, upvotes, downvotes, balance, admin_or_not) VALUES ('teymore', 'sCgaLBfywPCo', 'Marie-ève', 'Eymor', 'leymore@digg.com', '1956/03/17', 'France', 'Donec quis orci eget orci vehicula condimentum.', null, 0, 0, 0, 0);
INSERT INTO "users" (username, password, name, lastname, email, datebirth, nationality, quote, avatar, upvotes, downvotes, balance, admin_or_not) VALUES ('rarkleyf', 'K6dvVSZpUU4B', 'Maëlla', 'Arkley', 'jarkleyf@phpbb.com', '1952/07/26', 'Japan', 'Cras pellentesque volutpat dui. Maecenas tristique, est et tempus semper.', null, 0, 0, 0, 0);
INSERT INTO "users" (username, password, name, lastname, email, datebirth, nationality, quote, avatar, upvotes, downvotes, balance, admin_or_not) VALUES ('flocksg', 'khHA8lGtL', 'Pò', 'Locks', 'mlocksg@sciencedaily.com', '1952/11/23', 'Czech Republic', 'Maecenas tincidunt lacus at velit. Vivamus vel nulla eget eros elementum pellentesque.', null, 0, 0, 0, 0);
INSERT INTO "users" (username, password, name, lastname, email, datebirth, nationality, quote, avatar, upvotes, downvotes, balance, admin_or_not) VALUES ('jharrollh', 'GQGfKMN', 'Gaïa', 'Harroll', 'bharrollh@tuttocitta.it', '1952/04/21', 'Sweden', 'Morbi vestibulum, velit id pretium iaculis, diam erat fermentum justo, nec condimentum neque sapien placerat ante.', null, 0, 0, 0, 0);
INSERT INTO "users" (username, password, name, lastname, email, datebirth, nationality, quote, avatar, upvotes, downvotes, balance, admin_or_not) VALUES ('jyakunkini', 'ofwomKa7vUM', 'Marie-françoise', 'Yakunkin', 'byakunkini@mashable.com', '1996/03/30', 'Syria', 'Praesent blandit lacinia erat.', null, 0, 0, 0, 0);
INSERT INTO "users" (username, password, name, lastname, email, datebirth, nationality, quote, avatar, upvotes, downvotes, balance, admin_or_not) VALUES ('cpidgeleyj', 'fQC51NA429Dx', 'Zoé', 'Pidgeley', 'mpidgeleyj@goo.gl', '1992/07/19', 'Kazakhstan', 'In eleifend quam a odio. In hac habitasse platea dictumst. Maecenas ut massa quis augue luctus tincidunt.', null, 0, 0, 0, 0);


INSERT INTO "post" (author, preview, title, type, time_stamp, upvotes, downvotes, balance, media_category) VALUES ('chumburton4','sdfsdhdfg fsdgsrg qwwdc', 'Charlottes Web','image', '20:00:01', 0, 0, 0 ,'Movie');
INSERT INTO "post" (author, preview, title, type, time_stamp, upvotes, downvotes, balance, media_category) VALUES ('dmedinac','sdfsdh435 dfsdf ccsdgsrg qwwdc', 'Such Good Friends','image', '5:28:29', 0, 0, 0,'TV Show');
INSERT INTO "post" (author, preview, title, type, time_stamp, upvotes, downvotes, balance, media_category) VALUES ('flocksg','sdfspreview dfsmkddc', 'Vertical Ray of the Sun, The (Mua he chieu thang dung)','image', '20:41:01', 0, 0, 0,'TV Show');
INSERT INTO "post" (author, preview, title, type, time_stamp, upvotes, downvotes, balance, media_category) VALUES ('dmedinac','qwDJ lO0 Olhdfg fsdgsrg qwwdc', 'Love Crazy','image', '5:53:23', 0, 0, 0,'Movie');
INSERT INTO "post" (author, preview, title, type, time_stamp, upvotes, downvotes, balance, media_category) VALUES ('flocksg','smaquin ahskf estas j', 'Charlie Browns Christmas Tales','image', '0:43:01', 0, 0, 0,'Movie');
INSERT INTO "post" (author, preview, title, type, time_stamp, upvotes, downvotes, balance, media_category) VALUES ('flocksg','sudo minm dsiajsk unnola', 'With Fire and Sword (Ogniem i mieczem)','link', '20:22:55', 0, 0, 0,'TV Show');
INSERT INTO "post" (author, preview, title, type, time_stamp, upvotes, downvotes, balance, media_category) VALUES ('flocksg','quirioldo ajuun Mas u', 'Falling Up','link', '11:24:34', 0, 0, 0,'Movie');
INSERT INTO "post" (author, preview, title, type, time_stamp, upvotes, downvotes, balance, media_category) VALUES ('jyakunkini','sdfsrg qwwdc', 'Stalag17','link', '5:27:52', 0, 0, 0,'TV Show');
INSERT INTO "post" (author, preview, title, type, time_stamp, upvotes, downvotes, balance, media_category) VALUES ('dmedinac','sFRASE OLAS FUa OOOOpppppwdc', 'Rockaway','link', '16:23:13', 0, 0, 0,'Movie');
INSERT INTO "post" (author, preview, title, type, time_stamp, upvotes, downvotes, balance, media_category) VALUES ('jyakunkini','sdfdgsrg qwwdc', 'Neds','link', '9:43:56', 0, 0, 0,'TV Show');
INSERT INTO "post" (author, preview, title, type, time_stamp, upvotes, downvotes, balance, media_category) VALUES ('jyakunkini','sfg fsdgsrg qwwdc', 'Adios Sabata','text', '2:47:50', 0, 0, 0,'Movie');
INSERT INTO "post" (author, preview, title, type, time_stamp, upvotes, downvotes, balance, media_category) VALUES ('jyakunkini','sdfsrg qwwdc', 'City Slickers II: The Legend of Curlys Gold','text', '18:20:07', 0, 0, 0,'TV Show');
INSERT INTO "post" (author, preview, title, type, time_stamp, upvotes, downvotes, balance, media_category) VALUES ('dmedinac','sdfsdhdfgrg qwwdc', 'We Are The Night (Wir sind die Nacht)','text', '2:33:18', 0, 0, 0,'Movie');
INSERT INTO "post" (author, preview, title, type, time_stamp, upvotes, downvotes, balance, media_category) VALUES ('jyakunkini','sdfsdrg qwwdc', 'Kon-Tiki','text', '0:32:08', 0, 0, 0,'Movie');
INSERT INTO "post" (author, preview, title, type, time_stamp, upvotes, downvotes, balance, media_category) VALUES ('jyakunkini','hrg qwwdc', 'Last Taboo, The','text', '15:41:11', 0, 0, 0,'Movie');
INSERT INTO "post" (author, preview, title, type, time_stamp, upvotes, downvotes, balance, media_category) VALUES ('jyakunkini','sdfsdhgsrg qwwdc', 'Gloria','text', '4:48:17', 0, 0, 0,'Movie');
INSERT INTO "post" (author, preview, title, type, time_stamp, upvotes, downvotes, balance, media_category) VALUES ('jyakunkini','sdfsdhdfg fsdgsrg qwwdc', 'Eye of God','text', '7:00:41', 0, 0, 0,'Movie');
INSERT INTO "post" (author, preview, title, type, time_stamp, upvotes, downvotes, balance, media_category) VALUES ('cpidgeleyj','sd45rrf Imarg qwwdc', 'Casino Jack','text', '10:24:29', 0, 0, 0,'Movie');
INSERT INTO "post" (author, preview, title, type, time_stamp, upvotes, downvotes, balance, media_category) VALUES ('cpidgeleyj','sdfsdhdfsrg qwwdc', 'Nanny Diaries, The','text', '12:10:30', 0, 0, 0,'Movie');
INSERT INTO "post" (author, preview, title, type, time_stamp, upvotes, downvotes, balance, media_category) VALUES ('cpidgeleyj','sdfgfhqwwdc', 'School of Flesh, The (Ecole de la chair, L)','text', '16:29:29', 0, 0, 0,'Movie');

INSERT INTO "image_post" (id_post, image, source) VALUES (1, 'anao.png', 'http://blogger.com/phasellus/in.js');
INSERT INTO "image_post" (id_post, image, source) VALUES (2, 'arvore.png', 'http://amazon.com/pede/ac.jsp');
INSERT INTO "image_post" (id_post, image, source) VALUES (3, 'cogumelo.png', 'https://ebay.co.uk/parturient/montes/nascetur.jsp');
INSERT INTO "image_post" (id_post, image, source) VALUES (4, 'horse.png', 'http://businessinsider.com/mi.js');
INSERT INTO "image_post" (id_post, image, source) VALUES (5, 'anao.png', 'http://canalblog.com/pretium/iaculis/justo/in/hac.xml');

INSERT INTO "link_post" (id_post, url) VALUES (6, 'https://mac.com/congue/elementum.js');
INSERT INTO "link_post" (id_post, url) VALUES (7, 'https://opensource.org/potenti/nullam.aspx');
INSERT INTO "link_post" (id_post, url) VALUES (8, 'http://ucoz.com/dolor/sit/amet/consectetuer/adipiscing.png');
INSERT INTO "link_post" (id_post, url) VALUES (9, 'https://mit.edu/ut/rhoncus/aliquet/pulvinar/sed/nisl.png');
INSERT INTO "link_post" (id_post, url) VALUES (10, 'https://epa.gov/etiam/vel/augue/vestibulum.aspx');

INSERT INTO "text_post" (id_post, opinion, source) VALUES (11, 'Integer ac neque.', 'https://hhs.gov/pretium/nisl/ut/volutpat/sapien/arcu/sed.png');
INSERT INTO "text_post" (id_post, opinion, source) VALUES (12, 'Morbi non quam nec dui luctus rutrum.', 'http://google.nl/aenean/lectus.jpg');
INSERT INTO "text_post" (id_post, opinion, source) VALUES (13, 'Nam ultrices, libero non mattis pulvinar, nulla pede ullamcorper augue, a suscipit nulla elit ac nulla. Sed vel enim sit amet nunc viverra dapibus.', 'https://hibu.com/mauris/sit/amet/eros/suspendisse.xml');
INSERT INTO "text_post" (id_post, opinion, source) VALUES (14, 'Nulla suscipit ligula in lacus.', 'https://google.com/neque/aenean/auctor/gravida/sem/praesent/id.js');
INSERT INTO "text_post" (id_post, opinion, source) VALUES (15, 'Praesent id massa id nisl venenatis lacinia.', 'https://surveymonkey.com/mauris/lacinia/sapien/quis.js');
INSERT INTO "text_post" (id_post, opinion, source) VALUES (16, 'Integer rompet na outa praesent id ac neque.', 'https://hhs.gov/pretium/nisl/ut/volutpat/sapien/arcu/sed.png');
INSERT INTO "text_post" (id_post, opinion, source) VALUES (17, 'Morbi non quam rutrum.', 'http://google.nl/aenean/lectus.jpg');
INSERT INTO "text_post" (id_post, opinion, source) VALUES (18, 'Nam ultrices, libero non mattis pulvinara dapibus.', 'https://hibu.com/mauris/sit/amet/eros/suspendisse.xml');
INSERT INTO "text_post" (id_post, opinion, source) VALUES (19, 'Nulla suscipit ligula in lacus. Praesent id massa id nisl venenatis lacinia.', 'https://google.com/neque/aenean/auctor/gravida/sem/praesent/id.js');
INSERT INTO "text_post" (id_post, opinion, source) VALUES (20, 'Praesent id massa id nisl venenatis lacinia. Nulla suscipit ligula in lacus', 'https://surveymonkey.com/mauris/lacinia/sapien/quis.js');


INSERT INTO "post_comment" (id_post, id_author, id_parent, body, time_stamp) VALUES (1, 1, 0, 'Donec ut mauris eget massa tempor convallis. Nulla neque libero, convallis eget, eleifend luctus, ultricies eu, nibh.', '18:45:06');
INSERT INTO "post_comment" (id_post, id_author, id_parent, body, time_stamp) VALUES (2, 2, 0, 'Sed vel enim sit amet nunc viverra dapibus.', '2:01:48');
INSERT INTO "post_comment" (id_post, id_author, id_parent, body, time_stamp) VALUES (3, 3, 0, 'Sed sagittis.', '23:36:05');
INSERT INTO "post_comment" (id_post, id_author, id_parent, body, time_stamp) VALUES (4, 4, 0, 'Fusce posuere felis sed lacus.', '8:47:45');
INSERT INTO "post_comment" (id_post, id_author, id_parent, body, time_stamp) VALUES (5, 5, 0, 'Donec odio justo, sollicitudin ut, suscipit a, feugiat et, eros. Vestibulum ac est lacinia nisi venenatis tristique.', '22:10:55');
INSERT INTO "post_comment" (id_post, id_author, id_parent, body, time_stamp) VALUES (1, 6, 0, 'Maecenas tristique, est et tempus semper, est quam pharetra magna, ac consequat metus sapien ut nunc.', '15:02:59');
INSERT INTO "post_comment" (id_post, id_author, id_parent, body, time_stamp) VALUES (2, 7, 0, 'Mauris enim leo, rhoncus sed, vestibulum sit amet, cursus id, turpis. Integer aliquet, massa id lobortis convallis, tortor risus dapibus augue, vel accumsan tellus nisi eu orci.', '23:15:52');
INSERT INTO "post_comment" (id_post, id_author, id_parent, body, time_stamp) VALUES (3, 8, 0, 'Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Etiam vel augue.', '18:43:04');
INSERT INTO "post_comment" (id_post, id_author, id_parent, body, time_stamp) VALUES (4, 9, 0, 'Maecenas rhoncus aliquam lacus. Morbi quis tortor id nulla ultrices aliquet.', '18:48:00');
INSERT INTO "post_comment" (id_post, id_author, id_parent, body, time_stamp) VALUES (5, 10, 0, 'Donec quis orci eget orci vehicula condimentum. Curabitur in libero ut massa volutpat convallis.', '19:40:29');
INSERT INTO "post_comment" (id_post, id_author, id_parent, body, time_stamp) VALUES (6, 11, 0, 'Praesent lectus. Vestibulum quam sapien, varius ut, blandit non, interdum in, ante.', '22:10:37');
INSERT INTO "post_comment" (id_post, id_author, id_parent, body, time_stamp) VALUES (7, 12, 0, 'Maecenas leo odio, condimentum id, luctus nec, molestie sed, justo.', '21:23:05');
INSERT INTO "post_comment" (id_post, id_author, id_parent, body, time_stamp) VALUES (8, 13, 0, 'Quisque ut erat. Curabitur gravida nisi at nibh.', '6:23:32');
INSERT INTO "post_comment" (id_post, id_author, id_parent, body, time_stamp) VALUES (9, 14, 0, 'Praesent blandit lacinia erat. Vestibulum sed magna at nunc commodo placerat.', '8:37:24');
INSERT INTO "post_comment" (id_post, id_author, id_parent, body, time_stamp) VALUES (10, 15, 0, 'In hac habitasse platea dictumst.', '20:36:36');
INSERT INTO "post_comment" (id_post, id_author, id_parent, body, time_stamp) VALUES (11, 16, 0, 'Vivamus tortor.', '14:35:25');
INSERT INTO "post_comment" (id_post, id_author, id_parent, body, time_stamp) VALUES (12, 17, 0, 'Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Nulla dapibus dolor vel est.', '6:48:10');
INSERT INTO "post_comment" (id_post, id_author, id_parent, body, time_stamp) VALUES (13, 18, 0, 'Vestibulum ac est lacinia nisi venenatis tristique. Fusce congue, diam id ornare imperdiet, sapien urna pretium nisl, ut volutpat sapien arcu sed augue.', '2:22:20');
INSERT INTO "post_comment" (id_post, id_author, id_parent, body, time_stamp) VALUES (14, 19, 0, 'Nulla justo.', '0:51:25');
INSERT INTO "post_comment" (id_post, id_author, id_parent, body, time_stamp) VALUES (15, 20, 0, 'Praesent blandit lacinia erat. Vestibulum sed magna at nunc commodo placerat.', '0:53:05');

INSERT INTO "post_reaction" (postnumber, balance, reactor, reacted) VALUES (1, -1, 2, 6);
INSERT INTO "post_reaction" (postnumber, balance, reactor, reacted) VALUES (2, 1, 3, 7);
INSERT INTO "post_reaction" (postnumber, balance, reactor, reacted) VALUES (3, -1, 1, 9);
INSERT INTO "post_reaction" (postnumber, balance, reactor, reacted) VALUES (4, 1, 10, 10);
INSERT INTO "post_reaction" (postnumber, balance, reactor, reacted) VALUES (5, 1, 9, 9);
INSERT INTO "post_reaction" (postnumber, balance, reactor, reacted) VALUES (6, -1, 8, 8);
INSERT INTO "post_reaction" (postnumber, balance, reactor, reacted) VALUES (7, -1, 7, 7);
INSERT INTO "post_reaction" (postnumber, balance, reactor, reacted) VALUES (8, 1, 6, 6);
INSERT INTO "post_reaction" (postnumber, balance, reactor, reacted) VALUES (9, 1, 5, 5);
INSERT INTO "post_reaction" (postnumber, balance, reactor, reacted) VALUES (10, -1, 4, 4);
INSERT INTO "post_reaction" (postnumber, balance, reactor, reacted) VALUES (11, -1, 11, 11);
INSERT INTO "post_reaction" (postnumber, balance, reactor, reacted) VALUES (12, 1, 12, 12);
INSERT INTO "post_reaction" (postnumber, balance, reactor, reacted) VALUES (13, -1, 13, 13);
INSERT INTO "post_reaction" (postnumber, balance, reactor, reacted) VALUES (14, -1, 14, 14);
INSERT INTO "post_reaction" (postnumber, balance, reactor, reacted) VALUES (15, 1, 15, 15);
INSERT INTO "post_reaction" (postnumber, balance, reactor, reacted) VALUES (16, 1, 16, 16);
INSERT INTO "post_reaction" (postnumber, balance, reactor, reacted) VALUES (17, -1, 17, 17);
INSERT INTO "post_reaction" (postnumber, balance, reactor, reacted) VALUES (18, 1, 18, 18);
INSERT INTO "post_reaction" (postnumber, balance, reactor, reacted) VALUES (19, 1, 19, 19);
INSERT INTO "post_reaction" (postnumber, balance, reactor, reacted) VALUES (20, 1, 20, 20);

INSERT INTO "report" (title, type, time_stamp, criminal, author, postid) VALUES ('Innapropriate', 'Post', '2017/12/23', 1, 1, 1);
INSERT INTO "report" (title, type, time_stamp, criminal, author, postid) VALUES ('Abusive', 'Comment', '2017/06/27', 2, 2, 2);
INSERT INTO "report" (title, type, time_stamp, criminal, author, postid) VALUES ('Sexual', 'Post', '2017/12/12', 3, 3, 3);
INSERT INTO "report" (title, type, time_stamp, criminal, author, postid) VALUES ('Spam', 'Comment', '2017/03/14', 4, 4, 4);
INSERT INTO "report" (title, type, time_stamp, criminal, author, postid) VALUES ('Minors', 'Post', '2017/02/28', 5, 5, 5);
INSERT INTO "report" (title, type, time_stamp, criminal, author, postid) VALUES ('Terrorist', 'Post', '2017/01/30', 6, 6, 6);

INSERT INTO "friendship" (start, user1, user2) VALUES ('2017/10/19', 1, 2);
INSERT INTO "friendship" (start, user1, user2) VALUES ('2017/08/03', 2, 3);
INSERT INTO "friendship" (start, user1, user2) VALUES ('2017/08/14', 3, 4);
INSERT INTO "friendship" (start, user1, user2) VALUES ('2017/07/11', 4, 5);
INSERT INTO "friendship" (start, user1, user2) VALUES ('2017/06/17', 5, 6);
INSERT INTO "friendship" (start, user1, user2) VALUES ('2017/10/23', 6, 7);
INSERT INTO "friendship" (start, user1, user2) VALUES ('2017/09/09', 7, 8);
INSERT INTO "friendship" (start, user1, user2) VALUES ('2018/03/27', 8, 9);
INSERT INTO "friendship" (start, user1, user2) VALUES ('2017/05/08', 9, 10);
INSERT INTO "friendship" (start, user1, user2) VALUES ('2018/03/09', 10, 11);
INSERT INTO "friendship" (start, user1, user2) VALUES ('2017/04/25', 11, 12);
INSERT INTO "friendship" (start, user1, user2) VALUES ('2017/05/29', 12, 13);
INSERT INTO "friendship" (start, user1, user2) VALUES ('2017/10/05', 13, 14);
INSERT INTO "friendship" (start, user1, user2) VALUES ('2017/05/03', 14, 15);
INSERT INTO "friendship" (start, user1, user2) VALUES ('2017/08/24', 15, 16);
INSERT INTO "friendship" (start, user1, user2) VALUES ('2017/05/14', 16, 17);
INSERT INTO "friendship" (start, user1, user2) VALUES ('2017/05/13', 17, 18);
INSERT INTO "friendship" (start, user1, user2) VALUES ('2017/11/21', 18, 19);
INSERT INTO "friendship" (start, user1, user2) VALUES ('2017/11/12', 19, 20);
INSERT INTO "friendship" (start, user1, user2) VALUES ('2017/10/19', 20, 1);

INSERT INTO "friend_request" (dateRequest, dateConfirmation, sender, receiver) VALUES ('2017/08/13', '2018/02/22', 1, 2);
INSERT INTO "friend_request" (dateRequest, dateConfirmation, sender, receiver) VALUES ('2017/02/26', '2017/07/08', 2, 3);
INSERT INTO "friend_request" (dateRequest, dateConfirmation, sender, receiver) VALUES ('2018/02/16', '2018/06/21', 3, 4);
INSERT INTO "friend_request" (dateRequest, dateConfirmation, sender, receiver) VALUES ('2017/01/13', '2017/11/05', 4, 5);
INSERT INTO "friend_request" (dateRequest, dateConfirmation, sender, receiver) VALUES ('2018/01/22', '2018/03/24', 5, 6);
INSERT INTO "friend_request" (dateRequest, dateConfirmation, sender, receiver) VALUES ('2017/09/18', '2018/04/03', 6, 7);
INSERT INTO "friend_request" (dateRequest, dateConfirmation, sender, receiver) VALUES ('2017/09/17', '2017/11/19', 7, 8);
INSERT INTO "friend_request" (dateRequest, dateConfirmation, sender, receiver) VALUES ('2017/03/18', '2017/06/13', 8, 9);
INSERT INTO "friend_request" (dateRequest, dateConfirmation, sender, receiver) VALUES ('2017/06/22', '2017/12/23', 9, 10);
INSERT INTO "friend_request" (dateRequest, dateConfirmation, sender, receiver) VALUES ('2017/09/29', '2017/12/29', 10, 11);
INSERT INTO "friend_request" (dateRequest, dateConfirmation, sender, receiver) VALUES ('2018/02/19', '2018/06/02', 11, 12);
INSERT INTO "friend_request" (dateRequest, dateConfirmation, sender, receiver) VALUES ('2018/01/05', '2018/05/22', 12, 13);
INSERT INTO "friend_request" (dateRequest, dateConfirmation, sender, receiver) VALUES ('2017/07/27', '2017/11/13', 13, 14);
INSERT INTO "friend_request" (dateRequest, dateConfirmation, sender, receiver) VALUES ('2017/05/23', '2017/12/10', 14, 15);
INSERT INTO "friend_request" (dateRequest, dateConfirmation, sender, receiver) VALUES ('2017/08/12', '2018/01/17', 15, 16);
INSERT INTO "friend_request" (dateRequest, dateConfirmation, sender, receiver) VALUES ('2017/04/23', '2017/12/18', 16, 17);
INSERT INTO "friend_request" (dateRequest, dateConfirmation, sender, receiver) VALUES ('2017/04/14', '2018/04/01', 17, 18);
INSERT INTO "friend_request" (dateRequest, dateConfirmation, sender, receiver) VALUES ('2017/12/09', '2017/12/13', 18, 19);
INSERT INTO "friend_request" (dateRequest, dateConfirmation, sender, receiver) VALUES ('2017/08/03', '2017/10/25', 19, 20);
INSERT INTO "friend_request" (dateRequest, dateConfirmation, sender, receiver) VALUES ('2017/01/29', '2017/04/26', 20, 1);

INSERT INTO "conversation_message" (id_sender, id_recipient, body, title, time_stamp, read) VALUES (1, 2, 'Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Duis faucibus accumsan odio.', 'Generic Title', '2018/03/19', 1);
INSERT INTO "conversation_message" (id_sender, id_recipient, body, title, time_stamp, read) VALUES (2, 3, 'Suspendisse potenti. Cras in purus eu magna vulputate luctus.', 'Generic Title', '2018/03/27', 0);
INSERT INTO "conversation_message" (id_sender, id_recipient, body, title, time_stamp, read) VALUES (3, 4, 'Vivamus tortor. Duis mattis egestas metus.', 'Generic Title', '2017/09/08', 0);
INSERT INTO "conversation_message" (id_sender, id_recipient, body, title, time_stamp, read) VALUES (4, 5, 'Morbi a ipsum. Integer a nibh.', 'Generic Title', '2017/10/11', 1);
INSERT INTO "conversation_message" (id_sender, id_recipient, body, title, time_stamp, read) VALUES (5, 6, 'Phasellus sit amet erat. Nulla tempus.', 'Generic Title', '2018/03/23', 0);
INSERT INTO "conversation_message" (id_sender, id_recipient, body, title, time_stamp, read) VALUES (6, 7, 'In hac habitasse platea dictumst.', 'Generic Title', '2018/03/25', 1);
INSERT INTO "conversation_message" (id_sender, id_recipient, body, title, time_stamp, read) VALUES (7, 8, 'Aliquam non mauris.', 'Generic Title', '2017/06/03', 0);
INSERT INTO "conversation_message" (id_sender, id_recipient, body, title, time_stamp, read) VALUES (8, 9, 'Suspendisse ornare consequat lectus. In est risus, auctor sed, tristique in, tempus sit amet, sem.', 'Generic Title', '2017/11/03', 1);
INSERT INTO "conversation_message" (id_sender, id_recipient, body, title, time_stamp, read) VALUES (9, 10, 'Praesent id massa id nisl venenatis lacinia. Aenean sit amet justo.', 'Generic Title', '2017/07/08', 0);
INSERT INTO "conversation_message" (id_sender, id_recipient, body, title, time_stamp, read) VALUES (10, 11, 'Duis aliquam convallis nunc.', 'Generic Title', '2017/03/11', 1);
INSERT INTO "conversation_message" (id_sender, id_recipient, body, title, time_stamp, read) VALUES (11, 12, 'Aliquam quis turpis eget elit sodales scelerisque. Mauris sit amet eros.', 'Generic Title', '2017/06/20', 1);
INSERT INTO "conversation_message" (id_sender, id_recipient, body, title, time_stamp, read) VALUES (12, 13, 'Suspendisse potenti.', 'Generic Title', '2017/03/22', 1);
INSERT INTO "conversation_message" (id_sender, id_recipient, body, title, time_stamp, read) VALUES (13, 14, 'Vestibulum quam sapien, varius ut, blandit non, interdum in, ante.', 'Generic Title', '2018/01/18', 0);
INSERT INTO "conversation_message" (id_sender, id_recipient, body, title, time_stamp, read) VALUES (14, 15, 'Nunc rhoncus dui vel sem. Sed sagittis.', 'Generic Title', '2017/10/30', 0);
INSERT INTO "conversation_message" (id_sender, id_recipient, body, title, time_stamp, read) VALUES (15, 16, 'Nulla mollis molestie lorem.', 'Generic Title', '2017/11/16', 0);
INSERT INTO "conversation_message" (id_sender, id_recipient, body, title, time_stamp, read) VALUES (16, 17, 'In est risus, auctor sed, tristique in, tempus sit amet, sem.', 'Generic Title', '2017/06/23', 1);
INSERT INTO "conversation_message" (id_sender, id_recipient, body, title, time_stamp, read) VALUES (17, 18, 'Nulla neque libero, convallis eget, eleifend luctus, ultricies eu, nibh.', 'Generic Title', '2017/12/15', 1);
INSERT INTO "conversation_message" (id_sender, id_recipient, body, title, time_stamp, read) VALUES (18, 19, 'Nullam orci pede, venenatis non, sodales sed, tincidunt eu, felis.', 'Generic Title', '2017/06/09', 1);
INSERT INTO "conversation_message" (id_sender, id_recipient, body, title, time_stamp, read) VALUES (19, 20, 'Vestibulum sed magna at nunc commodo placerat.', 'Generic Title', '2018/01/19', 1);
INSERT INTO "conversation_message" (id_sender, id_recipient, body, title, time_stamp, read) VALUES (20, 1, 'Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Nulla dapibus dolor vel est. Donec odio justo, sollicitudin ut, suscipit a, feugiat et, eros.', 'Generic Title', '2017/01/29', 0);

INSERT INTO "media_tag" (rating, title) VALUES (2.2, 'Tuareg: The Desert Warrior (Tuareg - Il guerriero del deserto)');
INSERT INTO "media_tag" (rating, title) VALUES (8.3, 'Band Wagon, The');
INSERT INTO "media_tag" (rating, title) VALUES (7.6, 'Boogie Nights');
INSERT INTO "media_tag" (rating, title) VALUES (3.6, 'Help! I''m A Fish');
INSERT INTO "media_tag" (rating, title) VALUES (6.5, 'Coney Island');
INSERT INTO "media_tag" (rating, title) VALUES (8.7, 'Illegal');
INSERT INTO "media_tag" (rating, title) VALUES (2.0, 'My Brother the Terrorist');
INSERT INTO "media_tag" (rating, title) VALUES (5.8, 'Hum Aapke Hain Koun...!');
INSERT INTO "media_tag" (rating, title) VALUES (5.7, 'Thousand Months, A (Mille mois)');
INSERT INTO "media_tag" (rating, title) VALUES (8.4, 'The Open Road');
INSERT INTO "media_tag" (rating, title) VALUES (8.8, 'Mindwalk');
INSERT INTO "media_tag" (rating, title) VALUES (3.9, 'Death Wish 2');
INSERT INTO "media_tag" (rating, title) VALUES (3.8, 'How She Move');
INSERT INTO "media_tag" (rating, title) VALUES (8.7, 'Nine Queens (Nueve reinas)');
INSERT INTO "media_tag" (rating, title) VALUES (4.3, 'Strange One, The');
INSERT INTO "media_tag" (rating, title) VALUES (4.3, 'Strings');
INSERT INTO "media_tag" (rating, title) VALUES (2.9, 'Almighty Thor');
INSERT INTO "media_tag" (rating, title) VALUES (6.8, 'Lust for Gold (Duhul aurului)');
INSERT INTO "media_tag" (rating, title) VALUES (3.0, 'Dead Men Walk');
INSERT INTO "media_tag" (rating, title) VALUES (3.7, 'Dark Floors');

INSERT INTO "member" (id_user, reports) VALUES (9, 3);
INSERT INTO "member" (id_user, reports) VALUES (10, 2);
INSERT INTO "member" (id_user, reports) VALUES (11, 0);
INSERT INTO "member" (id_user, reports) VALUES (12, 1);
INSERT INTO "member" (id_user, reports) VALUES (13, 2);
INSERT INTO "member" (id_user, reports) VALUES (14, 0);
INSERT INTO "member" (id_user, reports) VALUES (15, 0);
INSERT INTO "member" (id_user, reports) VALUES (16, 0);
INSERT INTO "member" (id_user, reports) VALUES (17, 0);
INSERT INTO "member" (id_user, reports) VALUES (18, 2);
INSERT INTO "member" (id_user, reports) VALUES (19, 1);
INSERT INTO "member" (id_user, reports) VALUES (20, 1);

INSERT INTO "moderator" (id_user) VALUES (1);
INSERT INTO "moderator" (id_user) VALUES (2);
INSERT INTO "moderator" (id_user) VALUES (3);
INSERT INTO "moderator" (id_user) VALUES (4);

INSERT INTO "admin" (id_user) VALUES (5);
INSERT INTO "admin" (id_user) VALUES (6);
INSERT INTO "admin" (id_user) VALUES (7);
INSERT INTO "admin" (id_user) VALUES (8);

INSERT INTO "post_tag" (postnumber, tag_id) VALUES (1, 1);
INSERT INTO "post_tag" (postnumber, tag_id) VALUES (2, 2);
INSERT INTO "post_tag" (postnumber, tag_id) VALUES (3, 3);
INSERT INTO "post_tag" (postnumber, tag_id) VALUES (4, 4);
INSERT INTO "post_tag" (postnumber, tag_id) VALUES (5, 5);
INSERT INTO "post_tag" (postnumber, tag_id) VALUES (6, 6);
INSERT INTO "post_tag" (postnumber, tag_id) VALUES (7, 7);
INSERT INTO "post_tag" (postnumber, tag_id) VALUES (8, 8);
INSERT INTO "post_tag" (postnumber, tag_id) VALUES (9, 9);
INSERT INTO "post_tag" (postnumber, tag_id) VALUES (10, 10);
INSERT INTO "post_tag" (postnumber, tag_id) VALUES (11, 11);
INSERT INTO "post_tag" (postnumber, tag_id) VALUES (12, 12);
INSERT INTO "post_tag" (postnumber, tag_id) VALUES (13, 13);
INSERT INTO "post_tag" (postnumber, tag_id) VALUES (14, 14);
INSERT INTO "post_tag" (postnumber, tag_id) VALUES (15, 15);