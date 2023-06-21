select * from courses where upper(description)='UNKNOWN';

select count(*),sum(quantity) 
from courses_x_professors_with_grades join courses on courses.id=courses_x_professors_with_grades.course_ID
where upper(description)='UNKNOWN';

delete
from courses_x_professors_with_grades 
where course_ID in (select id from courses where upper(description)='UNKNOWN');