# SHOWCHAN - Collaborative News
The goal of this project is to provide tv show and movie aficionados with daily news and updates of this media. This very system will be community-based since only registered members are allowed to both rate and comment each other's submissions, triggering healthy discussions.

# A5: Relational schema, validation and schema refinement
This artifact contains the Relational Schema obtained by mapping from the Conceptual Data Model. The Relational Schema includes the relation schema, attributes, domains, primary keys, foreign keys and other integrity rules: UNIQUE and NOT NULL.
 
## 5. Relational Schema
Relational schemas are specified in the compact notation: 

|   |   |
|--:|---|
| R01 | post(<ins>id</ins>, author → user **NN**, title **NN**, timestamp **NN**, upvotes, downvotes, balance) |
| R01 | post_comment(<ins>id</ins>, id_post → post **NN**, body **NN**, timestamp **NN**) |
| R01 | post_reaction(<ins>id</ins>, id_post → post **NN**, id_user → user **NN**, balance **NN**) |
| R01 | image_post(<ins>id_post</ins> → post, image **NN**, source **NN**) |
| R01 | text_post(<ins>id_post</ins> → post, opinion **NN**, source **NN**) |
| R01 | link_post(<ins>id_post</ins> → post, url **NN**) |
| R01 | media_category(<ins>id_post</ins> → post, title **NN**) |
| R01 | media_tag(<ins>id_post</ins> → post, title **NN**, rating) |
| R01 | conversation(<ins>id_sender</ins> → user, id_recipient → user, title **NN**) | 
| R01 | user(<ins>id</ins>, username **UK**, passowrd **NN**, firstname **NN**, lastname **NN**, email **UK** **NN**, datebirth **NN**, nationality **NN**, quote, avatar, upvotes, downvotes, balance) |
| R01 | report(<ins>id</ins>, timestamp, criminal->User, author->User) |
| R01 | friendship(<ins>id</ins>, start, user1->user, user2->user) |
| R01 | friend_request(<ins>id</ins>, dateRequest, dateConfirmation, sender->User, receiver->user) |
| R01 | member(<ins>id_user</ins> → user, reports) |
| R01 | moderator(<ins>id_user</ins> → user) |
| R01 | admin(<ins>id_user</ins> → user) |

## 6. Domains
Specification of additional domains:

|   |   |
|--:|---|
| Today | DATE DEFAULT CURRENT_DATE |

## 7. Functional Dependencies and schema validation
To validate the Relational Schema obtained from the Conceptual Model, all functional dependencies are identified and the normalization of all relation schemas is accomplished.

**Table R01** (User)  
**Keys**: {id}  
**Functional Dependencies**  
* FD0101 {id} → {username, passowrd, firstname, lastname, email, datebirth, nationality, quote, avatar, upvotes, downvotes, balance}

**Normal form**: BCNF

---

**Table R02** (post)  
**Keys**: {id}  
**Functional Dependencies**  
* FD0201 {id} → {title, timestamp, upvotes, downvotes, balance}

**Normal form**: BCNF  

---

**Table R03** (post_comment)
**Keys**: {id}
**Functional Dependencies** 
* FD0301 {id} → {body, timestamp}

**Normal form**: BCNF

---

**Table R04** (post_reaction)
**Keys**: {id}
**Functional Dependencies** 
* FD0401 {id} → {balance}

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

**Table R01** (report)  
**Keys**: {id}  
**Functional Dependencies**  
* FD0801 {id} → {timestamp, user}

**Normal form**: BCNF

---

**Table R08** (frienship)  
**Keys**: {id}  
**Functional Dependencies**  
* FD0901 {id} → {start, user1, user2}

**Normal form**: BCNF

---

**Table R09** (friend_request)  
**Keys**: {id}  
**Functional Dependencies**  
* FD1001 {id} → {dateRequest, dateConfirmation, sender, receiver}

**Normal form**: BCNF

---
 
**Table R10** (conversation)  
**Keys**: {id_sender, id_recipient}  
 **Functional Dependencies**  
* FD1101 {id_sender} → {title}
* FD1102 {id_recipient} → {title}
 
 **Normal form**: BCNF
 
---
 
**Table R11** (media_category)  
**Keys**: {id_post}  
 **Functional Dependencies**  
* FD1201 {id_post} → {title}
 
 **Normal form**: BCNF

---
 
 **Table R12** (media_tag)  
**Keys**: {id_post}  
**Functional Dependencies**  
* FD1301 {id_post} → {title, rating}

---

**Table R13** (member)  
**Keys**: {id}  
**Functional Dependencies**  
* FD1401 {id_user} → {reports}

**Normal form**: BCNF  

---

**Table R14** (moderator)  
**Keys**: {id}  
**Functional Dependencies**  
* (none)

**Normal form**: BCNF  

---

**Table R15** (admin)  
**Keys**: {id_user}  
**Functional Dependencies**  
* (none)

**Normal form**: BCNF  


## 8. SQL Code
```SQL
-- Tables
CREATE TABLE user (
 
  id INTEGER NOT NULL AUTO_INCREMENT,
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

```

## Revision history
No changes.

 
***
 
GROUP1742, 06/03/2018
 
> Bernardo José Coelho Leite, up201404464@fe.up.pt  
> José Pedro da Silva e Sousa Borges, up201503603@fe.up.pt  
> Miguel Mano Fernandes, up201503538@fe.up.pt  
> Ventura de Sousa Pereira, up201404690@fe.up.pt  
