#overall grade percentage break down
select sum(quantity)/(select sum(quantity)from salisbuydata.courses_x_professors_with_grades)*100 as 'percentage', grade 
from salisbuydata.courses_x_professors_with_grades 
group by grade ;

#department/course
select sum(quantity)/(select sum(quantity)from salisbuydata.courses_x_professors_with_grades join courses on courses_x_professors_with_grades.course_ID=courses.id 
where departmentCode="GEOG" and courseNumber=201)*100 as 'percentage',grade 
from salisbuydata.courses_x_professors_with_grades join courses on courses_x_professors_with_grades.course_ID=courses.id 
where departmentCode="GEOG" and courseNumber=201
group by grade;