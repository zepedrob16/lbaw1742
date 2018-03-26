# SHOWCHAN - Collaborative News
The goal of this project is to provide tv show and movie aficionados with daily news and updates of this media. This very system will be community-based since only registered members are allowed to both rate and comment each other's submissions, triggering healthy discussions.

# A5: Relational schema, validation and schema refinement
This artifact contains the Relational Schema obtained by mapping from the Conceptual Data Model. The Relational Schema includes the relation schema, attributes, domains, primary keys, foreign keys and other integrity rules: UNIQUE and NOT NULL.
 
## 5. Relational Schema
Relational schemas are specified in the compact notation: 

|   |   |
|--:|---|
| R01 | user_table(<ins>id</ins>, <ins>username</ins> **UK** **NN**, <ins>email</ins> **UK** **NN**, password **NN**, firstname **NN**, lastname **NN**, datebirth **NN**, nationality **NN**, quote, avatar, \upvotes, \downvotes, \balance) |
| R02 | post(<ins>postnumber</ins>, <ins>author</ins> → user **NN**, title **NN**, timestamp **NN**, \upvotes, \downvotes, \balance) |
| R03 | post_comment(<ins>id</ins>, id_post → post **NN**, id_user → user **NN**, body **NN**, timestamp **NN**) |
| R04 | post_reaction(<ins>postnumber</ins> → post **NN**, <ins>id</ins> → user **NN**, balance **NN**) |
| R05 | image_post(<ins>id_post</ins> → post, image **NN**, source **NN**) |
| R06 | text_post(<ins>id_post</ins> → post, opinion **NN**, source **NN**) |
| R07 | link_post(<ins>id_post</ins> → post, url **NN**) |
| R08 | report(<ins>id</ins>, timestamp **NN**, criminal->User, author->User) |
| R09 | friendship(<ins>id</ins>, start **NN**, user1->user, user2->user) |
| R10 | friend_request(<ins>id</ins>, dateRequest, dateConfirmation, sender->User, receiver->user) |
| R11 | conversation_message(<ins>id_sender</ins> → user, <ins>id_recipient</ins> → user, body **NN**, timestamp **NN**, read) |
| R12 | media_category(<ins>cat_id</ins> **NN**, title **NN**) |
| R13 | media_tag(<ins>tag_id</ins> **NN**, rating, title **NN**) |
| R14 | member(<ins>id_user</ins> → user, reports) |
| R15 | moderator(<ins>id_user</ins> → user) |
| R16 | admin(<ins>id_user</ins> → user) |
| R17 | post_tag(<ins>postnumber</ins> → post, <ins>tag_id</ins> → media_tag) 
| R18 | post_category(<ins>postnumber</ins> → post, <ins>cat_id</ins> → media_category) 

## 6. Domains
Specification of additional domains:

|   |   |
|--:|---|
| Today | DATE DEFAULT CURRENT_DATE |
| Upvotes | \[0, MAX_INT\] |
| Downvotes | \[0, MAX_INT\] |

## 7. Functional Dependencies and schema validation
To validate the Relational Schema obtained from the Conceptual Model, all functional dependencies are identified and the normalization of all relation schemas is accomplished.

**Table R01** (User)  
**Keys**: {id,username,email}  
**Functional Dependencies**  
* FD0101 {id} → {username, password, firstname, lastname, email, datebirth, nationality, quote, avatar, upvotes, downvotes, balance}
* FD0102 {username} → {id, password, firstname, lastname, email, datebirth, nationality, quote, avatar, upvotes, downvotes, balance}
* FD0103 {email} → {id, username, password, firstname, lastname, datebirth, nationality, quote, avatar, upvotes, downvotes, balance}

**Normal form**: BCNF

---

**Table R02** (post)  
**Keys**: {postnumber,author}  
**Functional Dependencies**  
* FD0201 {postnumber} → {author, title, timestamp, upvotes, downvotes, balance}
* FD0202 {author} → {postnumber, title, timestamp, upvotes, downvotes, balance}

**Normal form**: BCNF  

---

**Table R03** (post_comment)  
**Keys**: {id}  
**Functional Dependencies** 
* FD0301 {id} → {body, timestamp, id_post, id_user}

**Normal form**: BCNF

---

