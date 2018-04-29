# A9: Main accesses to the database and transactions

## 0. Project Description (SHOWCHAN)

The goal of this project is to provide tv show and movie aficionados with daily news and updates of this media. This very system will be community-based since only registered members are allowed to both rate and comment each other's submissions, triggering healthy discussions.

## 1. Main Accesses

Here lie the main accesses to the database from every module.

### 1.1. M01: Authentication and Individual Profile

| SQL Reference | Access Description | Web Resource |
|:------------- |:------------------ |:------------ |
| SQL101        | Logs in a user in the platform | [R102](https://github.com/zepedrob16/lbaw1742/blob/master/artefacts/artefact-7/artefact-7.md#r102-login-action) |

```sql
SELECT username
FROM "user_table"
WHERE "user_table".username = $username OR "user_table".email = $email AND "user_table".password = $password;
```

*Note: the user is successfully logged in if the database is able to return a valid username.*

| SQL Reference | Access Description | Web Resource |
|:------------- |:------------------ |:------------ |
| SQL102        | Creates a new user in the platform | [R105](https://github.com/zepedrob16/lbaw1742/blob/master/artefacts/artefact-7/artefact-7.md#r105-signup-action) |

```sql
INSERT INTO "user" (username, email, password, first_name, last_name, date_birth, nationality, quote, avatar, 
upvotes, downvotes, balance)
VALUES ($username, $email, $password, $first_name, $last_name, $date_birth, "NONE", "This user hasn't setup 
their quote.", "default", 0, 0, 0);
```

| SQL Reference | Access Description | Web Resource |
|:------------- |:------------------ |:------------ |
| SQL103        | Fetches a specific user's profile | [R106](https://github.com/zepedrob16/lbaw1742/blob/master/artefacts/artefact-7/artefact-7.md#r106-view-profile) |

```sql
SELECT username, email, firstname, lastname, email, quote, avatar 
FROM "user_table" 
WHERE "user_table".id = $userId;
```

| SQL Reference | Access Description | Web Resource |
|:------------- |:------------------ |:------------ |
| SQL104        | Updates a user's profile information | [R108](https://github.com/zepedrob16/lbaw1742/blob/master/artefacts/artefact-7/artefact-7.md#r108-edit-profile-action) |

```sql
UPDATE "user"
SET email = $email, password = $password, first_name = $first_name, last_name = $last_name, 
date_birth = $date_birth, nationality = $nationality, quote = $quote, avatar = $avatar
WHERE id = $id AND username = $username;
```

| SQL Reference | Access Description | Web Resource |
|:------------- |:------------------ |:------------ |
| SQL105        | Sends a friend request from the logged user to a provided one | [R404](https://github.com/zepedrob16/lbaw1742/blob/master/artefacts/artefact-7/artefact-7.md#r404-send-friend-request-action) |

```sql
INSERT INTO "friend_request" (id_sender, id_recipient, date_request, date_confirmation)
VALUES ($id_sender, $id_recipient, current_timestamp, NULL);
```

| SQL Reference | Access Description | Web Resource |
|:------------- |:------------------ |:------------ |
| SQL106        | Reports user so it must be reviewed by administrators | [R405](https://github.com/zepedrob16/lbaw1742/blob/master/artefacts/artefact-7/artefact-7.md#r405-report-user-action) |

```sql
INSERT INTO "report" (criminal, author, type, timestamp)
VALUES ($criminal, $author, $type, current_timestamp);
```

### 1.2. M02: User Administration and Static Pages

| SQL Reference | Access Description | Web Resource |
|:------------- |:------------------ |:------------ |
| SQL201        | Promotes user to a higher role on the platform | [R205](https://github.com/zepedrob16/lbaw1742/blob/master/artefacts/artefact-7/artefact-7.md#r205-promote-user)|

```sql
DELETE FROM "member" WHERE id_user = $id_user
INSERT INTO "moderator" (id_user)
VALUES ($id_user)
```

| SQL Reference | Access Description | Web Resource |
|:------------- |:------------------ |:------------ |
| SQL202        | Demotes user to a low role on the platform | [R206](https://github.com/zepedrob16/lbaw1742/blob/master/artefacts/artefact-7/artefact-7.md#r206-demote-moderator)|

```sql
DELETE FROM "moderator" WHERE id_user = $id_user
INSERT INTO "member" (id_user, reports)
VALUES ($id_user, NULL)
```

| SQL Reference | Access Description | Web Resource |
|:------------- |:------------------ |:------------ |
| SQL203        | Banishes user from platform yet their content remains available for access | [R207](https://github.com/zepedrob16/lbaw1742/blob/master/artefacts/artefact-7/artefact-7.md#r207-ban-user)|

```sql
DELETE FROM "user" WHERE username = $username;
```

### 1.3. M03: Posts

| SQL Reference | Access Description | Web Resource |
|:------------- |:------------------ |:------------ |
| SQL301        | View Posts by date | [R301](https://github.com/zepedrob16/lbaw1742/blob/master/artefacts/artefact-7/artefact-7.md#r301-view-posts)|

```sql
select title from post ORDER BY time_stamp DESC;
```

| SQL Reference | Access Description | Web Resource |
|:------------- |:------------------ |:------------ |
| SQL302        | Search posts by the provided tag | [R302](https://github.com/zepedrob16/lbaw1742/blob/master/artefacts/artefact-7/artefact-7.md#r302-search-post-by-tag)|

```sql
SELECT * FROM "post", "post_tag", "media_tag"
WHERE post.postnumber = post_tag.postnumber AND media_tag.tag_id = post_tag.tag_id;
```

| SQL Reference | Access Description | Web Resource |
|:------------- |:------------------ |:------------ |
| SQL303        | Search posts by the provided category | [R303](https://github.com/zepedrob16/lbaw1742/blob/master/artefacts/artefact-7/artefact-7.md#r303-search-post-by-category)|

```sql
SELECT * FROM "post", media_category 
WHERE "post".category = $category AND "post".mediacategory_id LIKE media_category.id 
AND media_category.type LIKE 'action';
```

| SQL Reference | Access Description | Web Resource |
|:------------- |:------------------ |:------------ |
| SQL304        | Shows post information, it being either a text, image or link type post | [R304](https://github.com/zepedrob16/lbaw1742/blob/master/artefacts/artefact-7/artefact-7.md#r304-view-post)|

```sql
SELECT * FROM "image_post", "text_post", "link_post"
WHERE id_post = $id_post
```

| SQL Reference | Access Description | Web Resource |
|:------------- |:------------------ |:------------ |
| SQL305        | Creates a new post in the platform, it being either a text, image or link type post | [R306](https://github.com/zepedrob16/lbaw1742/blob/master/artefacts/artefact-7/artefact-7.md#r306-submit-post-action)|

```sql
INSERT INTO "text_post" (id_post, opinion, source)
VALUES ($id_post, $opinion, $source);

INSERT INTO "link_post" (id_post, url)
VALUES ($id_post, $url);

INSERT INTO "image_post" (id_post, image, source)
VALUES ($id_post, $image, $source);
```

| SQL Reference | Access Description | Web Resource |
|:------------- |:------------------ |:------------ |
| SQL306        | Creates a new comment on a post | [R307](https://github.com/zepedrob16/lbaw1742/blob/master/artefacts/artefact-7/artefact-7.md#r307-post-comment-action) |

```sql
INSERT INTO "post_comment" (id_post, id_user, body, timestamp)
VALUES ($id_post, $id_user, $body, current_timestamp);
```

| SQL Reference | Access Description | Web Resource |
|:------------- |:------------------ |:------------ |
| SQL307        | Deletes a user owned comment on a post | [R308](https://github.com/zepedrob16/lbaw1742/blob/master/artefacts/artefact-7/artefact-7.md#r308-delete-comment-action) |

```sql
DELETE FROM "post_comment" WHERE id = $id;
```

| SQL Reference | Access Description | Web Resource |
|:------------- |:------------------ |:------------ |
| SQL308        | Deletes a user owned post | [R309](https://github.com/zepedrob16/lbaw1742/blob/master/artefacts/artefact-7/artefact-7.md#r309-delete-post-action) |

```sql
DELETE FROM "post" WHERE id = $id;
```

| SQL Reference | Access Description | Web Resource |
|:------------- |:------------------ |:------------ |
| SQL309        | Edits a user owned comment on a post | [R310](https://github.com/zepedrob16/lbaw1742/blob/master/artefacts/artefact-7/artefact-7.md#r310-edit-comment-action) |

```sql
UPDATE "post_comment"
SET body = $body
WHERE id_user = $id_user AND id_post = $id_post;
```

| SQL Reference | Access Description | Web Resource |
|:------------- |:------------------ |:------------ |
| SQL310        | Edits a user owned post content, provided it is a text post | [R311](https://github.com/zepedrob16/lbaw1742/blob/master/artefacts/artefact-7/artefact-7.md#r311-edit-post-action) |

```sql
UPDATE "text_post"
SET opinion = $opinion
WHERE id_post = $id_post;
```

### 1.4. M04: Inbox

| SQL Reference | Access Description | Web Resource |
| ------------- | ------------------ | ------------ |
| SQL401        | Displays a list of conversations belonging to a user | [R401](https://github.com/zepedrob16/lbaw1742/blob/master/artefacts/artefact-7/artefact-7.md#r401-view-inbox)|

```sql
SELECT * FROM "conversation_message" 
WHERE id_recipient = $id_recipient;
```

| SQL Reference | Access Description | Web Resource |
| ------------- | ------------------ | ------------ |
| SQL402        | Displays a conversation between the logged in user and other user | [R402](https://github.com/zepedrob16/lbaw1742/blob/master/artefacts/artefact-7/artefact-7.md#r402-open_inbox-form)|

```sql
SELECT * FROM conversation_message 
WHERE id_recipient = $id_recipient AND id_sender = $id_sender;
```

| SQL Reference | Access Description | Web Resource |
|:------------- |:------------------ |:------------ |
| SQL403        | Sends a new message from the logged in user to a provided recipient | [R403](https://github.com/zepedrob16/lbaw1742/blob/master/artefacts/artefact-7/artefact-7.md#r403-open_inbox-action)|

```sql
INSERT INTO "conversation_message" (id_sender, id_recipient, body, timestamp, read)
VALUES ($id_sender, $id_recipient, $body, current_timestamp, false);
```

## 2. Transactions

Here follow transactions needed to assure the integrity of the data.

| SQL Reference | Description | Justification | Isolation Level |
|:------------- |:----------- |:------------- |:----------------|
| T01           | Insert new Post | In order to maintain consistency, it's necessary to use a transaction to ensure that the all the code executes without errors. If an error occurs, a ROLLBACK is issued (when the insertion of a post fails, per example). The isolation level is Repeatable Read, because, otherwise, an update of id_post could happen, due to an insert in the table Post committed by a concurrent transaction, and as a result, inconsistent data would be stored.| REPEATABLE READ |

```sql
BEGIN TRANSACTION;
SET TRANSACTION ISOLATION LEVEL REPEATABLE READ 

--Onyl one of these inserts will happen

--Insert Post
INSERT into "post" (author, title, time_stamp, upvotes, downvotes, balance)
values ($author, $title, $time_stamp, $upvotes, $downvotes, $balance);

--Insert Text Post
insert into "text_post" (id_post, opinion, source) 
values ($id_post, $opinion, $source);

--Insert Link Post
insert into "link_post" (id_post, url) 
VALUES ($id_post, $url);

--Insert Image Post
insert into "image_post" (id_post, image, source) 
VALUES ($id_post, $image, $source);

COMMIT;
```

## Revision history

Changes made to the first submission:
* Removed trivial queries (201/202/301);
* Added query responsible for ordering the posts by date (from the most recent to the oldest) and that will be used on final product;
* Removed all previous transactions;
* Added transaction related to the insertion of a new Post considering all related tables (text_post, link_post and image_post);

## Submission Information

GROUP1742, 23/04/2018

* Bernardo José Coelho Leite - [up201404464@fe.up.pt](mailto:up201404464@fe.up.pt)
* José Pedro da Silva e Sousa Borges - [up201503603@fe.up.pt](mailto:up201503603@fe.up.pt)
* Miguel Mano Fernandes - [up201503538@fe.up.pt](mailto:up201503538@fe.up.pt)
* Ventura de Sousa Pereira - [up201404690@fe.up.pt](mailto:up201404690@fe.up.pt)
