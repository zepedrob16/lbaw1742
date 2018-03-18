# SHOWCHAN - Collaborative News
The goal of this project is to provide tv show and movie aficionados with daily news and updates of this media. This very system will be community-based since only registered members are allowed to both rate and comment each other's submissions, triggering healthy discussions.

# A4: Conceptual Data Model

## 1. Class diagram
<img src="showchan-uml.png" />
 
## 2. Additional Business Rules
Here are additional business rules the project required after further inspection.  

| Identifier | Name | Description |
| ---------- | ---- | ----------- |
| BR01 | Balance Update | When a user adds a post reaction, both the post's and the user's reaction balance is updated. |
| BR02 | Self Friend Request | A user can't send a friend request for himself. |
| BR03 | Auto Report | A user can't report himmself. |
 
## Revision history
* Fixed two instances of incorrect **generalization bifurcations**;
* Added missing **post author relationship**;
* Fixed **consistency of multiplicity** (* and 0..\*);
* Removed useless **Conversation class** and replaced it with simply ConversationMessage;
* Removed **derived attribute Full Name** since it may be easily calculated;
* Removed **Thread class** and simplified thread-based commenting relationships;
* Added derivation to **upvotes and downvotes** attributes;
* Overall **UML cleanup**, better structuring and organization.

 
***
 
GROUP1742, 06/03/2018
 
> Bernardo José Coelho Leite, up201404464@fe.up.pt  
> José Pedro da Silva e Sousa Borges, up201503603@fe.up.pt  
> Miguel Mano Fernandes, up201503538@fe.up.pt  
> Ventura de Sousa Pereira, up201404690@fe.up.pt  