**Table R04** (post_reaction)  
**Keys**: {postnumber,id}  
**Functional Dependencies** 
* FD0401 {postnumber} → {balance}
* FD0402 {id} → {balance}

**Normal form**: BCNF

---

**Table R05** (image_post)  
**Keys**: {id_post}  
**Functional Dependencies**  
* FD0501 {id_post} → {image, source}

**Normal form**: BCNF

---

**Table R06** (text_post)  
**Keys**: {id_post}  
**Functional Dependencies**  
* FD0601 {id_post} → {opinion, source}

**Normal form**: BCNF

---

**Table R07** (link_post)  
**Keys**: {id_post}  
**Functional Dependencies**  
* FD0701 {id_post} → {url}

**Normal form**: BCNF

---

**Table R08** (report)  
**Keys**: {id}  
**Functional Dependencies**  
* FD0801 {id} → {timestamp, user}

**Normal form**: BCNF

---

**Table R09** (frienship)  
**Keys**: {id}  
**Functional Dependencies**  
* FD0901 {id} → {start, user1, user2}

**Normal form**: BCNF

---

**Table R10** (friend_request)  
**Keys**: {id}  
**Functional Dependencies**  
* FD1001 {id} → {dateRequest, dateConfirmation, sender, receiver}

**Normal form**: BCNF

---
 
**Table R11** (conversation)  
**Keys**: {id_sender, id_recipient}  
 **Functional Dependencies**  
* FD1101 {id_sender} → {title}
* FD1102 {id_recipient} → {title}
 
 **Normal form**: BCNF
 
---
 
**Table R12** (media_category)  
**Keys**: {cat_id}  
 **Functional Dependencies**  
* FD1201 {cat_id} → {title}
 
 **Normal form**: BCNF

---
 
 **Table R13** (media_tag)  
**Keys**: {tag_id}  
**Functional Dependencies**  
* FD1301 {tag_id} → {rating,title}

---

**Table R14** (member)  
**Keys**: {id}  
**Functional Dependencies**  
* FD1401 {id_user} → {reports}

**Normal form**: BCNF  

---

**Table R15** (moderator)  
**Keys**: {id}  
**Functional Dependencies**  
* (none)

**Normal form**: BCNF  

---

**Table R16** (admin)  
**Keys**: {id_user}  
**Functional Dependencies**  
* (none)

**Normal form**: BCNF  

---

**Table R17** (post_tag)  
**Keys**: {postnumber, tag_id}  
**Functional Dependencies**  
* (none)

**Normal form**: BCNF  

---

**Table R18** (post_category)  
**Keys**: {postnumber, cat_id}  
**Functional Dependencies**  
* (none)

**Normal form**: BCNF  

Because all relations are in the Boyce–Codd Normal Form (BCNF), the relational schema is also in the BCNF and therefore there is no need to be refined it using normalisation. 


## 8. SQL Code

#### [Download](https://github.com/zepedrob16/lbaw1742/blob/master/artefacts/artefact-5/lbaw.sql)
```SQL

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


```

## Revision history
* **Username** and every instance of **timestamp** is now a **NOT NULL** attribute.
* Fixed direction of **derivation bar**.
* Fixed some **inconsistencies** between the conceptual model and this artefact.
* Fixed incorrect **media tag** and **media category keys**.
* Added **connection** between **post_comment** and **user**.
* Added plenty of **attributes** to **conversation_message** (we got mixed up because of parent class deletion).
* **Post_reaction** is now modelled according to **derived class rules**, as well as the **response** relation.
* Added **domains** for **upvotes** and **downvotes**.
* Added **keys** to some **functional dependencies**.
* Added some missing **candidate keys** (e.g. username).
* There's now a **final paragraph** relative to the **normal form** present on **topic seven's relational schema**.
* Added missing **drops**.
* Fixed plenty of **errors** previously present on the **SQL code**.
* Added **Github download link** for **SQL code**.
* **Markdown formatting**.

 
***
 
GROUP1742, 06/03/2018
 
> Bernardo José Coelho Leite, up201404464@fe.up.pt  
> José Pedro da Silva e Sousa Borges, up201503603@fe.up.pt  
> Miguel Mano Fernandes, up201503538@fe.up.pt  
> Ventura de Sousa Pereira, up201404690@fe.up.pt  
