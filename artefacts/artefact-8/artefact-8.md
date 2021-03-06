# A8: Vertical prototype
 
## 0. Project Description (SHOWCHAN) 

The goal of this project is to provide tv show and movie aficionados with daily news and updates of this media. This very system will be community-based since only registered members are allowed to both rate and comment each other's submissions, triggering healthy discussions. 
 
## 1. Implemented Features
 
### 1.1. Implemented User Stories
 
| User Story reference | Name                   | Priority                   | Description                   |
| -------------------- | ---------------------- | -------------------------- | ----------------------------- |
| US12                 | Login                  | high                       | As an Visitor, I want to authenticate into the system, so that I can access privileged information. |
| US11                 | Register               | high                       | As Visitor, I want to register myself into the system, so that I can authenticate myself into the system. |
| US03                 | View Home Page         | high                       | As an User, I want to access home page, so that I can see a brief website's presentation. |
| US04                 | View About Page        | high                       | As an User, I want to access the about page, so that I can see a complete website's description. |
| US02                 | Check Profile           | high                       | As a Reader, I want to change my information, so that I can keep it updated (e.g. changing the password). |
 
### 1.2. Implemented Web Resources
 
Here are the web resources which were implemented in the prototype.
 
#### Module M01: Authentication and Individual Profile
 
| Web Resource Reference | URL                            |
| ---------------------- | ------------------------------ |
| R101: Login Form       | [/login](http://lbaw1742.lbaw-prod.fe.up.pt/login)                         |
| R102: Login Action     | POST /login                    |
| R103: Register Form    | [/register](http://lbaw1742.lbaw-prod.fe.up.pt/register)                      |
| R104: Register Action  | POST /register                 |
| R105: View all HomePage Posts | [/posts/](http://lbaw1742.lbaw-prod.fe.up.pt/posts)            |
| R106: View Post Content| /posts/{postnumber}            |
| R107: Create Post Form | [/posts/create](http://lbaw1742.lbaw-prod.fe.up.pt/posts/create)             |
| R108: Create Post Action | POST /posts/create             |
| R109: Edit Post Form   | [/posts/{postnumber}/edit](http://lbaw1742.lbaw-prod.fe.up.pt/posts/edit)       |
| R110: Edit Post Action | POST /posts/{postnumber}/edit  |
| R111: Password Reset Form | [/password/reset](http://lbaw1742.lbaw-prod.fe.up.pt/password/reset)       |
| R112: Password Reset Action | POST /password/reset  |
 
#### Module M02: User Administration and Static pages
 
| Web Resource Reference | URL                            |
| ---------------------- | ------------------------------ |
| R208: About            | [/about](http://lbaw1742.lbaw-prod.fe.up.pt/about)                         |
| R209: Error              | [/error](http://lbaw1742.lbaw-prod.fe.up.pt/error)                           |
 
 
## 2. Prototype

* The prototype is available at http://lbaw1742.lbaw-prod.fe.up.pt/.
* The code is available at http://github.com/zepedrob16/lbaw1742/tree/proto.

#### Credentials

* A test user has the username **bcurless0** and password **HmeeUgMD7**.  

## Revision history

Changes made to the first submission:
* Added Homepage to see all related Posts;
* Added the possibility to open an individual Post;
* Added the possibility to create a new Post and submit it;
* Added the possibility to edit a Post and resubmit it.
* Added the possibility to reset Password.
 
## Submission Information

GROUP1742, 22/04/2018

* Bernardo José Coelho Leite - [up201404464@fe.up.pt](mailto:up201404464@fe.up.pt)
* José Pedro da Silva e Sousa Borges - [up201503603@fe.up.pt](mailto:up201503603@fe.up.pt)
* Miguel Mano Fernandes - [up201503538@fe.up.pt](mailto:up201503538@fe.up.pt)
* Ventura de Sousa Pereira - [up201404690@fe.up.pt](mailto:up201404690@fe.up.pt)
