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

### 1.2. Frequent Queries

> Most important queries (SELECT) and their frequency.

| Query Reference | Query Description | Query Frequency  |
| --------------- | ----------------- | ---------------- |
| SELECT01        | User's profile    | hundreds per day |

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

```sql

```

## Revision History

No changes to show.



## Submission Information

GROUP1742, 20/03/2018

- Bernardo José Coelho Leite - [up201404464@fe.up.pt](mailto:up201404464@fe.up.pt)

- José Pedro da Silva e Sousa Borges - [up201503603@fe.up.pt](mailto:up201503603@fe.up.pt)

- Miguel Mano Fernandes - [up201503538@fe.up.pt](mailto:up201503538@fe.up.pt)

- Ventura de Sousa Pereira - [up201404690@fe.up.pt](mailto:up201404690@fe.up.pt)

