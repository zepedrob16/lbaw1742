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
DROP TABLE IF EXISTS media_category cascade;
DROP TABLE IF EXISTS media_tag cascade;
DROP TABLE IF EXISTS moderator cascade;
DROP TABLE IF EXISTS member cascade;
DROP TABLE IF EXISTS admin cascade;
DROP TABLE IF EXISTS post_tag cascade;
DROP TABLE IF EXISTS post_category cascade;
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
  remember_token text
);

CREATE TABLE password_resets (
  email text,
  token text,
  created_at text
);

CREATE TABLE post (
  postnumber SERIAL UNIQUE ,
  author text ,
  title text NOT NULL,
  time_stamp time ,
  upvotes smallint,
  downvotes smallint,
  balance smallint
);

CREATE TABLE post_comment (
  id INTEGER NOT NULL,
  id_post INTEGER,
  id_user INTEGER,
  body text NOT NULL,
  time_stamp time NOT NULL
);

CREATE TABLE post_reaction (
  postnumber INTEGER NOT NULL,
  id INTEGER NOT NULL,
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
  id INTEGER NOT NULL,
  time_stamp time NOT NULL,
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
  body text NOT NULL,
  time_stamp date NOT NULL,
  read smallint
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
  postnumber INTEGER NOT NULL,
  tag_id INTEGER NOT NULL
);

