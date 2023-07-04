select sum(quantity) , "Grades"from courses_x_professors_with_grades
union
select count(*) , "Professors" from professors
union
select count(*) , "Courses" from courses
union 
select count(*), "Reviews" from reviews;
