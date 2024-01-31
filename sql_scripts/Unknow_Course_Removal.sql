select * from courses where upper(description)='UNKNOWN';

select count(*),sum(quantity) 
from courses_x_professors_with_grades join courses on courses.id=courses_x_professors_with_grades.course_ID
where upper(description)='UNKNOWN';

-- delete course line items for unknown courses
delete
from courses_x_professors_with_grades 
where course_ID in (select id from courses where upper(description)='UNKNOWN');

-- delete unknown courses
delete from courses where  upper(description)='UNKNOWN';

-- delete professors that only taught an unknown courses
delete from professors where id not in (select distinct professor_ID from courses_x_professors_with_grades);