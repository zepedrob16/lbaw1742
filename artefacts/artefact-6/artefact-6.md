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


```

## Revision History

No changes to show.



## Submission Information

GROUP1742, 20/03/2018

- Bernardo José Coelho Leite - [up201404464@fe.up.pt](mailto:up201404464@fe.up.pt)

- José Pedro da Silva e Sousa Borges - [up201503603@fe.up.pt](mailto:up201503603@fe.up.pt)

- Miguel Mano Fernandes - [up201503538@fe.up.pt](mailto:up201503538@fe.up.pt)

- Ventura de Sousa Pereira - [up201404690@fe.up.pt](mailto:up201404690@fe.up.pt)


