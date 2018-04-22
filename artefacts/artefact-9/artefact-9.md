# A9: Main accesses to the database and transactions

## 0\. Project Description (SHOWCHAN)

The goal of this project is to provide tv show and movie aficionados with daily news and updates of this media. This very system will be community-based since only registered members are allowed to both rate and comment each other's submissions, triggering healthy discussions.

## 1\. Main Accesses

Here lie the main accesses to the database from every module.

### 1.1. M01: Authentication and Individual Profile

| SQL Reference | Access Description | Web Resource |
|:------------- |:------------------ | ------------ |
| SQL101        | Logs in a user in the platform | [R102](https://github.com/zepedrob16/lbaw1742/blob/master/artefacts/artefact-7/artefact-7.md#r102-login-action) |

```sql
SELECT username
FROM "user_table"
WHERE "user_table".username = $username OR "user_table".email = $email AND "user_table".password = $password;
```

*Note: the user is successfully logged in if the database is able to return a valid username.*

| SQL Reference | Access Description | Web Resource |
|:------------- |:------------------ | ------------ |
| SQL102        | Creates a new user in the platform | [R105](https://github.com/zepedrob16/lbaw1742/blob/master/artefacts/artefact-7/artefact-7.md#r105-signup-action) |

```sql
INSERT INTO "user" (username, email, password, first_name, last_name, date_birth, nationality, quote, avatar, upvotes, downvotes, balance)
VALUES ($username, $email, $password, $first_name, $last_name, $date_birth, "NONE", "This user hasn't setup their quote.", "default", 0, 0, 0);
```

| SQL Reference | Access Description | Web Resource |
|:------------- |:------------------ | ------------ |
| SQL103        | Fetches a specific user's profile | [R106](https://github.com/zepedrob16/lbaw1742/blob/master/artefacts/artefact-7/artefact-7.md#r106-view-profile) |

```sql
SELECT username, email, firstname, lastname, email, quote, avatar 
FROM "user_table" 
WHERE "user_table".id = $userId;
```

| SQL Reference | Access Description | Web Resource |
|:------------- |:------------------ | ------------ |
| SQL104        | Updates a user's profile information | [R108](https://github.com/zepedrob16/lbaw1742/blob/master/artefacts/artefact-7/artefact-7.md#r108-edit-profile-action) |

```sql
UPDATE "user"
SET email = $email, password = $password, first_name = $first_name, last_name = $last_name, date_birth = $date_birth, nationality = $nationality, quote = $quote, avatar = $avatar
WHERE id = $id AND username = $username;
```

### 1.2. M02: User Administration and Static Pages

| SQL Reference | Access Description | Web Resource |
| ------------- | ------------------ | ------------ |
| SQL201        | Displays a list of every registered user | [R201](https://github.com/zepedrob16/lbaw1742/blob/master/artefacts/artefact-7/artefact-7.md#r201-get-users)|

```sql
SELECT * FROM "user";
```

| SQL Reference | Access Description | Web Resource |
| ------------- | ------------------ | ------------ |
| SQL202        | Displays a list of reports related to comments and posts | [R204](https://github.com/zepedrob16/lbaw1742/blob/master/artefacts/artefact-7/artefact-7.md#r204-get-reports)|

```sql
SELECT * FROM "report";
```

| SQL Reference | Access Description | Web Resource |
| ------------- | ------------------ | ------------ |
| SQL203        | Promotes user to a higher role on the platform | [R205](https://github.com/zepedrob16/lbaw1742/blob/master/artefacts/artefact-7/artefact-7.md#r205-promote-user)|

```sql
TODO
```

| SQL Reference | Access Description | Web Resource |
| ------------- | ------------------ | ------------ |
| SQL204        | Demotes user to a low role on the platform | [R206](https://github.com/zepedrob16/lbaw1742/blob/master/artefacts/artefact-7/artefact-7.md#r206-demote-moderator)|

```sql
TODO
```

| SQL Reference | Access Description | Web Resource |
| ------------- | ------------------ | ------------ |
| SQL205        | Banishes user from platform yet their content remains available for access | [R207](https://github.com/zepedrob16/lbaw1742/blob/master/artefacts/artefact-7/artefact-7.md#r207-ban-user)|

```sql
DELETE FROM "user" WHERE username = $username;
```

### 1.3. M03: Posts

| SQL Reference | Access Description | Web Resource |
| ------------- | ------------------ | ------------ |
| SQL301        | Shows posts made by users on the system | [R301](https://github.com/zepedrob16/lbaw1742/blob/master/artefacts/artefact-7/artefact-7.md#r301-view-posts)|

```sql
SELECT * FROM "post";
```

| SQL Reference | Access Description | Web Resource |
| ------------- | ------------------ | ------------ |
| SQL302        | Search posts by the provided tag | [R302](https://github.com/zepedrob16/lbaw1742/blob/master/artefacts/artefact-7/artefact-7.md#r302-search-post-by-tag)|

```sql
SELECT * FROM "post", "post_tag", "media_tag"
WHERE post.postnumber = post_tag.postnumber AND media_tag.tag_id = post_tag.tag_id;
```

| SQL Reference | Access Description | Web Resource |
| ------------- | ------------------ | ------------ |
| SQL303        | Search posts by the provided category | [R303](https://github.com/zepedrob16/lbaw1742/blob/master/artefacts/artefact-7/artefact-7.md#r303-search-post-by-category)|

```sql
SELECT * FROM "post", media_category 
WHERE "post".category = $category AND "post".mediacategory_id LIKE media_category.id AND media_category.type LIKE 'action';
```

| SQL Reference | Access Description | Web Resource |
| ------------- | ------------------ | ------------ |
| SQL304        | Shows post information, it being either a text, image or link type post | [R304](https://github.com/zepedrob16/lbaw1742/blob/master/artefacts/artefact-7/artefact-7.md#r304-view-post)|

```sql
TODO
```

| SQL Reference | Access Description | Web Resource |
| ------------- | ------------------ | ------------ |
| SQL305        | Creates a new post in the platform, it being either a text, image or link type post | [R306](https://github.com/zepedrob16/lbaw1742/blob/master/artefacts/artefact-7/artefact-7.md#r306-submit-post-action)|

```sql
TODO: May we present SQL like this?

INSERT INTO "text_post" (id_post, opinion, source)
VALUES ($id_post, $opinion, $source);

INSERT INTO "link_post" (id_post, url)
VALUES ($id_post, $url);

INSERT INTO "image_post" (id_post, image, source)
VALUES ($id_post, $image, $source);
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
| ------------- | ------------------ | ------------ |
| SQL403        | Sends a new message from the logged in user to a provided recipient | [R402](https://github.com/zepedrob16/lbaw1742/blob/master/artefacts/artefact-7/artefact-7.md#r403-open_inbox-action)|

```sql
INSERT INTO "conversation_message" (id_sender, id_recipient, body, timestamp, read)
VALUES ($id_sender, $id_recipient, $body, current_timestamp, false);
```

## 2\. Transactions

Here follow transactions needed to assure the integrity of the data.

| SQL Reference | Description | Justification | Isolation Level |
| T01           |             |               | REPEATABLE READ | 

...

## Revision history

Changes made to the first submission:

- No changes thus far.

***

## Submission Information

GROUP1742, 16/04/2018

- Bernardo José Coelho Leite - [up201404464@fe.up.pt](mailto:up201404464@fe.up.pt)

- José Pedro da Silva e Sousa Borges - [up201503603@fe.up.pt](mailto:up201503603@fe.up.pt)

- Miguel Mano Fernandes - [up201503538@fe.up.pt](mailto:up201503538@fe.up.pt)

- Ventura de Sousa Pereira - [up201404690@fe.up.pt](mailto:up201404690@fe.up.pt)
