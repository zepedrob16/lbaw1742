# A6: Indexes, triggers, user functions and population

## 0. Project Description (SHOWCHAN)

The goal of this project is to provide tv show and movie aficionados with daily news and updates of this media. This very system will be community-based since only registered members are allowed to both rate and comment each other's submissions, triggering healthy discussions.

## 1. Database Workload

> A study of the predicted system load (database load), organized in subsections.

### 1.1. Tuple Estimation

> Estimate of tuples at each relation.

| Relation Reference | Relation Name | Order of Magnitude | Estimated Growth |
| ------------------ | ------------- | ------------------ | ---------------- |
| R01                | user          | tens               | units per day    |
| R02                | post          | tens               | units per day    |
| R03                | post_comment  | hundreds           | dozens per day    |
| R04                | post_reaction | hundreds           | dozens per day    |
| R05                | image_post    | tens               | units per day    |
| R06                | text_post     | tens               | units per day    |
| R07                | link_post     | tens               | units per day    |
| R08                | report        | tens               | units per day    |
| R09                | friendship    | tens               | units per day
| R10                | friend_request | tens | units per day |
| R11                | conversation_message | tens | units per day |
| R12                | media_category | tens | units per day |
| R13                | media_tag     | tens | units per day |
| R14                | member        | tens | units per day |
| R15                | moderator     | tens | units per day |
| R16                | admin         | tens | units per day |
| R17                | post_tag      | tens | units per day |
| R18                | post_category | tens | units per day |
  

### 1.2. Frequent Queries

> Most important queries (SELECT) and their frequency.

| Query Reference | Query Description | Query Frequency  |
| --------------- | ----------------- | ---------------- |
| SELECT01        | User's profile    | hundreds per day |


```  SELECT username, email, firstname, lastname, email, quote, avatar FROM "user_table" WHERE "user_table".id = $userId; ``` 


| Query Reference | Query Description | Query Frequency  |
| --------------- | ----------------- | ---------------- |
| SELECT02        | Read Message     | dozens per day   |


``` SELECT body, timestamp FROM "conversation_message" WHERE "recipient".id = $recipientId; ```

| Query Reference | Query Description | Query Frequency  |
| --------------- | ----------------- | ---------------- |
| SELECT03        | Search by type    | dozens per day   |
|```SELECT ``` |

| Query Reference | Query Description | Query Frequency  |
| --------------- | ----------------- | ---------------- |
| SELECT04        | Filter by Category| hundreds per day |

```sql

```

| Query Reference | Query Description | Query Frequency  |
| --------------- | ----------------- | ---------------- |
| SELECT05        | Read comments     | hundreds per day |

```sql

```

| Query Reference | Query Description | Query Frequency  |
| --------------- | ----------------- | ---------------- |
| SELECT06        | Read Post Content | hundreds per day |

```sql

```

| Query Reference | Query Description | Query Frequency  |
| --------------- | ----------------- | ---------------- |
| SELECT07        | Check Post Rank   | dozens per day |

```sql

```

| Query Reference | Query Description | Query Frequency  |
| --------------- | ----------------- | ---------------- |
| SELECT08        | Check statistics  | units per day    |

```sql

```

### 1.3. Frequent Updates

> Most important updates (INSERT, UPDATE, DELETE) and their frequency.

| Query Reference | Query Description       | Query Frequency  |
| --------------- | ----------------------- | ---------------- |
| UPDATE01        | Update user information | hundreds per day |

```sql

```

## 2. Proposed Indexes

### 2.1. Performance Indexes

> Indices proposed to improve performance of the identified queries.

| Index Reference | Related Queries | Index Relation | Index Attribute | Index Type | Cardinality | Clustering |
| --------------- | --------------- | -------------- | --------------- | ---------- | ----------- | ---------- |
| IDX01           | SELECT01        | user           | email           | Hash       | High        | No         |

**Justification**: Query SELECT01 has to be fast as it is executed many times; doesn't need range query support; cardinality is high because email is an unique key; it's not a good candidate for clustering.

```sql

```

### 2.2. Full-text Search Indexes

> The system being developed must provide full-text search features supported by PostgreSQL. Thus, it is necessary to specify the fields where full-text search will be available and the associated setup, namely all necessary configurations, indexes definitions and other relevant details.

| Index Reference | Related Queries | Index Relation | Index Attribute | Index Type | Cardinality | Clustering |
| --------------- | --------------- | -------------- | --------------- | ---------- | ----------- | ---------- |
| IDX01           | SELECT01        | user           | email           | Hash       | High        | No         |

**Justification**: Query SELECT01 has to be fast as it is executed many times; doesn't need range query support; cardinality is high because email is an unique key; it's not a good candidate for clustering.

```sql

```

## 3. Triggers

> User-defined functions and trigger procedures that add control structures to the SQL language or perform complex computations, are identified and described to be trusted by the database server. Every kind of function (SQL functions, Stored procedures, Trigger procedures) can take base types, composite types, or combinations of these as arguments (parameters). In addition, every kind of function can return a base type or a composite type. Functions can also be defined to return sets of base or composite values.

| Trigger Reference | Trigger Description                                     |
| ----------------- | ------------------------------------------------------- |
| TRIGGER01         | An item can only be loaned to one user in every moment. |

