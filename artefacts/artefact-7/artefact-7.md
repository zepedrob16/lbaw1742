# A7: High-level architecture. Privileges. Web resources specification
 
## 1. Overview
 
> Identify and overview the modules that will be part of the application.
 
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
 
### 3.1 Module M01:

R101: Login Form

|   |   |
|--:|---|
| **URL** | /login
| **Description** | Page with a login form to authenticate a user into his account
| **Method** | GET
| **UI** | UI06
| **SUBMIT** | R101 (Deve redirecionar para login action)
| **Permissions** | PUB

R101: Login Action

|   |   |   |
|--:|---|---|
| **URL** | /register
| **Description** | This web resource logs out the authenticated user of admin.
| **Method** | POST
| **Request Body** | +email: string, +username: string | Email or Username
|              | +password: string | Password
| **Redirects** | R101 (Deve redirecionar para homepage) | Success
|           | R101 (Para login novamente)            | Error
| **Permissions** | PUB

R101: Logout Action

|   |   |   |
|--:|---|---|
| **URL** | /logout
| **Description** | This web resource logs out the authenticated user or admin.
| **Method** | POST
| **Redirects** | R101 (LOGIN) | Success
| **Permissions** | USR, ADM

R101: Signup Form

|   |   |
|--:|---|
| **URL** | /signup
| **Description** | Page with a form to register a new user account
| **Method** | GET
| **UI** | UI01 (já vou ver)
| **SUBMIT** | R101
| **Permissions** | PUB

R101: Signup Action

|   |   |   |
|--:|---|---|
| **URL** | /signup
| **Description** | This web resource inserts a new user into the system. Redirects to the homepage on success and the register form on failure.
| **Method** | POST
| **Request Body** | +username: string | Username
|              | +email: string | Email
|              | +password: string | Password
|              | +confirmPassword: string | Password confirmation
| **Redirects** | R101 (Homepage) | Success
|           | R101 (Signup) | Error
| **Permissions** | PUB

R101: View Profile

|   |   |   |
|--:|---|---|
| **URL** | /profile/{id}
| **Description** | Shows the user's profile
| **Method** | GET
| **Parameters** | +id: integer | user primary key
| **UI** | UI01 (já vou ver)
| **Permissions** | USR

R101: Edit Profile Form

|   |   |   |
|--:|---|---|
| **URL** | /edit_profile/{id}
| **Description** | Edits the current user's profile
| **Method** | GET
| **Parameters** | +id: integer | user primary key
| **UI** | UI01
| **SUBMIT** | R101 (Para o edit profile action)
| **Permissions** | OWN

R101: Edit Profile Action

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
| **Redirects** | R101 (Profile)      | Success
|           | R101 (Edit_profile) | Error
| **Permissions** | OWN

R101: Password Recovery Form

|   |   |
|--:|---|
| **URL** | /password_reset
| **Description** | Page with a form to request a token to reset the password
| **Method** | GET
| **UI** | UI01
| **SUBMIT** | R101 (Password Action)
| **Permissions** | PUB

R101: Password Recovery Action

|   |   |   |
|--:|---|---|
| **URL** | /password_reset
| **Description** | Web resource that sends a reset password link to the specified email.
| **Method** | POST
| **Request Body** | +email: string | User email
| **Redirects** | UI01 | Success
|           | R109 | Error
| **Permissions** | PUB
 
### 3.2 Module M02: User Administration and Static Pages

#### Endpoints of User Administration and Static pages

  * R201: Get Users /users
  * R201: Get Moderators /users
  * R201: Get Statistics /statistics
  * R201: Get Reports /reports
  * R201: Promote User /users/{id}/promote
  * R201: Demote Moderator /users/{id}/demote
  * R201: Ban User /users/{id}/ban
  * R201: About /about
  * R201: 404 /404

R201: Get Users

