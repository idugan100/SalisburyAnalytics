#import completion stats report
select count(*)/574.16 , '% completed' from courses_x_professors_with_grades
Union
select count(*) , '# completed' from courses_x_professors_with_grades
Union
select count(*), 'professor count' from professors 
union
select count(*) , 'course count' from courses
union
select sum(quantity), 'total grades' from salisbuydata.courses_x_professors_with_grades;

