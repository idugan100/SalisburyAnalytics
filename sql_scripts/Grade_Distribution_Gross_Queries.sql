Select grade, sum(quantity)
from courses_x_professors_with_grades
join courses on courses.id=course_ID
where course_ID=3
group by grade
order by grade;

Select grade, sum(quantity)
from courses_x_professors_with_grades
join professors on professors.id=professor_ID
where professor_ID=3
group by grade
order by grade;