## 4. Complete SQL Code

> The database script must also include the SQL to populate a database with test data with an amount of tuples suitable for testing and with plausible values for the fields of the database. This code should also be included in the group's github repository as an SQL script, and a link include here.

```
INSERT INTO "user_table" (id, username, password, firstname, lastname, email, datebirth, nationality, quote, avatar, upvotes, downvotes, balance) VALUES (1, 'bcurless0', 'HmeeUgMD7', 'Inès', 'Curless', 'lcurless0@google.com', '09/01/2002', 'Kazakhstan', 'Vivamus metus arcu, adipiscing molestie, hendrerit at, vulputate vitae, nisl. Aenean lectus. Pellentesque eget nunc. Donec quis orci eget orci vehicula condimentum.', 'http://dummyimage.com/237x147.png/ff4444/ffffff', 32, 62, 44);
INSERT INTO "user_table" (id, username, password, firstname, lastname, email, datebirth, nationality, quote, avatar, upvotes, downvotes, balance) VALUES (2, 'cnolleth1', 'b6eeebM', 'Léandre', 'Nolleth', 'cnolleth1@illinois.edu', '05/05/1977', 'Brazil', 'Cras in purus eu magna vulputate luctus. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Vivamus vestibulum sagittis sapien.', 'http://dummyimage.com/190x240.png/cc0000/ffffff', 86, 1, 97);
INSERT INTO "user_table" (id, username, password, firstname, lastname, email, datebirth, nationality, quote, avatar, upvotes, downvotes, balance) VALUES (3, 'rdennehy2', '2ivVAD', 'Bérengère', 'Dennehy', 'ldennehy2@census.gov', '11/08/1979', 'Indonesia', 'Suspendisse potenti.', 'http://dummyimage.com/146x239.bmp/ff4444/ffffff', 82, 74, 7);
INSERT INTO "user_table" (id, username, password, firstname, lastname, email, datebirth, nationality, quote, avatar, upvotes, downvotes, balance) VALUES (4, 'jhruska3', 'tQBf6E6zN', 'Wá', 'Hruska', 'khruska3@jalbum.net', '06/09/1987', 'Indonesia', 'Nulla justo. Aliquam quis turpis eget elit sodales scelerisque.', 'http://dummyimage.com/144x156.bmp/cc0000/ffffff', 71, 42, 69);
INSERT INTO "user_table" (id, username, password, firstname, lastname, email, datebirth, nationality, quote, avatar, upvotes, downvotes, balance) VALUES (5, 'chumburton4', 'F3JPPx', 'Léone', 'Humburton', 'ehumburton4@utexas.edu', '24/03/1972', 'Egypt', 'Nullam orci pede, venenatis non, sodales sed, tincidunt eu, felis. Fusce posuere felis sed lacus. Morbi sem mauris, laoreet ut, rhoncus aliquet, pulvinar sed, nisl.', 'http://dummyimage.com/213x147.png/dddddd/000000', 58, 32, 88);
INSERT INTO "user_table" (id, username, password, firstname, lastname, email, datebirth, nationality, quote, avatar, upvotes, downvotes, balance) VALUES (6, 'hcharker5', 'iwXcscQaQ', 'Irène', 'Charker', 'rcharker5@vistaprint.com', '30/10/1970', 'China', 'Cras non velit nec nisi vulputate nonummy. Maecenas tincidunt lacus at velit.', 'http://dummyimage.com/137x132.jpg/cc0000/ffffff', 61, 94, 92);
INSERT INTO "user_table" (id, username, password, firstname, lastname, email, datebirth, nationality, quote, avatar, upvotes, downvotes, balance) VALUES (7, 'srubinowitsch6', 'dVeDO9FuzEh', 'Marie-hélène', 'Rubinowitsch', 'crubinowitsch6@usgs.gov', '15/03/1999', 'Indonesia', 'Vivamus in felis eu sapien cursus vestibulum. Proin eu mi.', 'http://dummyimage.com/146x207.jpg/5fa2dd/ffffff', 15, 15, 83);
INSERT INTO "user_table" (id, username, password, firstname, lastname, email, datebirth, nationality, quote, avatar, upvotes, downvotes, balance) VALUES (8, 'ndenziloe7', 'Ih4CjNyGaJ', 'Eugénie', 'Denziloe', 'jdenziloe7@gravatar.com', '21/11/1960', 'Sweden', 'Suspendisse accumsan tortor quis turpis. Sed ante. Vivamus tortor. Duis mattis egestas metus. Aenean fermentum.', 'http://dummyimage.com/219x104.jpg/5fa2dd/ffffff', 72, 44, 93);
INSERT INTO "user_table" (id, username, password, firstname, lastname, email, datebirth, nationality, quote, avatar, upvotes, downvotes, balance) VALUES (9, 'epaulich8', 'PgR0Yb', 'Crééz', 'Paulich', 'lpaulich8@youtu.be', '19/10/1982', 'Greece', 'Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae.', 'http://dummyimage.com/160x115.bmp/dddddd/000000', 7, 78, 63);
INSERT INTO "user_table" (id, username, password, firstname, lastname, email, datebirth, nationality, quote, avatar, upvotes, downvotes, balance) VALUES (10, 'sgriss9', 'rz64uv4rxUa', 'Céline', 'Griss', 'dgriss9@samsung.com', '19/03/1957', 'Philippines', 'Ut tellus. Nulla ut erat id mauris vulputate elementum. Nullam varius. Nulla facilisi. Cras non velit nec nisi vulputate nonummy.', 'http://dummyimage.com/215x165.bmp/5fa2dd/ffffff', 20, 70, 100);
INSERT INTO "user_table" (id, username, password, firstname, lastname, email, datebirth, nationality, quote, avatar, upvotes, downvotes, balance) VALUES (11, 'bbeelbya', 'wDhFYVIZUCs', 'Loïca', 'Beelby', 'hbeelbya@ning.com', '27/06/1978', 'China', 'Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae.', 'http://dummyimage.com/218x108.png/cc0000/ffffff', 91, 52, 77);
INSERT INTO "user_table" (id, username, password, firstname, lastname, email, datebirth, nationality, quote, avatar, upvotes, downvotes, balance) VALUES (12, 'kstearleyb', 'LweWxKJOE4', 'Véronique', 'Stearley', 'istearleyb@flickr.com', '13/04/1985', 'Poland', 'Quisque id justo sit amet sapien dignissim vestibulum.', 'http://dummyimage.com/192x173.png/5fa2dd/ffffff', 83, 14, 30);
INSERT INTO "user_table" (id, username, password, firstname, lastname, email, datebirth, nationality, quote, avatar, upvotes, downvotes, balance) VALUES (13, 'dmedinac', 'taVz0yB', 'Célia', 'Medina', 'dmedinac@shop-pro.jp', '15/03/1972', 'Mexico', 'Proin interdum mauris non ligula pellentesque ultrices.', 'http://dummyimage.com/241x199.bmp/5fa2dd/ffffff', 15, 48, 38);
INSERT INTO "user_table" (id, username, password, firstname, lastname, email, datebirth, nationality, quote, avatar, upvotes, downvotes, balance) VALUES (14, 'xscoldingd', 'zNEG3Z', 'Eléa', 'Scolding', 'tscoldingd@cnbc.com', '15/02/1973', 'China', 'Nulla facilisi.', 'http://dummyimage.com/231x107.jpg/cc0000/ffffff', 23, 89, 83);
INSERT INTO "user_table" (id, username, password, firstname, lastname, email, datebirth, nationality, quote, avatar, upvotes, downvotes, balance) VALUES (15, 'teymore', 'sCgaLBfywPCo', 'Marie-ève', 'Eymor', 'leymore@digg.com', '17/03/1956', 'France', 'Donec quis orci eget orci vehicula condimentum.', 'http://dummyimage.com/227x105.jpg/5fa2dd/ffffff', 69, 89, 48);
INSERT INTO "user_table" (id, username, password, firstname, lastname, email, datebirth, nationality, quote, avatar, upvotes, downvotes, balance) VALUES (16, 'rarkleyf', 'K6dvVSZpUU4B', 'Maëlla', 'Arkley', 'jarkleyf@phpbb.com', '26/07/1952', 'Japan', 'Cras pellentesque volutpat dui. Maecenas tristique, est et tempus semper.', 'http://dummyimage.com/139x147.png/cc0000/ffffff', 83, 36, 79);
INSERT INTO "user_table" (id, username, password, firstname, lastname, email, datebirth, nationality, quote, avatar, upvotes, downvotes, balance) VALUES (17, 'flocksg', 'khHA8lGtL', 'Pò', 'Locks', 'mlocksg@sciencedaily.com', '23/11/1952', 'Czech Republic', 'Maecenas tincidunt lacus at velit. Vivamus vel nulla eget eros elementum pellentesque.', 'http://dummyimage.com/197x140.bmp/5fa2dd/ffffff', 71, 31, 72);
INSERT INTO "user_table" (id, username, password, firstname, lastname, email, datebirth, nationality, quote, avatar, upvotes, downvotes, balance) VALUES (18, 'jharrollh', 'GQGfKMN', 'Gaïa', 'Harroll', 'bharrollh@tuttocitta.it', '21/04/1952', 'Sweden', 'Morbi vestibulum, velit id pretium iaculis, diam erat fermentum justo, nec condimentum neque sapien placerat ante.', 'http://dummyimage.com/209x180.png/dddddd/000000', 49, 22, 21);
INSERT INTO "user_table" (id, username, password, firstname, lastname, email, datebirth, nationality, quote, avatar, upvotes, downvotes, balance) VALUES (19, 'jyakunkini', 'ofwomKa7vUM', 'Marie-françoise', 'Yakunkin', 'byakunkini@mashable.com', '30/03/1996', 'Syria', 'Praesent blandit lacinia erat.', 'http://dummyimage.com/206x103.bmp/ff4444/ffffff', 55, 72, 88);
INSERT INTO "user_table" (id, username, password, firstname, lastname, email, datebirth, nationality, quote, avatar, upvotes, downvotes, balance) VALUES (20, 'cpidgeleyj', 'fQC51NA429Dx', 'Zoé', 'Pidgeley', 'mpidgeleyj@goo.gl', '19/07/1992', 'Kazakhstan', 'In eleifend quam a odio. In hac habitasse platea dictumst. Maecenas ut massa quis augue luctus tincidunt.', 'http://dummyimage.com/125x176.jpg/dddddd/000000', 49, 62, 69);


INSERT INTO "post" (postnumber, author, title, timestamp, upvotes, downvotes, balance) VALUES (1, 'jboss0', 'Charlotte''s Web', '20:00:01', 73, 89, 49);
INSERT INTO "post" (postnumber, author, title, timestamp, upvotes, downvotes, balance) VALUES (2, 'bmarusic1', 'Such Good Friends', '5:28:29', 93, 43, 90);
INSERT INTO "post" (postnumber, author, title, timestamp, upvotes, downvotes, balance) VALUES (3, 'jterrett2', 'Vertical Ray of the Sun, The (Mua he chieu thang dung)', '20:41:01', 90, 100, 62);
INSERT INTO "post" (postnumber, author, title, timestamp, upvotes, downvotes, balance) VALUES (4, 'gaffuso3', 'Love Crazy', '5:53:23', 89, 12, 38);
INSERT INTO "post" (postnumber, author, title, timestamp, upvotes, downvotes, balance) VALUES (5, 'akeesman4', 'Charlie Brown''s Christmas Tales', '0:43:01', 5, 96, 41);
INSERT INTO "post" (postnumber, author, title, timestamp, upvotes, downvotes, balance) VALUES (6, 'tanstis5', 'With Fire and Sword (Ogniem i mieczem)', '20:22:55', 48, 75, 98);
INSERT INTO "post" (postnumber, author, title, timestamp, upvotes, downvotes, balance) VALUES (7, 'ksiberry6', 'Falling Up', '11:24:34', 51, 33, 42);
INSERT INTO "post" (postnumber, author, title, timestamp, upvotes, downvotes, balance) VALUES (8, 'anardoni7', 'Stalag 17', '5:27:52', 36, 93, 73);
INSERT INTO "post" (postnumber, author, title, timestamp, upvotes, downvotes, balance) VALUES (9, 'sverdon8', 'Rockaway', '16:23:13', 46, 68, 11);
INSERT INTO "post" (postnumber, author, title, timestamp, upvotes, downvotes, balance) VALUES (10, 'kanderl9', 'Neds', '9:43:56', 51, 76, 41);
INSERT INTO "post" (postnumber, author, title, timestamp, upvotes, downvotes, balance) VALUES (11, 'cyatesa', 'Adios Sabata', '2:47:50', 56, 94, 99);
INSERT INTO "post" (postnumber, author, title, timestamp, upvotes, downvotes, balance) VALUES (12, 'mpauligb', 'City Slickers II: The Legend of Curly''s Gold', '18:20:07', 7, 42, 99);
INSERT INTO "post" (postnumber, author, title, timestamp, upvotes, downvotes, balance) VALUES (13, 'jhaldenbyc', 'We Are The Night (Wir sind die Nacht)', '2:33:18', 29, 85, 4);
INSERT INTO "post" (postnumber, author, title, timestamp, upvotes, downvotes, balance) VALUES (14, 'xtwiddelld', 'Kon-Tiki', '0:32:08', 45, 50, 29);
INSERT INTO "post" (postnumber, author, title, timestamp, upvotes, downvotes, balance) VALUES (15, 'rlagene', 'Last Taboo, The', '15:41:11', 37, 19, 40);
INSERT INTO "post" (postnumber, author, title, timestamp, upvotes, downvotes, balance) VALUES (16, 'awollacottf', 'Gloria', '4:48:17', 6, 33, 43);
INSERT INTO "post" (postnumber, author, title, timestamp, upvotes, downvotes, balance) VALUES (17, 'gseldong', 'Eye of God', '7:00:41', 52, 21, 59);
INSERT INTO "post" (postnumber, author, title, timestamp, upvotes, downvotes, balance) VALUES (18, 'wdefriesh', 'Casino Jack', '10:24:29', 51, 37, 6);
INSERT INTO "post" (postnumber, author, title, timestamp, upvotes, downvotes, balance) VALUES (19, 'rrodgei', 'Nanny Diaries, The', '12:10:30', 46, 94, 53);
INSERT INTO "post" (postnumber, author, title, timestamp, upvotes, downvotes, balance) VALUES (20, 'whandj', 'School of Flesh, The (École de la chair, L'')', '16:29:29', 52, 57, 67);

INSERT INTO "image_post" (id_post, image, source) VALUES (1, 'http://dummyimage.com/186x117.jpg/dddddd/000000', 'http://blogger.com/phasellus/in.js');
INSERT INTO "image_post" (id_post, image, source) VALUES (2, 'http://dummyimage.com/191x139.png/5fa2dd/ffffff', 'http://amazon.com/pede/ac.jsp');
INSERT INTO "image_post" (id_post, image, source) VALUES (3, 'http://dummyimage.com/187x113.jpg/cc0000/ffffff', 'https://ebay.co.uk/parturient/montes/nascetur.jsp');
INSERT INTO "image_post" (id_post, image, source) VALUES (4, 'http://dummyimage.com/103x218.jpg/ff4444/ffffff', 'http://businessinsider.com/mi.js');
INSERT INTO "image_post" (id_post, image, source) VALUES (5, 'http://dummyimage.com/125x149.png/5fa2dd/ffffff', 'http://canalblog.com/pretium/iaculis/justo/in/hac.xml');

INSERT INTO "link_post" (id_post, url) VALUES (1, 'https://mac.com/congue/elementum.js');
INSERT INTO "link_post" (id_post, url) VALUES (2, 'https://opensource.org/potenti/nullam.aspx');
INSERT INTO "link_post" (id_post, url) VALUES (3, 'http://ucoz.com/dolor/sit/amet/consectetuer/adipiscing.png');
INSERT INTO "link_post" (id_post, url) VALUES (4, 'https://mit.edu/ut/rhoncus/aliquet/pulvinar/sed/nisl.png');
INSERT INTO "link_post" (id_post, url) VALUES (5, 'https://epa.gov/etiam/vel/augue/vestibulum.aspx');

INSERT INTO "text_post" (id_post, opinion, source) VALUES (1, 'Integer ac neque.', 'https://hhs.gov/pretium/nisl/ut/volutpat/sapien/arcu/sed.png');
INSERT INTO "text_post" (id_post, opinion, source) VALUES (2, 'Morbi non quam nec dui luctus rutrum.', 'http://google.nl/aenean/lectus.jpg');
INSERT INTO "text_post" (id_post, opinion, source) VALUES (3, 'Nam ultrices, libero non mattis pulvinar, nulla pede ullamcorper augue, a suscipit nulla elit ac nulla. Sed vel enim sit amet nunc viverra dapibus.', 'https://hibu.com/mauris/sit/amet/eros/suspendisse.xml');
INSERT INTO "text_post" (id_post, opinion, source) VALUES (4, 'Nulla suscipit ligula in lacus.', 'https://google.com/neque/aenean/auctor/gravida/sem/praesent/id.js');
INSERT INTO "text_post" (id_post, opinion, source) VALUES (5, 'Praesent id massa id nisl venenatis lacinia.', 'https://surveymonkey.com/mauris/lacinia/sapien/quis.js');


INSERT INTO "post_comment" (id, id_post, id_user, body, timestamp) VALUES (1, 1, 'earmsden0', 'Donec ut mauris eget massa tempor convallis. Nulla neque libero, convallis eget, eleifend luctus, ultricies eu, nibh.', '18:45:06');
INSERT INTO "post_comment" (id, id_post, id_user, body, timestamp) VALUES (2, 2, 'bpash1', 'Sed vel enim sit amet nunc viverra dapibus.', '2:01:48');
INSERT INTO "post_comment" (id, id_post, id_user, body, timestamp) VALUES (3, 3, 'cpridie2', 'Sed sagittis.', '23:36:05');
INSERT INTO "post_comment" (id, id_post, id_user, body, timestamp) VALUES (4, 4, 'mdanielot3', 'Fusce posuere felis sed lacus.', '8:47:45');
INSERT INTO "post_comment" (id, id_post, id_user, body, timestamp) VALUES (5, 5, 'hgentzsch4', 'Donec odio justo, sollicitudin ut, suscipit a, feugiat et, eros. Vestibulum ac est lacinia nisi venenatis tristique.', '22:10:55');
INSERT INTO "post_comment" (id, id_post, id_user, body, timestamp) VALUES (1, 1, 'cwogan0', 'Maecenas tristique, est et tempus semper, est quam pharetra magna, ac consequat metus sapien ut nunc.', '15:02:59');
INSERT INTO "post_comment" (id, id_post, id_user, body, timestamp) VALUES (2, 2, 'cdenisot1', 'Mauris enim leo, rhoncus sed, vestibulum sit amet, cursus id, turpis. Integer aliquet, massa id lobortis convallis, tortor risus dapibus augue, vel accumsan tellus nisi eu orci.', '23:15:52');
INSERT INTO "post_comment" (id, id_post, id_user, body, timestamp) VALUES (3, 3, 'bkenwright2', 'Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Etiam vel augue.', '18:43:04');
INSERT INTO "post_comment" (id, id_post, id_user, body, timestamp) VALUES (4, 4, 'jspilling3', 'Maecenas rhoncus aliquam lacus. Morbi quis tortor id nulla ultrices aliquet.', '18:48:00');
INSERT INTO "post_comment" (id, id_post, id_user, body, timestamp) VALUES (5, 5, 'myerrington4', 'Donec quis orci eget orci vehicula condimentum. Curabitur in libero ut massa volutpat convallis.', '19:40:29');
INSERT INTO "post_comment" (id, id_post, id_user, body, timestamp) VALUES (6, 6, 'seykel5', 'Praesent lectus. Vestibulum quam sapien, varius ut, blandit non, interdum in, ante.', '22:10:37');
INSERT INTO "post_comment" (id, id_post, id_user, body, timestamp) VALUES (7, 7, 'dluxford6', 'Maecenas leo odio, condimentum id, luctus nec, molestie sed, justo.', '21:23:05');
INSERT INTO "post_comment" (id, id_post, id_user, body, timestamp) VALUES (8, 8, 'tpetrusch7', 'Quisque ut erat. Curabitur gravida nisi at nibh.', '6:23:32');
INSERT INTO "post_comment" (id, id_post, id_user, body, timestamp) VALUES (9, 9, 'abelden8', 'Praesent blandit lacinia erat. Vestibulum sed magna at nunc commodo placerat.', '8:37:24');
INSERT INTO "post_comment" (id, id_post, id_user, body, timestamp) VALUES (10, 10, 'usavidge9', 'In hac habitasse platea dictumst.', '20:36:36');
INSERT INTO "post_comment" (id, id_post, id_user, body, timestamp) VALUES (11, 11, 'spettingalla', 'Vivamus tortor.', '14:35:25');
INSERT INTO "post_comment" (id, id_post, id_user, body, timestamp) VALUES (12, 12, 'lbartleb', 'Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Nulla dapibus dolor vel est.', '6:48:10');
INSERT INTO "post_comment" (id, id_post, id_user, body, timestamp) VALUES (13, 13, 'tpattinic', 'Vestibulum ac est lacinia nisi venenatis tristique. Fusce congue, diam id ornare imperdiet, sapien urna pretium nisl, ut volutpat sapien arcu sed augue.', '2:22:20');
INSERT INTO "post_comment" (id, id_post, id_user, body, timestamp) VALUES (14, 14, 'jjoistd', 'Nulla justo.', '0:51:25');
INSERT INTO "post_comment" (id, id_post, id_user, body, timestamp) VALUES (15, 15, 'eclampe', 'Praesent blandit lacinia erat. Vestibulum sed magna at nunc commodo placerat.', '0:53:05');

INSERT INTO "post_reaction" (post_reaction, id, balance) VALUES (1, 1, 89);
INSERT INTO "post_reaction" (post_reaction, id, balance) VALUES (2, 2, 45);
INSERT INTO "post_reaction" (post_reaction, id, balance) VALUES (3, 3, 97);
INSERT INTO "post_reaction" (post_reaction, id, balance) VALUES (4, 4, 57);
INSERT INTO "post_reaction" (post_reaction, id, balance) VALUES (5, 5, 58);
INSERT INTO "post_reaction" (post_reaction, id, balance) VALUES (6, 6, 8);
INSERT INTO "post_reaction" (post_reaction, id, balance) VALUES (7, 7, 63);
INSERT INTO "post_reaction" (post_reaction, id, balance) VALUES (8, 8, 68);
INSERT INTO "post_reaction" (post_reaction, id, balance) VALUES (9, 9, 89);
INSERT INTO "post_reaction" (post_reaction, id, balance) VALUES (10, 10, 66);
INSERT INTO "post_reaction" (post_reaction, id, balance) VALUES (11, 11, 69);
INSERT INTO "post_reaction" (post_reaction, id, balance) VALUES (12, 12, 39);
INSERT INTO "post_reaction" (post_reaction, id, balance) VALUES (13, 13, 65);
INSERT INTO "post_reaction" (post_reaction, id, balance) VALUES (14, 14, 45);
INSERT INTO "post_reaction" (post_reaction, id, balance) VALUES (15, 15, 1);
INSERT INTO "post_reaction" (post_reaction, id, balance) VALUES (16, 16, 68);
INSERT INTO "post_reaction" (post_reaction, id, balance) VALUES (17, 17, 4);
INSERT INTO "post_reaction" (post_reaction, id, balance) VALUES (18, 18, 7);
INSERT INTO "post_reaction" (post_reaction, id, balance) VALUES (19, 19, 24);
INSERT INTO "post_reaction" (post_reaction, id, balance) VALUES (20, 20, 88);

INSERT INTO "report" (id, timestamp, criminal, author) VALUES (1, '21:04:52', 1, 1);
INSERT INTO "report" (id, timestamp, criminal, author) VALUES (2, '3:49:41', 2, 2);
INSERT INTO "report" (id, timestamp, criminal, author) VALUES (3, '12:34:51', 3, 3);
INSERT INTO "report" (id, timestamp, criminal, author) VALUES (4, '12:25:02', 4, 4);
INSERT INTO "report" (id, timestamp, criminal, author) VALUES (5, '18:35:36', 5, 5);
INSERT INTO "report" (id, timestamp, criminal, author) VALUES (6, '0:44:21', 6, 6);
INSERT INTO "report" (id, timestamp, criminal, author) VALUES (7, '9:01:58', 7, 7);
INSERT INTO "report" (id, timestamp, criminal, author) VALUES (8, '21:38:33', 8, 8);
INSERT INTO "report" (id, timestamp, criminal, author) VALUES (9, '4:15:15', 9, 9);
INSERT INTO "report" (id, timestamp, criminal, author) VALUES (10, '14:54:43', 10, 10);
INSERT INTO "report" (id, timestamp, criminal, author) VALUES (11, '6:50:21', 11, 11);
INSERT INTO "report" (id, timestamp, criminal, author) VALUES (12, '4:00:59', 12, 12);
INSERT INTO "report" (id, timestamp, criminal, author) VALUES (13, '14:01:28', 13, 13);
INSERT INTO "report" (id, timestamp, criminal, author) VALUES (14, '17:35:30', 14, 14);
INSERT INTO "report" (id, timestamp, criminal, author) VALUES (15, '22:56:21', 15, 15);
INSERT INTO "report" (id, timestamp, criminal, author) VALUES (16, '18:53:54', 16, 16);
INSERT INTO "report" (id, timestamp, criminal, author) VALUES (17, '0:29:02', 17, 17);
INSERT INTO "report" (id, timestamp, criminal, author) VALUES (18, '22:27:26', 18, 18);
INSERT INTO "report" (id, timestamp, criminal, author) VALUES (19, '13:07:22', 19, 19);
INSERT INTO "report" (id, timestamp, criminal, author) VALUES (20, '20:29:50', 20, 20);

INSERT INTO "friendship" (id, start, user1, user2) VALUES (1, '19/10/2017', 1, 1);
INSERT INTO "friendship" (id, start, user1, user2) VALUES (2, '03/08/2017', 2, 2);
INSERT INTO "friendship" (id, start, user1, user2) VALUES (3, '14/08/2017', 3, 3);
INSERT INTO "friendship" (id, start, user1, user2) VALUES (4, '21/07/2017', 4, 4);
INSERT INTO "friendship" (id, start, user1, user2) VALUES (5, '17/06/2017', 5, 5);
INSERT INTO "friendship" (id, start, user1, user2) VALUES (6, '23/10/2017', 6, 6);
INSERT INTO "friendship" (id, start, user1, user2) VALUES (7, '09/09/2017', 7, 7);
INSERT INTO "friendship" (id, start, user1, user2) VALUES (8, '27/03/2018', 8, 8);
INSERT INTO "friendship" (id, start, user1, user2) VALUES (9, '08/05/2017', 9, 9);
INSERT INTO "friendship" (id, start, user1, user2) VALUES (10, '09/03/2018', 10, 10);
INSERT INTO "friendship" (id, start, user1, user2) VALUES (11, '25/04/2017', 11, 11);
INSERT INTO "friendship" (id, start, user1, user2) VALUES (12, '29/05/2017', 12, 12);
INSERT INTO "friendship" (id, start, user1, user2) VALUES (13, '05/10/2017', 13, 13);
INSERT INTO "friendship" (id, start, user1, user2) VALUES (14, '03/05/2017', 14, 14);
INSERT INTO "friendship" (id, start, user1, user2) VALUES (15, '24/08/2017', 15, 15);
INSERT INTO "friendship" (id, start, user1, user2) VALUES (16, '17/05/2017', 16, 16);
INSERT INTO "friendship" (id, start, user1, user2) VALUES (17, '13/05/2017', 17, 17);
INSERT INTO "friendship" (id, start, user1, user2) VALUES (18, '21/11/2017', 18, 18);
INSERT INTO "friendship" (id, start, user1, user2) VALUES (19, '12/11/2017', 19, 19);
INSERT INTO "friendship" (id, start, user1, user2) VALUES (20, '19/10/2017', 20, 20);

INSERT INTO "friend_request" (id, date_request, date_confirmation, sender, receiver) VALUES (1, '13/08/2017', '22/02/2018', 1, 1);
INSERT INTO "friend_request" (id, date_request, date_confirmation, sender, receiver) VALUES (2, '26/09/2017', '08/07/2017', 2, 2);
INSERT INTO "friend_request" (id, date_request, date_confirmation, sender, receiver) VALUES (3, '16/02/2018', '21/06/2017', 3, 3);
INSERT INTO "friend_request" (id, date_request, date_confirmation, sender, receiver) VALUES (4, '13/01/2018', '05/11/2017', 4, 4);
INSERT INTO "friend_request" (id, date_request, date_confirmation, sender, receiver) VALUES (5, '22/01/2018', '24/03/2018', 5, 5);
INSERT INTO "friend_request" (id, date_request, date_confirmation, sender, receiver) VALUES (6, '18/09/2017', '03/04/2017', 6, 6);
INSERT INTO "friend_request" (id, date_request, date_confirmation, sender, receiver) VALUES (7, '17/09/2017', '20/11/2017', 7, 7);
INSERT INTO "friend_request" (id, date_request, date_confirmation, sender, receiver) VALUES (8, '18/03/2018', '13/06/2017', 8, 8);
INSERT INTO "friend_request" (id, date_request, date_confirmation, sender, receiver) VALUES (9, '22/06/2017', '23/12/2017', 9, 9);
INSERT INTO "friend_request" (id, date_request, date_confirmation, sender, receiver) VALUES (10, '29/09/2017', '29/12/2017', 10, 10);
INSERT INTO "friend_request" (id, date_request, date_confirmation, sender, receiver) VALUES (11, '09/02/2018', '02/06/2017', 11, 11);
INSERT INTO "friend_request" (id, date_request, date_confirmation, sender, receiver) VALUES (12, '05/01/2018', '22/05/2017', 12, 12);
INSERT INTO "friend_request" (id, date_request, date_confirmation, sender, receiver) VALUES (13, '27/07/2017', '05/11/2017', 13, 13);
INSERT INTO "friend_request" (id, date_request, date_confirmation, sender, receiver) VALUES (14, '23/05/2017', '14/12/2017', 14, 14);
INSERT INTO "friend_request" (id, date_request, date_confirmation, sender, receiver) VALUES (15, '12/08/2017', '18/01/2018', 15, 15);
INSERT INTO "friend_request" (id, date_request, date_confirmation, sender, receiver) VALUES (16, '23/04/2017', '18/12/2017', 16, 16);
INSERT INTO "friend_request" (id, date_request, date_confirmation, sender, receiver) VALUES (17, '15/04/2017', '01/04/2018', 17, 17);
INSERT INTO "friend_request" (id, date_request, date_confirmation, sender, receiver) VALUES (18, '09/12/2017', '13/12/2017', 18, 18);
INSERT INTO "friend_request" (id, date_request, date_confirmation, sender, receiver) VALUES (19, '03/08/2017', '25/10/2017', 19, 19);
INSERT INTO "friend_request" (id, date_request, date_confirmation, sender, receiver) VALUES (20, '29/01/2018', '26/04/2017', 20, 20);

INSERT INTO "conversation_message" (id_sender, id_recipient, body, timestamp, read) VALUES (1, 1, 'Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Duis faucibus accumsan odio.', '19/03/2018', true);
INSERT INTO "conversation_message" (id_sender, id_recipient, body, timestamp, read) VALUES (2, 2, 'Suspendisse potenti. Cras in purus eu magna vulputate luctus.', '27/03/2018', false);
INSERT INTO "conversation_message" (id_sender, id_recipient, body, timestamp, read) VALUES (3, 3, 'Vivamus tortor. Duis mattis egestas metus.', '08/09/2017', false);
INSERT INTO "conversation_message" (id_sender, id_recipient, body, timestamp, read) VALUES (4, 4, 'Morbi a ipsum. Integer a nibh.', '11/10/2017', true);
INSERT INTO "conversation_message" (id_sender, id_recipient, body, timestamp, read) VALUES (5, 5, 'Phasellus sit amet erat. Nulla tempus.', '23/03/2018', false);
INSERT INTO "conversation_message" (id_sender, id_recipient, body, timestamp, read) VALUES (6, 6, 'In hac habitasse platea dictumst.', '25/03/2018', true);
INSERT INTO "conversation_message" (id_sender, id_recipient, body, timestamp, read) VALUES (7, 7, 'Aliquam non mauris.', '03/06/2017', false);
INSERT INTO "conversation_message" (id_sender, id_recipient, body, timestamp, read) VALUES (8, 8, 'Suspendisse ornare consequat lectus. In est risus, auctor sed, tristique in, tempus sit amet, sem.', '03/11/2017', true);
INSERT INTO "conversation_message" (id_sender, id_recipient, body, timestamp, read) VALUES (9, 9, 'Praesent id massa id nisl venenatis lacinia. Aenean sit amet justo.', '08/07/2017', false);
INSERT INTO "conversation_message" (id_sender, id_recipient, body, timestamp, read) VALUES (10, 10, 'Duis aliquam convallis nunc.', '11/03/2018', true);
INSERT INTO "conversation_message" (id_sender, id_recipient, body, timestamp, read) VALUES (11, 11, 'Aliquam quis turpis eget elit sodales scelerisque. Mauris sit amet eros.', '20/06/2017', true);
INSERT INTO "conversation_message" (id_sender, id_recipient, body, timestamp, read) VALUES (12, 12, 'Suspendisse potenti.', '22/03/2018', true);
INSERT INTO "conversation_message" (id_sender, id_recipient, body, timestamp, read) VALUES (13, 13, 'Vestibulum quam sapien, varius ut, blandit non, interdum in, ante.', '18/01/2018', false);
INSERT INTO "conversation_message" (id_sender, id_recipient, body, timestamp, read) VALUES (14, 14, 'Nunc rhoncus dui vel sem. Sed sagittis.', '30/10/2017', false);
INSERT INTO "conversation_message" (id_sender, id_recipient, body, timestamp, read) VALUES (15, 15, 'Nulla mollis molestie lorem.', '16/11/2017', false);
INSERT INTO "conversation_message" (id_sender, id_recipient, body, timestamp, read) VALUES (16, 16, 'In est risus, auctor sed, tristique in, tempus sit amet, sem.', '23/06/2017', true);
INSERT INTO "conversation_message" (id_sender, id_recipient, body, timestamp, read) VALUES (17, 17, 'Nulla neque libero, convallis eget, eleifend luctus, ultricies eu, nibh.', '15/12/2017', true);
INSERT INTO "conversation_message" (id_sender, id_recipient, body, timestamp, read) VALUES (18, 18, 'Nullam orci pede, venenatis non, sodales sed, tincidunt eu, felis.', '09/06/2017', true);
INSERT INTO "conversation_message" (id_sender, id_recipient, body, timestamp, read) VALUES (19, 19, 'Vestibulum sed magna at nunc commodo placerat.', '19/01/2018', true);
INSERT INTO "conversation_message" (id_sender, id_recipient, body, timestamp, read) VALUES (20, 20, 'Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Nulla dapibus dolor vel est. Donec odio justo, sollicitudin ut, suscipit a, feugiat et, eros.', '29/01/2018', false);

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



```

## Revision History

No changes to show.



## Submission Information

GROUP1742, 20/03/2018

- Bernardo José Coelho Leite - [up201404464@fe.up.pt](mailto:up201404464@fe.up.pt)

- José Pedro da Silva e Sousa Borges - [up201503603@fe.up.pt](mailto:up201503603@fe.up.pt)

- Miguel Mano Fernandes - [up201503538@fe.up.pt](mailto:up201503538@fe.up.pt)

- Ventura de Sousa Pereira - [up201404690@fe.up.pt](mailto:up201404690@fe.up.pt)


