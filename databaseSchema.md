# Actor 

## Student
### Activities
 - Register and Login
 - Submit Project Title -> Coordinator
 - Upload Document -> Advisor
 - Send Feedback about Advisor--> Coordinator
### Table Related with Student
  - Users
  - Projects -> Title
  - Projects -> Document
  - Feedback -> Project Id

## Admin
  ### Activities
  - Approve Register Request
  - Manage User Info (CRUD)
  ### Table Related with Admin
  - Users
## Coordinator

  ### Activities
- Assign Advisor
- Approve Title
- Notify or Scheduling
  ### Table Related with Coordinator
- User
- Project --> Approve
- Project --> Due Date
- Feedback - mark as read

## Advisor
  ### Activities
- View Schedule 
- View Notification
- Give Comment 
- View Doc
  
  ### Table Related with Advisor
- Projects
- Comments 


## Tables

- Users
  - id
  - name
  - email
  - password 
  - student_id --> nullable
  - role
  - approved
- Project -> department
    - project_title
    - description
    - student_id --> fk 
    - adivisor_id --> fk
    - department
    - document
    - due Date
    - approved
- Feedback
    - content
    - student_id -> fk
    - adivisor_id ->fk
    - project_id --> fk
    - isRead
- Comments
  - content
  - project_id
  - user_id
  
