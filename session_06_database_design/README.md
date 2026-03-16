session_06_database_design

Part 1: Normalization
Student_Grades_Raw (Unnormalized Table)
The original table Student_Grades_Raw contains redundant information because multiple attributes repeat whenever a student enrolls in different courses.

| StudentID | StudentName | CourseID | CourseName | ProfessorName | ProfessorEmail | Grade |
|-----------|-------------|----------|------------|---------------|---------------|-------|
| 1 | Nguyen An | 101 | Database Systems | Dr. Le | le@uni.edu | A |
| 1 | Nguyen An | 102 | Web Development | Dr. Tran | tran@uni.edu | B+ |
| 2 | Tran Binh | 101 | Database Systems | Dr. Le | le@uni.edu | A- |

Task 1 – Problem Analysis
1. Redundant Columns
Several attributes repeat across multiple rows:
- StudentName repeats whenever the same student takes multiple courses.
- CourseName repeats for every student enrolled in the same course.
- ProfessorName repeats for each row containing the same course.
- ProfessorEmail also repeats multiple times.

This redundancy increases storage usage and may lead to data inconsistency.

2. Update Anomalies
Because of redundancy, several update anomalies may occur.

Professor Email Change
If a professor changes their email address, the update must be applied to multiple rows. Missing one update may result in inconsistent data.

Course Name Change
If a course name changes (for example from Database Systems to another name), every row containing that course must be updated.

Student Name Change
If a student updates their name, the change must be made in all rows where the student appears.

3. Transitive Dependencies
The table contains transitive dependencies, which violate Third Normal Form (3NF):

- `StudentID → StudentName`
- `CourseID → CourseName`
- `ProfessorName → ProfessorEmail`

In these cases, non-key attributes depend on other non-key attributes, which causes redundancy.

Task 2 – Normalization to Third Normal Form (3NF)
To eliminate redundancy and anomalies, the table is decomposed into four related tables:
- Students  
- Professors  
- Courses  
- Enrollments  
Normalized Schema

| Table Name | Primary Key | Foreign Keys | Non-key Attributes |
|-----------|-------------|-------------|-------------------|
| Students | StudentID | None | StudentName |
| Professors | ProfessorID | None | ProfessorName, ProfessorEmail |
| Courses | CourseID | ProfessorID | CourseName |
| Enrollments | (StudentID, CourseID) | StudentID, CourseID | Grade |

Explanation of Each Table
Students
Stores information about students.
Attributes:
- StudentID(Primary Key)
- StudentName
Each student appears only once in this table, eliminating repeated student information.

Professors
Stores information about professors.
Attributes:
- ProfessorID (Primary Key)
- ProfessorName
- ProfessorEmail
Separating professors prevents repeated storage of professor information.

Courses
Stores course information and links each course to a professor.
Attributes:
- CourseID(Primary Key)
- CourseName
- ProfessorID (Foreign Key referencing Professors)

Enrollments
Represents the relationship between students and courses.
Attributes:
- StudentID(Foreign Key referencing Students)
- CourseID (Foreign Key referencing Courses)
- Grade
Primary Key: (StudentID, CourseID)
This table resolves the many-to-many relationship between students and courses.
Final Result
By decomposing the original table into Students, Professors, Courses, and Enrollments, redundancy and update anomalies are removed. The resulting database structure satisfies Third Normal Form (3NF).

Part 2: Relationships
1. Author — Book
Relationship Type: One-to-Many (1:N)
One author can write multiple books, but each book is written by one author.
Foreign Key Location: `book.author_id`
2. Citizen — Passport
Relationship Type: One-to-One (1:1)
Each citizen has one passport, and each passport belongs to exactly one citizen.
Foreign Key Location: `passport.citizen_id`
3. Customer — Order
Relationship Type: One-to-Many (1:N)
A customer can place multiple orders, but each order belongs to one customer.
Foreign Key Location: `orders.customer_id`
4. Student — Class
Relationship Type: Many-to-Many (M:N)
A student can join multiple classes, and each class can contain many students.
Implemented using a junction table: `enrollments`
5. Team — Player
Relationship Type: One-to-Many (1:N)
A team can have multiple players, but each player belongs to one team.
Foreign Key Location: `players.team_id`