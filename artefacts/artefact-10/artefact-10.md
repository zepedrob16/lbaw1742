# A10: Product
 
## 0. Project Description (SHOWCHAN) 

The goal of this project is to provide television show and movie aficionados daily news and updates of this media. This very system will be community-based since only registered members are allowed to both rate and comment each other's submissions, triggering healthy discussions. 
 
## 1. Installation
### GitHub release
The GitHub release with the final version of the code was made available [here](#).

### Full Docker command for Docker Hub image testing
`docker pull aquelemiguel/lbaw1742`
 
## 2. Usage

### Product URL
The full product may be accessed [here](http://lbaw1742.lbaw-prod.fe.up.pt).
 
### 2.1. Administration Credentials
The administration URL was is avaliable [here](http://lbaw1742.lbaw-prod.fe.up.pt/admin/[ADMIN_ID]). The URL must be completed with the administrator user's ID.
 
| Username | Password |
| -------- | -------- |
| admin    | admin |
 
### 2.2. User Credentials
Here follow example user credentials for the three different types of user roles in the system.
 
| Type          | Username  | Password |
| ------------- | --------- | -------- |
| Regular user account | reguser    | regpass |
| Moderator account   | moduser    | modpass |
| Administrator account | adminuser | adminpass |
 
 
## 3. Application Help
No application help has been implemented.
 
 
## 4. Input Validation
* On the registration action, a user must introduce a **password with more than 6 characters**. This is accomplished via **HTML checking**.
* On the registration action, a user's **password confirmation must match with their desired password**. This is accomplished via **HTML checking**.
* On the registration action, the user's username must be unique. This is verified by **querying the database**.
* On the profile section, a user **may not send multiple friend requests** to the same user. This is accomplished by **querying the database** and **disallowing button presses**.
 
## 5. Check Accessibility and Usability
The website has been thoroughly tested for accessibility and usability and changes were made according to the feedback.

### Accessibility
This project's accessibility checklist may be found in the submission folder at **accessibility-checklist.pdf**.

### Usability
This project's usability checklist may be found in the submission folder at **usability-checklist.pdf**.
 
## 6. HTML & CSS Validation

### HTML Validation
This project's HTML has been validated and its results may be found in the submission folder at **html-validation.pdf**.

### CSS Validation
This project's CSS has been validated and its results may be found in the submission folder at **css-validation.pdf**.
> HTML: https://validator.w3.org/nu/
> https://jigsaw.w3.org/css-validator/

## 7. Revisions to the Project
Minor changes were made to the **stylesheet** but pages maintained their **general appearance and functionality**.  
Many extra user stories were implemented.

## 8. Implementation Details
 
### 8.1. Libraries Used
No external libraries were used. The website was developed simply using **jQuery** and **Bootstrap**.
 
### 8.2 User Stories
 
Here follow the proposed user stories and their corresponding state of implementation.  
Several new user stories were added too.
 
| US Identifier | Name    | Priority                       | Team members               | State  |
| ------------- | ------- | ------------------------------ | -------------------------- | ------ |
| US01          | Search | Important | Bernardo Leite  |  100%  |
| US02          | Check Profile | Mandatory | José Borges |  100%  |
| US03          | View Home Page | Mandatory | Bernardo Leite, Ventura Pereira |  100%  |
| US04          | View About Page | Optional | José Borges |  100%  |
| US05          | View Individual Post | Mandatory | José Borges, Miguel Mano |  100%  |
| US11          | Register | Mandatory | José Borges | 100% |
| US12          | Login | Mandatory | Bernardo Leite, José Borges | 100% |
| US21          | Add Friend | Important | José Borges, Miguel Mano, Ventura Pereira | 100% |
| US22          | Filter Information | Optional | Bernardo Leite | 100% |
| US23          | Check Profile | Optional | José Borges, Miguel Mano | 100% |
| US24          | Post Comments | Mandatory | José Borges, Miguel Mano | 100% |
| US25          | Upvote | Mandatory | Bernardo Leite, Ventura Pereira | 100% |
| US26          | Downvote | Mandatory | Bernardo Leite, Ventura Pereira | 100% |
| US27          | Share | Optional |  | 0% |
| US28          | Post | Mandatory | José Borges, Miguel Mano | 100% |
| US29          | Check Statistics | Optional | Bernardo Leite | 100% |
| US30          | Exchange Messages | Important | José Borges | 100% |
| US31          | View Post History | Optional | | 0% |
| US32          | Logout | Important | Miguel Mano, Ventura Pereira | 100% |
| US33          | Delete User Comments | Important | | 0% |
| US34          | Delete User Posts | Important | | 0% |
| US35          | Change Content Tags | Optional | | 0% |
| US41          | Name Moderators | Mandatory | Miguel Mano, Ventura Pereira | 100% |
| US42          | Promote Users | Important | Miguel Mano | 100% |
| US43          | Demote Users | Important | Ventura Pereira | 100% |
| US44          | Ban Users | Important | Miguel Mano, Ventura Pereira | 100%
| US45          | Enter Admin Control Panel | Mandatory | Bernardo Leite, Miguel Mano, Ventura Pereira | 100%
 

## 9. Group Specification
 
**GROUP1742**, 30/05/2018  

Bernardo José Coelho Leite, 201404464  
José Pedro da Silva e Sousa Borges, 201503603  
Miguel Mano Fernandes, 201503538  
Ventura de Sousa Pereira, 201404690
