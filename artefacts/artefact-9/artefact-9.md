# A9: Main accesses to the database and transactions

## 0\. Project Description (SHOWCHAN)

The goal of this project is to provide tv show and movie aficionados with daily news and updates of this media. This very system will be community-based since only registered members are allowed to both rate and comment each other's submissions, triggering healthy discussions.

## 1\. Main Accesses

> Main accesses to the database.

### 1.1. M01: Authentication and Individual Profile

| SQL Reference | Access Description          | Web Resource                                                                                                     |
|:------------- |:--------------------------- | ---------------------------------------------------------------------------------------------------------------- |
| SQL101        | Logs a user in the platform | [R105](https://github.com/zepedrob16/lbaw1742/blob/master/artefacts/artefact-7/artefact-7.md#r105-signup-action) |

```pgsql
INSERT INTO "user" (username, email, password, first_name, last_name, date_birth, nationality, quote, avatar, upvotes, downvotes, balance)
VALUES ($username, $email, $password, $first_name, $last_name, $date_birth, $nationality, $quote, $avatar, 0, 0, 0);
```

### 1.2. M02: User Administration and Static Pages

| SQL Reference | Access Description | Web Resource |
| ------------- | ------------------ | ------------ |
| SQL201        |                    |              |

### 1.3. M03: Posts

### 1.4. M04: Inbox

## 2\. Transactions

> Transactions needed to assure the integrity of the data.

| SQL Reference   | Transaction Name                    |
| \-\-\-\-\-\-\-\-\-\-\-\-\-\-\- | \-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\- |
| Justification   | Justification for the transaction.  |
| Isolation level | Isolation level of the transaction. |
| \`Complete SQL Code\`                                   |

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
