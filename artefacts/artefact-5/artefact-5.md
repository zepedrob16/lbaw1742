# SHOWCHAN - Collaborative News
The goal of this project is to provide tv show and movie aficionados with daily news and updates of this media. This very system will be community-based since only registered members are allowed to both rate and comment each other's submissions, triggering healthy discussions.

# A5: Relational schema, validation and schema refinement
This artifact contains the Relational Schema obtained by mapping from the Conceptual Data Model. The Relational Schema includes the relation schema, attributes, domains, primary keys, foreign keys and other integrity rules: UNIQUE and NOT NULL.
 
## 5. Relational Schema
Relational schemas are specified in the compact notation: 

|   |   |
|--:|---|
| R01 | post(id, title **NN**, timestamp **NN**, upvotes, downvotes, balance) |
| R01 | post_comment(id, body **NN**, timestamp **NN**) |
| R01 | post_reaction(id, balance **NN**) |
| R01 | image_post(id_post → post, image **NN**, source **NN**) |
| R01 | text_post(id_post → post, opinion **NN**, source **NN**) |
| R01 | link_post(id_post → post, url **NN**) |

## 6. Domains
Specification of additional domains:

|   |   |
|--:|---|
| Today | DATE DEFAULT CURRENT_DATE |

## 7. Functional Dependencies and schema validation
To validate the Relational Schema obtained from the Conceptual Model, all functional dependencies are identified and the normalization of all relation schemas is accomplished.

**Table R01** (user)  
**Keys**: {id, username, email}  
**Functional Dependencies**  
* FD0101
* FD0102

**Normal form**: BCNF

---

**Table R01** (image_post)  
**Keys**: {id_post}  
**Functional Dependencies**  
* FD0101 {id_post} → {image, source}

**Normal form**: BCNF

---

**Table R01** (text_post)  
**Keys**: {id_post}  
**Functional Dependencies**  
* FD0101 {id_post} → {opinion, source}

**Normal form**: BCNF

---

**Table R01** (link_post)  
**Keys**: {id_post}  
**Functional Dependencies**  
* FD0101 {id_post} → {url}

**Normal form**: BCNF


## 8. SQL Code
```SQL
-- Tables

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

-- Primary Keys and Uniques

ALTER TABLE ONLY image_post
    ADD CONSTRAINT image_post_pkey PRIMARY KEY (id_post);

ALTER TABLE ONLY text_post
    ADD CONSTRAINT text_post_pkey PRIMARY KEY (id_post);

ALTER TABLE ONLY link_post
    ADD CONSTRAINT link_post_pkey PRIMARY KEY (id_post); 

-- Foreign Keys

ALTER TABLE ONLY image_post
    ADD CONSTRAINT image_post_id_post_fkey FOREIGN KEY (id_post) REFERENCES post(id) ON UPDATE CASCADE;

ALTER TABLE ONLY text_post
    ADD CONSTRAINT text_post_id_post_fkey FOREIGN KEY (id_post) REFERENCES post(id) ON UPDATE CASCADE;

ALTER TABLE ONLY link_post
    ADD CONSTRAINT link_post_id_post_fkey FOREIGN KEY (id_post) REFERENCES post(id) ON UPDATE CASCADE;

```

## Revision history
No changes.

 
***
 
GROUP1742, 06/03/2018
 
> Bernardo José Coelho Leite, up201404464@fe.up.pt  
> José Pedro da Silva e Sousa Borges, up201503603@fe.up.pt  
> Miguel Mano Fernandes, up201503538@fe.up.pt  
> Ventura de Sousa Pereira, up201404690@fe.up.pt  
