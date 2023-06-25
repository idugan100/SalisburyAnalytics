Select courseTitle, departmentCode, courseNumber
from salisbuydata.courses_x_professors_with_grades
join courses on courses.id=course_ID
where professor_ID=823
group by course_ID
order by  sum(quantity) desc
limit 3;


Select firstName, lastName
from salisbuydata.courses_x_professors_with_grades
join professors on professors.id=professor_ID
where course_ID=256
group by professor_ID
order by  sum(quantity) desc
limit 4;