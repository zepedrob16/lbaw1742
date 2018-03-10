# SHOWCHAN: Class Attribute
### User
* username: text
* password: text
* firstname: text
* lastname: text
* / fullname: text
* email: text
* datebirth: date
* nationality: text
* quote: text
* avatar: text
* upvotes: smallint
* downvotes: smallint
* / balance: smallint

### Member
* reports: smallint

### Moderator

### Admin

### Report
* timestamp: timestamptz
Restriction: just one report permitted per pair.

### Conversation
* title: text

### ConversationMessage
* body: text
* timestamp: timestamptz
* read: bool

### Friendship
* start: date

### FriendRequest
* accepted: bool

### Post
* title: text
* timestamp: timestamptz
* upvotes: smallint
* downvotes: smallint
* / balance: smallint

### ImagePost
* image: text
* source: text

### TextPost
* opinion: text
* source: text

### LinkPost
* url: text

### MediaCategory
* title: text

### MediaTag
* title: text
* rating: float

### PostComment
* body: text
* timestamp: timestamptz

### PostReaction
* balance: bit
