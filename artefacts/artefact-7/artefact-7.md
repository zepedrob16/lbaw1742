# A7: High-level architecture. Privileges. Web resources specification

## 0. Project Description (SHOWCHAN) 

The goal of this project is to provide tv show and movie aficionados with daily news and updates of this media. This very system will be community-based since only registered members are allowed to both rate and comment each other's submissions, triggering healthy discussions.

## 1. Overview

|   |   | 
|--:|---|
| M01: Authentication and Individual Profile | Web resources associated with user authentication and individual profile management, includes the following system features: login/logout, registration, view and edit personal profile information.
| M02: User Administration and Static pages | Web resources associates with user management, specifically: view and search users, delete or ban user accounts, view user information and view system access details for each user. Web resources with static content are associated with this module: dashboard and about.
| M03: Posts | Web resources associated with Posts, includes the following system features: posts list and search, view and submit details.
| M04: Inbox | Module dedicated to the interaction between users, including: inbox and individual conversations.
 
## 2. Permissions

|   |   |   |
|--:|---|---|
| PUB | Public | Group of users without privileges
| USR | User | Authenticated user
| OWN | Owner | Group of users that can update their profiles and have privileges regarding their items
| ADM | Administrator | Group of administrators
 
> Define the permissions used by each module, necessary to access its data and features.
 
## 3. Modules
 
> Web resources organized by module
> Document and describe the web resources associated with each module, indicating the URL, HTTP method, request parameters and response.
> Follow the RESTful resource naming
> At the end of this page is presented some usual descriptors to document the web resources.
 
### 3.1 Module M01: Authentication and Individual Profile

 * R101: Login Form /login
 * R102: Login Action /register
 * R103: Logout Action /logout
 * R104: Signup Form /signup
 * R105: View Profile /profile/{id}
 * R106: Edit Profile Form /edit_profile/{id}
 * R107: Edit Profile Action /edit_profile/{id}
 * R108: Password Recovery Form /password_reset
 * R109: Password Recovery Form Action /password_reset

R101: Login Form

|   |   |
|--:|---|
| **URL** | /login
| **Description** | Page with a login form to authenticate a user into his account
| **Method** | GET
| **UI** | UI06
| **SUBMIT** | R102
| **Permissions** | PUB

R102: Login Action

|   |   |   |
|--:|---|---|
| **URL** | /register
| **Description** | This web resource logs out the authenticated user of admin.
| **Method** | POST
| **Request Body** | +email: string, +username: string | Email or Username
|              | +password: string | Password
| **Redirects** | R301 | Success
|           | R101 | Error
| **Permissions** | PUB

R103: Logout Action

|   |   |   |
|--:|---|---|
| **URL** | /logout
| **Description** | This web resource logs out the authenticated user or admin.
| **Method** | POST
| **Redirects** | R101 | Success
| **Permissions** | USR, ADM

R104: Signup Form

|   |   |
|--:|---|
| **URL** | /signup
| **Description** | Page with a form to register a new user account
| **Method** | GET
| **UI** | UI04
| **SUBMIT** | R105
| **Permissions** | PUB

R105: Signup Action

|   |   |   |
|--:|---|---|
| **URL** | /signup
| **Description** | This web resource inserts a new user into the system. Redirects to the homepage on success and the register form on failure.
| **Method** | POST
| **Request Body** | +username: string | Username
|              | +email: string | Email
|              | +password: string | Password
|              | +confirmPassword: string | Password confirmation
| **Redirects** | R301 | Success
|           | R104 | Error
| **Permissions** | PUB

R106: View Profile

|   |   |   |
|--:|---|---|
| **URL** | /profile/{id}
| **Description** | Shows the user's profile
| **Method** | GET
| **Parameters** | +id: integer | user primary key
| **UI** | UI10 (já vou ver)
| **Permissions** | USR

R107: Edit Profile Form

|   |   |   |
|--:|---|---|
| **URL** | /edit_profile/{id}
| **Description** | Edits the current user's profile
| **Method** | GET
| **Parameters** | +id: integer | user primary key
| **UI** | A completar
| **SUBMIT** | R108
| **Permissions** | OWN

R108: Edit Profile Action

|   |   |   |
|--:|---|---|
| **URL** | /edit_profile/{id}
| **Description** | Web resource that changes user profile info based on the input received. Redirects to the user profile on success and edit profile page on failure. 
| **Method** | POST
| **Parameters** | +id: integer | user primary key
| **Request body** | ?username: string | New username
|              | ?picture: string | New profile picture path
|              | ?name: string | New name
|              | ?password: string | New password
|              | ?quote: quote | New favourite quote
| **Redirects** | R106 | Success
|           | R107 | Error
| **Permissions** | OWN