CREATE TABLE post_category(
  postnumber INTEGER NOT NULL,
  cat_id INTEGER NOT NULL
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
   ADD CONSTRAINT report_id_user_fkey FOREIGN KEY (author) REFERENCES users(id) ON UPDATE CASCADE;

ALTER TABLE ONLY report
   ADD CONSTRAINT report_id2_user_fkey FOREIGN KEY (criminal) REFERENCES users(id) ON UPDATE CASCADE;

ALTER TABLE ONLY friendship
    ADD CONSTRAINT friendship_id_user_fkey FOREIGN KEY (user1) REFERENCES users(id) ON UPDATE CASCADE;

ALTER TABLE ONLY friendship
    ADD CONSTRAINT friendship_id2_user_fkey FOREIGN KEY (user2) REFERENCES users(id) ON UPDATE CASCADE;

ALTER TABLE ONLY friend_request
    ADD CONSTRAINT friend_request1_id_user_fkey FOREIGN KEY (sender) REFERENCES users(id) ON UPDATE CASCADE;

ALTER TABLE ONLY friend_request
    ADD CONSTRAINT friend_request2_id_user_fkey FOREIGN KEY (receiver) REFERENCES users(id) ON UPDATE CASCADE;

ALTER TABLE ONLY post_comment
    ADD CONSTRAINT id_post_fkey FOREIGN KEY (id_post) REFERENCES post(postnumber) ON UPDATE CASCADE;

ALTER TABLE ONLY post_comment
    ADD CONSTRAINT id_user_fkey FOREIGN KEY (id_user) REFERENCES users(id) ON UPDATE CASCADE;

ALTER TABLE ONLY post_reaction
    ADD CONSTRAINT id_user FOREIGN KEY (reactor) REFERENCES users(id) ON UPDATE CASCADE;

ALTER TABLE ONLY post_reaction
    ADD CONSTRAINT id_post FOREIGN KEY (reacted) REFERENCES post(postnumber) ON UPDATE CASCADE;

ALTER TABLE ONLY image_post
    ADD CONSTRAINT image_post_id_post_fkey FOREIGN KEY (id_post) REFERENCES post(postnumber) ON UPDATE CASCADE;

ALTER TABLE ONLY text_post
    ADD CONSTRAINT text_post_id_post_fkey FOREIGN KEY (id_post) REFERENCES post(postnumber) ON UPDATE CASCADE;

ALTER TABLE ONLY link_post
    ADD CONSTRAINT link_post_id_post_fkey FOREIGN KEY (id_post) REFERENCES post(postnumber) ON UPDATE CASCADE;

ALTER TABLE ONLY conversation_message
    ADD CONSTRAINT conversation_id_sender_fkey FOREIGN KEY (id_sender) REFERENCES users(id) on UPDATE CASCADE;
    
ALTER TABLE ONLY conversation_message
    ADD CONSTRAINT conversation_id_recipient_fkey FOREIGN KEY (id_recipient) REFERENCES users(id) on UPDATE CASCADE;
   
ALTER TABLE ONLY media_category
    ADD CONSTRAINT media_category_id_post_fkey FOREIGN KEY (cat_id) REFERENCES post(postnumber) on UPDATE CASCADE;

ALTER TABLE ONLY media_tag
    ADD CONSTRAINT media_tag_id_post_fkey FOREIGN KEY (tag_id) REFERENCES post(postnumber) on UPDATE CASCADE;
    
ALTER TABLE ONLY moderator
    ADD CONSTRAINT moderator_id_user_fkey FOREIGN KEY (id_user) REFERENCES users(id) on UPDATE CASCADE;

ALTER TABLE ONLY member
    ADD CONSTRAINT member_id_user_fkey FOREIGN KEY (id_user) REFERENCES users(id) on UPDATE CASCADE;
    
ALTER TABLE ONLY admin
    ADD CONSTRAINT admin_id_user_fkey FOREIGN KEY (id_user) REFERENCES users(id) on UPDATE CASCADE;

ALTER TABLE ONLY post_tag
    ADD CONSTRAINT postnumber_tag_fkey FOREIGN KEY (postnumber) REFERENCES post(postnumber) on UPDATE CASCADE;

ALTER TABLE ONLY post_tag
    ADD CONSTRAINT postnumber_tag_id_fkey FOREIGN KEY (tag_id) REFERENCES media_tag(tag_id) on UPDATE CASCADE;
    
ALTER TABLE ONLY post_category
    ADD CONSTRAINT postnumber_cat_fkey FOREIGN KEY (postnumber) REFERENCES post(postnumber) on UPDATE CASCADE;

ALTER TABLE ONLY post_category
ADD CONSTRAINT postnumber_cat_id_fkey FOREIGN KEY (cat_id) REFERENCES media_category(cat_id) on UPDATE CASCADE;

INSERT INTO "users" (username, password, name, lastname, email, datebirth, nationality, quote, avatar, upvotes, downvotes, balance) VALUES ('bcurless0', 'HmeeUgMD7', 'Inès', 'Curless', 'lcurless0@google.com', '2002/01/09', 'Kazakhstan', 'Vivamus metus arcu, adipiscing molestie, hendrerit at, vulputate vitae, nisl. Aenean lectus. Pellentesque eget nunc. Donec quis orci eget orci vehicula condimentum.', 'http://dummyimage.com/237x147.png/ff4444/ffffff', 32, 62, 44);
INSERT INTO "users" (username, password, name, lastname, email, datebirth, nationality, quote, avatar, upvotes, downvotes, balance) VALUES ('cnolleth1', 'b6eeebM', 'Léandre', 'Nolleth', 'cnolleth1@illinois.edu', '1977/05/05', 'Brazil', 'Cras in purus eu magna vulputate luctus. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Vivamus vestibulum sagittis sapien.', 'http://dummyimage.com/190x240.png/cc0000/ffffff', 86, 1, 97);
INSERT INTO "users" (username, password, name, lastname, email, datebirth, nationality, quote, avatar, upvotes, downvotes, balance) VALUES ('rdennehy2', '2ivVAD', 'Bérengère', 'Dennehy', 'ldennehy2@census.gov', '1979/08/11', 'Indonesia', 'Suspendisse potenti.', 'http://dummyimage.com/146x239.bmp/ff4444/ffffff', 82, 74, 7);
INSERT INTO "users" (username, password, name, lastname, email, datebirth, nationality, quote, avatar, upvotes, downvotes, balance) VALUES ('jhruska3', 'tQBf6E6zN', 'Wá', 'Hruska', 'khruska3@jalbum.net', '1987/09/06', 'Indonesia', 'Nulla justo. Aliquam quis turpis eget elit sodales scelerisque.', 'http://dummyimage.com/144x156.bmp/cc0000/ffffff', 71, 42, 69);
INSERT INTO "users" (username, password, name, lastname, email, datebirth, nationality, quote, avatar, upvotes, downvotes, balance) VALUES ('chumburton4', 'F3JPPx', 'Léone', 'Humburton', 'ehumburton4@utexas.edu', '2008/03/24', 'Egypt', 'Nullam orci pede, venenatis non, sodales sed, tincidunt eu, felis. Fusce posuere felis sed lacus. Morbi sem mauris, laoreet ut, rhoncus aliquet, pulvinar sed, nisl.', 'http://dummyimage.com/213x147.png/dddddd/000000', 58, 32, 88);
INSERT INTO "users" (username, password, name, lastname, email, datebirth, nationality, quote, avatar, upvotes, downvotes, balance) VALUES ('hcharker5', 'iwXcscQaQ', 'Irène', 'Charker', 'rcharker5@vistaprint.com', '1970/10/10', 'China', 'Cras non velit nec nisi vulputate nonummy. Maecenas tincidunt lacus at velit.', 'http://dummyimage.com/137x132.jpg/cc0000/ffffff', 61, 94, 92);
INSERT INTO "users" (username, password, name, lastname, email, datebirth, nationality, quote, avatar, upvotes, downvotes, balance) VALUES ('srubinowitsch6', 'dVeDO9FuzEh', 'Marie-hélène', 'Rubinowitsch', 'crubinowitsch6@usgs.gov', '1999/03/15', 'Indonesia', 'Vivamus in felis eu sapien cursus vestibulum. Proin eu mi.', 'http://dummyimage.com/146x207.jpg/5fa2dd/ffffff', 15, 15, 83);
INSERT INTO "users" (username, password, name, lastname, email, datebirth, nationality, quote, avatar, upvotes, downvotes, balance) VALUES ('ndenziloe7', 'Ih4CjNyGaJ', 'Eugénie', 'Denziloe', 'jdenziloe7@gravatar.com', '1960/11/21', 'Sweden', 'Suspendisse accumsan tortor quis turpis. Sed ante. Vivamus tortor. Duis mattis egestas metus. Aenean fermentum.', 'http://dummyimage.com/219x104.jpg/5fa2dd/ffffff', 72, 44, 93);
INSERT INTO "users" (username, password, name, lastname, email, datebirth, nationality, quote, avatar, upvotes, downvotes, balance) VALUES ('epaulich8', 'PgR0Yb', 'Crééz', 'Paulich', 'lpaulich8@youtu.be', '1982/10/19', 'Greece', 'Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae.', 'http://dummyimage.com/160x115.bmp/dddddd/000000', 7, 78, 63);
INSERT INTO "users" (username, password, name, lastname, email, datebirth, nationality, quote, avatar, upvotes, downvotes, balance) VALUES ('sgriss9', 'rz64uv4rxUa', 'Céline', 'Griss', 'dgriss9@samsung.com', '1957/03/19', 'Philippines', 'Ut tellus. Nulla ut erat id mauris vulputate elementum. Nullam varius. Nulla facilisi. Cras non velit nec nisi vulputate nonummy.', 'http://dummyimage.com/215x165.bmp/5fa2dd/ffffff', 20, 70, 100);
INSERT INTO "users" (username, password, name, lastname, email, datebirth, nationality, quote, avatar, upvotes, downvotes, balance) VALUES ('bbeelbya', 'wDhFYVIZUCs', 'Loïca', 'Beelby', 'hbeelbya@ning.com', '1978/06/27', 'China', 'Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae.', 'http://dummyimage.com/218x108.png/cc0000/ffffff', 91, 52, 77);
INSERT INTO "users" (username, password, name, lastname, email, datebirth, nationality, quote, avatar, upvotes, downvotes, balance) VALUES ('kstearleyb', 'LweWxKJOE4', 'Véronique', 'Stearley', 'istearleyb@flickr.com', '1985/04/13', 'Poland', 'Quisque id justo sit amet sapien dignissim vestibulum.', 'http://dummyimage.com/192x173.png/5fa2dd/ffffff', 83, 14, 30);
INSERT INTO "users" (username, password, name, lastname, email, datebirth, nationality, quote, avatar, upvotes, downvotes, balance) VALUES ('dmedinac', 'taVz0yB', 'Célia', 'Medina', 'dmedinac@shop-pro.jp', '1972/03/15', 'Mexico', 'Proin interdum mauris non ligula pellentesque ultrices.', 'http://dummyimage.com/241x199.bmp/5fa2dd/ffffff', 15, 48, 38);
INSERT INTO "users" (username, password, name, lastname, email, datebirth, nationality, quote, avatar, upvotes, downvotes, balance) VALUES ('xscoldingd', 'zNEG3Z', 'Eléa', 'Scolding', 'tscoldingd@cnbc.com', '1973/02/15', 'China', 'Nulla facilisi.', 'http://dummyimage.com/231x107.jpg/cc0000/ffffff', 23, 89, 83);
INSERT INTO "users" (username, password, name, lastname, email, datebirth, nationality, quote, avatar, upvotes, downvotes, balance) VALUES ('teymore', 'sCgaLBfywPCo', 'Marie-ève', 'Eymor', 'leymore@digg.com', '1956/03/17', 'France', 'Donec quis orci eget orci vehicula condimentum.', 'http://dummyimage.com/227x105.jpg/5fa2dd/ffffff', 69, 89, 48);
INSERT INTO "users" (username, password, name, lastname, email, datebirth, nationality, quote, avatar, upvotes, downvotes, balance) VALUES ('rarkleyf', 'K6dvVSZpUU4B', 'Maëlla', 'Arkley', 'jarkleyf@phpbb.com', '1952/07/26', 'Japan', 'Cras pellentesque volutpat dui. Maecenas tristique, est et tempus semper.', 'http://dummyimage.com/139x147.png/cc0000/ffffff', 83, 36, 79);
INSERT INTO "users" (username, password, name, lastname, email, datebirth, nationality, quote, avatar, upvotes, downvotes, balance) VALUES ('flocksg', 'khHA8lGtL', 'Pò', 'Locks', 'mlocksg@sciencedaily.com', '1952/11/23', 'Czech Republic', 'Maecenas tincidunt lacus at velit. Vivamus vel nulla eget eros elementum pellentesque.', 'http://dummyimage.com/197x140.bmp/5fa2dd/ffffff', 71, 31, 72);
INSERT INTO "users" (username, password, name, lastname, email, datebirth, nationality, quote, avatar, upvotes, downvotes, balance) VALUES ('jharrollh', 'GQGfKMN', 'Gaïa', 'Harroll', 'bharrollh@tuttocitta.it', '1952/04/21', 'Sweden', 'Morbi vestibulum, velit id pretium iaculis, diam erat fermentum justo, nec condimentum neque sapien placerat ante.', 'http://dummyimage.com/209x180.png/dddddd/000000', 49, 22, 21);
INSERT INTO "users" (username, password, name, lastname, email, datebirth, nationality, quote, avatar, upvotes, downvotes, balance) VALUES ('jyakunkini', 'ofwomKa7vUM', 'Marie-françoise', 'Yakunkin', 'byakunkini@mashable.com', '1996/03/30', 'Syria', 'Praesent blandit lacinia erat.', 'http://dummyimage.com/206x103.bmp/ff4444/ffffff', 55, 72, 88);
INSERT INTO "users" (username, password, name, lastname, email, datebirth, nationality, quote, avatar, upvotes, downvotes, balance) VALUES ('cpidgeleyj', 'fQC51NA429Dx', 'Zoé', 'Pidgeley', 'mpidgeleyj@goo.gl', '1992/07/19', 'Kazakhstan', 'In eleifend quam a odio. In hac habitasse platea dictumst. Maecenas ut massa quis augue luctus tincidunt.', 'http://dummyimage.com/125x176.jpg/dddddd/000000', 49, 62, 69);


INSERT INTO "post" (author, title, time_stamp, upvotes, downvotes, balance) VALUES ('chumburton4', 'Charlottes Web', '20:00:01', 73, 89, 49);
INSERT INTO "post" (author, title, time_stamp, upvotes, downvotes, balance) VALUES ('dmedinac', 'Such Good Friends', '5:28:29', 93, 43, 90);
INSERT INTO "post" (author, title, time_stamp, upvotes, downvotes, balance) VALUES ('flocksg', 'Vertical Ray of the Sun, The (Mua he chieu thang dung)', '20:41:01', 90, 100, 62);
INSERT INTO "post" (author, title, time_stamp, upvotes, downvotes, balance) VALUES ('dmedinac', 'Love Crazy', '5:53:23', 89, 12, 38);
INSERT INTO "post" (author, title, time_stamp, upvotes, downvotes, balance) VALUES ('flocksg', 'Charlie Browns Christmas Tales', '0:43:01', 5, 96, 41);
INSERT INTO "post" (author, title, time_stamp, upvotes, downvotes, balance) VALUES ('flocksg', 'With Fire and Sword (Ogniem i mieczem)', '20:22:55', 48, 75, 98);
INSERT INTO "post" (author, title, time_stamp, upvotes, downvotes, balance) VALUES ('flocksg', 'Falling Up', '11:24:34', 51, 33, 42);
INSERT INTO "post" (author, title, time_stamp, upvotes, downvotes, balance) VALUES ('jyakunkini', 'Stalag17', '5:27:52', 36, 93, 73);
INSERT INTO "post" (author, title, time_stamp, upvotes, downvotes, balance) VALUES ('dmedinac', 'Rockaway', '16:23:13', 46, 68, 11);
INSERT INTO "post" (author, title, time_stamp, upvotes, downvotes, balance) VALUES ('jyakunkini', 'Neds', '9:43:56', 51, 76, 41);
INSERT INTO "post" (author, title, time_stamp, upvotes, downvotes, balance) VALUES ('jyakunkini', 'Adios Sabata', '2:47:50', 56, 94, 99);
INSERT INTO "post" (author, title, time_stamp, upvotes, downvotes, balance) VALUES ('jyakunkini', 'City Slickers II: The Legend of Curlys Gold', '18:20:07', 7, 42, 99);
INSERT INTO "post" (author, title, time_stamp, upvotes, downvotes, balance) VALUES ('dmedinac', 'We Are The Night (Wir sind die Nacht)', '2:33:18', 29, 85, 4);
INSERT INTO "post" (author, title, time_stamp, upvotes, downvotes, balance) VALUES ('jyakunkini', 'Kon-Tiki', '0:32:08', 45, 50, 29);
INSERT INTO "post" (author, title, time_stamp, upvotes, downvotes, balance) VALUES ('jyakunkini', 'Last Taboo, The', '15:41:11', 37, 19, 40);
INSERT INTO "post" (author, title, time_stamp, upvotes, downvotes, balance) VALUES ('jyakunkini', 'Gloria', '4:48:17', 6, 33, 43);
INSERT INTO "post" (author, title, time_stamp, upvotes, downvotes, balance) VALUES ('jyakunkini', 'Eye of God', '7:00:41', 52, 21, 59);
INSERT INTO "post" (author, title, time_stamp, upvotes, downvotes, balance) VALUES ('cpidgeleyj', 'Casino Jack', '10:24:29', 51, 37, 6);
INSERT INTO "post" (author, title, time_stamp, upvotes, downvotes, balance) VALUES ('cpidgeleyj', 'Nanny Diaries, The', '12:10:30', 46, 94, 53);
INSERT INTO "post" (author, title, time_stamp, upvotes, downvotes, balance) VALUES ('cpidgeleyj', 'School of Flesh, The (Ecole de la chair, L)', '16:29:29', 52, 57, 67);

INSERT INTO "image_post" (id_post, image, source) VALUES (1, 'http://dummyimage.com/186x117.jpg/dddddd/000000', 'http://blogger.com/phasellus/in.js');
INSERT INTO "image_post" (id_post, image, source) VALUES (2, 'http://dummyimage.com/191x139.png/5fa2dd/ffffff', 'http://amazon.com/pede/ac.jsp');
INSERT INTO "image_post" (id_post, image, source) VALUES (3, 'http://dummyimage.com/187x113.jpg/cc0000/ffffff', 'https://ebay.co.uk/parturient/montes/nascetur.jsp');
INSERT INTO "image_post" (id_post, image, source) VALUES (4, 'http://dummyimage.com/103x218.jpg/ff4444/ffffff', 'http://businessinsider.com/mi.js');
INSERT INTO "image_post" (id_post, image, source) VALUES (5, 'http://dummyimage.com/125x149.png/5fa2dd/ffffff', 'http://canalblog.com/pretium/iaculis/justo/in/hac.xml');

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


INSERT INTO "post_comment" (id, id_post, id_user, body, time_stamp) VALUES (1, 1, '1', 'Donec ut mauris eget massa tempor convallis. Nulla neque libero, convallis eget, eleifend luctus, ultricies eu, nibh.', '18:45:06');
INSERT INTO "post_comment" (id, id_post, id_user, body, time_stamp) VALUES (2, 2, '2', 'Sed vel enim sit amet nunc viverra dapibus.', '2:01:48');
INSERT INTO "post_comment" (id, id_post, id_user, body, time_stamp) VALUES (3, 3, '3', 'Sed sagittis.', '23:36:05');
INSERT INTO "post_comment" (id, id_post, id_user, body, time_stamp) VALUES (4, 4, '4', 'Fusce posuere felis sed lacus.', '8:47:45');
INSERT INTO "post_comment" (id, id_post, id_user, body, time_stamp) VALUES (5, 5, '5', 'Donec odio justo, sollicitudin ut, suscipit a, feugiat et, eros. Vestibulum ac est lacinia nisi venenatis tristique.', '22:10:55');
INSERT INTO "post_comment" (id, id_post, id_user, body, time_stamp) VALUES (6, 1, '6', 'Maecenas tristique, est et tempus semper, est quam pharetra magna, ac consequat metus sapien ut nunc.', '15:02:59');
INSERT INTO "post_comment" (id, id_post, id_user, body, time_stamp) VALUES (7, 2, '7', 'Mauris enim leo, rhoncus sed, vestibulum sit amet, cursus id, turpis. Integer aliquet, massa id lobortis convallis, tortor risus dapibus augue, vel accumsan tellus nisi eu orci.', '23:15:52');
INSERT INTO "post_comment" (id, id_post, id_user, body, time_stamp) VALUES (8, 3, '8', 'Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Etiam vel augue.', '18:43:04');
INSERT INTO "post_comment" (id, id_post, id_user, body, time_stamp) VALUES (9, 4, '9', 'Maecenas rhoncus aliquam lacus. Morbi quis tortor id nulla ultrices aliquet.', '18:48:00');
INSERT INTO "post_comment" (id, id_post, id_user, body, time_stamp) VALUES (10, 5, '10', 'Donec quis orci eget orci vehicula condimentum. Curabitur in libero ut massa volutpat convallis.', '19:40:29');
INSERT INTO "post_comment" (id, id_post, id_user, body, time_stamp) VALUES (11, 6, '11', 'Praesent lectus. Vestibulum quam sapien, varius ut, blandit non, interdum in, ante.', '22:10:37');
INSERT INTO "post_comment" (id, id_post, id_user, body, time_stamp) VALUES (12, 7, '12', 'Maecenas leo odio, condimentum id, luctus nec, molestie sed, justo.', '21:23:05');
INSERT INTO "post_comment" (id, id_post, id_user, body, time_stamp) VALUES (13, 8, '13', 'Quisque ut erat. Curabitur gravida nisi at nibh.', '6:23:32');
INSERT INTO "post_comment" (id, id_post, id_user, body, time_stamp) VALUES (14, 9, '14', 'Praesent blandit lacinia erat. Vestibulum sed magna at nunc commodo placerat.', '8:37:24');
INSERT INTO "post_comment" (id, id_post, id_user, body, time_stamp) VALUES (15, 10, '15', 'In hac habitasse platea dictumst.', '20:36:36');
INSERT INTO "post_comment" (id, id_post, id_user, body, time_stamp) VALUES (16, 11, '16', 'Vivamus tortor.', '14:35:25');
INSERT INTO "post_comment" (id, id_post, id_user, body, time_stamp) VALUES (17, 12, '17', 'Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Nulla dapibus dolor vel est.', '6:48:10');
INSERT INTO "post_comment" (id, id_post, id_user, body, time_stamp) VALUES (18, 13, '18', 'Vestibulum ac est lacinia nisi venenatis tristique. Fusce congue, diam id ornare imperdiet, sapien urna pretium nisl, ut volutpat sapien arcu sed augue.', '2:22:20');
INSERT INTO "post_comment" (id, id_post, id_user, body, time_stamp) VALUES (19, 14, '19', 'Nulla justo.', '0:51:25');
INSERT INTO "post_comment" (id, id_post, id_user, body, time_stamp) VALUES (20, 15, '20', 'Praesent blandit lacinia erat. Vestibulum sed magna at nunc commodo placerat.', '0:53:05');

INSERT INTO "post_reaction" (postnumber, id, balance, reactor, reacted) VALUES (1, 1, 0, 2, 6);
INSERT INTO "post_reaction" (postnumber, id, balance, reactor, reacted) VALUES (2, 2, 1, 3, 7);
INSERT INTO "post_reaction" (postnumber, id, balance, reactor, reacted) VALUES (3, 3, 0, 1, 9);
INSERT INTO "post_reaction" (postnumber, id, balance, reactor, reacted) VALUES (4, 4, 1, 10, 10);
INSERT INTO "post_reaction" (postnumber, id, balance, reactor, reacted) VALUES (5, 5, 1, 9, 9);
INSERT INTO "post_reaction" (postnumber, id, balance, reactor, reacted) VALUES (6, 6, 1, 8, 8);
INSERT INTO "post_reaction" (postnumber, id, balance, reactor, reacted) VALUES (7, 7, 0, 7, 7);
INSERT INTO "post_reaction" (postnumber, id, balance, reactor, reacted) VALUES (8, 8, 0, 6, 6);
INSERT INTO "post_reaction" (postnumber, id, balance, reactor, reacted) VALUES (9, 9, 1, 5, 5);
INSERT INTO "post_reaction" (postnumber, id, balance, reactor, reacted) VALUES (10, 10, 0, 4, 4);
INSERT INTO "post_reaction" (postnumber, id, balance, reactor, reacted) VALUES (11, 11, 0, 11, 11);
INSERT INTO "post_reaction" (postnumber, id, balance, reactor, reacted) VALUES (12, 12, 1, 12, 12);
INSERT INTO "post_reaction" (postnumber, id, balance, reactor, reacted) VALUES (13, 13, 0, 13, 13);
INSERT INTO "post_reaction" (postnumber, id, balance, reactor, reacted) VALUES (14, 14, 0, 14, 14);
INSERT INTO "post_reaction" (postnumber, id, balance, reactor, reacted) VALUES (15, 15, 1, 15, 15);
INSERT INTO "post_reaction" (postnumber, id, balance, reactor, reacted) VALUES (16, 16, 1, 16, 16);
INSERT INTO "post_reaction" (postnumber, id, balance, reactor, reacted) VALUES (17, 17, 0, 17, 17);
INSERT INTO "post_reaction" (postnumber, id, balance, reactor, reacted) VALUES (18, 18, 1, 18, 18);
INSERT INTO "post_reaction" (postnumber, id, balance, reactor, reacted) VALUES (19, 19, 1, 19, 19);
INSERT INTO "post_reaction" (postnumber, id, balance, reactor, reacted) VALUES (20, 20, 1, 20, 20);

INSERT INTO "report" (id, time_stamp, criminal, author) VALUES (1, '21:04:52', 1, 1);
INSERT INTO "report" (id, time_stamp, criminal, author) VALUES (2, '3:49:41', 2, 2);
INSERT INTO "report" (id, time_stamp, criminal, author) VALUES (3, '12:34:51', 3, 3);
INSERT INTO "report" (id, time_stamp, criminal, author) VALUES (4, '12:25:02', 4, 4);
INSERT INTO "report" (id, time_stamp, criminal, author) VALUES (5, '18:35:36', 5, 5);
INSERT INTO "report" (id, time_stamp, criminal, author) VALUES (6, '0:44:21', 6, 6);
INSERT INTO "report" (id, time_stamp, criminal, author) VALUES (7, '9:01:58', 7, 7);
INSERT INTO "report" (id, time_stamp, criminal, author) VALUES (8, '21:38:33', 8, 8);
INSERT INTO "report" (id, time_stamp, criminal, author) VALUES (9, '4:15:15', 9, 9);
INSERT INTO "report" (id, time_stamp, criminal, author) VALUES (10, '14:54:43', 10, 10);
INSERT INTO "report" (id, time_stamp, criminal, author) VALUES (11, '6:50:21', 11, 11);
INSERT INTO "report" (id, time_stamp, criminal, author) VALUES (12, '4:00:59', 12, 12);
INSERT INTO "report" (id, time_stamp, criminal, author) VALUES (13, '14:01:28', 13, 13);
INSERT INTO "report" (id, time_stamp, criminal, author) VALUES (14, '17:35:30', 14, 14);
INSERT INTO "report" (id, time_stamp, criminal, author) VALUES (15, '22:56:21', 15, 15);
INSERT INTO "report" (id, time_stamp, criminal, author) VALUES (16, '18:53:54', 16, 16);
INSERT INTO "report" (id, time_stamp, criminal, author) VALUES (17, '0:29:02', 17, 17);
INSERT INTO "report" (id, time_stamp, criminal, author) VALUES (18, '22:27:26', 18, 18);
INSERT INTO "report" (id, time_stamp, criminal, author) VALUES (19, '13:07:22', 19, 19);
INSERT INTO "report" (id, time_stamp, criminal, author) VALUES (20, '20:29:50', 20, 20);

INSERT INTO "friendship" (id, start, user1, user2) VALUES (1, '2017/10/19', 1, 1);
INSERT INTO "friendship" (id, start, user1, user2) VALUES (2, '2017/08/03', 2, 2);
INSERT INTO "friendship" (id, start, user1, user2) VALUES (3, '2017/08/14', 3, 3);
INSERT INTO "friendship" (id, start, user1, user2) VALUES (4, '2017/07/11', 4, 4);
INSERT INTO "friendship" (id, start, user1, user2) VALUES (5, '2017/06/17', 5, 5);
INSERT INTO "friendship" (id, start, user1, user2) VALUES (6, '2017/10/23', 6, 6);
INSERT INTO "friendship" (id, start, user1, user2) VALUES (7, '2017/09/09', 7, 7);
INSERT INTO "friendship" (id, start, user1, user2) VALUES (8, '2018/03/27', 8, 8);
INSERT INTO "friendship" (id, start, user1, user2) VALUES (9, '2017/05/08', 9, 9);
INSERT INTO "friendship" (id, start, user1, user2) VALUES (10, '2018/03/09', 10, 10);
INSERT INTO "friendship" (id, start, user1, user2) VALUES (11, '2017/04/25', 11, 11);
INSERT INTO "friendship" (id, start, user1, user2) VALUES (12, '2017/05/29', 12, 12);
INSERT INTO "friendship" (id, start, user1, user2) VALUES (13, '2017/10/05', 13, 13);
INSERT INTO "friendship" (id, start, user1, user2) VALUES (14, '2017/05/03', 14, 14);
INSERT INTO "friendship" (id, start, user1, user2) VALUES (15, '2017/08/24', 15, 15);
INSERT INTO "friendship" (id, start, user1, user2) VALUES (16, '2017/05/14', 16, 16);
INSERT INTO "friendship" (id, start, user1, user2) VALUES (17, '2017/05/13', 17, 17);
INSERT INTO "friendship" (id, start, user1, user2) VALUES (18, '2017/11/21', 18, 18);
INSERT INTO "friendship" (id, start, user1, user2) VALUES (19, '2017/11/12', 19, 19);
INSERT INTO "friendship" (id, start, user1, user2) VALUES (20, '2017/10/19', 20, 20);

INSERT INTO "friend_request" (id, dateRequest, dateConfirmation, sender, receiver) VALUES (1, '2017/08/13', '2018/02/22', 1, 2);
INSERT INTO "friend_request" (id, dateRequest, dateConfirmation, sender, receiver) VALUES (2, '2017/02/26', '2017/07/08', 2, 3);
INSERT INTO "friend_request" (id, dateRequest, dateConfirmation, sender, receiver) VALUES (3, '2018/02/16', '2018/06/21', 3, 4);
INSERT INTO "friend_request" (id, dateRequest, dateConfirmation, sender, receiver) VALUES (4, '2017/01/13', '2017/11/05', 4, 5);
INSERT INTO "friend_request" (id, dateRequest, dateConfirmation, sender, receiver) VALUES (5, '2018/01/22', '2018/03/24', 5, 6);
INSERT INTO "friend_request" (id, dateRequest, dateConfirmation, sender, receiver) VALUES (6, '2017/09/18', '2018/04/03', 6, 7);
INSERT INTO "friend_request" (id, dateRequest, dateConfirmation, sender, receiver) VALUES (7, '2017/09/17', '2017/11/19', 7, 8);
INSERT INTO "friend_request" (id, dateRequest, dateConfirmation, sender, receiver) VALUES (8, '2017/03/18', '2017/06/13', 8, 9);
INSERT INTO "friend_request" (id, dateRequest, dateConfirmation, sender, receiver) VALUES (9, '2017/06/22', '2017/12/23', 9, 10);
INSERT INTO "friend_request" (id, dateRequest, dateConfirmation, sender, receiver) VALUES (10, '2017/09/29', '2017/12/29', 10, 11);
INSERT INTO "friend_request" (id, dateRequest, dateConfirmation, sender, receiver) VALUES (11, '2018/02/19', '2018/06/02', 11, 12);
INSERT INTO "friend_request" (id, dateRequest, dateConfirmation, sender, receiver) VALUES (12, '2018/01/05', '2018/05/22', 12, 13);
INSERT INTO "friend_request" (id, dateRequest, dateConfirmation, sender, receiver) VALUES (13, '2017/07/27', '2017/11/13', 13, 14);
INSERT INTO "friend_request" (id, dateRequest, dateConfirmation, sender, receiver) VALUES (14, '2017/05/23', '2017/12/10', 14, 15);
INSERT INTO "friend_request" (id, dateRequest, dateConfirmation, sender, receiver) VALUES (15, '2017/08/12', '2018/01/17', 15, 16);
INSERT INTO "friend_request" (id, dateRequest, dateConfirmation, sender, receiver) VALUES (16, '2017/04/23', '2017/12/18', 16, 17);
INSERT INTO "friend_request" (id, dateRequest, dateConfirmation, sender, receiver) VALUES (17, '2017/04/14', '2018/04/01', 17, 18);
INSERT INTO "friend_request" (id, dateRequest, dateConfirmation, sender, receiver) VALUES (18, '2017/12/09', '2017/12/13', 18, 19);
INSERT INTO "friend_request" (id, dateRequest, dateConfirmation, sender, receiver) VALUES (19, '2017/08/03', '2017/10/25', 19, 20);
INSERT INTO "friend_request" (id, dateRequest, dateConfirmation, sender, receiver) VALUES (20, '2017/01/29', '2017/04/26', 20, 1);

INSERT INTO "conversation_message" (id_sender, id_recipient, body, time_stamp, read) VALUES (1, 2, 'Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Duis faucibus accumsan odio.', '2018/03/19', 1);
INSERT INTO "conversation_message" (id_sender, id_recipient, body, time_stamp, read) VALUES (2, 3, 'Suspendisse potenti. Cras in purus eu magna vulputate luctus.', '2018/03/27', 0);
INSERT INTO "conversation_message" (id_sender, id_recipient, body, time_stamp, read) VALUES (3, 4, 'Vivamus tortor. Duis mattis egestas metus.', '2017/09/08', 0);
INSERT INTO "conversation_message" (id_sender, id_recipient, body, time_stamp, read) VALUES (4, 5, 'Morbi a ipsum. Integer a nibh.', '2017/10/11', 1);
INSERT INTO "conversation_message" (id_sender, id_recipient, body, time_stamp, read) VALUES (5, 6, 'Phasellus sit amet erat. Nulla tempus.', '2018/03/23', 0);
INSERT INTO "conversation_message" (id_sender, id_recipient, body, time_stamp, read) VALUES (6, 7, 'In hac habitasse platea dictumst.', '2018/03/25', 1);
INSERT INTO "conversation_message" (id_sender, id_recipient, body, time_stamp, read) VALUES (7, 8, 'Aliquam non mauris.', '2017/06/03', 0);
INSERT INTO "conversation_message" (id_sender, id_recipient, body, time_stamp, read) VALUES (8, 9, 'Suspendisse ornare consequat lectus. In est risus, auctor sed, tristique in, tempus sit amet, sem.', '2017/11/03', 1);
INSERT INTO "conversation_message" (id_sender, id_recipient, body, time_stamp, read) VALUES (9, 10, 'Praesent id massa id nisl venenatis lacinia. Aenean sit amet justo.', '2017/07/08', 0);
INSERT INTO "conversation_message" (id_sender, id_recipient, body, time_stamp, read) VALUES (10, 11, 'Duis aliquam convallis nunc.', '2017/03/11', 1);
INSERT INTO "conversation_message" (id_sender, id_recipient, body, time_stamp, read) VALUES (11, 12, 'Aliquam quis turpis eget elit sodales scelerisque. Mauris sit amet eros.', '2017/06/20', 1);
INSERT INTO "conversation_message" (id_sender, id_recipient, body, time_stamp, read) VALUES (12, 13, 'Suspendisse potenti.', '2017/03/22', 1);
INSERT INTO "conversation_message" (id_sender, id_recipient, body, time_stamp, read) VALUES (13, 14, 'Vestibulum quam sapien, varius ut, blandit non, interdum in, ante.', '2018/01/18', 0);
INSERT INTO "conversation_message" (id_sender, id_recipient, body, time_stamp, read) VALUES (14, 15, 'Nunc rhoncus dui vel sem. Sed sagittis.', '2017/10/30', 0);
INSERT INTO "conversation_message" (id_sender, id_recipient, body, time_stamp, read) VALUES (15, 16, 'Nulla mollis molestie lorem.', '2017/11/16', 0);
INSERT INTO "conversation_message" (id_sender, id_recipient, body, time_stamp, read) VALUES (16, 17, 'In est risus, auctor sed, tristique in, tempus sit amet, sem.', '2017/06/23', 1);
INSERT INTO "conversation_message" (id_sender, id_recipient, body, time_stamp, read) VALUES (17, 18, 'Nulla neque libero, convallis eget, eleifend luctus, ultricies eu, nibh.', '2017/12/15', 1);
INSERT INTO "conversation_message" (id_sender, id_recipient, body, time_stamp, read) VALUES (18, 19, 'Nullam orci pede, venenatis non, sodales sed, tincidunt eu, felis.', '2017/06/09', 1);
INSERT INTO "conversation_message" (id_sender, id_recipient, body, time_stamp, read) VALUES (19, 20, 'Vestibulum sed magna at nunc commodo placerat.', '2018/01/19', 1);
INSERT INTO "conversation_message" (id_sender, id_recipient, body, time_stamp, read) VALUES (20, 1, 'Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Nulla dapibus dolor vel est. Donec odio justo, sollicitudin ut, suscipit a, feugiat et, eros.', '2017/01/29', 0);

INSERT INTO "media_category" (cat_id, title) VALUES (1, 'Yellow Cab Man, The');
INSERT INTO "media_category" (cat_id, title) VALUES (2, 'Shanghai Ghetto');
INSERT INTO "media_category" (cat_id, title) VALUES (3, 'Caligula');
INSERT INTO "media_category" (cat_id, title) VALUES (4, 'Rookie, The');
INSERT INTO "media_category" (cat_id, title) VALUES (5, 'The Lego Movie');
INSERT INTO "media_category" (cat_id, title) VALUES (6, '7th Floor');
INSERT INTO "media_category" (cat_id, title) VALUES (7, 'Time Walker (a.k.a. Being From Another Planet)');
INSERT INTO "media_category" (cat_id, title) VALUES (8, 'Flipper');
INSERT INTO "media_category" (cat_id, title) VALUES (9, 'Lackawanna Blues');
INSERT INTO "media_category" (cat_id, title) VALUES (10, 'Welcome to New York');
INSERT INTO "media_category" (cat_id, title) VALUES (11, 'Merchant of Four Seasons, The (Händler der vier Jahreszeiten)');
INSERT INTO "media_category" (cat_id, title) VALUES (12, 'Winchester ''73');
INSERT INTO "media_category" (cat_id, title) VALUES (13, 'Private Romeo');
INSERT INTO "media_category" (cat_id, title) VALUES (14, 'Defender, The (a.k.a. Bodyguard from Beijing, The) (Zhong Nan Hai bao biao)');
INSERT INTO "media_category" (cat_id, title) VALUES (15, 'Song of the Thin Man');
INSERT INTO "media_category" (cat_id, title) VALUES (16, 'Väreitä');
INSERT INTO "media_category" (cat_id, title) VALUES (17, 'Coming Down the Mountain');
INSERT INTO "media_category" (cat_id, title) VALUES (18, 'Woodsman, The');
INSERT INTO "media_category" (cat_id, title) VALUES (19, 'Ordinary Decent Criminal');
INSERT INTO "media_category" (cat_id, title) VALUES (20, 'Carnosaur 2');

INSERT INTO "media_tag" (tag_id, rating, title) VALUES (1, 2.2, 'Tuareg: The Desert Warrior (Tuareg - Il guerriero del deserto)');
INSERT INTO "media_tag" (tag_id, rating, title) VALUES (2, 8.3, 'Band Wagon, The');
INSERT INTO "media_tag" (tag_id, rating, title) VALUES (3, 7.6, 'Boogie Nights');
INSERT INTO "media_tag" (tag_id, rating, title) VALUES (4, 3.6, 'Help! I''m A Fish');
INSERT INTO "media_tag" (tag_id, rating, title) VALUES (5, 6.5, 'Coney Island');
INSERT INTO "media_tag" (tag_id, rating, title) VALUES (6, 8.7, 'Illegal');
INSERT INTO "media_tag" (tag_id, rating, title) VALUES (7, 2.0, 'My Brother the Terrorist');
INSERT INTO "media_tag" (tag_id, rating, title) VALUES (8, 5.8, 'Hum Aapke Hain Koun...!');
INSERT INTO "media_tag" (tag_id, rating, title) VALUES (9, 5.7, 'Thousand Months, A (Mille mois)');
INSERT INTO "media_tag" (tag_id, rating, title) VALUES (10, 8.4, 'The Open Road');
INSERT INTO "media_tag" (tag_id, rating, title) VALUES (11, 8.8, 'Mindwalk');
INSERT INTO "media_tag" (tag_id, rating, title) VALUES (12, 3.9, 'Death Wish 2');
INSERT INTO "media_tag" (tag_id, rating, title) VALUES (13, 3.8, 'How She Move');
INSERT INTO "media_tag" (tag_id, rating, title) VALUES (14, 8.7, 'Nine Queens (Nueve reinas)');
INSERT INTO "media_tag" (tag_id, rating, title) VALUES (15, 4.3, 'Strange One, The');
INSERT INTO "media_tag" (tag_id, rating, title) VALUES (16, 4.3, 'Strings');
INSERT INTO "media_tag" (tag_id, rating, title) VALUES (17, 2.9, 'Almighty Thor');
INSERT INTO "media_tag" (tag_id, rating, title) VALUES (18, 6.8, 'Lust for Gold (Duhul aurului)');
INSERT INTO "media_tag" (tag_id, rating, title) VALUES (19, 3.0, 'Dead Men Walk');
INSERT INTO "media_tag" (tag_id, rating, title) VALUES (20, 3.7, 'Dark Floors');

INSERT INTO "member" (id_user, reports) VALUES (1, 3);
INSERT INTO "member" (id_user, reports) VALUES (2, 2);
INSERT INTO "member" (id_user, reports) VALUES (3, 0);
INSERT INTO "member" (id_user, reports) VALUES (4, 1);
INSERT INTO "member" (id_user, reports) VALUES (5, 2);
INSERT INTO "member" (id_user, reports) VALUES (6, 0);
INSERT INTO "member" (id_user, reports) VALUES (7, 0);
INSERT INTO "member" (id_user, reports) VALUES (8, 0);
INSERT INTO "member" (id_user, reports) VALUES (9, 0);
INSERT INTO "member" (id_user, reports) VALUES (10, 2);
INSERT INTO "member" (id_user, reports) VALUES (11, 1);
INSERT INTO "member" (id_user, reports) VALUES (12, 1);

INSERT INTO "moderator" (id_user) VALUES (1);
INSERT INTO "moderator" (id_user) VALUES (2);
INSERT INTO "moderator" (id_user) VALUES (3);
INSERT INTO "moderator" (id_user) VALUES (4);

INSERT INTO "admin" (id_user) VALUES (1);
INSERT INTO "admin" (id_user) VALUES (2);
INSERT INTO "admin" (id_user) VALUES (3);
INSERT INTO "admin" (id_user) VALUES (4);

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

INSERT INTO "post_category" (postnumber, cat_id) VALUES (1, 1);
INSERT INTO "post_category" (postnumber, cat_id) VALUES (2, 2);
INSERT INTO "post_category" (postnumber, cat_id) VALUES (3, 3);
INSERT INTO "post_category" (postnumber, cat_id) VALUES (4, 4);
INSERT INTO "post_category" (postnumber, cat_id) VALUES (5, 5);
INSERT INTO "post_category" (postnumber, cat_id) VALUES (6, 6);
INSERT INTO "post_category" (postnumber, cat_id) VALUES (7, 7);
INSERT INTO "post_category" (postnumber, cat_id) VALUES (8, 8);
INSERT INTO "post_category" (postnumber, cat_id) VALUES (9, 9);
INSERT INTO "post_category" (postnumber, cat_id) VALUES (10, 10);
INSERT INTO "post_category" (postnumber, cat_id) VALUES (11, 11);
INSERT INTO "post_category" (postnumber, cat_id) VALUES (12, 12);
INSERT INTO "post_category" (postnumber, cat_id) VALUES (13, 13);
INSERT INTO "post_category" (postnumber, cat_id) VALUES (14, 14);
INSERT INTO "post_category" (postnumber, cat_id) VALUES (15, 15);