|   |   |
|--:|---|
| **URL** | /users
| **Description** | Get all registed users.
| **Method** | GET
| **UI** | UI14
| **Permissions** | ADM

R201: Get Moderators

|   |   |
|--:|---|
| **URL** | /users
| **Description** | Get all Moderators. The Moderators are Users. This works as a shortcut to access Moderators list.
| **Method** | GET
| **UI** | UI16
| **Permissions** | ADM

R201: Get Statistics

|   |   |
|--:|---|
| **URL** | /statistics
| **Description** | Get Statistics related to Posts, Comments and Reports.
| **Method** | GET
| **UI** | UI15
| **Permissions** | ADM

R201: Get Reports

|   |   |
|--:|---|
| **URL** | /reports
| **Description** | Get all Reports related to the Comments and Posts.
| **Method** | GET
| **UI** | UI17
| **Permissions** | ADM

R201: Promote User

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

R201: Demote Moderator

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

R201: Ban User

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

R201: About

|   |   |
|--:|---|
| **URL** | /about
| **Description** | Get about page.
| **Method** | GET
| **UI** | UI19
| **Permissions** | PUB

R201: 404

|   |   |
|--:|---|
| **URL** | /404
| **Description** | Get 404 page.
| **Method** | GET
| **UI** | A colocar
| **Permissions** | PUB

### 3.3 Module M03:

R301: View Posts

|   |   |   |
|--:|---|---|
| **URL** | /homepage
| **Description** | Shows a few posts made by the users of the system
| **Method** | GET
| **UI** | UI01 (já vou ver)
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
| **UI** | UI01 (já vou ver)
| **Response body** | JSON201 (**mudar isto**)
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
| **UI** | UI01 (já vou ver)
| **Permissions** | PUB


R304: View Link Post

|   |   |   |
|--:|---|---|
| **URL** | /post-link
| **Description** | Shows a Link Post
| **Method** | GET
| **UI** | UI01 (já vou ver)
| **Permissions** | PUB

R305: View Text Post

|   |   |   |
|--:|---|---|
| **URL** | /post
| **Description** | Shows a Text Post
| **Method** | GET
| **UI** | UI01 (já vou ver)
| **Permissions** | PUB

R306: View Image Post

|   |   |   |
|--:|---|---|
| **URL** | /post-image
| **Description** | Shows an Image Post
| **Method** | GET
| **UI** | UI01 (já vou ver)
| **Permissions** | PUB

R307: Submit Post Form

|   |   |   |
|--:|---|---|
| **URL** | /sub-params
| **Description** | Page with a form to submit a new post
| **Method** | GET
| **Parameters** | +id: integer | User primary key
| **UI** | UI01
| **SUBMIT** | R308 (Password Action)
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

R401: View homepage


|   |   |   |
|--:|---|---|
| **URL** | /homepage
| **Description** | Shows the initial page
| **Method** | GET
| **UI** | UI01 
| **Permissions** | PUB

R401: View inbox


|   |   |   |
|--:|---|---|
| **URL** | /inbox
| **Description** | Shows a list of conversations belonging to a user
| **Method** | GET
| **UI** | UI01 
| **Permissions** | USR

R401: Open_inbox form


|   |   |   |
|--:|---|---|
| **URL** | /open_inbox
| **Description** | Shows a conversation between users
| **Method** | GET
| **UI** | UI01 
| **Permissions** | USR


R402: Open_inbox action

|   |   |   |
|--:|---|---|
| **URL** | /../open_inbox
| **Description** | Page that displays a conversation between the authenticated user and a friend
| **Method** | POST
| **Parameters** | +id: integer | User primary key
| **UI** | UI01
| **Request Body** | ?body: string | Message
| **Permissions** | USR










## 4. JSON/XML Types
 
> Document the JSON or XML responses that will be used by the web resources.
 
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
 
GROUP17xx, xx/xx/2018
 
> Group member 1 name, email
> Group member 2 name, email