R109: Password Recovery Form

|   |   |
|--:|---|
| **URL** | /password_reset
| **Description** | Page with a form to request a token to reset the password
| **Method** | GET
| **UI** | A completar
| **SUBMIT** | R101 (Password Action)
| **Permissions** | PUB

R110: Password Recovery Action

|   |   |   |
|--:|---|---|
| **URL** | /password_reset
| **Description** | Web resource that sends a reset password link to the specified email.
| **Method** | POST
| **Request Body** | +email: string | User email
| **Redirects** | R102 | Success
|           | R109 | Error
| **Permissions** | PUB
 
### 3.2 Module M02: User Administration and Static Pages

#### Endpoints of User Administration and Static pages

 * R201: Get Users /users
 * R202: Get Moderators /users
 * R203: Get Statistics /statistics
 * R204: Get Reports /reports
 * R205: Promote User /users/{id}/promote
 * R206: Demote Moderator /users/{id}/demote
 * R207: Ban User /users/{id}/ban
 * R208: About /about
 * R209: 404 /404

R201: Get Users

|   |   |
|--:|---|
| **URL** | /users
| **Description** | Get all registed users.
| **Method** | GET
| **UI** | UI14
| **Permissions** | ADM

R202: Get Moderators

|   |   |
|--:|---|
| **URL** | /users
| **Description** | Get all Moderators. The Moderators are Users. This works as a shortcut to access Moderators list.
| **Method** | GET
| **UI** | UI16
| **Permissions** | ADM

R203: Get Statistics

|   |   |
|--:|---|
| **URL** | /statistics
| **Description** | Get Statistics related to Posts, Comments and Reports.
| **Method** | GET
| **UI** | UI15
| **Permissions** | ADM

R204: Get Reports

|   |   |
|--:|---|
| **URL** | /reports
| **Description** | Get all Reports related to the Comments and Posts.
| **Method** | GET
| **UI** | UI17
| **Permissions** | ADM

R205: Promote User

|   |   |   |
|--:|---|---|
| **URL** | /users/{id}/promote
| **Description** | This web resource promotes a User (to Moderator).
| **Method** | PUT
| **Parameters** | +id: integer | User id
| **Returns** | 200 OK | The user was successfully promoted.
|                | 400 Bad Request | Error. Error message is specified via a HTTP header.
|                | 404 Not Found | Error. No user with the specified primary key exists.
| **Permissions** | ADM

R206: Demote Moderator

|   |   |   |
|--:|---|---|
| **URL** | /users/{id}/demote
| **Description** | This web resource demotes a Moderator (to Member).
| **Method** | PUT
| **Parameters** | +id: integer | User (moderator) id
| **Returns** | 200 OK | The user was successfully demoted.
|                | 400 Bad Request | Error. Error message is specified via a HTTP header.
|                | 404 Not Found | Error. No user (moderator) with the specified primary key exists.
| **Permissions** | ADM

R207: Ban User

|   |   |   |
|--:|---|---|
| **URL** | /users/{id}/ban
| **Description** | This web resource produces a banishment of particular user.
| **Method** | PUT
| **Parameters** | +id: integer | User id
| **Returns** | 200 OK | The user was successfully banned.
|                | 400 Bad Request | Error. Error message is specified via a HTTP header.
|                | 404 Not Found | Error. No user with the specified primary key exists.
| **Permissions** | ADM

R208: About

|   |   |
|--:|---|
| **URL** | /about
| **Description** | Get about page.
| **Method** | GET
| **UI** | UI19
| **Permissions** | PUB

R209: 404

|   |   |
|--:|---|
| **URL** | /404
| **Description** | Get 404 page.
| **Method** | GET
| **UI** | UI20
| **Permissions** | PUB

### 3.3 Module M03: Posts

* R301: View Posts /homepage
* R302: Search Post by Tag /homepage/{search}
* R303: Search Post by Category /homepage/{search}
* R304: View Link Post /post-link
* R305: View Text Post /post
* R306: View Image Post /post-image
* R307: Submit Post Form /sub-params
* R308: Submit Post Action /sub-params/{id}

R301: View Posts

|   |   |   |
|--:|---|---|
| **URL** | /homepage
| **Description** | Shows a few posts made by the users of the system
| **Method** | GET
| **UI** | UI01
| **Permissions** | PUB


R302: Search Post by Tag

|   |   |   |
|--:|---|---|
| **URL** | /homepage/{search}
| **Description** | Shows a few posts made by the users of the system with a specific tag
| **Method** | GET
| **Parameters** | ?query: string | String field to search for in posts
|                | ?tag: string | String Tag of the post
|                | ?author: string | Author of the post
|                | ?content: string | Content of the post
| **UI** | UI01
| **Response body** | JSON201
| **Permissions** | PUB


