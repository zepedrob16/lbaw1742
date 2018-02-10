# A2: Actors and User Stories
 
## 1. Actors

For the TubeNews system, the actors are represented in Figure 1 and described in Table 1. 

Identifier | Description | Examples
-- | -- | --
User | Generic user. Has access to all public information, which includes all news and profiles. | n/a
Guest | A user which is not authenticated. Can either register on log in the system | n/a
Authenticated User | A user that has authenticated into his account on the system. Can read all news, upvote and downvote if desired, comment on any post, manage **his** comments, post a news item and manage **his** news items. | jlopes69
Moderator | An Authenticated User that has been promoted. Has all previous priviledges but can also remove comments and posts made by other users if needed. | jlopes69 
Admin | Authenticated user. Responsible for the management of users and for some specific supervisory and moderation functions. | admin

> Table 1: Identification of actors, including a brief description and examples.
 
## 2. User Stories
 
> User stories organized by actor.

For the TubeNews system, consider the user stories that are presented in the following sections.

 
### 2.1. User

Identifier | Name | Priority | Description
-- | -- | -- | --
US01 | Search | High |  As a *User*, I want the ability to search for all kind of news posted on the site.
US02 | Check Profiles | High | As a *User*, I want the ability to be check other user's profiles and my own.
US03 | Home Page | High | As a *User* I want to be able to view the Home Page of the system, so that I can better understand what the website is about.
US04 | About Page | High | As a *User* I want to be able to view the About Page of the system, so that I can see a description of the website and of the authors.

### 2.2. Guest

Identifier | Name | Priority | Description
-- | -- | -- | --
US11 | Register | High | As a *Guest* I want to register myself into the system, creating an account so that I can later authenticate myself whenever I want.
US12 | Log In | High | As a *Guest* I want to have the possibility to log into the system using an account that was previously created.
 
### 2.3. Authenticated User

Identifier | Name | Priority | Description
-- | -- | -- | --
US21 | Add Friend | High | As an *Authenticated User*, I want the possibility to add other users as my friend.
US22 | Filter | High |  As an *Authenticated User*, I want the possibility to filter and choose the content I pretend to read.
US23 | Profile | High | As an *Authenticated User* it is important to have configurable settings in order to define or change names, emails, passowords and avatar.
US24 | Comments  | High |  As an *Authenticated User*, I want to give my feedback about the existing publications.
US25 | Rank  | High |  As an *Authenticated User*, I want to contribute to a reliable rating of the site's content posts.
US26 | Share  | Medium |  As an *Authenticated User*, I want to share certain publications with my friends.
US27 | Post  | High |   As an *Authenticated User*, I want to write my own text and post it in the site so that everyone can read.
US28 | Check Statistics | Optional | As an *Authenticated User*, I want to be able to check my own statistics and of other users, such as Comments Posted, News Posted and Overall rating.

### 2.4. Moderator

Identifier | Name | Priority | Description
-- | -- | -- | --
US31 | Delete User Comments  | High | As a *Moderator* I may need to delete innapropriate comments made by some users.
US32 | Delete User Posts | High | As a *Moderator* I may need to delete innapropriate posts made by some users.
US33 | Change Post Location | Medium | As a *Moderator* I may need to change a news items' location if it was posted in the wrong place.

### 2.5. Admin

Identifier | Name | Priority | Description
-- | -- | -- | --
US41 | Name Moderators | High | As an *Admin* I want to elect Moderators to my system so that they can help manage the community.
US42 | Accept user | High | As an *Admin* I need to control who uses my system and the information that they need to give me so that I can verify they meet my requirements.
US43 | Ban Users | High | As an *Admin* I need to have the ability to ban Users, preventing them from reusing the system.
 
## A1. Annex: Supplementary requirements
 
> Annex including business rules, technical requirements, and restrictions.
> For each subsection, a table containing identifiers, names, and descriptions for each requirement.
 
### A1.1. Business rules

Identifier | Name | Description
-- | -- | --
BR01 | Profit | Users do not have any profit when posting news and/or comments.
BR02 | Profanity | Users should not post content that is innapropriate, such as pornographic or racist news.
 
### A1.2. Technical requirements

Identifier | Name | Description
-- | -- | --
TR01 | Availability | The system must be available practically 24 hours a day.
TR02 | Accessibility | The system must ensure that everyone can access the pages, regardless of whether they have any handicap or not, or the Web browser they use.
TR03 | Usability | The system should be simple and easy to use.
TR04 | Performance | The system should have response times shorter than 2s to ensure the user's attention.
TR05 | Web application | The system should be implemented as a Web application with dynamic pages (HTML5, JavaScript, CSS3 and PHP).
TR06 | Portability | The server-side system should work across multiple platforms (Linux, Mac OS, etc.).
TR07 | Database | The PostgreSQL database management system must be used.
TR08 | Security | The system shall protect information from unauthorised access through the use of an authentication and privilege verification system as well as security measures to prevent attackers.
TR09 | Robustness | The system must be prepared to handle and continue operating when runtime errors occur.
TR10 | Scalability | The system must be prepared to deal with the growth in the number of users and corresponding operations.
TR11 | Ethics | The system must respect the ethical principles in software development (for example, the password must be stored encrypted to ensure that only the owner knows it).
TR12 | Development | Git should be used to control software version envelopment.
 
### A1.3. Restrictions

Identifier | Name | Description
-- | -- | --
C01 | Deadline | The project must be developed throughout the semester and finished before the end of it.

 
***
 
## Revision history
No revision history to show.
 
***
 
GROUP1742, xx/xx/2018