R303: Search Post by Category

|   |   |   |
|--:|---|---|
| **URL** | /homepage/{search}
| **Description** | Shows a few posts made by the users of the system with a specific tag
| **Method** | GET
| **Parameters** | ?query: string | String field to search for in posts
|                | ?category: string | Category of the post
|                | ?author: string | Author of the post
|                | ?content: string | Content of the post
| **UI** | UI01
| **Response body** | JSON202
| **Permissions** | PUB


R304: View Link Post

|   |   |   |
|--:|---|---|
| **URL** | /post-link
| **Description** | Shows a Link Post
| **Method** | GET
| **UI** | UI03
| **Permissions** | PUB

R305: View Text Post

|   |   |   |
|--:|---|---|
| **URL** | /post
| **Description** | Shows a Text Post
| **Method** | GET
| **UI** | UI05
| **Permissions** | PUB

R306: View Image Post

|   |   |   |
|--:|---|---|
| **URL** | /post-image
| **Description** | Shows an Image Post
| **Method** | GET
| **UI** | UI06
| **Permissions** | PUB

R307: Submit Post Form

|   |   |   |
|--:|---|---|
| **URL** | /sub-params
| **Description** | Page with a form to submit a new post
| **Method** | GET
| **Parameters** | +id: integer | User primary key
| **UI** | UI09
| **SUBMIT** | R308
| **Permissions** | PUB


R308: Submit Post Action

|   |   |   |
|--:|---|---|
| **URL** | /sub-params/{id}
| **Description** | Web Resource for the user to submit a post
| **Method** | POST
| **Parameters** | +id: integer | User primary key
| **UI** | UI01
| **Request Body** | ?title: string | Post title
|                  | ?content: string | Post content
|                  | ?image: string | Post image
|                  | ?link: string | Post link
|                  | ?source: string | Post source
| **Redirects** | R301 | Success
|               | R307 | Error
| **Permissions** | PUB

### 3.3 Module M04:

R401: View inbox


|   |   |   |
|--:|---|---|
| **URL** | /inbox
| **Description** | Shows a list of conversations belonging to a user
| **Method** | GET
| **UI** | UI12
| **Permissions** | USR

R402: Open_inbox form


|   |   |   |
|--:|---|---|
| **URL** | /open_inbox
| **Description** | Shows a conversation between users
| **Method** | GET
| **UI** | UI13
| **Permissions** | USR


R403: Open_inbox action

|   |   |   |
|--:|---|---|
| **URL** | /../open_inbox
| **Description** | Page that displays a conversation between the authenticated user and a friend
| **Method** | POST
| **Parameters** | +id: integer | User primary key
| **Request Body** | ?body: string | Message
| **Permissions** | USR


## 4. 
/XML Types
```
JSON201: Search by Tag
{
  "post": [
    {
      "id": "1",
      "title": "Netflix cancels 'Everything Sucks'",
      "url: https://dummylink.com"
      "tag: everything sucks"
      "category: TV"
    },
    {
      "id": "15",
      "title": "Boss Baby the series now on movie",
      "opinion: Lorem ipsum dona beu."
      "source: https://dummylink.com"
      "tag: boss baby"
      "category: TV"
    }
  ]
}

JSON201: Search by Category
{
  "post": [
    {
      "id": "2",
      "title": "A Series of Unfortunate Events is amazing",
      "image: https://dummyimage.com/images/asoue.jpg"
      "tag: a series of unfortunate events"
      "category: TV"
    },
    {
      "id": "13",
      "title": "Lady Bird wins the Oscar",
      "url: https://dummylink.com"
      "tag: lady bird"
      "category: Movie"
    }
  ]
}
```



 
## Web resources descriptors <note important>Do not include on the final artefact</note>
 
  * URL - Resource identifier, following the RESTful resource naming conventions 
  * Description - Describe the resource, when it's used and why
  * UI - Reference to the A3 user interface used by the resource
  * SUBMIT - Reference to the actions/requests integrated with the resource
  * Method - HTTP request Method
  * Parameters - Information that is sent through the URL, by a query string or path
  * Request Body - Data associated and transmitted with each request
  * Returns - HTTP code returned from a request
  * Response Body - Data sent from the server, in response to a given request
  * Permissions - Required permissions to access the resource
 
## Revision history
 
Changes made to the first submission:
1. Item 1
1. Item 2
 
***
 
GROUP1742, 06/03/2018
 
> Bernardo José Coelho Leite, up201404464@fe.up.pt  
> José Pedro da Silva e Sousa Borges, up201503603@fe.up.pt  
> Miguel Mano Fernandes, up201503538@fe.up.pt  
> Ventura de Sousa Pereira, up201404690@fe.up.pt  
